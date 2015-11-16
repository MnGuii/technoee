<?php
	include("seguranca.php");
	if($_POST["email"] != null && $_POST["senha"] != null && $_POST["grupo"] != null)
	{
		$error="";
		$javascript="";
		$email = $_POST["email"];
		$senha = $_POST["senha"];
		$grupo = $_POST["grupo"];
		$nomeEmpresa = $_POST["nomeEmpresa"];
		$cnpj = $_POST["cnpj"];
		$nome = $_POST["nome"];
		$con = abreConexao();
		$sql="SELECT * FROM empresas WHERE cnpj='$cnpj'";
		$result = mysqli_query($con,$sql) or die(mysqli_error($con));
		if(mysqli_num_rows($result))
			$error.="<div class='alert alert-danger'>Este CNPJ já está cadastrado.</div>";
		$sql="SELECT * FROM usuarios WHERE usuario='$email'";
		$result = mysqli_query($con,$sql) or die(mysqli_error($con));
		if(mysqli_num_rows($result))
			$error.="<div class='alert alert-danger'>Este e-mail já está cadastrado.</div>";
		if($error)
		{
			$javascript="
			<script>
				document.getElementById('cnpj').value='$cnpj';
				document.getElementById('nomeEmpresa').value='$nomeEmpresa';
				document.getElementById('nome').value='$nome';
				document.getElementById('email').value='$email';
			</script>
			";
		}
		else
		{
			$sql="INSERT INTO empresas (cnpj,nome,data_inclusao,ip,ativo) VALUES ('$cnpj','$nome',NOW(),'".$_SERVER["REMOTE_ADDR"]."','S')";
			//die($sql);
			mysqli_query($con,$sql) or die(mysqli_error($con));
			$sql="SELECT id_empresas FROM empresas WHERE cnpj='$cnpj'";
			$result = mysqli_query($con,$sql) or die(mysqli_error($con));
			$row = mysqli_fetch_assoc($result);
			$sql="INSERT INTO usuarios (_id_grupos,_id_empresas,usuario,senha,nome) VALUES ('$grupo','".$row["id_empresas"]."','$email','".md5($senha)."','$nome')";
			mysqli_query($con,$sql) or die(mysqli_error($con));
			mysqli_close($con);
			header("Location: index.php");
		}
		mysqli_close($con);
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastro</title>
    <?php include("header.php");
      includes();
    ?>
    <title>Cadastro</title>
</head>
<body>
   <div class="container">
    <div class="col-md-6 col-md-offset-3">
	 <?php echo $error; ?>
     <div class="row">
      <form method="post" action="cadastrar.php">
		<label class="control-label">CNPJ</label><input class="form-control" id="cnpj" name="cnpj" type="text" required><br>
		<label class="control-label">Nome da Empresa</label><input class="form-control" id="nomeEmpresa" name="nomeEmpresa" type="text" required><br>
		<label class="control-label">Seu nome</label><input class="form-control" id="nome" name="nome" type="text" required><br>
		<label class="control-label">E-mail</label><input class="form-control" id="email" name="email" type="email" required><br>
        <label class="control-label">Senha</label> <input type="password" name="senha" id="senha" class="form-control" required><br>
		<input type="hidden" value="1" name="grupo" id="grupo">
        <button class="btn btn-lg btn-success btn-block"> <i class="fa fa-thumbs-up fa-fw"></i> Cadastrar</button><br>
        <a class="btn btn-lg btn-warning btn-block" href="login.php"> <i class="fa fa-arrow-left fa-fw"></i> Voltar</a><br>
      </form>
    </div>
   </div>
  </div>
  <?php echo $javascript; ?>
</body>
</html>