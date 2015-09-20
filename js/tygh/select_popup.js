(function(_, $) {

    $.ceEvent('on', 'ce.update_object_status_callback', function(data, params) {
        if (data.return_status && params.obj) {
            fn_update_object_status(params.obj, data.return_status.toLowerCase());
        }
    });

}(Tygh, Tygh.$));


function fn_check_object_status(obj, status, color)
{
    if (Tygh.$(obj).hasClass('cm-active')) {
        Tygh.$(obj).removeClass('cm-ajax');
        return false;
    }

    fn_update_object_status(obj, status, color);
    return true;
}

function fn_update_object_status(obj, status, color)
{
    var $ = Tygh.$;

    var upd_elm = $(obj).parents('.cm-popup-box:first');
    var button_elm = $('a:first', upd_elm);

    if ($(obj).prop('href')) {
        $(obj).prop('href', fn_query_remove($(obj).prop('href'), ['notify_user', 'notify_department']));

        if ($('input[name=__notify_user]:checked', upd_elm).length) {
            $(obj).prop('href', $(obj).prop('href') + '&notify_user=Y');
        }
        if ($('input[name=__notify_department]:checked', upd_elm).length) {
            $(obj).prop('href', $(obj).prop('href') + '&notify_department=Y');
        }
        if ($('input[name=__notify_vendor]:checked', upd_elm).length) {
            $(obj).prop('href', $(obj).prop('href') + '&notify_vendor=Y');
        }
        /* FIXME CORE SUPPLIERS
        /*
        if ($('input[name=__notify_supplier]:checked', upd_elm).length) {
            $(obj).prop('href', $(obj).prop('href') + '&notify_supplier=Y');
        }
        */

        $('li a', upd_elm).addClass('cm-ajax');
    } else if ($(obj).data('caResultId')) {
        $('input[id="' + $(obj).data('caResultId') + '"]').val(status.toUpperCase());
    }

    var p_active = $('li a.cm-active', upd_elm);
    if (p_active.length) {
        var p_status = p_active.prop('class').match(/status-link-([^\s]+)/i);

        var row = upd_elm.parents('.cm-row-status-' + p_status[1] + ':first');
        if (row.length) {
            row.removeClass('cm-row-status-' + p_status[1]);
            row.addClass('cm-row-status-' + status);
        }

        var ch_item = $('.cm-item-status-' + p_status[1], upd_elm.parents('tr:first'));
        if (ch_item.length) {
            ch_item.removeClass('cm-item-status-' + p_status[1]);
            ch_item.addClass('cm-item-status-' + status);
        }

    }

    $('li a', upd_elm).removeClass('cm-active');
    $('li', upd_elm).removeClass('disabled');

    $('.status-link-' + status, upd_elm).addClass('cm-active');
    $('.status-link-' + status, upd_elm).parents('li:first').addClass('disabled');
    button_elm.html($('.status-link-' + status, upd_elm).text() + ' <span class="caret"></span>');
}
