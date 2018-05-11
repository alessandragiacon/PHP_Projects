<?php
	require_once("../resources/config.php");
?>
<html>
	<head>

		<title></title>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="js/jquery.NobleCount.min.js"></script>
		<script>
		$(function(){
			$("#caixatxt").NobleCount("#charsLeft",{
				on_negative: 'go_red',
				on_positive: 'go_green',
				max_chars: 150
			});
		});
		</script>
	</head>

	<body>
		<?php 
			$msg = "";
			if($_GET["err"]){
				if($_GET["err"] == 1){
					echo "<h1> A Sua mensagem tem um tamanho inadequado.</h1>";
					$msg = $_GET["msg"];
				}
			}
		?>
		<form action="postar.php" method="POST" name="" >
			<textarea class="caixatxt" name="caixatxt" id="caixatxt"><?= $msg ?></textarea>
			<br/>
			Characteres sobrando: <span id="charsLeft"></span>		
			<button type="submit" class="send" id="button">Enviar!</button>
		</form>
		<p></p>
		<div>
			<h2>Ultimas 10 mensagens</h2>
			<?php
				$dbArray = $config["db"]["db1"];
				$conn = mysqli_connect($dbArray["host"],$dbArray["dbUsername"],$dbArray["dbPassword"],$dbArray["dbName"]);
				if(!$conn){?>
					<h1>Erro no BD</h1>
					<?php
				}

				$queryExibir = "SELECT mensagem, DATE_FORMAT(reg_date,'%H:%i %d/%m/%Y') as reg_date FROM `post` ORDER BY reg_date desc limit 10";
				$resp = mysqli_query($conn, $queryExibir);
				$elementoHTML = "<table>
				<tr><th>Mensagem</th>
				<th>Data de Envio</th></tr>";
				if($resp->num_rows > 0){
					// exibir posts
					while($row = $resp->fetch_assoc()){
						$elementoHTML .= "<tr><td>".$row["mensagem"]." (numChars ".strlen($row["mensagem"]).")</td>
						<td>".$row["reg_date"]."</td>
						</tr>";
					}
				}
				$elementoHTML .= "</table>";
				echo $elementoHTML;
				mysqli_close($conn);
			?>
		</div>
		<br/>
		<a href="login.php">LOGIN</a>
		<br/>
		<a href="cadastro.php">CADASTRAR</a>
		<br/>
	</body>
</html>