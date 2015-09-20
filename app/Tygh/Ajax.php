<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

namespace Tygh;

class Ajax
{
    private $_result = array();
    private $_progress_coefficient = 0;
    private $_progress_parts = 2;
    public $result_ids = array();
    public $skip_result_ids_check = false;
    public $content_type = "application/json";
    public $request_type = NULL;
    public $redirect_type = NULL;
    public $callback = NULL;
    const REQUEST_XML = 1;
    const REQUEST_IFRAME = 2;
    const REQUEST_COMET = 3;
    const REQUEST_JSONP = 4;
    const REQUEST_JSONP_POST = 5;

    /**
     * Create new Ajax backend object and start output buffer (buffer will be catched in destructor)
     */
    public function __construct()
    {
        $this->result_ids = !empty($_REQUEST['result_ids']) ? explode(',', str_replace(' ', '', $_REQUEST['result_ids'])) : array();
        $this->skip_result_ids_check = !empty($_REQUEST['skip_result_ids_check']);

        $this->_result = !empty($_REQUEST['_ajax_data']) ? $_REQUEST['_ajax_data'] : array();

        $this->request_type = (!empty($_REQUEST['is_ajax'])) ? $_REQUEST['is_ajax'] : self::REQUEST_XML;

        if (!empty($_REQUEST['callback'])) {
            $this->request_type = self::REQUEST_JSONP;
            $this->callback = $_REQUEST['callback'];
        }

        $this->redirect_type = $this->request_type;

        // Start OB handling early.
        if ($this->request_type != self::REQUEST_COMET) {
            ob_start();
        } else {
            $this->redirect_type = Ajax::REQUEST_IFRAME;
            Registry::set('runtime.comet', true);
        }

        $origin_host = '';
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $_purl = parse_url($_SERVER['HTTP_REFERER']);
            $origin_host = $_purl['host'];
            $origin_scheme = $_purl['scheme'];

            if ($origin_host != Registry::get('config.current_host')) { // cross-domain request
                fn_define('EMBEDDED', true);
                header('Access-Control-Allow-Origin: ' . $origin_scheme . '://' . $origin_host);
                header('Access-Control-Allow-Credentials: true');
            }
        }

        // Check if headers are already sent (see Content-Type library usage).
        // If true - generate debug message and exit.
        $file = $line = null;
        if (headers_sent($file, $line)) {
            trigger_error(
                "HTTP headers are already sent" . ($line !== null? " in $file on line $line" : "") . ". "
                . "Possibly you have extra spaces (or newlines) before first line of the script or any library. "
                . "Please note that Subsys_Ajax uses its own Content-Type header and fails if "
                . "this header cannot be set. See header() function documentation for details",
                E_USER_ERROR
            );
            exit();
        }
    }

    /**
     * Destructor: cache output and display valid javascript code
     */
    public function __destruct()
    {
        static $called = false;

        if ($called == false) {
            $called = true;

            $text = ($this->request_type != self::REQUEST_COMET) ? ob_get_clean() : '';

            if (!empty($this->result_ids)) {
                $result_ids = array();
                // get the matching ids
                foreach ($this->result_ids as $r_id) {
                    if (strpos($r_id, '*')) {
                        $clear_id = str_replace('*', '\w+?', $r_id);
                        preg_match_all('/<[^>]*?id=(?:\'|")(' . $clear_id . '\w*?)(?:\'|")[^>]*?>/isS', $text, $ids);
                        if (!empty($ids[1])) {
                            foreach ($ids[1] as $r_id2) {
                                $result_ids[] = $r_id2;
                            }
                        }
                    } else {
                        $result_ids[] = $r_id;
                    }
                }

                foreach ($result_ids as $r_id) {
                    if (strpos($text, ' id="' . $r_id . '">') !== false) {
                        $start = strpos($text, ' id="'.$r_id.'">') + strlen(' id="' . $r_id . '">');
                        $end = strpos($text, '<!--' . $r_id . '--></');
                        $this->assignHtml($r_id, substr($text, $start, $end - $start));
                    // Assume that all data should be put to div with this ID
                    } elseif ($this->skip_result_ids_check == true) {
                        $this->assignHtml($r_id, $text);
                    }
                }

                $text = '';
            }

            if (empty($this->_result['non_ajax_notifications'])) {
                $this->assign('notifications', fn_get_notifications());
            }

            if (!empty($_SESSION['from_url'])) {
                $from_url = $_SESSION['from_url'];
            } elseif (!empty($_REQUEST['from_url'])) {
                $from_url = $_REQUEST['from_url'];
            }

            // we call session saving directly
            session_write_close();

            // Prepare response
            $response = $this->_result;
            if (fn_string_not_empty($text)) {
                $response['text'] = trim($text);
            }
            $response = json_encode($response);

            if (!headers_sent()) {
                header(' ', true, 200); // force 200 header, because we still need to return content
            }

            if ($this->request_type == self::REQUEST_XML) {
                // Return json object
                header('Content-type: ' . $this->content_type);

            } elseif ($this->request_type == self::REQUEST_JSONP) {
                // Return jsonp object
                header('Content-type: ' . $this->content_type);
                $response = $this->callback . '(' . $response . ');';
            } elseif ($this->request_type == self::REQUEST_JSONP_POST) {
                // Return jsonp object

                header("X-Frame-Options: ", true);
                header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"'); // for IE cors
                $response = '<script type="text/javascript" src="' . Registry::get('config.current_location') . '/js/lib/jquery/jquery.min.js' . '"></script>
                             <script type="text/javascript">

                                var Tygh = {};
                                Tygh.$ = jQuery.noConflict(true);
                             </script>
                             <script type="text/javascript" src="' . Registry::get('config.current_location') . '/js/lib/postmessage/jquery.ba-postmessage.js' . '"></script>
                             <script type="text/javascript">Tygh.$.postMessage(
                                "' . fn_js_escape($response) . '",\'' . $from_url . '\');</script>';

            } else {
                // Return html textarea object
                $response = '<textarea>' . fn_html_escape($response) . '</textarea>';
            }

            fn_echo($response);
        }
    }

    /**
     * Assign php variable to pass it to javascript
     *
     * @param  string $var   variable name
     * @param  mixed  $value variable value
     * @return void
     */
    public function assign($var, $value)
    {
        $this->_result[$var] = $value;
    }

    /**
     * Assign html code for javascript backend
     *
     * @param  string $id   html element ID
     * @param  mixed  $code html code
     * @return void
     */
    public function assignHtml($id, $code)
    {
        $this->_result['html'][$id] = $code;
    }

    /**
     * Returns list of assigned vars
     *
     * @return array
     */
    public function getAssignedVars()
    {
        return $this->_result;
    }

    /**
     * Updates request type and start output buffer for soft-redirect
     *
     * @return void
     */
    public function updateRequest()
    {
        if ($this->request_type == self::REQUEST_COMET) {
            $this->request_type = self::REQUEST_IFRAME;
            ob_start();
        }
    }

    public function setStepScale($scale)
    {
        $this->_progress_parts--;

        if ($this->_progress_parts != 0 && $scale != 0) {
            $this->_progress_coefficient = (100 / $this->_progress_parts) / $scale;
        }
    }

    public function setProgressParts($parts)
    {
        $this->_progress_parts = $parts + 1;

        if ($this->_progress_coefficient == 0) {
            $this->setStepScale(1);
        }
    }

    public function progressEcho($text = '', $advance = true)
    {
        static $current_position = 0;
        static $force_output = false;

        if (!$force_output) {
            // Force browser to output content
            $str = str_repeat('.', 1024);
            fn_echo($str);

            $force_output = true;
        }

        if ($advance == true) {
            $progress = $this->_progress_coefficient;
            $current_position += $progress;

        }

        return fn_echo("<script type=\"text/javascript\">parent.Tygh.$('#comet_container_controller').ceProgress('setValue', " . json_encode(array('text' => $text, 'progress' => $current_position)) . ');</script>');
    }

    public function changeTitle($text = '')
    {
        return fn_echo("<script type=\"text/javascript\">parent.Tygh.$('#comet_container_controller').ceProgress('setTitle', " . json_encode(array('title' => $text)) . ');</script>');
    }
}
