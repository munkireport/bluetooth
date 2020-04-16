<?php $this->view('partials/head'); ?>

<div class="container">
  <div class="row">
	<div class="col-lg-12">

	  <h3><span data-i18n="bluetooth.reporttitle"></span> <span id="total-count" class='label label-primary'>…</span></h3>

	  <table class="table table-striped table-condensed table-bordered">

		<thead>
		  <tr>
			<th data-i18n="listing.computername" data-colname='machine.computer_name'></th>
			<th data-i18n="serial" data-colname='reportdata.serial_number'></th>
			<th data-i18n="bluetooth.machine_address" data-colname='bluetooth.machine_address'></th>
			<th data-i18n="bluetooth.power" data-colname='bluetooth.power'></th>
			<th data-i18n="bluetooth.discoverable" data-colname='bluetooth.discoverable'></th>
			<th data-i18n="bluetooth.supports_lowenergy" data-colname='bluetooth.supports_lowenergy'></th>
			<th data-i18n="bluetooth.supports_airdrop" data-colname='bluetooth.supports_airdrop'></th>
			<th data-i18n="bluetooth.supports_instanthotspot" data-colname='bluetooth.supports_instanthotspot'></th>
			<th data-i18n="bluetooth.supports_handoff" data-colname='bluetooth.supports_handoff'></th>
			<th data-i18n="bluetooth.remotewake" data-colname='bluetooth.remotewake'></th>
			<th data-i18n="bluetooth.autoseek_keyboard" data-colname='bluetooth.autoseek_keyboard'></th>
			<th data-i18n="bluetooth.autoseek_pointing" data-colname='bluetooth.autoseek_pointing'></th>
			<th data-i18n="bluetooth.connectable" data-colname='bluetooth.connectable'></th>
			<th data-i18n="bluetooth.apple_bluetooth_version" data-colname='bluetooth.apple_bluetooth_version'></th>
		  </tr>
		</thead>

		<tbody>
		  <tr>
			<td data-i18n="listing.loading" colspan="14" class="dataTables_empty"></td>
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
                     d.mrColNotEmpty = "bluetooth.machine_address";

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

	        	var colvar=$('td:eq(3)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('on') :
	        	(colvar === '0' ? i18n.t('off') : '')
	        	$('td:eq(3)', nRow).html(colvar)

	        	var colvar=$('td:eq(4)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('yes') :
	        	(colvar === '0' ? i18n.t('no') : '')
	        	$('td:eq(4)', nRow).html(colvar)

	        	var colvar=$('td:eq(5)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('yes') :
	        	(colvar === '0' ? i18n.t('no') : '')
	        	$('td:eq(5)', nRow).html(colvar)

	        	var colvar=$('td:eq(6)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('bluetooth.supported') :
	        	(colvar === '0' ? i18n.t('bluetooth.unsupported') : '')
	        	$('td:eq(6)', nRow).html(colvar)

	        	var colvar=$('td:eq(7)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('bluetooth.supported') :
	        	(colvar === '0' ? i18n.t('bluetooth.unsupported') : '')
	        	$('td:eq(7)', nRow).html(colvar)

	        	var colvar=$('td:eq(8)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('bluetooth.supported') :
	        	(colvar === '0' ? i18n.t('bluetooth.unsupported') : '')
	        	$('td:eq(8)', nRow).html(colvar)

	        	var colvar=$('td:eq(9)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('yes') :
	        	(colvar === '0' ? i18n.t('no') : '')
	        	$('td:eq(9)', nRow).html(colvar)

	        	var colvar=$('td:eq(10)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('yes') :
	        	(colvar === '0' ? i18n.t('no') : '')
	        	$('td:eq(10)', nRow).html(colvar)

	        	var colvar=$('td:eq(11)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('yes') :
	        	(colvar === '0' ? i18n.t('no') : '')
	        	$('td:eq(11)', nRow).html(colvar)

	        	var colvar=$('td:eq(12)', nRow).html();
	        	colvar = colvar == '1' ? i18n.t('yes') :
	        	(colvar === '0' ? i18n.t('no') : '')
	        	$('td:eq(12)', nRow).html(colvar)
		    }
	    });

	});
</script>

<?php $this->view('partials/foot'); ?>
