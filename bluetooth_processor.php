<?php

use CFPropertyList\CFPropertyList;
use munkireport\processors\Processor;

class Bluetooth_processor extends Processor
{
    /**
     * Process data sent by postflight
     *
     * @param string data
     * @author abn290
     **/
    public function run($plist)
    {
        // Check if we have data
		if ( ! $plist){
			throw new Exception("Error Processing Request: No property list found", 1);
		}

        // Delete previous set
        Bluetooth_model::where('serial_number', $this->serial_number)->delete();

		$parser = new CFPropertyList();
        $parser->parse($plist, CFPropertyList::FORMAT_XML);

        // Get fillable items
        $fillable = array_fill_keys((new Bluetooth_model)->getFillable(), null);
        $fillable['serial_number'] = $this->serial_number;

        $save_list = [];
        foreach ($parser->toArray() as $btdevice) {
            $save_list[] = array_replace($fillable, array_intersect_key($btdevice, $fillable));
        }

        Bluetooth_model::insertChunked($save_list);
    }
}