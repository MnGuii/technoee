<?php
  include('seguranca.php');  
  protegePagina(); 
  $con = abreConexao();
  $sql="
    SELECT *,
    (SELECT ligou FROM maquinas_dados WHERE _id_maquinas = id_maquinas ORDER BY id_maquinas_dados desc LIMIT 1) as ligou,
    (SELECT desligou FROM maquinas_dados WHERE _id_maquinas = id_maquinas ORDER BY id_maquinas_dados desc LIMIT 1) as desligou
    FROM maquinas JOIN usuarios USING (_id_empresas) WHERE id_usuarios=".$_SESSION['usuarioID'].";";
  //die($sql);
  $tabela='';
  $resultado = mysqli_query($con,$sql) or die(mysqli_error($con));
  while($row = mysqli_fetch_array($resultado,MYSQLI_ASSOC))
  {
    if(($row['ligou'] == null && $row['desligou'] == null) || ($row['ligou'] != null && $row['desligou'] != null))
      $status = "Desligada";
    else if($row['ligou'] != null && $row['desligou'] == null)
      $status = "Ligada";
    $tabela .= "<tr style='padding: 2px'><td><a href='equipamentos.php?id_maquinas=".$row['id_maquinas']."'>".$row['cod_maquina']."</a></td><td>".$status."</td></tr>";
  }
  if($tabela=='')
    $tabela = '<tr style="padding: 2px" class="warning"><td colspan="2"><i class="fa fa-warning fa-fw"></i>&nbsp;Nenhuma máquina cadastrada</td><td>&nbsp;</td></tr>';
  mysqli_close($con);
?>
<html>
<head>
  <title>Página Inicial</title>
  <?php include("header.php");
    includes();
    style_grid();
  ?>
  <script type="text/javascript">
  function atualiza()
  {
    atual = new Date();
    hora = atual.getHours();
    if(hora < 10)
      hora = "0"+hora;
    minuto = atual.getMinutes();
    if(minuto < 10)
      minuto = "0"+minuto;
    segundo = atual.getSeconds();
    if(segundo < 10)
      segundo = "0"+segundo;
    //document.getElementById("hora").innerHTML = atual.getUTCDate()+"/"+(atual.getMonth()+1)+"/"+atual.getFullYear()+" "+hora+":"+minuto+":"+segundo;
    setTimeout(atualiza,1000);
  }
  </script>
</head>
<body onload="atualiza()"  style="background-color: #f0f8ff">
  
  <!-- Navigation -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a href="login.php?Logout=1" style="color: grey;" class="navbar-toggle collapsed" onclick='return sair();'><i class="fa fa-fw fa-lg fa-power-off"></i></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="login.php?Logout=1" class="navbar-toggle collapsed" onclick='return sair();'><i class="fa fa-fw fa-lg fa-power-off"></i></a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="col-xs-12">
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Bem vindo!</strong><br>
      <p>Você está conectado pelo IP: <?php echo $_SERVER["REMOTE_ADDR"]; ?></p>
      <!--<em>Data: <span id="hora"></span></em>-->
    </div> 
    <div class="panel panel-default">
      <!--<div class="panel-heading">
        <h3 class="panel-title">Máquinas</h3>
      </div>-->
      <div class="table-responsive">
          <table class="table table-responsive table-striped table-hover table-condensed">  
            <tr>
              <!-- BEGIN ControlTitle -->
                <th>Máquina</th>
                <th>Status</th>
              <!-- END ControlTitle -->
            </tr>     
              <?php echo $tabela; ?>
          </table>
      </div>
      <!--<div class="panel-footer">
        <a href="login.php?Logout=1" class='btn btn-lg btn-danger btn-block'>Sair</a>
      </div>-->
    </div>
  </div>
</body>
</html>		