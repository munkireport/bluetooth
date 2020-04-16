<div class="col-lg-4 col-md-6">
	<div class="panel panel-default" id="bluetooth-battery-widget">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-bolt"></i> 
				<span data-i18n="bluetooth.bluetooth_battery_widget"></span>
				<span class="counter badge"></span>
				<list-link data-url="/show/listing/bluetooth/bluetooth"></list-link>
			</h3>
		</div>
		<div class="list-group scroll-box"></div>
	</div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(){

    $.getJSON( appUrl + '/module/bluetooth/bluetooth_low_battery', function( data ) {
        var scrollBox = $('#bluetooth-battery-widget .scroll-box').empty();

        $.each(data, function(index, obj){
            var badge = '<span class="badge pull-right">'+obj.batterypercent+'%</span>';
            scrollBox
                .append($('<a>')
                    .addClass('list-group-item')
                    .attr('href', appUrl + '/clients/detail/' + obj.serial_number + '#tab_summary')
            .append(obj.device_name)
            .append(badge));

        });

        $('#bluetooth-battery-widget .counter').html(data.length);

        if( ! data.length){
            scrollBox
                .append($('<span>')
                    .addClass('list-group-item')
                    .text(i18n.t('bluetooth.all_ok')))
        }
    });				
});
</script>