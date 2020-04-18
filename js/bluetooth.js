var formatBluetoothPercentage = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        batt_percent = col.text();
    if (batt_percent){
        var cls = batt_percent < 15 ? 'danger' : (batt_percent < 40 ? 'warning' : 'success');
        col.html('<div class="progress"><div class="progress-bar progress-bar-'+cls+'" style="width: '+batt_percent+'%;">'+batt_percent+'%</div></div>');
    }
}

var formatBluetoothSupported = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();
    colvar = colvar == '1' ? i18n.t('bluetooth.supported') :
        (colvar === '0' ? i18n.t('bluetooth.unsupported') : '')
    col.text(colvar)
}
