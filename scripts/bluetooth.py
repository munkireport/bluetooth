#!/usr/bin/python

import subprocess
import os
import plistlib
import sys
import re

def get_bluetooth_info():

    '''Uses system profiler to get memory info for this machine.'''
    cmd = ['/usr/sbin/system_profiler', 'SPBluetoothDataType', '-xml']
    proc = subprocess.Popen(cmd, shell=False, bufsize=-1,
                            stdin=subprocess.PIPE,
                            stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    (output, unused_error) = proc.communicate()
    try:
        plist = plistlib.readPlistFromString(output)
        # system_profiler xml is an array
        sp_dict = plist[0]
        items = sp_dict['_items'][0]
        return (items)
    except Exception:
        return {}

def flatten_bluetooth_info(obj):
    '''Un-nest bluetooth information, return array with objects with relevant keys'''
    out = []
    i = 0

    # Check if there is Bluetooth hardware
    try:
        obj['device_title']
    except:
        return [{'power':-1}]

    obj_device = obj['device_title']

    for bt_device in obj_device:
        for item in bt_device:
            device = {}
            for item_att in bt_device[item]:

                # Set name of device
                device['device_name'] = item

                if i == 0:
                    device['apple_bluetooth_version'] = obj['apple_bluetooth_version']
                    obj_local = obj['local_device_title']
                    i = 1
                    for item_local in obj_local:
                        if item_local == 'general_address':
                            device['machine_address'] = obj_local[item_local]
                        elif item_local == 'general_autoseek_keyboard':
                            device['autoseek_keyboard'] = to_bool(obj_local[item_local])
                        elif item_local == 'general_autoseek_pointing':
                            device['autoseek_pointing'] = to_bool(obj_local[item_local])
                        elif item_local == 'general_connectable':
                            device['connectable'] = to_bool(obj_local[item_local])
                        elif item_local == 'general_discoverable' or item_local == 'device_discoverable':
                            device['discoverable'] = to_bool(obj_local[item_local])
                        elif item_local == 'general_hardware_transport':
                            device['hardware_transport'] = obj_local[item_local]
                        elif item_local == 'general_name':
                            device['machine_name'] = obj_local[item_local]

                        elif item_local == 'general_power' or item_local == 'device_power':
                            device['power'] = to_bool(obj_local[item_local])

                        elif item_local == 'general_remoteWake':
                            device['remotewake'] = to_bool(obj_local[item_local])
                        elif item_local == 'general_supports_handoff':
                            device['supports_handoff'] = to_bool(obj_local[item_local])
                        elif item_local == 'general_supports_instantHotspot':
                            device['supports_instanthotspot'] = to_bool(obj_local[item_local])
                        elif item_local == 'general_supports_airDrop':
                            device['supports_airdrop'] = to_bool(obj_local[item_local])
                        elif item_local == 'general_supports_lowEnergy':
                            device['supports_lowenergy'] = to_bool(obj_local[item_local])

                        elif item_local == 'general_vendorID':
                            device['vendor_id'] = obj_local[item_local]
                
                
                if item_att == 'device_addr':
                    device['device_address'] = bt_device[item][item_att]
                elif item_att == 'device_RSSI':
                    device['rssi'] = bt_device[item][item_att]
                elif item_att == 'device_batteryPercent':
                    device['batterypercent'] = re.sub('[^0-9-]','',bt_device[item][item_att])

                elif item_att == 'device_isNormallyConnectable':
                    device['isnormallyconnectable'] = to_bool(bt_device[item][item_att])
                elif item_att == 'device_isconfigured':
                    device['isconfigured'] = to_bool(bt_device[item][item_att])
                elif item_att == 'device_isconnected':
                    device['isconnected'] = to_bool(bt_device[item][item_att])
                elif item_att == 'device_ispaired':
                    device['ispaired'] = to_bool(bt_device[item][item_att])

                elif item_att == 'device_manufacturer':
                    device['manufacturer'] = bt_device[item][item_att]
                elif item_att == 'device_majorClassOfDevice_string':
                    device['majorclass'] = bt_device[item][item_att]
                elif item_att == 'device_minorClassOfDevice_string':
                    device['minorclass'] = bt_device[item][item_att]
                elif item_att == 'device_services':
                    device['services'] = bt_device[item][item_att]

            out.append(device)
    return out

def to_bool(s):
    if s == "attrib_Yes" or s == "attrib_On":
        return 1
    else:
        return 0
    
def main():
    """Main"""
    # Create cache dir if it does not exist
    cachedir = '%s/cache' % os.path.dirname(os.path.realpath(__file__))
    if not os.path.exists(cachedir):
        os.makedirs(cachedir)

    # Skip manual check
    if len(sys.argv) > 1:
        if sys.argv[1] == 'manualcheck':
            print 'Manual check: skipping'
            exit(0)

    # Set the encoding
    # The "ugly hack" :P 
    reload(sys)  
    sys.setdefaultencoding('utf8')

    # Get results
    result = dict()
    result = flatten_bluetooth_info(get_bluetooth_info())

    # Write memory results to cache
    output_plist = os.path.join(cachedir, 'bluetoothinfo.plist')
    plistlib.writePlist(result, output_plist)
#    print plistlib.writePlistToString(result)

if __name__ == "__main__":
    main()
