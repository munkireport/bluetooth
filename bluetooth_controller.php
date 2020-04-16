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
        $obj = new View();
        $queryobj = new Ms_office_model();
        $sql = "SELECT COUNT(CASE WHEN `power` = '1' THEN 1 END) AS 'on',
                        COUNT(CASE WHEN `power` = '0' THEN 0 END) AS 'off'
                        from bluetooth
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }

     /**
     * REST API for retrieving low battery for widget
     * @tuxudo
     *
     **/
     public function bluetooth_low_battery()
     {        
        $obj = new View();
        $queryobj = new Bluetooth_model();

        $sql = "SELECT device_address, batterypercent, device_name, serial_number
						FROM bluetooth
						LEFT JOIN reportdata USING (serial_number)
						WHERE (`batterypercent` <= '15')
						".get_machine_group_filter('AND');

        $bluetooth_array = $queryobj->query($sql);
        $obj->view('json', array('msg' => current(array('msg' => $bluetooth_array)))); 
     }

	/**
     * Retrieve data in json format
     *
     **/
    public function get_bluetooth_data($serial_number)
    {
        $obj = new View();
        $queryobj = new Bluetooth_model();
        
        $sql = "SELECT machine_address, power, discoverable, supports_lowenergy, supports_airdrop, supports_instanthotspot, supports_handoff, remotewake, autoseek_keyboard, autoseek_pointing, connectable, vendor_id, apple_bluetooth_version, device_name, device_address, isconnected, ispaired, isconfigured, isnormallyconnectable, rssi, batterypercent, manufacturer, majorclass, minorclass, services
                        FROM bluetooth
                        WHERE serial_number = '$serial_number'";
        
        $bluetooth_tab = $queryobj->query($sql);

        $bluetooth = new Bluetooth_model;
        $obj->view('json', array('msg' => current(array('msg' => $bluetooth_tab)))); 
    }
} // End class Bluetooth_controller