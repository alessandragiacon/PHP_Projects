<?php
	require_once("../resources/config.php");	

		function validaEmail($email){
		    // First, we check that there's one @ symbol, and that the lengths are right
		    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
		        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		        return false;
		    }
		    // Split it into sections to make life easier
		    $email_array = explode("@", $email);
		    $local_array = explode(".", $email_array[0]);
		    for ($i = 0; $i < sizeof($local_array); $i++) {
		        if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
		            return false;
		        }
		    }
		    if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
		        $domain_array = explode(".", $email_array[1]);
		        if (sizeof($domain_array) < 2) {
		            return false; // Not enough parts to domain
		        }
		        for ($i = 0; $i < sizeof($domain_array); $i++) {
		            if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
		                return false;
		            }
		        }
		    }

		    return true;
		}


	if($_POST["nome"] == null || $_POST["password"] == null || $_POST["email"] == null || validaEmail($_POST["email"]) == false || $_POST["username"] == null){

		$Erro = 0;

		if($_POST["nome"] == null){
			$Erro += 1000;
		}
		if($_POST["password"] == null){
			$Erro += 100;
		}
		if($_POST["email"] == null || validaEmail($_POST["email"]) == false){
			$Erro += 10;
		}
		if($_POST["username"] == null){
			$Erro += 1;
		}
		header("location:cadastro.php"."?err=".$Erro);
		exit();
	}

	$nome = $_POST["nome"];
	$senha = $_POST["password"];
	$email = $_POST["email"];
	$user = $_POST["username"];


	$dbArray = $config["db"]["db1"];

	$conn = mysqli_connect($dbArray["host"],$dbArray["dbUsername"],$dbArray["dbPassword"],$dbArray["dbName"]);

	if(!$conn){
		echo "Erro";
		die("Não foi possível conectar no banco de dados ".mysqli_errno());
	}

	$queryVerifica = "SELECT count(*) as 'qtdUser' FROM `usuarios` WHERE username = '$user' or email = '$email'";

	$resp = mysqli_query($conn, $queryVerifica);

	if($resp->num_rows > 0){
		if($row = $resp->fetch_assoc()){
			if($row['qtdUser'] > 0){
				echo "Username ou Email já está em uso.";
				echo '<a href="javascript:history.back()">Voltar</a>';
				exit();
			}
			else{
				$queryInserir = "INSERT INTO usuarios (username, senha, email, nomeUser) values ('$user', '$senha', '$email', '$nome');";
				$res = mysqli_query($conn, $queryInserir);
				if(!$res){
					echo "Erro ao executar query";
				}
			}
		}
	}

	mysqli_close($conn);
	header("location:index.php")




















?>