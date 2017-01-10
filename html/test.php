<?php

if (file_put_contents("../var/tmp/ephemeral/foo", "bar") === false) {
    echo "Cannot write";
} else {
    unlink("../ar/tmp/ephemeral/foo");
    echo "Can write";
}
