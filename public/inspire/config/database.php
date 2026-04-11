<?php
###########################################################################
#
# NAME:  Database Connection CRUD operation from API
#
# COMMENT:  CRUD
#
# VERSION HISTORY:
#
# Sample: DatabaseOperation(Data,Table Name, Operation(0,1,2,3));
# Select - 0, Insert - 1, Update - 2, Delete -3
###########################################################################

include_once 'functions.php';

## DB Connection ##

function connect()
{
    $host = "db";
    $username = "admin_edinz";
    $password = "Ke2FES@e4evxIUT";
    //$username = "root";
    //$password = "";
    $db_name = "admin_edinz";
    try {
        $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
    } catch (PDOException $exception) {
        echo "Connection error: " . $exception->getMessage();
    }
    return $conn;
}

