<?php
	function includes(){
		echo '<script src="./jquery/jquery-2.1.3.min.js"></script>
		<!-- bootstrap -->
		<link rel="stylesheet" href="./bootstrap-3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="./bootstrap-3.3.4/css/bootstrap-theme.min.css">
		<script src="./bootstrap-3.3.4/js/bootstrap.js"></script>
		<!-- ./bootstrap -->

		<!-- fontawesome -->
		<link rel="stylesheet" href="./font-awesome-4.3.0/css/font-awesome.min.css">
		<!-- ./fontawesome -->
		
		<!-- mask -->
		<script src="./lib/jquery.mask.js"></script>
		<!-- ./mask -->

		<script>
			function sair(){
				var resposta = confirm("Deseja realmente sair?");
				if(resposta)
					return true;
				else
					return false;
			}
		</script>
		';
	}
	function style_grid(){
		echo '
		<style>
			td{padding-top:7px !important;padding-bottom:7px !important;}
		</style>
		';
	}
	function topo($voltar,$nome)
	{
		echo '
			<!-- Navigation -->
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<a href="login.php?Logout=1" style="color: gray;" onclick="return sair();" class="navbar-toggle collapsed"><i class="fa fa-fw fa-lg fa-power-off"></i></a>
						<!--
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						-->
						<a class="navbar-brand" href="'.$voltar.'">
							<i class="fa fa-fw fa-lg fa-arrow-left"></i> '.$nome.'
						</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="login.php?Logout=1" onclick="return sair();" class="navbar-toggle collapsed"><i class="fa fa-fw fa-lg fa-power-off"></i></a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		';
	}
?>