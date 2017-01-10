<?php

if (file_put_contents("/tmp/foo", "bar") === false) {
    echo "Cannot write";
} else {
    unlink("/tmp/foo");
    echo "Can write";
}
