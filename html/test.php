<?php

echo "Current User";

var_dump(posix_getpwuid(posix_geteuid()));

echo "Umask";

var_dump(sprintf('%o', umask()));

echo "/tmp";

$directory = '/tmp';

$files = array_diff(
    scandir($directory), ['.', '..']
);

foreach($files as $file) {
    echo "Perms for " . $file;
    
    var_dump(fileperms($file));
    
    echo "User for " . $file;
    
    var_dump(fileowner($file));
}
