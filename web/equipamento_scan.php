<?php
	include('seguranca.php');		
	$con = abreConexao();
	$sql="SELECT maquinas_oee.*,DATE_FORMAT(data,'%d/%m/%Y') as data_formata,(SELECT cod_maquina FROM maquinas WHERE id_maquinas=_id_maquinas) as cod_maquina FROM maquinas_oee WHERE _id_maquinas=".$_GET['id_maquina'];
	$sql="SELECT *,DATE_FORMAT(data,'%d/%m/%Y') as data_formata,DATE_FORMAT(ligou,'%d/%m/%Y %H:%i:%s') as ligou_formatado,DATE_FORMAT(desligou,'%d/%m/%Y %H:%i:%s') as desligou_formatado FROM maquinas_dados JOIN maquinas ON id_maquinas = _id_maquinas WHERE _id_maquinas=".$_GET['id_maquina'];
	//die($sql);
	$tabela='';
	$modal='';
	$resultado = mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row = mysqli_fetch_array($resultado,MYSQLI_ASSOC))
	{
		$tabela .= "<tr><td>".$row['data_formata']."</td><td style='text-align:center'>".$row['disponibilidade']."%</td><td style='text-align:center'>".$row['performance']."%</td><td style='text-align:center'>".$row['qualidade']."%</td><td style='text-align:center'>".$row['oee']."%</td><td><button class='btn btn-sm btn-warning' data-toggle='tooltip' data-placement='top' title='Ver detalhes' onclick='".'$("#'.$row['id_maquinas_dados'].'").modal("show");'."'><i class='fa fa-fw fa-search'></i></button></td></tr>";
        $cod_maquina=$row['cod_maquina'];
		$modal .= '<div class="modal fade" id="'.$row['id_maquinas_dados'].'">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<label>Ligou às</label>
						<span class="form-control">'.$row['ligou_formatado'].'</span>
						<label>Desligou às</label>
						<span class="form-control">'.$row['desligou_formatado'].'</span>
						<label>Motivo do desligamento</label>
						<span class="form-control">'.$row['motivo_desligamento'].'</span>
						<label>Quantidade produzida</label>
						<span class="form-control">'.$row['qtd_produzida'].'</span>
						<label>Quantidade perdida</label>
						<span class="form-control">'.$row['qtd_perdida'].'</span>
						<label>Tempo real produzindo</label>
						<span class="form-control">'.$row['tempo_produzindo'].'</span>
					   	<div id="chart-'.$row['id_maquinas_dados'].'" style="width:150px"></div>
					</div>
					<div class="modal-footer">
						<div class="btn btn-lg btn-info btn-block" data-dismiss="modal">Fechar</div>
					</div>
				</div>
			</div>
		</div>
		';
	}
	if($tabela=='')
		$tabela = '<tr class="warning"><td colspan="5"><i class="fa fa-warning fa-fw"></i>&nbsp;Nenhum registro</td><td></td></tr>';
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
  	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>
<body>
<div class="container">
    <div class="col-md-8 col-md-offset-2">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<i class="fa fa-table fa-fw fa-lg"></i>&nbsp;<strong>Relatório - <?php echo $cod_maquina;?></strong>&nbsp;&nbsp;
				<a class='btn btn-sm btn-info' href='modal_status.php' data-target='#modal-status' data-toggle='modal'>
					<i class='fa fa-dashboard fa-fw'></i> Histórico
				</a>
			</h3>
			<div class="pull-right">
				
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-responsive table-striped table-hover table-condensed">	
				<tr>
					<!-- BEGIN ControlTitle -->
						<th>Data</th>
						<th style='text-align:center'>Disponibilidade</th>
						<th style='text-align:center'>Performance</th>
						<th style='text-align:center'>Qualidade</th>
						<th style='text-align:center'>OEE</th>
						<th></th>
					<!-- END ControlTitle -->
				</tr>			
				<!-- BEGIN Separator --><!-- END Separator -->	
				<!-- BEGIN Row -->
					<?php echo $tabela; ?>
				<!-- END Row -->	
			</table>
		</div>
		<!-- BEGIN Footer -->
		<div class="panel-footer text-center">
                       <div class="text-left" style="display:none">
				  <!-- BEGIN Navigator Navigator --><ul class="pagination">
				  <!-- BEGIN First_On --><!--<li><a href="{First_URL}">&laquo;&laquo;</a></li>--><!-- END First_On -->
				  <!-- BEGIN First_Off --><li class="disabled"><a href="#">&laquo;&laquo;</a></li><!-- END First_Off -->
				  <!-- BEGIN Prev_On --><!--<li><a href="{Prev_URL}">&laquo;</a></li>--><!-- END Prev_On -->
				  <!-- BEGIN Prev_Off --><li class="disabled"><a href="#">&laquo;</a></li><!-- END Prev_Off -->
				  <!-- BEGIN Pages -->
				  <!-- BEGIN Page_On --><!--<li><a href="{Page_URL}">{Page_Number}</a></li>--><!-- END Page_On -->
				  <!-- BEGIN Page_Off --><!--<li class="active"><a href="#">{Page_Number}</a></li>--><!-- END Page_Off --><!-- END Pages --><!-- {Total_Pages} -->
				  <!-- BEGIN Next_On --><!--<li><a href="{Next_URL}">&raquo;</a></li>--><!-- END Next_On -->
				  <!-- BEGIN Next_Off --><li class="disabled"><a href="#">&raquo;</a></li><!-- END Next_Off -->
				  <!-- BEGIN Last_On --><!--<li><a href="{Last_URL}">&raquo;&raquo;</a></li>--><!-- END Last_On -->
				  <!-- BEGIN Last_Off --><li class="disabled"><a href="#">&raquo;&raquo;</a></li><!-- END Last_Off --></ul><!-- END Navigator Navigator -->
                       </div>
						<div class="text-left">
							<a class="btn btn-primary" href="equipamentos.php">Voltar</a>
						</div>
                       <div class="text-right" style="margin-top: -35px">
                            <a class="btn btn-success" href="dados_editar.php?id_maquina=<?php echo $_GET['id_maquina'];?>"><i class="fa fa-fw fa-plus"></i> Novo Registro</a>
                            <a class="btn btn-info" href="equipamentos_editar.php?id_maquina=<?php echo $_GET['id_maquina'];?>"><i class="fa fa-fw fa-cogs"></i> Editar os dados da máquina</a>
                       </div>
		</div>
		<!-- END Footer -->
	</div>
   </div>
</div>
<?php echo $modal; ?>
<div class="modal fade" id="modal-status">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>
</body>
</html>