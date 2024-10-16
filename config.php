<?php

$cfg = array();

//Adatbázis konfigurációs beállítások
$cfg["dbhost"] = "mysql.rackhost.hu";
$cfg["dbdb"] = "c53281guitars";
$cfg["port"] = 3306;
$cfg["user"] = "c53281guitarapi";
$cfg["pass"] = "OzzyMotorhead666";



//REST beállítások
$cfg["procparam"] = "method";
$cfg["methods"]["getguitars"] = array("input" => array(), "method" => "GET", "name" => "GetGuitar");
$cfg["methods"]["getguitar"] = array("input" => array("id"), "method" => "GET", "name" => "GetGuitarById");
$cfg["methods"]["setguitar"] = array("input" => array("name", "type", "body", "neckProfile", "fretsSize", "fretCount", "bridgePU", "neckPU", "price", "image_url", "storeno"), "method" => "POST", "name" => "SetNewGuitar");
$cfg["methods"]["getstorenos"] = array("input" => array(), "method" => "GET", "name" => "GetAllStoreNos");
$cfg["methods"]["modguitar"] = array("input" => array("id"), "method" => "PUT", "name" => "ModGuitar");
$cfg["methods"]["delguitar"] = array("input" => array("id"), "method" => "DELETE", "name" => "DelGuitar");