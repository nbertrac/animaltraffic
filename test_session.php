<?php
// Démarre ou restaure une session
session_start();
// Teste si une connexion est active
if ((!isset($_SESSION['connected']) || !$_SESSION['connected']) && (!isset($_SESSION['user']) || $_SESSION['user']==! 'admin')){
    header('location:adminConnect.html');
    exit();
}