#!/bin/bash
file="/usr/share/applications/$(xdg-mime query default "$(xdg-mime query filetype "$1")")"
while IFS= read -r line; do
    if [[ $line == *"Name="* ]]; then
        echo "${line/"Name="/""}"
    fi
done < "$file"
