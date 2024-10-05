<?php
// Fejlécek beállítása a kimenet előtt
header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// A kimeneti buffer kezelése
ob_start();

require_once("autoloader.php");
require_once("config.php");

Model::Connect();
Controller::ServRequest();

// A kimeneti buffer kiírása és a fejléc beállítása
View::RenderJSON();

// OPTIONS kérés kezelése (preflight request)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    ob_end_flush(); // Kimenet befejezése
    exit();
}

// A kimeneti buffer törlése és kiírása
ob_end_flush();
