<?php
	error_reporting(E_ERROR);
	if(isset($_GET)){

		// PESOS SINAPTICOS DE ENTRADA 
		$pesos = array(
				"x1" => 0,
				"x2" => 0,
				"x3" => 0,
				"x4" => 0,
				"bias" => 0
			);

		// VARIAVEL RESPONSAVEL PELO SOMATORIO 
		$NET = 0;

		// VARIAVEL RESPONSAVEL PELO NUMERO MAXIMO DE EPOCAS
		$epocasMax = 30;

		// Contador de epocas
		$count = 0;
		
		/* Matriz de aprendizado
		// S = (A+B) * (B+D') + C * (D+A') <- Função lógica que o perceptron irá aprender
		[
			[x1][x2][x3][x4][ValorEsperado]
		]
		*/
		$matrizAprendizado = array(
								array(0,0,0,0,0),
								array(1,0,0,0,0),
								array(1,1,0,0,0),
								array(1,1,1,0,1),
								array(1,1,1,1,1),
								array(0,1,0,0,0),
								array(0,1,1,0,1),
								array(0,1,1,1,1)
		);

		// METODO RESPONSAVEL PELA FUNÇÃO DE ATIVAÇÃO
		function executar($x1,$x2,$x3,$x4){
			global $pesos;
			$NETRetorno = ($x1 * $pesos["x1"]) + ($x2 * $pesos["x2"]) + ($x3 * $pesos["x3"]) + ($x4 * $pesos["x4"]) + ($pesos["bias"] * (-1));

			if($NETRetorno >= 0){
				return 1;
			}
			else{
				return 0;
			}
		}

		function corrigirPesos($i, $saida){
			global $pesos, $matrizAprendizado;
			$pesos["x1"] = $pesos["x1"] + (1 * ($matrizAprendizado[$i][4] - $saida) * $matrizAprendizado[$i][0]);
			$pesos["x2"] = $pesos["x2"] + (1 * ($matrizAprendizado[$i][4] - $saida) * $matrizAprendizado[$i][1]);
			$pesos["x3"] = $pesos["x3"] + (1 * ($matrizAprendizado[$i][4] - $saida) * $matrizAprendizado[$i][2]);
			$pesos["x4"] = $pesos["x4"] + (1 * ($matrizAprendizado[$i][4] - $saida) * $matrizAprendizado[$i][3]);
			$pesos["bias"] = $pesos["bias"] + (1 * ($matrizAprendizado[$i][4] - $saida) * (-1));
		}

		function treinar(){
			global $pesos, $matrizAprendizado, $count, $epocasMax;
			$treinou = true; // Variavel de verificação de sucesso de treinamento
			$saida = 0;

			for($i = 0; $i < sizeof($matrizAprendizado); $i++){
				$saida = executar($matrizAprendizado[$i][0],$matrizAprendizado[$i][1],$matrizAprendizado[$i][2],$matrizAprendizado[$i][3]);
				if($saida != $matrizAprendizado[$i][4]){
					corrigirPesos($i,$saida);
					$treinou = false;
				}
			}

			$count++;
		
			if($treinou == false && $count < $epocasMax){
				treinar();
			}
		}

		// Perceptron foi treinado
		treinar();

		$x1Entrada = $_GET["x1"];
		$x2Entrada = $_GET["x2"];
		$x3Entrada = $_GET["x3"];
		$x4Entrada = $_GET["x4"];

		$saidasPedidas = executar($x1Entrada,$x2Entrada,$x3Entrada,$x4Entrada);
		echo "A=".$x1Entrada."<br/>";
		echo "B=".$x2Entrada."<br/>";
		echo "C=".$x3Entrada."<br/>";
		echo "D=".$x4Entrada."<br/>";
		echo "Saida: ".$saidasPedidas;

	}
	
?>
<html>
	<header>
	

	</header>
	<body>
		<form action="index.php" method="GET">
			<p>x1:</p>
			<input name="x1"></input><br/>
			<p>x2:</p>
			<input name="x2"></input><br/>
			<p>x3:</p>
			<input name="x3"></input><br/>
			<p>x4:</p>
			<input name="x4"></input><br/>
			<button>Enviar</button>
		</form>
	</body>
</html>