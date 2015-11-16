<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<title>Login</title>
  	<?php
	  	if($_GET['Logout'] == 1)
                {
                   // remove all session variables
                   session_unset(); 

                   // destroy the session 
                   session_destroy();
                   
                   header("Location:login.php");
                }
                include("header.php");
		includes();
		$var = $_GET['type'];
		//die($var);   
		if($_GET['type'] == 'incorrect')
		{
			echo "
				<script>
				function erro(){
					document.getElementById('erro').innerHTML='<div class=\"alert alert-danger\" role=\"alert\">Usuário ou Senha estao incorretos.</div>';
				}
				</script>
			";
			$body = "onload='erro();'";
		}
		else
		{
			$body = "";
		}
	?>
</head>
<body <?php echo $body ?>>
	<div class="container">
<div style="height:20px;">
  <!-- Espa�o top -->
</div>
<p class="text-center"><img src=""></p>
<div style="height:20px;">
  <!-- Espaço top -->
</div>

		<div class="col-md-6 col-md-offset-3">
			<div id="erro"></div>
	      	<form method="post" action="valida.php">
		      	<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-lock fa-fw fa-lg"></i>&nbsp;<strong>Entre com seus dados</strong></h3>
		      		</div>
		      		<div class="panel-body">      			
    					<div class="form-group">
							<label class="control-label">E-mail </label>
							<input class="form-control" name="usuario" type="email" required autofocus>
						</div>
						<div class="form-group">
							<label class="control-label">Senha</label>
							<input type="password" name="senha" class="form-control" >
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-lg btn-success btn-block"> <i class="fa fa-check fa-fw"></i> Entrar</button>
						<!--<a class="btn btn-lg btn-warning btn-block" href="recuperar_senha.html"><i class="fa fa-search fa-fw"></i>Esqueci minha senha</a></br>-->
						<a class="btn btn-lg btn-info btn-block" href="cadastrar.php"><i class="fa fa-plus fa-fw"></i>Cadastre sua Empresa</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>		