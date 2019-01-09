#!/bin/bash
echo "This script (install.sh) makes a config.php file and gets Parsedown"

if [ ! -f config.php ]; then
    echo "Creating config.php from sample..."
    cp config.sample.php config.php
else
    echo "  skipping making config.php because it already exists."
fi

if [[ ! -d lib || ! -d lib/parsedown ]]; then
    mkdir -p lib/parsedown
fi

echo "  updating lib/parsedown with the latest release..."
curl --silent "https://api.github.com/repos/erusev/parsedown/releases/latest" | grep '"tag_name":' | sed -E 's/.*"([^"]+)".*/\1/' | xargs -I {} curl -sL "https://github.com/erusev/parsedown/archive/"{}'.tar.gz' | tar -xz --strip-components=1 -C lib/parsedown/;
echo "Finished (install.sh)"
