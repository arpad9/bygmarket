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
use Tygh\Registry;

class Less extends \lessc
{
    protected $overrides = array();

    protected function injectVariables($args)
    {
        $this->pushEnv();
        $parser = new \lessc_parser($this, __METHOD__);
        foreach ($args as $name => $strValue) {
            if ($name{0} != '@') $name = '@'.$name;
            $parser->count = 0;
            $parser->buffer = (string) $strValue;
            if (!$parser->propertyValue($value)) {
                throw new \Exception("failed to parse passed in variable $name: $strValue");
            }

            $this->overrideSet($name, $value);
        }
    }

    protected function overrideSet($name, $value)
    {
        $this->overrides[$name] = $value;
    }

    protected function get($name, $default=null)
    {
        $current = $this->env;

        $isArguments = $name == $this->vPrefix . 'arguments';

        while ($current) {
            if ($isArguments && isset($current->arguments)) {
                return array('list', ' ', $current->arguments);
            }

            if (isset($this->overrides[$name])) {
                return $this->overrides[$name];
            } elseif (isset($current->store[$name]))

                return $current->store[$name];
            else {
                $current = isset($current->storeParent) ? $current->storeParent : $current->parent;
            }
        }

        return $default;
    }

    private function _editorFontVars($var, $params, $schema_field)
    {
        $vars = array();
        $vars[$var] = $params['family'];

        $size = $params['size'] . $schema_field['properties']['size']['unit'];
        // if we match size to var, do not add size to family
        if (!empty($schema_field['properties']['size']['match'])) {
            $vars[$schema_field['properties']['size']['match']] = !empty($schema_field['properties']['size']['clean']) ? $params['size'] : $size;
        } else {
            $vars[$var] = $size . ' ' . $vars[$var];
        }

        $schema_props = $schema_field['properties']['style'];
        if (!empty($schema_props)) {
            foreach ($schema_props as $s_type => $s_data) {
                $vars[$s_data['match']] = !empty($params['style'][$s_type]) ? $s_data['property'] : $s_data['default'];
            }
        }

        return $vars;
    }

    private function _editorGeneralVars($var, $params, $schema_field)
    {
        $vars = array();
        $parts = array();

        if ($schema_field['type'] == 'checkbox') {
            $vars[$var] = empty($params) ? $schema_field['off'] : $schema_field['on'];
        }

        return $vars;
    }

    private function _editorBackgroundVars($var, $params, $schema_field)
    {
        $vars = array();
        $parts = array();

        if (!empty($schema_field['properties'])) {
            foreach (array_keys($schema_field['properties']) as $element) {
                if (!empty($params[$element])) {
                    $el_data = '';
                    if ($element == 'image_data') {
                        $el_data = 'url(' . $params[$element] . ')';
                    } elseif ($element == 'image') {
                        $el_data = 'url(../media/images/custom/' . $params[$element] . '?' . time() . ')';
                    } else {
                        $el_data = $params[$element];
                    }

                    if (is_array($schema_field['properties'][$element])) {
                        if (!empty($schema_field['properties'][$element]['match'])) {
                            $vars[$schema_field['properties'][$element]['match']] = $el_data;
                        }
                    } else {
                        $parts[] = $el_data;
                    }
                }
            }

            $vars[$var] = implode(' ', $parts);
        }

        if (!empty($schema_field['gradient'])) {
            $vars[$schema_field['gradient']['match']] = $params['gradient'];
        }

        // Copy original var to another by condition
        if (!empty($schema_field['copies'])) {
            foreach ($schema_field['copies'] as $parameter => $conditions) {
                foreach ($conditions as $condition) {
                    $vars[$condition['match']] = ((!empty($params[$parameter]) && !empty($condition['inverse'])) || (empty($params[$parameter]) && empty($condition['inverse']))) ? $condition['default'] : $vars[$condition['source']];
                }
            }
        }

        return $vars;
    }

    public function editorVars($current_preset = array())
    {
        $path = fn_get_theme_path('[themes]/[theme]/presets/', 'C', Registry::get('runtime.company_id'));
        if (file_exists($path . 'schema.json')) {
            $schema = file_get_contents($path . 'schema.json');
            $schema = json_decode($schema);
            $schema = fn_object_to_array($schema);

        } else {
            $schema = array();
        }

        $_current_preset = db_get_field("SELECT data FROM ?:theme_presets WHERE preset_id = ?i", Registry::get('runtime.layout.preset_id'));
        if (!empty($_current_preset)) {
            $_current_preset = unserialize($_current_preset);
        }

        if (empty($current_preset)) {
            $current_preset = $_current_preset;
        } elseif (!empty($_current_preset['backgrounds'])) {
            // FIXME: this should be removed after image uploader refactoring
            foreach ($_current_preset['backgrounds'] as $var => $params) {
                if (!empty($params['image_data'])) {
                    $current_preset['backgrounds'][$var]['image_data'] = $params['image_data'];
                    $current_preset['backgrounds'][$var]['image_name'] = $params['image_name'];
                }
            }
        }

        $vars = array();

        if (!empty($current_preset['general'])) {
            foreach ($current_preset['general'] as $var => $params) {
                $schema_value = isset($schema['general']['fields'][$var]) ? $schema['general']['fields'][$var] : array();
                $vars = array_merge($vars, $this->_editorGeneralVars($var, $params, $schema_value));
            }
        }

        if (!empty($current_preset['colors'])) {
            $vars = array_merge($vars, $current_preset['colors']);
        }

        if (!empty($current_preset['backgrounds'])) {
            foreach ($current_preset['backgrounds'] as $var => $params) {
                $schema_value = isset($schema['backgrounds']['fields'][$var]) ? $schema['backgrounds']['fields'][$var] : array();
                $vars = array_merge($vars, $this->_editorBackgroundVars($var, $params, $schema_value));
            }
        }

        if (!empty($current_preset['fonts'])) {
            foreach ($current_preset['fonts'] as $var => $params) {
                $schema_value = isset($schema['fonts']['fields'][$var]) ? $schema['fonts']['fields'][$var] : array();
                $vars = array_merge($vars, $this->_editorFontVars($var, $params, $schema_value));
            }
        }

        if (!empty($current_preset['buttons'])) {
            foreach ($current_preset['buttons'] as $var => $params) {

                $schema_field = isset($schema['buttons']['fields'][$var]['properties']) ? $schema['buttons']['fields'][$var]['properties'] : array();

                if (!empty($schema_field['font'])) {
                    $vars = array_merge($vars, $this->_editorFontVars($var, $params['font'], $schema_field['font']));
                }

                if (!empty($schema_field['background'])) {
                    $vars = array_merge($vars, $this->_editorBackgroundVars($var, $params['background'], $schema_field['background']));
                }

                if (!empty($schema_field['border'])) {
                    if (!empty($schema_field['border']['properties']['border'])) {
                        $parts = array();

                        foreach (array_keys($schema_field['border']['properties']['border']) as $element) {
                            if (!empty($params['border'][$element])) {
                                if ($element == 'width') {
                                    $params['border'][$element] = $params['border'][$element] . $schema_field['border']['properties']['border'][$element]['unit'];
                                }
                                $parts[] = $params['border'][$element];
                            }
                        }

                        $vars[$schema_field['border']['properties']['border']['match']] = implode(' ', $parts);
                    }

                    if (!empty($schema_field['border']['properties']['border_radius'])) {
                        $vars[$schema_field['border']['properties']['border_radius']['match']] = $params['border']['radius'] . $schema_field['border']['properties']['border_radius']['unit'];
                    }
                }
            }
        }

        fn_set_hook('less_variables_compiler', $schema, $vars);

        return $this->setVariables($vars);
    }

    public static function parseUrls($content, $from_path, $to_path)
    {
        if (preg_match_all("/url\((?![\"]?data\:).*?\)/", $content, $m)) {
            $relative_path = self::_relativePath($from_path, $to_path);

            foreach ($m[0] as $match) {
                $url = trim(str_replace('url(', '', $match), "'()\"");
                $url = $relative_path . '/' . preg_replace("/^(\.\.\/)+media\//", '', $url);

                $content = str_replace($match, "url('" . $url . "')", $content);
            }
        }

        return $content;
    }

    private static function _relativePath($from, $to)
    {
        $from = fn_normalize_path($from);
        $to = fn_normalize_path($to);

        $_from = explode('/', rtrim($from, '/'));
        $_to = explode('/', rtrim($to, '/'));

        while (count($_from) && count($_to) && ($_from[0] == $_to[0])) {
            array_shift($_from);
            array_shift($_to);
        }

        return str_pad('', count($_from) * 3, '../') . implode('/', $_to);
    }
}
