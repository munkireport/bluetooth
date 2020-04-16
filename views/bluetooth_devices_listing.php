<?php $this->view('partials/head'); ?>

<div class="container">
  <div class="row">
	<div class="col-lg-12">
	  <h3><span data-i18n="bluetooth.bluetooth_devices_report"></span> <span id="total-count" class='label label-primary'>…</span></h3>
	  <table class="table table-striped table-condensed table-bordered">

		<thead>
		  <tr>
			<th data-i18n="listing.computername" data-colname='machine.computer_name'></th>
			<th data-i18n="serial" data-colname='reportdata.serial_number'></th>
			<th data-i18n="bluetooth.device_name" data-colname='bluetooth.device_name'></th>
			<th data-i18n="bluetooth.device_address" data-colname='bluetooth.device_address'></th>
			<th data-i18n="bluetooth.isconnected" data-colname='bluetooth.isconnected'></th>
			<th data-i18n="bluetooth.rssi" data-colname='bluetooth.rssi'></th>
			<th data-i18n="bluetooth.batterypercent" data-colname='bluetooth.batterypercent'></th>
			<th data-i18n="bluetooth.manufacturer" data-colname='bluetooth.manufacturer'></th>
			<th data-i18n="bluetooth.majorclass" data-colname='bluetooth.majorclass'></th>
			<th data-i18n="bluetooth.minorclass" data-colname='bluetooth.minorclass'></th>
		  </tr>
		</thead>

		<tbody>
		  <tr>
			<td data-i18n="listing.loading" colspan="10" class="dataTables_empty"></td>
		  </tr>
		</tbody>

	  </table>
	</div> <!-- /span 12 -->
  </div> <!-- /row -->
</div>  <!-- /container -->

<script type="text/javascript">

	$(document).on('appUpdate', function(e){

		var oTable = $('.table').DataTable();
		oTable.ajax.reload();
		return;

	});

	$(document).on('appReady', function(e, lang) {

        // Get modifiers from data attribute
        var mySort = [], // Initial sort
            hideThese = [], // Hidden columns
            col = 0, // Column counter
            runtypes = [], // Array for runtype column
            columnDefs = [{ visible: false, targets: hideThese }]; //Column Definitions

        $('.table th').map(function(){

            columnDefs.push({name: $(this).data('colname'), targets: col, render: $.fn.dataTable.render.text()});

            if($(this).data('sort')){
              mySort.push([col, $(this).data('sort')])
            }

            if($(this).data('hide')){
              hideThese.push(col);
            }

            col++
        });

	    oTable = $('.table').dataTable( {
            ajax: {
                url: appUrl + '/datatables/data',
                type: "POST",
                data: function(d){
                     d.mrColNotEmpty = "device_address";

                    // Check for column in search
                    if(d.search.value){
                        $.each(d.columns, function(index, item){
                            if(item.name == 'bluetooth.' + d.search.value){
                                d.columns[index].search.value = '> 0';
                            }
                        });

                    }
                }
            },
            dom: mr.dt.buttonDom,
            buttons: mr.dt.buttons,
            order: mySort,
            columnDefs: columnDefs,
		    createdRow: function( nRow, aData, iDataIndex ) {
	        	// Update name in first column to link
	        	var name=$('td:eq(0)', nRow).html();
	        	if(name == ''){name = "No Name"};
	        	var sn=$('td:eq(1)', nRow).html();
	        	var link = mr.getClientDetailLink(name, sn, '#tab_bluetooth-tab');
	        	$('td:eq(0)', nRow).html(link);

	        	var colvar=$('td:eq(4)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('yes') :
	        	(colvar === '0' ? i18n.t('no') : '')
	        	$('td:eq(4)', nRow).html(colvar)

                // Format battery percentage
                var batt_percent=$('td:eq(6)', nRow).html();
                if (batt_percent){
                    var cls = batt_percent < 15 ? 'danger' : (batt_percent < 40 ? 'warning' : 'success');
                    $('td:eq(6)', nRow).html('<div class="progress"><div class="progress-bar progress-bar-'+cls+'" style="width: '+batt_percent+'%;">'+batt_percent+'%</div></div>');
                }
            }
	    });

	});
</script>

<?php $this->view('partials/foot'); ?>
