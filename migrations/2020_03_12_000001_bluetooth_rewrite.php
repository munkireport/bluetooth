<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class BluetoothRewrite extends Migration
{
    private $tableName = 'bluetooth';

    public function up()
    {
        $capsule = new Capsule();
        
        // Drop the old table
        $capsule::schema()->dropIfExists($this->tableName);
        
        $capsule::schema()->create($this->tableName, function (Blueprint $table) {
            $table->increments('id');

            $table->string('serial_number');
            $table->string('machine_address')->nullable();
            $table->boolean('autoseek_keyboard')->nullable();
            $table->boolean('autoseek_pointing')->nullable();
            $table->boolean('connectable')->nullable();
            $table->boolean('discoverable')->nullable();
            $table->string('hardware_transport')->nullable();
            $table->string('machine_name')->nullable();
            $table->boolean('power')->nullable();
            $table->boolean('remotewake')->nullable();
            $table->boolean('supports_handoff')->nullable();
            $table->boolean('supports_instanthotspot')->nullable();
            $table->boolean('supports_airdrop')->nullable();
            $table->boolean('supports_lowenergy')->nullable();
            $table->string('vendor_id')->nullable();
            $table->string('apple_bluetooth_version')->nullable();
            
            $table->string('device_name')->nullable();
            $table->string('device_address')->nullable();
            $table->integer('rssi')->nullable();
            $table->integer('batterypercent')->nullable();
            $table->boolean('isnormallyconnectable')->nullable();
            $table->boolean('isconfigured')->nullable();
            $table->boolean('isconnected')->nullable();
            $table->boolean('ispaired')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('majorclass')->nullable();
            $table->string('minorclass')->nullable();
            $table->TEXT('services')->nullable();
            
            
            $table->index('serial_number');
            $table->index('machine_address');
            $table->index('autoseek_keyboard');
            $table->index('autoseek_pointing');
            $table->index('connectable');
            $table->index('discoverable');
            $table->index('machine_name');
            $table->index('power');
            $table->index('remotewake');
            $table->index('supports_handoff');
            $table->index('supports_instanthotspot');
            $table->index('supports_airdrop');
            $table->index('supports_lowenergy');
            $table->index('device_name');
            $table->index('device_address');
            $table->index('rssi');
            $table->index('batterypercent');
            $table->index('isnormallyconnectable');
            $table->index('isconfigured');
            $table->index('isconnected');
            $table->index('ispaired');
        });
    }
    
    public function down()
    {
        // Can't go back :upside_down_face:
    }
}
