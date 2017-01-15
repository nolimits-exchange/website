<?php

echo "Current User";

var_dump(posix_getpwuid(posix_geteuid()));

echo "Umask";

var_dump(sprintf('%o', umask()));

echo "var/tmp/ephemeral directory listing";

$directory = __DIR__ . '/../var/tmp/ephemeral';

$files = array_diff(
    scandir($directory), ['.', '..']
);

foreach($files as $file) {
    echo "Perms for " . $file;
    
    var_dump(fileperms($file));
    
    echo "User for " . $file;
    
    var_dump(fileowner($file));
}
