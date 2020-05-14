<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Bluetooth_model::class, function (Faker\Generator $faker) {
    return [
        'machine_address' => $faker->regexify('[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}'),
        'autoseek_keyboard' => $faker->boolean(),
        'autoseek_pointing' => $faker->boolean(),
        'connectable' => $faker->boolean(),
        'discoverable' => $faker->boolean(),
        'hardware_transport' => $faker->word(),
        'machine_name' => $faker->word(),
        'power' => $faker->boolean(),
        'remotewake' => $faker->boolean(),
        'supports_handoff' => $faker->boolean(),
        'supports_instanthotspot' => $faker->boolean(),
        'supports_airdrop' => $faker->boolean(),
        'supports_lowenergy' => $faker->boolean(),
        'vendor_id' => $faker->word(),
        'apple_bluetooth_version' => $faker->word(),
        'device_name' => $faker->word(),
        'device_address' => $faker->regexify('[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}'),
        'rssi' => $faker->randomNumber(),
        'batterypercent' => $faker->numberBetween(0, 100),
        'isnormallyconnectable' => $faker->boolean(),
        'isconfigured' => $faker->boolean(),
        'isconnected' => $faker->boolean(),
        'ispaired' => $faker->boolean(),
        'manufacturer' => $faker->company(),
        'majorclass' => $faker->word(),
        'minorclass' => $faker->word(),
        'services' => $faker->text(),
    ];
});

