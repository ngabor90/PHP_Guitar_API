<?php

// Hibaüzenetek kiírása (fejlesztési környezetben)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS fejlécek beállítása
header("Access-Control-Allow-Origin: https://guitarapi.eu");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// OPTIONS kérés kezelése (preflight request)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200); // Válasz 200 OK
    exit();
}

// A kimeneti buffer kezelése
ob_start();

require_once("autoloader.php");
require_once("config.php");

// Kapcsolódás az adatbázishoz
Model::Connect();

// Kérés kiszolgálása
Controller::ServRequest();

// A kimeneti buffer kiírása és a fejléc beállítása
View::RenderJSON();

// A kimeneti buffer törlése és kiírása
ob_end_flush();
