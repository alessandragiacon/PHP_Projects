<?php

	if(isset($_POST["usuario"]) && isset($_POST["senha"]) && !empty($_POST["usuario"]) && !empty($_POST["senha"])){

		require_once("../resources/config.php");


		$dbArray = $config["db"]["db1"];

		$conn = mysqli_connect($dbArray["host"],$dbArray["dbUsername"],$dbArray["dbPassword"],$dbArray["dbName"]);

		if(!$conn){
			echo "Erro";
			die("Não foi possível conectar no banco de dados ".mysqli_errno());
		}

		$user = $_POST["usuario"];
		$senha = $_POST["senha"];

		$queryVerifica = "SELECT count(*) as 'qtdUser' FROM `usuarios` WHERE username = '$user' and senha = '$senha'";

		$resp = mysqli_query($conn, $queryVerifica);

		if($resp->num_rows > 0){
			if($row = $resp->fetch_assoc()){
				if($row['qtdUser'] > 0){
					echo "Usuário conectado";
				}else{
					echo "Esse usuário não existe!";
				}
			}
		}
		mysqli_close($conn);
		
		exit();
	}

?>