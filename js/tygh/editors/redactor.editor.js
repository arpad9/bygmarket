/* editior-description:text_redactor */
(function(_, $) {
    $.ceEditor('handlers', {

		editorName: 'redactor',
		params: null,
        elms: [],

        run: function(elm, params) {

            var lang_code = _.cart_language;

            if (typeof($.fn.redactor) == 'undefined') {
                $.ceEditor('state', 'loading');
                $.ceEditor('push', elm);
                $.loadCss(['js/lib/redactor/redactor.css']);

                var callback = function() {
                    // Load elFinder
                    $.loadCss(['js/lib/elfinder/css/elfinder.css']);
                    $.getScript('js/lib/elfinder/js/elfinder.min.js');

                    $.getScript('js/lib/redactor/redactor.min.js', function() {
                        $.ceEditor('state', 'loaded', params);
                    });
                };

                if (lang_code != 'en') {
                    $.getScript('js/lib/redactor/lang/' + lang_code + '.js', function() {
                        callback();
                    });
                } else {
                    callback();
                }

                return true;
            }

			if (!this.params) {
				this.params = {
					lang: lang_code
				};
            }

            if (typeof params !== 'undefined' && params[this.editorName]) {
                $.extend(this.params, params[this.editorName]);
            }

            this.params.callback = function(obj)
            {
                obj.addBtnBefore('video', 'image', 'Image', function(obj, e, key) {
                    // Start button processing
                    obj.saveSelection();

                    var modal_image = String() +
                        '<div id="redactor_modal_content">' +
                            '<div id="redactor_tab3" class="redactor_tab">' +
                                '<label>' + RLANG.image_web_link + '</label>' +
                                '<span>' + 
                                    '<input type="text" name="redactor_file_link" id="redactor_file_link" class="redactor_input"  />' +
                                    '<a class="redactor_modal_btn" style="margin-left: 0px; margin-top: 10px;" id="elfinder_control">'+ _.tr("browse") +'</a>' +
                                '</span>' + 
                            '</div>' +
                        '</div>' +
                        '<div id="redactor_modal_footer">' +
                            '<a href="javascript:void(null);" class="redactor_modal_btn redactor_btn_modal_close">' + RLANG.cancel + '</a>' +
                            '<input type="button" name="upload" class="redactor_modal_btn" id="redactor_upload_btn_elfinder" value="' + RLANG.insert + '" />' +
                        '</div>';

                    var callback = $.proxy(function()
                    {
                        $('#redactor_upload_btn_elfinder').click($.proxy(this.imageUploadCallbackLink, this));
                        $('#redactor_file_link').focus();

                        var elf_config = {
                            url  : fn_url('elf_connector.images?ajax_custom=1')
                        };

                        $('#elfinder_control').click(function(){
                            $('<div id="elfinder_browser" />').elfinder({
                                url : fn_url('elf_connector.images?ajax_custom=1'),
                                lang : 'en',
                                dialog: {width: 900, modal: true, title: _.tr('file_browser')},
                                cutURL: _.current_location + '/',
                                closeOnEditorCallback : true,
                                places: '',
                                view: 'list',
                                disableShortcuts: true,
                                editorCallback: function(file) {
                                    $('#redactor_file_link').val(_.current_location + '/' + file);
                                }
                            });
                            $(".el-finder-dialog").css({'z-index': 50001});
                        });

                    }, obj);

                    obj.modalInit(RLANG.image, modal_image, 610, callback);

                    // End button processing
                });
            }

            this.params.buttons = ['html', '|', 'formatting', '|', 'bold', 'italic', 'deleted', '|', 'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
                    'video', 'file', 'table', 'link', '|',
                    'fontcolor', 'backcolor', '|', 'alignment', '|', 'horizontalrule']; // 'underline', 'alignleft', 'aligncenter', 'alignright', 'justify'

            // Launch Redactor
            elm.redactor(this.params);

            if ($(elm).prop('disabled')) {
                elm.ceEditor('disable', true);
            }

            this.elms.push(elm.get(0));

            return true;
        },

        destroy: function(elm) {
            elm.destroyEditor();
        },

        recover: function(elm) {
            if ($.inArray(elm.get(0), this.elms) !== -1) {
                $.ceEditor('run', elm);
            }
        },
               
        val: function(elm, value) {
            if (typeof(value) == 'undefined') {
                return $(elm).getCode();
            } else {
                $(elm).setCode(value);
            }
            return true;
        },

        updateTextFields: function(elm) {
            return true;
        },

        disable: function(elm, value) {
            var obj = $('#' + elm.prop('id')).getObject().$box;
            if (value == true) {
                $(obj).wrap("<div class='wysiwyg_overlay_wrap'></div>");
                $(obj).before("<div id='" + elm.prop('id') + "_overlay' class='wysiwyg_overlay'></div>");
            } else {
                $(obj).unwrap();
                $('#' + elm.prop('id') + '_overlay').remove();
            }

        }
    });
}(Tygh, Tygh.$));
