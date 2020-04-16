<?php

use CFPropertyList\CFPropertyList;

class Bluetooth_model extends \Model {

	function __construct($serial='')
	{
		parent::__construct('id', 'bluetooth'); //primary key, tablename
		$this->rs['id'] = '';
		$this->rs['serial_number'] = $serial;
		$this->rs['machine_address'] = null;
		$this->rs['autoseek_keyboard'] = null; // true/false
		$this->rs['autoseek_pointing'] = null; // true/false
		$this->rs['connectable'] = null; // true/false
		$this->rs['discoverable'] = null; // true/false
		$this->rs['hardware_transport'] = null;
		$this->rs['machine_name'] = null;
		$this->rs['power'] = null;
		$this->rs['remotewake'] = null;
		$this->rs['supports_handoff'] = null;  // true/false
		$this->rs['supports_instanthotspot'] = null; // true/false
		$this->rs['supports_airdrop'] = null; // true/false
		$this->rs['supports_lowenergy'] = null; // true/false
		$this->rs['vendor_id'] = null;
		$this->rs['apple_bluetooth_version'] = null;
		$this->rs['device_name'] = null;
		$this->rs['device_address'] = null;
		$this->rs['rssi'] = null;
		$this->rs['batterypercent'] = null;
		$this->rs['isnormallyconnectable'] = null; // true/false
		$this->rs['isconfigured'] = null; // true/false
		$this->rs['isconnected'] = null; // true/false
		$this->rs['ispaired'] = null; // true/false
		$this->rs['manufacturer'] = null;
		$this->rs['majorclass'] = null;
		$this->rs['minorclass'] = null;
		$this->rs['services'] = null;
        
		$this->serial_number = $serial;
	}
	
	// ------------------------------------------------------------------------
    
	/**
	 * Process data sent by postflight
	 *
	 * @param string data
	 * @author tuxudo
	 **/
	function process($plist)
	{
        // Check if we have data
		if ( ! $plist){
			throw new Exception("Error Processing Request: No property list found", 1);
		}

		// Delete previous set
        $this->deleteWhere('serial_number=?', $this->serial_number);

		$parser = new CFPropertyList();
		$parser->parse($plist, CFPropertyList::FORMAT_XML);
		$bt_list = $parser->toArray();

        // Process each Bluetooth device
        foreach ($bt_list as $btdevice) {

            // Process singular bluetooth data
            $singularitems = array ('machine_address','autoseek_keyboard','autoseek_pointing','connectable','discoverable','hardware_transport','machine_name','power','remotewake','supports_handoff','supports_instanthotspot','supports_airdrop','supports_lowenergy','vendor_id','apple_bluetooth_version');
            foreach ($singularitems as $singlekey) {
                if( array_key_exists($singlekey, $btdevice)){
                    $this->rs[$singlekey] = $btdevice[$singlekey]; 
                } else {
                    $this->rs[$singlekey] = null;
                }
            }
            
            // Process device data
			foreach ($this->rs as $key => $value) {
				$this->rs[$key] = $value;
				if(array_key_exists($key, $btdevice))
				{
					$this->rs[$key] = $btdevice[$key];
				}
			}

			// Save Bluetooth device data, I've traveled each and every highway, And more, much more than this
			$this->id = '';
			$this->save();
		}
	}
}
