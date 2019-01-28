<?php

try
{
	$data=new PDO('mysql:host=localhost;dbname=BloodBankSystem;charset=utf8','root','');
}
catch(PDOException $e)
{
    $dataStatus= "Connection failed: " . $e->getMessage();
}

?>

