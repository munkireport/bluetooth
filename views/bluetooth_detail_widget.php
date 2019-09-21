<div class="col-lg-4">
    <h4><i class="fa fa-keyboard-o fa-fixed"></i> <span data-i18n="bluetooth.bluetooth"></span></h4>
    <table class="mr-bluetooth-table">
    </table>
</div>

<script>

$(document).on('appReady', function(e, lang) {
	// Get Bluetooth data
	$.getJSON( appUrl + '/module/bluetooth/get_data/' + serialNumber, function( data ) {
		if(data.id !== '')
		{
			$('table.mr-bluetooth-table')
				.empty()
				.append($('<tr>')
					.append($('<th>')
						.text(i18n.t('bluetooth.status')))
					.append($('<td>')
						.text(function(){
							if(data.bluetooth_power == 1){
								return i18n.t('on');
							}
							if(data.bluetooth_power == 0){
								return i18n.t('off');
							}
							if(data.bluetooth_power == -1){
								return i18n.t('bluetooth.nobluetooth');
							}
							return i18n.t('unknown');
						})));

			for (key in data){
				var rows = ''
				if (key != 'bluetooth_power'){
					rows = rows + '<tr><th>'+i18n.t('bluetooth.'+key)+'</th><td>'+data[key]+'%'+'</td></tr>'
					$('table.mr-bluetooth-table').append(rows)
				}
			}
		}
		else{
			$('table.mr-bluetooth-table')
				.empty()
				.append($('<tr>')
					.append($('<td>')
						.attr('colspan', 2)
						.text(i18n.t('no_data'))))
		}

    });
});

</script>