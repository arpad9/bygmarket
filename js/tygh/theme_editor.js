(function(_, $) {

    var link_iterator = 0;
    var disable_value_changer = false;
    var preset_changed = false;
    var form_initial_state = '';

    // Do not initialize in embedded mode
    if (_.embedded) {
        return false;
    }

    /*
     *
     * Color generator for CSS Editor
     *
     */
    (function($){

        var base_color = {"h": Math.floor(Math.random() * 360), "s": 100, "b": 100};
        var algorithm = '';
        var variant = '';
        var data = {};
        var color_pickers;
        var variant_keys = ['s', 'b'];

        var methods = {

            init: function() {
                var self = $(this);

                data = self.data('caTEColorGenerator') || null;

                var self_id = self.prop('id');

                // set base color
                var color_picker = $('#storage_elm_' + self_id + '_color');
                var hex = '#' + methods._HSBToHex(base_color);
                color_picker.val(hex);

                // init algorithm selectbox
                var alg = $('#elm_' + self_id + '_algorithm');
                algorithm = alg.val();
                alg.on('change', function() {
                    algorithm = alg.val();
                    self.ceTEditorColorGenerator('generate');
                });

                // init variations selectbox
                var sb_variant = $('#elm_' + self_id + '_variant');
                variant = sb_variant.val();
                sb_variant.on('change', function() {
                    variant = sb_variant.val();
                    self.ceTEditorColorGenerator('generate');
                });
            },

            change_base_color: function(hsb) {
                base_color = hsb;
            },

            generate: function() {
                var result_colors = $(this).ceTEditorColorGenerator('_form_colors_array');
                var subc, i, m;

                // apply modifiers
                for (subc in result_colors) {
                    for (i in result_colors[subc]) {
                        if (typeof(data.variants[variant][i]) != 'undefined') {
                            var modifier = data.variants[variant][i];
                            for (m in modifier) {
                                if (modifier[m] <= 1) {
                                    result_colors[subc][i][variant_keys[m]] *= modifier[m];
                                } else {
                                    result_colors[subc][i][variant_keys[m]] = modifier[m];
                                }
                            }
                        }
                    }
                }

                // make one-level array
                var colors = [];
                var j = 0;
                for (subc in result_colors) {
                    for (i in result_colors[subc]) {
                        colors[j++] = methods._fixHSB(result_colors[subc][i]);
                    }
                }

                // fill pickers
                color_pickers.each(function(i) {
                    if (typeof(colors[i]) != 'undefined') {
                        var self = $(this);

                        var hex = '#' + methods._HSBToHex(colors[i]);
                        self.val(hex);
                    }
                });
            },

            _form_colors_array: function() {
                var colors = [];
                var subc;

                color_pickers = $(this).parents('.cm-te-section').find('.te-color-generate');
                var length = color_pickers.length;

                if (typeof(length) == 'undefined' || !length || typeof(data.algorithms[algorithm]) == 'undefined') {
                    return colors;
                }

                var alg_colors = data.algorithms[algorithm];
                var subcount = Math.ceil(length / alg_colors.length);
                for (subc in alg_colors) {
                    colors[subc] = [];
                    var fill_color = base_color.h;
                    fill_color += alg_colors[subc];
                    fill_color %= 360;
                    for (i = 0; i < subcount; i++) {
                        colors[subc][i] = {
                            "h": fill_color,
                            "s": base_color.s,
                            "b": base_color.b
                        };
                    }
                }
                return colors;
            },

            _HSBToHex: function(hsb) {
                return methods._RGBToHex(methods._HSBToRGB(hsb));
            },

            _RGBToHex: function(rgb) {
                var hex = [
                    rgb.r.toString(16),
                    rgb.g.toString(16),
                    rgb.b.toString(16)
                ];
                $.each(hex, function (nr, val) {
                    if (val.length == 1) {
                        hex[nr] = '0' + val;
                    }
                });
                return hex.join('');
            },

            _HSBToRGB: function(hsb) {
                var rgb = {};
                var h = Math.round(hsb.h);
                var s = Math.round(hsb.s * 255 / 100);
                var v = Math.round(hsb.b * 255 / 100);
                if(s === 0) {
                    rgb.r = rgb.g = rgb.b = v;
                } else {
                    var t1 = v;
                    var t2 = (255 - s) * v / 255;
                    var t3 = (t1 - t2) * (h % 60) / 60;
                    if (h == 360) {
                        h = 0;
                    }
                    if (h < 60) {
                        rgb.r = t1;
                        rgb.b = t2;
                        rgb.g = t2+t3;
                    } else if (h < 120) {
                        rgb.g = t1;
                        rgb.b = t2;
                        rgb.r = t1-t3;
                    } else if(h < 180) {
                        rgb.g = t1;
                        rgb.r = t2;
                        rgb.b = t2+t3;
                    } else if(h < 240) {
                        rgb.b = t1;
                        rgb.r = t2;
                        rgb.g = t1-t3;
                    } else if(h < 300) {
                        rgb.b = t1;
                        rgb.g = t2;
                        rgb.r = t2+t3;
                    } else if(h < 360) {
                        rgb.r = t1;
                        rgb.g = t2;
                        rgb.b = t1-t3;
                    } else {
                        rgb.r = 0;
                        rgb.g = 0;
                        rgb.b = 0;
                    }
                }
                return {
                    r: Math.round(rgb.r),
                    g: Math.round(rgb.g),
                    b: Math.round(rgb.b)
                };
            },

            _fixHSB: function (hsb) {
                return {
                    h: Math.min(360, Math.max(0, hsb.h)),
                    s: Math.min(100, Math.max(0, hsb.s)),
                    b: Math.min(100, Math.max(0, hsb.b))
                };
            }
        };

        $.fn.ceTEditorColorGenerator = function(method) {
            if (methods[method]) {
                return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply(this, arguments);
            } else {
                $.error('ty.TEditorColorGenerator: method ' +  method + ' does not exist');
            }
        };
    })($);


    function formParams()
    {
        var elms = $('[name^="preset[data]"]', $('#theme_editor'));
        var s = '';
        var params = [];

        elms.each(function() {
            var self = $(this);

            if (self.hasClass('cm-te-skip-css')) {
                return;
            }

            if (self.is('input[type=checkbox]') && !self.prop('checked')) {
                return;
            }

            if (self.is('input[type=radio]') && !self.prop('checked')) {
                return;
            }

            params[self.prop('name')] = self.val();
        });

        for (var k in params) {
            s += '&' + escape(k) + '=' + escape(params[k]);
        }

        return s;
    }

    function updateCss(url)
    {
        link_iterator++;

        $.toggleStatusBox('show');

        var link = $('<link/>', {
            type: 'text/css',
            rel: 'stylesheet',
            media: 'screen',
            id: 'theme_editor_css_' + link_iterator
        }).appendTo('head');


        link.prop('href', $.attachToUrl(url, 'x=' + Math.random()));

        link.on('load', function() {
            // We should keep 2 link elements to avoid flickering when styles are reloaded
            var obsolete_link = $('#theme_editor_css_' + (link_iterator - 1));
            if (obsolete_link.length) {
                obsolete_link.remove();
            }
                        
            $.toggleStatusBox('hide');
        });
    }

    function serializeForm()
    {
        var form = $('form[name=theme_editor_form]');
        var serialized_data = $('[name^="preset[data]"]', form).serialize();
        $('input[type=file]', form).each(function() {
            serialized_data += $(this).val();
        });

        return serialized_data;
    }

    function isFormChanged()
    {
        if (serializeForm() == form_initial_state) {
            return false;
        }

        return true;
    }

    function setPresetStatus(status)
    {
        var s_elm = $('#theme_editor .cm-te-load-preset.active');
        var t_elm = $('#theme_editor span.cm-preset-title');
        var text = s_elm.html();
        var changed_text = ' *';

        if (!text) {
            return false;
        }

        if (status == 'changed') {
            preset_changed = true;
            if (text.indexOf(changed_text) === -1) {
                s_elm.html(text + changed_text);
                t_elm.html(text + changed_text);
            }
        } else if (status === 'clear') {
            preset_changed = false;
            if (text.indexOf(changed_text) !== -1) {
                s_elm.html(text.str_replace(changed_text, ''));
                t_elm.html(text.str_replace(changed_text, ''));
            }
        }

        return true;
    }

    function getUrlFromCss(prop)
    {
        var url = prop.str_replace('url(', '');
        url = url.str_replace(')', '');
        url = url.str_replace('"', '');

        return url;
    }

    $(document).ready(function() {

        $('#' + _.init_container).addClass('te-mode');
        $.ceAjax('request', fn_url('theme_editor.view'), {
            result_ids: 'theme_editor',
            data: {
                theme_url: _.current_location + '/' + _.current_url
            },
            callback: function() {

                var current_css = $('link[href*=standalone]');
                var css_filename = current_css.prop('href').split('/').pop();
                var editor_url = 'theme_editor.get_css?css_filename=' + encodeURIComponent(css_filename) + '&';

                // FIXME: this event catches logout link click
                $(_.doc).on('click', 'a.account,.cm-te-change-layout', function(e) {
                    e.stopImmediatePropagation();
                    return true;
                });

                $('#theme_editor').on('click', '.cm-te-close-editor', function(e) {
                    e.stopImmediatePropagation();
                    var langvar = preset_changed ? _.tr('theme_editor.text_close_editor_unsaved') : _.tr('theme_editor.text_close_editor');

                    if (confirm(langvar)) {
                        var self = $(this);
                        self.prop('href', $.attachToUrl(self.prop('href'), 'redirect_url=' + escape($('input[name=redirect_url]:first').val())));
                        return true;
                    }

                    return false;
                });
                

                $('#theme_editor').on('change', '.cm-colorpicker', function() {
                    var self = $(this);
                    var gradient = $('#' + self.prop('id') + '_gradient');

                    if (gradient.length) {
                        disable_value_changer = true;
                        gradient.ceColorpicker('set', self.val());
                        disable_value_changer = false;
                    }
                });

                $('#theme_editor').on('change', '.cm-te-value-changer', function() {
                    if (disable_value_changer === true) {
                        return false;
                    }

                    updateCss(fn_url(editor_url + formParams()));
                });

                $('#theme_editor').on('click', '.cm-te-load-preset', function(e) {
                    var self = $(this);
                    if (isFormChanged() && confirm(_.tr('text_changes_not_saved')) === false) {
                        return false;
                    }

                    $.ajaxLink(e, '', function() {
                        updateCss(fn_url(editor_url + 'preset_id=' + self.data('caPresetId')));
                        self.addClass('active');
                        form_initial_state = serializeForm();
                    });

                    e.preventDefault();
                    return false;
                });

                $('#theme_editor').on('click', '.cm-te-change-layout', function(e) {
                    var self = $(this);

                    if (isFormChanged() && confirm(_.tr('text_changes_not_saved')) === false) {
                        return false;
                    }
                });

                // Set changed flag
                $('#theme_editor').on('change', 'input', function() {
                    setPresetStatus('changed');
                });


                // Close opened select boxes
                $('#theme_editor').on('click', function(e) {
                    if ($(e.target).hasClass('cm-te-selectbox') || $(e.target).parents('.cm-te-selectbox').length) {
                        return;
                    }

                    if ($(e.target).parents('.te-select-dropdown').length === 0) {
                        $('.te-select-dropdown:visible').hide();
                    }
                });

                // Display opened select box
                $('#theme_editor').on('click', '.cm-te-selectbox', function(e) {
                    var self = $(this);
                    var ul = self.find('ul');

                    $('ul.te-select-dropdown').not(ul).hide();

                    if (ul.is(':visible')) {
                        ul.hide();
                    } else {
                        ul.show();
                    }
                });

                // selectbox: select element
                $('#theme_editor').on('click', '.cm-te-selectbox li', function(e, stop_propagation) {

                    stop_propagation = stop_propagation || false;
                    var self = $(this);
                    var container = self.parents('.cm-te-selectbox');

                    // set selectbox value
                    container.find('input[type=text]').val(self.data('caSelectBoxValue'));
                    
                    // set selectbox title
                    container.find('span:first-child').html(self.html());
                    
                    // highlight active item
                    container.find('li').removeClass('active');
                    self.addClass('active');

                    if (container.hasClass('cm-te-value-changer')){
                        container.trigger('change');
                    }

                    if (stop_propagation) {
                        e.stopImmediatePropagation();
                    }
                });

                // tabs
                $('#theme_editor').on('click', '.cm-te-tabs a', function() {
                    var self = $(this);
                    var ul = self.parents('ul');
                    var container = self.parents('.cm-te-tabs');
                    
                    $('li', ul).removeClass('active');
                    $('.cm-te-tab-contents', container).hide();
                    $('#' + self.data('caTargetId')).show();

                    self.parent('li').addClass('active');
                });

                // Show editor sections
                $('#theme_editor').on('click', '.cm-te-sections li', function() {
                    $('.cm-te-section').hide().addClass('hidden');
                    $('#' + $(this).data('caTargetId')).show().removeClass('hidden');
                    $('input[name=selected_section]', $('#theme_editor')).val($(this).data('caTargetId'));
                });

                // Reset button
                $('#theme_editor').on('click', '.cm-te-reset', function() {

                    result = confirm(_.tr('theme_editor.text_reset_changes'));
                    if (!result) {
                        return false;
                    }

                    var container = $(this).parents('.cm-te-section');

                    var elms = $('[name^="preset[data]"]', container);

                    disable_value_changer = true; // disable cm-te-value-changer event

                    elms.each(function() {
                        var self = $(this);

                        if (self.is('input[type=checkbox]') || self.is('input[type=radio]')) {
                            self.prop('checked', self.prop('defaultChecked'));
                        } else {

                            self.val(self.prop('defaultValue')).trigger('change');

                            // dirty, fix to allow selectbox work
                            if (self.hasClass('cm-te-selectbox-storage')) {
                                $('li[data-ca-select-box-value="' + self.val() + '"]', self.parents('.cm-te-selectbox')).trigger('click', [true]);
                            }

                            if (self.hasClass('cm-colorpicker')) {
                                self.ceColorpicker('reset');
                            }
                        }
                    });

                    disable_value_changer = false;

                    updateCss(fn_url(editor_url + formParams()));

                    if (isFormChanged() === false) {
                        setPresetStatus('clear');
                    }

                    return false; // prevent default action (form submit)
                });

                $('#theme_editor').on('click', '.cm-te-duplicate-preset', function() {
                    result = prompt(_.tr('theme_editor.preset_name'), '');
                    if (result) {
                        $.ceAjax('request', fn_url('theme_editor.duplicate'), {
                            data: {
                                preset_id: $(this).data('caPresetId'),
                                name: result
                            },
                            result_ids: 'theme_editor'
                        });
                    }
                });

                // Enable embedded mode to allow navigation during theme editing
                _.embedded = true;


                form_initial_state = serializeForm();
            }
        });
    });


    // Save theme
    $.ceEvent('on', 'ce.formpre_theme_editor_form', function(form, elm) {
        var result;
        var s_name = $('input[name="preset[name]"]', form);
        var s_id = $('input[name="preset_id"]', form);

        if (s_id.data('caIsDefault')) {
            result = prompt(_.tr('theme_editor.preset_name'), '');
            if (result) {
                s_id.val('');
                s_name.val(result);
            } else {
                return false;
            }
        }

        return true;
        
    });

    $.ceEvent('on', 'ce.formajaxpost_theme_editor_form', function() {
        $('div.cm-te-logo').each(function() {
            var self = $(this);

            if (self.data('caImageArea') && self.data('caImageArea') == 'theme') {
                $('img.logo', 'div.logo-container').prop('src', getUrlFromCss(self.css('background-image'))).css({
                    width: 'auto',
                    height: 'auto'
                });
            }

            if (self.data('caImageArea') && self.data('caImageArea') == 'favicon') {
                $('link[rel="shortcut icon"]').remove();
                $('<link rel="shortcut icon" href="' + getUrlFromCss(self.css('background-image')) + '">').appendTo('head');
            }
        });

        $('.cm-te-value-changer:first').trigger('change');

        setPresetStatus('clear');
        form_initial_state = serializeForm();
    });

    $.ceEvent('on', 'ce.switch_theme_editor_container', function(flag) {
        if (flag) {
            $('#sw_theme_editor_container').addClass('hidden');
            $('#tygh_container').removeClass('te-mode');
        } else {
            $('#sw_theme_editor_container').removeClass('hidden');
            $('#tygh_container').addClass('te-mode');
        }
    });

    // Update URL in layout selector
    $.ceEvent('on', 'ce.ajaxdone', function(elms, scripts, params, response_data, response_text) {
        if (response_data && response_data.current_url) {
            $('a.cm-te-change-layout').each(function() {
                var s = $(this);
                s.prop('href', $.attachToUrl(response_data.current_url, 's_layout=' + s.data('caLayoutId')));
            });
        }
    });

})(Tygh, Tygh.$);
