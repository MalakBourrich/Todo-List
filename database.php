<?php 
try
{
    $pdo = new PDO('mysql:host=localhost;dbname=todo','root',123456);
}catch(PDOException $e)
{
    die("Error connection : ". $e->getMessage());
}
?>