#!/bin/bash

# Remove bluetooth script
rm -f "${MUNKIPATH}preflight.d/bluetooth.py"
rm -f "${MUNKIPATH}preflight.d/bluetooth.sh"

# Remove bluetoothinfo.txt file
rm -f "${CACHEPATH}bluetoothinfo.txt"
rm -f "${CACHEPATH}bluetoothinfo.plist"
