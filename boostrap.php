<?php

require_once __DIR__ .  "/vendor/autoload.php";
use Config\Database;

$CONNECTION_VAR = Database::connect_database();
