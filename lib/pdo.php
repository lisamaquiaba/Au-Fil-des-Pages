<?php
try
{
    $pdo = new PDO("mysql:dbname=au_fil_des_pages;host=localhost;charset=utf8mb4", "root", "");
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>