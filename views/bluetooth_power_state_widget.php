<div class="col-lg-4 col-md-6">
    <div class="panel panel-default" id="bluetooth_power-widget">
        <div id="bluetooth_power-widget" class="panel-heading" data-container="body">
            <h3 class="panel-title"><i class="fa fa-bluetooth"></i> 
                <span data-i18n="bluetooth.bluetooth_power"></span>
                <list-link data-url="/show/listing/bluetooth/bluetooth"></list-link>
            </h3>
        </div>
        <div class="panel-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/bluetooth/get_power_state', function( data ) {
        if(data.error){
            //alert(data.error);
            return;
        }

        var panel = $('#bluetooth_power-widget div.panel-body'),
        baseUrl = appUrl + '/show/listing/bluetooth/bluetooth/';
        panel.empty();
        // Set blocks, disable if zero
        if(data.off != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-info"><span class="bigger-150">'+data.off+'</span><br>&nbsp;&nbsp;'+i18n.t('Off')+'&nbsp;&nbsp;</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-info disabled"><span class="bigger-150">'+data.off+'</span><br>&nbsp;&nbsp;'+i18n.t('Off')+'&nbsp;&nbsp;</a>');
        }
        if(data.on != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success"><span class="bigger-150">'+data.on+'</span><br>&nbsp;&nbsp;'+i18n.t('On')+'&nbsp;&nbsp;</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success disabled"><span class="bigger-150">'+data.on+'</span><br>&nbsp;&nbsp;'+i18n.t('On')+'&nbsp;&nbsp;</a>');
        }
    });
});

</script>
