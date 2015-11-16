<?php
	include('seguranca.php');		
	$con = abreConexao();
	$sql="SELECT * FROM maquinas JOIN usuarios USING(_id_empresas) WHERE id_usuarios=".$_SESSION['usuarioID'].";";
	//die($sql);
	$tabela='';
	$resultado = mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row = mysqli_fetch_array($resultado,MYSQLI_ASSOC))
	{
		$tabela .= "<tr><td><a href='equipamento_scan.php?id_maquina=".$row['id_maquinas']."'>".$row['cod_maquina']."</a></td></tr>";
	}
	if($tabela=='')
		$tabela = '<tr class="warning"><td><i class="fa fa-warning fa-fw"></i>&nbsp;Nenhuma máquina cadastrada</td><td>&nbsp;</td></tr>';
	mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <title>Meus equipamentos</title>
  <?php include("header.php");
    includes();
  ?>
</head>
<body>
	<div id="wrapper">

		<?php
	    	//topo();
	  	?>

		<div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-table fa-fw fa-lg"></i>&nbsp;<strong>Meus Equipamentos</strong></h3>
					<div class="pull-right">
						<!-- Voce pode colocar outras funcoes aqui -->
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-responsive table-striped table-hover table-condensed">	
						<tr>
							<!-- BEGIN ControlTitle -->
								<th>Código da máquina</th>
							<!-- END ControlTitle -->
						</tr>			
						<!-- BEGIN Separator --><!-- END Separator -->	
						<!-- BEGIN Row -->
							<tr>
								<?php echo $tabela; ?>
								<td>&nbsp;<!-- Botoes --></td>
							</tr>
						<!-- END Row -->	
					</table>
				</div>
				<!-- BEGIN Footer -->
				<div class="panel-footer text-center" style="padding-top:0px;">
		                          <div class="text-right">
						  <!-- BEGIN Navigator Navigator --><ul class="pagination">
						  <!-- BEGIN First_On --><li><a href="#">&laquo;&laquo;</a></li><!-- END First_On -->
						  <!-- BEGIN First_Off --><li class="disabled"><a href="#">&laquo;&laquo;</a></li><!-- END First_Off -->
						  <!-- BEGIN Prev_On --><li><a href="#">&laquo;</a></li><!-- END Prev_On -->
						  <!-- BEGIN Prev_Off --><li class="disabled"><a href="#">&laquo;</a></li><!-- END Prev_Off -->
						  <!-- BEGIN Pages -->
						  <!-- BEGIN Page_On --><!--<li><a href="{Page_URL}">{Page_Number}</a></li><!-- END Page_On -->
						  <!-- BEGIN Page_Off --><!--<li class="active"><a href="#">{Page_Number}</a></li><!-- END Page_Off --><!-- END Pages --><!-- {Total_Pages} -->
						  <!-- BEGIN Next_On --><li><a href="#">&raquo;</a></li><!-- END Next_On -->
						  <!-- BEGIN Next_Off --><li class="disabled"><a href="#">&raquo;</a></li><!-- END Next_Off -->
						  <!-- BEGIN Last_On --><li><a href="#">&raquo;&raquo;</a></li><!-- END Last_On -->
						  <!-- BEGIN Last_Off --><li class="disabled"><a href="#">&raquo;&raquo;</a></li><!-- END Last_Off --></ul><!-- END Navigator Navigator -->
		                         </div>
		                         <div class="text-left" style="margin-top:-60px">
		                             <a href="index.php" class="btn btn-primary">Voltar</a>
		                         </div>
				</div>
				<!-- END Footer -->
			</div>
		</div>
	</div>
</body>
</html>	