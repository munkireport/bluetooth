Bluetooth module
==============

Bluetooth module for MunkiReport. Gathers information connected Bluetooth devices



Table Schema
-----

Database:
* machine_address - varchar(255) - MAC address of computer
* autoseek_keyboard - boolean - will prompt to connect to keyboard on boot
* autoseek_pointing - boolean - will prompt to connect to mouse on boot
* connectable - boolean - devices able to connect
* discoverable - boolean - machine discoverable
* hardware_transport - varchar(255) - Bluetooth hardware bus
* machine_name - varchar(255) - name of machine
* power - boolean - Bluetooth power state
* remotewake - boolean - remote wake for devices enabled
* supports_handoff - boolean - supports handoff
* supports_instanthotspot - boolean - supports instant hotspot
* supports_airdrop - boolean - supports AirDrop
* supports_lowenergy - boolean - supports Bluetooth low energy
* vendor_id - varchar(255) - Bluetooth hardware vendor ID
* apple_bluetooth_version - varchar(255) - Apple Bluetooth version
* device_name - varchar(255) - device name
* device_address - varchar(255) - device MAC address
* rssi - int - RSSI value of connection
* batterypercent - int - battery percentage of device
* isnormallyconnectable - boolean - is device normally connectable
* isconfigured- boolean - is device configured
* isconnected - boolean - is device connected
* ispaired - boolean - is device paired
* manufacturer - varchar(255) - manufacturer of device
* majorclass - varchar(255) - major class of device
* minorclass - varchar(255) - minor class of device
* services - text - string of exposed Bluetooth services
