{script src="js/lib/daterangepicker/moment.min.js"}
{script src="js/lib/daterangepicker/daterangepicker.js"}
{style src="lib/daterangepicker/daterangepicker.css"}

{$start_date = $start_date|default:("-30 day"|strtotime)}
{$end_date = $end_date|default:("now"|strtotime)}

<div id="{$id}" class="reportrange {$extra_class}" {if $data_url}data-ca-target-url="{$data_url}"{/if} {if $result_ids}data-ca-target-id="{$result_ids}"{/if}>
    <a class="btn-text">
        <span>
            {$start_date|date_format:"%b %d, %Y"} — {$end_date|date_format:"%b %d, %Y"}
        </span>
        <b class="caret"></b>
    </a>
</div>

<script type="text/javascript">
//<![CDATA[
Tygh.$(document).ready(function() {
	fn_init_daterange_picker('{$id}');
});
//]]>

function fn_init_daterange_picker(id)
{
	Tygh.$('#' + id).daterangepicker({
	    ranges: {
	        'Today': [moment().startOf('day'), moment().endOf('day')],
	        'Yesterday': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
	        'Last 7 Days': [moment().startOf('day').subtract('days', 6), moment().endOf('day')],
	        'Last 30 Days': [moment().startOf('day').subtract('days', 29), moment().endOf('day')],
	        'This Month': [moment().startOf('month'), moment().endOf('month')],
	        'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
	    },
	    startDate: moment({$time_from}*1000).startOf('day'),
        endDate: moment({$time_to}*1000).startOf('day')
	}, 
	function(start, end) {
		var self = Tygh.$(this.element);
		var $ = Tygh.$;

		start = !start ? moment({$time_from}*1000).startOf('day') : start;
		end = !end ? moment({$time_to}*1000).startOf('day') : end;

	    $('span', self).html(start.format('MMM D, YYYY') + ' — ' + end.format('MMM D, YYYY'));
	    if (self.data('ca-target-url') && self.data('ca-target-id')) {
	    	$.ceAjax('request', $.attachToUrl(self.data('ca-target-url'), 'time_from=' + (start.utc() / 1000) + '&time_to=' + (parseInt(end.utc() / 1000) + 86400)), { // Seconds in day
	    			result_ids: self.data('ca-target-id'),
	    			caching: false,
	    			force_exec: true,
	    			callback: function(id) {
	    				Tygh.$('.reportrange').each(function(){
	    					fn_init_daterange_picker(Tygh.$(this).prop('id'));
	    				});
	    				
	    			}
	    		});
	    }
	});
}
</script>