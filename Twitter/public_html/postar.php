<?php
	
	require_once("../resources/config.php");

	//require_once(realpath(dirname(__FILE__)."/../config.php"));


	//Código PHP vai Aqui
	$txtMsg =  $_POST["caixatxt"];

	if(strlen($txtMsg) == 0 || strlen($txtMsg) > 150){		
		header("location:index.php"."?err=1&msg=".$txtMsg);
		exit();
	}

	//echo realpath(dirname(__FILE__)."/../resources/config.php");

	$dbArray = $config["db"]["db1"];

	$conn = mysqli_connect($dbArray["host"],$dbArray["dbUsername"],$dbArray["dbPassword"],$dbArray["dbName"]);
	//$conn = new mysqli($dbArray["host"],$dbArray["dbUsername"],$dbArray["dbPassword"],$dbArray["dbName"]);

	if(!$conn){
		echo "Erro";
		die("Não foi possível conectar no banco de dados ".mysqli_errno());
	}
	$queryInserir = "INSERT into post(mensagem) values('$txtMsg');";

	$res = mysqli_query($conn, $queryInserir);
	if(!$res){
		echo "Erro ao executar query";
	}

	mysqli_close($conn);
	header("location:index.php")

	//$conn->close();
?>