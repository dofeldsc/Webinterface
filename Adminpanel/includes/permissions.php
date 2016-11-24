<?php

$PERMISSIONS_CONFIG = [
    "PlayersView" => ["PlayersView", "Spieler anzeigen"],
    "PlayersEdit" => ["PlayersEdit", "Spieler bearbeiten"],
    "VehicleView" => ["VehicleView", "Fahrzeuge anzeigen"],
    "VehicleEdit" => ["VehicleEdit", "Fahrzeuge bearbeiten"],
    "VehicleReset" => ["VehicleReset", "Fahrzeuge zurücksetzen"],
    "UserView" => ["UserView", "Benutzer anzeigen"],
    "UserAdd" => ["UserAdd", "Benutzer erstellen"],
    "UserEdit" => ["UserEdit", "Benutzer bearbeiten"],
    "UserRoot" => ["UserRoot", "Root"],
    "BanTmp" => ["BanTmp", "Temp-Ban"],
    "BanPerm" => ["BenPerm", "Perm-Ban"],
    "BanKick" => ["BanKick", "Kicken"],
    "BanUnbanAll" => ["BanUnbanAll", "Alle entbannen"]
];

$PERMISSION_GROUPS = [
  "Player" => ["Spieler",["PlayersView","PlayersEdit"]],
  "Vehicle" => ["Fahrzeug",["VehicleView","VehicleEdit","VehicleReset"]],
  "User" => ["Benutzer",["UserView","UserEdit","UserAdd","UserRoot"]],
  "Rcon" => ["Rcon",["BanKick","BanTmp","BanPerm","BanUnbanAll"]]
];
