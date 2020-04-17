<div id="bluetooth-tab"></div>
<h2 data-i18n="bluetooth.bluetooth"></h2>

<div id="bluetooth-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

<script>
$(document).on('appReady', function(){
	$.getJSON(appUrl + '/module/bluetooth/get_bluetooth_data/' + serialNumber, function(data){

        // Check if we have data
        if(!data[0]){
            $('#bluetooth-msg').text(i18n.t('no_data'));
            $('#bluetooth-header').removeClass('hide');
            $('#mr-bluetooth-table').append($('<tr>')
                                            .append($('<td>')
                                                .attr('colspan', 2)
                                                .text(i18n.t('no_data'))))

            // Update the tab bluetooth power state
            $('#bluetooth-cnt').text("");

        } else {

            // Hide
            $('#bluetooth-msg').text('');
            $('#bluetooth-view').removeClass('hide');

            $.each(data, function(i,d){
                // Generate rows from data
                var inforows = ''
                var devicerows = ''
                var detail_rows = ''

                for (var prop in d){
                    // Blank empty rows
                    if(d[prop] == '' || d[prop] == null){
                        inforows = inforows
                    }
                    else if(prop == 'machine_address' || prop == 'hardware_transport' || prop == 'machine_name' || prop == 'vendor_id'){
                       inforows = inforows + '<tr><th>'+i18n.t('bluetooth.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                    } 
                    
                    else if( prop == 'power' && d[prop] == -1){
                       $('#bluetooth-msg').text(i18n.t('bluetooth.no_bluetooth'));
                       $('#bluetooth-cnt').text('')
                       $('#mr-bluetooth-table').prepend('<tr><th>'+i18n.t('bluetooth.no_bluetooth')+'</th><td></td></tr>')
                       return false
                    }

                    else if((prop == 'power') && d[prop] == 1){
                       inforows = inforows + '<tr><th>'+i18n.t('bluetooth.'+prop)+'</th><td>'+i18n.t('on')+'</td></tr>';
                       $('#bluetooth-cnt').text(i18n.t('on'));
                       $('#mr-bluetooth-table').prepend('<tr><th>'+i18n.t('bluetooth.power')+'</th><td>'+i18n.t('on')+'</td></tr>')
                    }
                    else if((prop == 'power') && d[prop] == 0){
                       inforows = inforows + '<tr><th>'+i18n.t('bluetooth.'+prop)+'</th><td>'+i18n.t('off')+'</td></tr>';
                       $('#bluetooth-cnt').text(i18n.t('off'));
                       $('#mr-bluetooth-table').prepend('<tr><th>'+i18n.t('bluetooth.power')+'</th><td>'+i18n.t('off')+'</td></tr>')
                    }


                    else if((prop == 'autoseek_keyboard' || prop == 'autoseek_pointing' || prop == 'connectable' || prop == 'discoverable' || prop == 'remotewake') && d[prop] == 1){
                       inforows = inforows + '<tr><th>'+i18n.t('bluetooth.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    }
                    else if((prop == 'autoseek_keyboard' || prop == 'autoseek_pointing' || prop == 'connectable' || prop == 'discoverable' || prop == 'remotewake') && d[prop] == 0){
                       inforows = inforows + '<tr><th>'+i18n.t('bluetooth.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    }
                    else if((prop == 'supports_handoff' || prop == 'supports_instanthotspot' || prop == 'supports_airdrop' || prop == 'supports_lowenergy') && d[prop] == 1){
                       inforows = inforows + '<tr><th>'+i18n.t('bluetooth.'+prop)+'</th><td>'+i18n.t('bluetooth.supported')+'</td></tr>';
                    }
                    else if((prop == 'supports_handoff' || prop == 'supports_instanthotspot' || prop == 'supports_airdrop' || prop == 'supports_lowenergy') && d[prop] == 0){
                       inforows = inforows + '<tr><th>'+i18n.t('bluetooth.'+prop)+'</th><td>'+i18n.t('bluetooth.unsupported')+'</td></tr>';
                    }


                    else if(prop == 'device_address' || prop == 'manufacturer' || prop == 'majorclass' || prop == 'minorclass' || prop == 'services'){
                       devicerows = devicerows + '<tr><th>'+i18n.t('bluetooth.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                    }
                    else if(prop == 'batterypercent'){
                       devicerows = devicerows + '<tr><th>'+i18n.t('bluetooth.'+prop)+'</th><td>'+d[prop]+'%</td></tr>';
                       var cls = d['batterypercent'] < 15 ? 'danger' : (d['batterypercent'] < 40 ? 'warning' : 'success');
                       detail_rows = detail_rows + '<tr><th>'+d['device_name']+'</th><td><div class="progress"><div class="progress-bar progress-bar-'+cls+'" style="width: '+d['batterypercent']+'%;">'+d['batterypercent']+'%</div></div></td></tr>'
                    }
                    else if((prop == 'isnormallyconnectable' || prop == 'isconfigured' || prop == 'isconnected' || prop == 'ispaired') && d[prop] == 1){
                       devicerows = devicerows + '<tr><th>'+i18n.t('bluetooth.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    }
                    else if((prop == 'isnormallyconnectable' || prop == 'isconfigured' || prop == 'isconnected' || prop == 'ispaired') && d[prop] == 0){
                       devicerows = devicerows + '<tr><th>'+i18n.t('bluetooth.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    }
                }
                
                // Fill in the client detail widget
                $('#mr-bluetooth-table').append(detail_rows)

                $('#bluetooth-tab')

                .append($('<div style="max-width:450px;">')
                    .append($('<table>')
                        .addClass('table table-striped table-condensed')
                        .append($('<tbody>')
                            .append(inforows))))

				.append($('<h4>')
					.append($('<i>')
						.addClass('fa fa-bluetooth'))
					.append(' '+d.device_name))
                .append($('<div style="max-width:450px;">')
                    .append($('<table>')
                        .addClass('table table-striped table-condensed')
                        .append($('<tbody>')
                            .append(devicerows))))
            })
        }
	});
});
</script>
