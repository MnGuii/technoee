<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Dados Editar</title>
	<?php include("header.php");
		includes();
	?>
	
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                    <li>
                        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
                    <li>
                        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                    </li>
                    <li>
                        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                    </li>
                    <li>
                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Editar Dados <small>Calcular de OEE</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> COD_MAQUINA
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
				
				<?php

					include("seguranca.php"); // Inclui o arquivo com o sistema de seguran?a
					protegePagina();
						if(!$_GET["id_maquina"])
						{
							echo "<span style='text-align:center'>ERRO FATAL: não foi informado o id_maquina</span>";
							die();
						}
						if($_POST)
						{
							//NOS TESTES REALIZADOS, ESTAO SENDO INFORMADOS EM SEGUNDOS.
							//É PRECISO COLOCAR MASCARA DE HORA MINUTO E SEGUNDO
							//REALIZAR AS CONVERSOES E CALCULOS E INSERIR CORRETAMENTE NA BASE DE DADOS
							//POIS ATUALMENTE, AS HORAS ESTÃO SENDO SALVAS ERRADAS
							
							/*
							echo "
							<br> Tempo de Preparacao: ".$_POST["temp_prep"]."
							<br>Tempo de Reabastecimento: ".$_POST["temp_reab"]."
							<br>Quantidade Produzida: ".$_POST["qtd_prod"]."
							<br>Quantidade Perdida: ".$_POST["qtd_perd"]."
							<br>Tempo Produzindo: ".$_POST["temp_prod"]."
							<br>Tempo para produzir uma unidade: ".$_POST["temp_prod_uni"]."
							<br>
							";
							die();*/
							
							$temp_prep = explode(":",$_POST["temp_prep"]);
							$temp_prep = ($temp_prep[0]*3600)+($temp_prep[1]*60)+$temp_prep[2];
							$temp_reab = explode(":",$_POST["temp_reab"]);
							$temp_reab = ($temp_reab[0]*3600)+($temp_reab[1]*60)+$temp_reab[2];
							$temp_prod = explode(":",$_POST["temp_prod"]);
							$temp_prod = ($temp_prod[0]*3600)+($temp_prod[1]*60)+$temp_prod[2];
							$temp_prod_uni = explode(":",$_POST["temp_prod_uni"]);
							$temp_prod_uni = ($temp_prod_uni[0]*3600)+($temp_prod_uni[1])*60+$temp_prod_uni[2];

							$data = explode("/",$_POST["data"]);
							$data = $data[2]."-".$data[1]."-".$data[0];
							$qualidade = (($_POST["qtd_prod"]-$_POST["qtd_perd"])/$_POST["qtd_prod"])*100;
							$performance = ($_POST["qtd_prod"]/(($temp_prod-$temp_prep-$temp_reab)/$temp_prod_uni))*100;
							$disponibilidade = (($temp_prod-$temp_prep-$temp_reab)/$temp_prod)*100;
							$oee = (($disponibilidade/100) * ($performance/100) * ($qualidade/100))*100;
							/*
							echo "$oee = $disponibilidade * $performance * $qualidade <br>";
							echo $oee;
							*/
							$disponibilidade = number_format($disponibilidade,2);
							$performance = number_format($performance,2);
							$qualidade = number_format($qualidade,2);
							$oee = number_format($oee,2);
							
							$con = abreConexao();
							//Seleciona o id_empresa e quantidade a produzir da maquina
							$sql="(SELECT _id_empresas,quantidade_produzida FROM maquinas WHERE id_maquinas = ".$_GET["id_maquina"]." LIMIT 1)";
							$result = mysqli_query($con, $sql) or die("Erro na busca de id_empresa: ".mysqli_error($con));
							$row = mysqli_fetch_assoc($result);
							$id_empresas = $row["_id_empresas"];
							$qtd_produzir = $row["quantidade_produzida"];
							
							//Insere no BD os dados da disponibilidade
							$sql="INSERT INTO maquinas_disponibilidade(_id_maquina, _id_empresa, tempo_producao, tempo_preparacao, tempo_reabastecimento, resultado, data) VALUES ('".$_GET["id_maquina"]."' , '$id_empresas' ,'".$_POST["temp_prod"]."', '".$_POST["temp_prep"]."','".$_POST["temp_reab"]."','$disponibilidade',$data)";
							mysqli_query($con,$sql) or die("Erro no insert de disponibilidade: ".mysqli_error($con));
							
							//Insere no BD os dados da performance
							$sql="INSERT INTO maquinas_performance(_id_maquina, _id_empresa, qtd_deve_produzir, qtd_produzida, tempo_prod_uma_item, resultado, data) VALUES ('".$_GET["id_maquina"]."','$id_empresas','$qtd_produzir','".$_POST["qtd_prod"]."','".$_POST["temp_prod_uni"]."','$performance','$data')";
							mysqli_query($con,$sql) or die("Erro no insert de performance: ".mysqli_error($con));
							
							//Insere no BD os dados da qualidade
							$sql="INSERT INTO `maquinas_qualidade`(_id_maquina, _id_empresa, qtd_produzida, qtd_perdida, resultado, data) VALUES ('".$_GET["id_maquina"]."','$id_empresas','".$_POST["qtd_prod"]."','".$_POST["qtd_perd"]."','$qualidade','$data')";
							mysqli_query($con,$sql) or die("Erro no insert de qualidade: ".mysqli_error($con));
							
							$sql="
								INSERT INTO maquinas_oee(_id_maquinas,_id_empresas,result_dispon,result_perfor,result_qualid,resultado,data)
								VALUES('".$_GET["id_maquina"]."','$id_empresas','$disponibilidade','$performance','$qualidade','$oee','$data')
								";
							mysqli_query($con,$sql) or die("Erro no insert do OEE: ".mysqli_error($con));
						}
					?>
					
						<div class="col-md-8 col-md-offset-2">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title"><strong>Cálculo de OEE</strong></h3>
								</div>
								<div class="panel-body">
									<form method="post" action="dados_editar.php?id_maquina=<?php echo $_GET["id_maquina"];?>">
										<label>Data</label><input type="text" name="data" id="data" class="form-control">
										<label>Digite o tempo de preparação que a máquina teve para começar a funcionar</label><input type="text" name="temp_prep" id="temp_prep" class="form-control time">
										<label>Digite o tempo que levou para fazer o reabastecimento da máquina</label><input type="text" name="temp_reab" id="temp_reab" class="form-control time">
										<label>Digite a quantidade de matéria-prima produzida</label><input type="text" name="qtd_prod" id="qtd_prod" class="form-control">
										<label>Digite a quantidade de matéria-prima perdida</label><input type="text" name="qtd_perd" id="qtd_perd" class="form-control">
										<label>Digite o tempo em que a máquina deve produzir</label><input type="text" name="temp_prod" id="temp_prod" class="form-control time">
										<label>Digite o tempo em que a máquina leva para produzir uma unidade</label><input type="text" name="temp_prod_uni" id="temp_prod_uni" class="form-control time">
									
								</div>
								<div class="panel-footer">
									<input type="submit" value="Calcular" class="btn btn-lg btn-success btn-block">
									<button onclick="javascript:history.go(-1);return false;" class="btn btn-lg btn-primary btn-block">Voltar</button>
									</form>
								</div>
							</div>
						</div>	
				

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<script>
	$(document).ready(function(){
		$('.time').mask('00:00:00', {placeholder:"HH:mm:ss"});
	});
	</script>

</body>

</html>
