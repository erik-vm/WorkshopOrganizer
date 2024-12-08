<?php

const USERNAME = "root";
const PASSWORD = "";
const HOST = "localhost";
const DBNAME = "workshop_organizer_db";

function getConnection(): PDO
{
    $address = sprintf("mysql:host=%s;dbname=%s", HOST, DBNAME);

    return new PDO($address, USERNAME, PASSWORD);
}


