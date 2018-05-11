<html>
	<head>
		<title>Cadastre-se!</title>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>
	<body>
		<?php  
			$erro = 0;
			if(isset($_GET["err"]) && $_GET["err"] <= 1111){
				$erro = $_GET["err"];
			}
		?>
		<form action="cadastrausuario.php" method="post"> 
			<div>*Nome completo:</div>
			<input type="textfield" name="nome"></input><?php if(isset($_GET["err"]) == true && $erro >= 1000){ echo "*Campo Obrigatório"; $erro -= 1000;} ?><br/><br/>
			<div>*Senha:</div>
			<input type="textfield" name="password"></input><?php if(isset($_GET["err"]) == true && $erro >= 100){ echo "*Campo Obrigatório"; $erro -= 100;} ?><br/><br/>
			<div>*Email:</div>
			<input type="textfield" name="email"></input><?php if(isset($_GET["err"]) == true && $erro >= 10){echo "*Campo Obrigatório"; $erro -= 10;} ?><br/><br/>
			<div>*Nome de Usuário:</div>
			<input type="textfield" name="username"></input><?php if(isset($_GET["err"]) == true && $erro >= 1){ $erro = $_GET["err"]; echo "*Campo Obrigatório"; $erro -= 1;}?><br/><br/>
			<button type="submit" value="submit">Efetuar cadastro</button><br/>
		</form>	
		<div>* Itens obrigatórios</div>
	</body>
</html>

