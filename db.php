<?php

require_once '../_lib/helper.inc';

$conn = helper_login('gp');
if (!$conn) {
    die("Database Connection FAILED !!!");
}
