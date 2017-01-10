<?php

$dir = scandir('/tmp');

print_r($dir);

$dir = scandir('var/tmp/ephemeral');

print_r($dir);
