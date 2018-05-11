<?php 

// Informações de configuração

$config = array(
		"db" => array(
			"db1" => array(
				"dbName" =>"db_twitter",
				"dbUsername" => "adminTwitter",
				"dbPassword" => "password",
				"host" => "localhost"),
			"db2" => array()),
		"urls" => array(),
		"paths" => array(
			"resources" => "",
			"images" => array(
				"content" => $_SERVER["DOCUMENT_ROOT"]."/images/content",
				"layout" =>	$_SERVER["DOCUMENT_ROOT"]."/images/layout",
			)
		)
	);

/* Reportar os erros*/

ini_set("error_reporting", "true");
error_reporting(E_ALL||E_STRCT);
?>