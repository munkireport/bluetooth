<?php 

/**
 * Bluetooth module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class Bluetooth_controller extends Module_controller
{

	/*** Protect methods with auth! ****/
	function __construct()
	{
		// Store module path
		$this->module_path = dirname(__FILE__);
	}

	/**
	 * Default method
	 * @author tuxudo
	 *
	 **/
	function index()
	{
		echo "You've loaded the bluetooth module!";
	}

    /**
    * Retrieve bluetooth power state data in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_power_state()
    {
        jsonView(
            Bluetooth_model::selectRaw("COUNT(CASE WHEN `power` = '1' THEN 1 END) AS 'on'")
                ->selectRaw("COUNT(CASE WHEN `power` = '0' THEN 1 END) AS 'off'")
                ->filter()
                ->first()
                ->toLabelCount()
        );
    }

     /**
     * REST API for retrieving low battery for widget
     * @tuxudo
     *
     **/
     public function bluetooth_low_battery()
     {
        jsonView(
            Bluetooth_model::selectRaw('bluetooth.serial_number, batterypercent as percent, device_name')
                ->where('batterypercent', '<=', 15)
                ->filter()
                ->get()
                ->toArray()
        );
   }

	/**
     * Retrieve data in json format
     *
     **/
    public function get_bluetooth_data($serial_number)
    {
        jsonView(
            Bluetooth_model::select()
                ->where('bluetooth.serial_number', $serial_number)
                ->filter()
                ->get()
                ->toArray()
        );
   }
} // End class Bluetooth_controller