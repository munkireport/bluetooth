<?php

use munkireport\models\MRModel as Eloquent;

class Bluetooth_model extends Eloquent
{
    protected $table = 'bluetooth';

    protected $fillable = [
		'serial_number',
		'machine_address',
		'autoseek_keyboard',
		'autoseek_pointing',
		'connectable',
		'discoverable',
		'hardware_transport',
		'machine_name',
		'power',
		'remotewake',
		'supports_handoff',
		'supports_instanthotspot',
		'supports_airdrop',
		'supports_lowenergy',
		'vendor_id',
		'apple_bluetooth_version',
		'device_name',
		'device_address',
		'rssi',
		'batterypercent',
		'isnormallyconnectable',
		'isconfigured',
		'isconnected',
		'ispaired',
		'manufacturer',
		'majorclass',
		'minorclass',
		'services',
    ];

    public $timestamps = false;
}
