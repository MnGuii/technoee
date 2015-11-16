<?php
	date_default_timezone_set("America/Sao_Paulo");
	include('seguranca.php');
	protegePagina();
	$con = abreConexao();
	$sql="INSERT INTO maquinas_dados (_id_maquinas,_id_empresas,ligou,data) 
	VALUES ('".$_GET["id_maquinas"]."',(SELECT _id_empresas FROM maquinas WHERE id_maquinas=".$_GET["id_maquinas"]."),'".date("Y-m-d H:i:s")."','".date("Y-m-d")."');";
	//die($sql);
	mysqli_query($con,$sql) or die(mysqli_error($con));
	mysqli_close($con);
	header("Location: index.php");
?>