<?php

require_once 'functions.php';
$db = new Testing();

$db->deleteUser(3, 10);

?>