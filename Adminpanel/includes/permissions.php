<?php

$PERMISSIONS_CONFIG = [
    "PlayersView" => "Spieler anzeigen",
    "PlayersEdit" => "Spieler bearbeiten",
    "InvBack" => "Unsichtbarer Rucksack",
    "AdRank" => "Admin-Rang bearbeiten",
    "CopRank" => "Polizei-Rang bearbeiten",
    "ThrRank" => "THR-Rang bearbeiten",
    "NoBodyRank" => "NoBody-Rang bearbeiten",
    "PCash" => "Bankkonto bearbeiten",
    "VehicleView" => "Fahrzeuge anzeigen",
    "VehicleEdit" =>"Fahrzeuge bearbeiten",
    "VehicleReset" => "Fahrzeuge zurücksetzen",
    "VehicleResetAdv" => "ChopShop zurücksetzen",
    "GangsView" => "Gangs anzeigen",
    "GangEdit" => "Gangs bearbeiten",
    "GangCash" => "Gang-Geld bearbeiten",
    "GangMember" => "Gang-Mitglieder bearbeiten",
    "UserView" => "Benutzer anzeigen",
    "UserDel" => "Benutzer löschen",
    "UserEdit" => "Benutzer bearbeiten",
    "LogsView" => "Logs anzeigen",
    "UserRoot" => "Root",
    "BanTmp" => "Temp-Ban",
    "BanPerm" => "Perm-Ban",
    "BanKick" => "Kicken",
    "BanUnbanAll" => "Alle entbannen"
];

$PERMISSION_GROUPS = [
  "Player" => ["Spieler",["PlayersView","PlayersEdit","InvBack","AdRank","CopRank","ThrRank","NoBodyRank","PCash"]],
  "Gangs" => ["Gangs",["GangsView","GangEdit","GangCash","GangMember"]],
  "Vehicle" => ["Fahrzeug",["VehicleView","VehicleEdit","VehicleReset","VehicleResetAdv"]],
  "User" => ["Benutzer",["UserView","UserEdit","UserDel","UserRoot","LogsView"]],
  "Rcon" => ["Rcon",["BanKick","BanTmp","BanPerm","BanUnbanAll"]]
];