<?php

include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina();
	if($_GET["id_maquina"] != null)
	{
		$parametros="?id_maquina=".$_GET['id_maquina'];
                $BotaoVoltar="equipamento_scan.php?id_maquina=".$_GET['id_maquina'];
		$NomeDoBotao="Alterar Dados";
		$con = abreConexao();
		if($_POST != null)
		{
			$sql="
			UPDATE maquinas SET 
			cod_maquina='".$_POST["cod_maq"]."',
			tempo_programado='".$_POST["temp_prog"]."',
			tempo_preparacao='".$_POST["temp_prep"]."',
			tempo_reabastecimento='".$_POST["temp_rea"]."',
			quantidade_produzida='".$_POST["qntd_prod"]."',
			tempo_ciclo='".$_POST["temp_ciclo"]."'
			WHERE id_maquinas=".$_GET['id_maquina'];
			mysqli_query($con,$sql);
		}
		$sql="SELECT * FROM maquinas WHERE id_maquinas=".$_GET["id_maquina"];
		if($result = mysqli_query($con,$sql))
		{
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$valores = "
					<script>
						document.getElementById('cod_maq').value='".$row['cod_maquina']."';
						document.getElementById('temp_prog').value='".$row['tempo_programado']."';
						document.getElementById('temp_prep').value='".$row['tempo_preparacao']."';
						document.getElementById('temp_rea').value='".$row['tempo_reabastecimento']."';
						document.getElementById('qntd_prod').value='".$row['quantidade_produzida']."';
						document.getElementById('temp_ciclo').value='".$row['tempo_ciclo']."';
					</script>
				";
			}
		}
		mysqli_close($con);
	}
	else
	{
		$parametros="";
        $BotaoVoltar="index.php";
		$NomeDoBotao="Cadastrar Máquina";
		if($_POST["cod_maq"] != null && $_POST["temp_prog"] != null && $_POST["temp_prep"] != null && $_POST["temp_rea"] != null && $_POST["qntd_prod"] != null && $_POST["temp_ciclo"] != null)
		{
			$cod_maquina= $_POST["cod_maq"];
			$tempo_programado= $_POST["temp_prog"];
			$tempo_preparacao= $_POST["temp_prep"];
			$tempo_reabastecimento= $_POST["temp_rea"];
			$quantidade_produzida= $_POST["qntd_prod"];
			$tempo_ciclo= $_POST["temp_ciclo"];
			$con = abreConexao();
			$sql="INSERT INTO maquinas (_id_empresas,cod_maquina,tempo_programado,tempo_preparacao,tempo_reabastecimento,quantidade_produzida,tempo_ciclo,datahora_inclusao,_id_inclusao,ativo) VALUES ((SELECT _id_empresas FROM usuarios WHERE id_usuarios=".$_SESSION['usuarioID']."),'$cod_maquina','$tempo_programado','$tempo_preparacao','$tempo_reabastecimento','$quantidade_produzida','$tempo_ciclo',NOW(),".$_SESSION['usuarioID'].",'S')";
			//die($sql);
			mysqli_query($con,$sql) or die(mysqli_error($con));
			mysqli_close($con);
			header("Location: index.php");
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <title>Editar equipamento</title>
  <?php include("header.php");
    includes();
  ?>
  <script>
  $(document).ready(function(){
	$(".time").mask("00:00:00",{placeholder:"HH:mm:ss"});
  });
  </script>
</head>
<body>
	<div class="container">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-fw fa-edit"></i> <strong>Editar</strong></h3>
				</div>
				<div class="panel-body">
					<form action="equipamentos_editar.php<?php echo $parametros;?>" method="post">
					<label>Código da máquina</label><input type="text" name="cod_maq" id="cod_maq" class="form-control">
					<label>Tempo programado</label><input type="text" name="temp_prog" id="temp_prog" class="form-control time">
					<label>Tempo de preparação</label><input type="text" name="temp_prep" id="temp_prep" class="form-control time">
					<label>Tempo de reabastecimento</label><input type="text" name="temp_rea" id="temp_rea" class="form-control time">
					<label>Quantidade produzida</label><input type="text" name="qntd_prod" id="qntd_prod" class="form-control">
					<label>Tempo do ciclo</label><input type="text" name="temp_ciclo" id="temp_ciclo" class="form-control time">
				</div>
				<div class="panel-footer">
					<input type="submit" class="btn btn-lg btn-block btn-success" value="<?php echo $NomeDoBotao ?>">
					<button class="btn btn-lg btn-block btn-info" onclick="javascript:window.location='<?php echo $BotaoVoltar; ?>'; return false;">Voltar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php 
		if($_GET["id_maquina"] != null)
		{
			echo $valores;
		}
	?>
</body>
</html>