<?php
  include('seguranca.php'); 
  protegePagina(); 
  $con = abreConexao();
  $sql="
    SELECT *, DATE_FORMAT(ligou,'%d/%m/%Y às %H:%i:%s') as ligou_formatado FROM maquinas_dados JOIN maquinas ON id_maquinas = _id_maquinas WHERE _id_maquinas = ".$_GET["id_maquinas"]." ORDER BY id_maquinas_dados desc LIMIT 1";
  //die($sql);
  $resultado = mysqli_query($con,$sql) or die(mysqli_error($con));
  $row = mysqli_fetch_array($resultado,MYSQLI_ASSOC);
  if(($row['ligou'] == null && $row['desligou'] == null) || ($row['ligou'] != null && $row['desligou'] != null))
  {
    $status = '<span class="text-danger">Desligada</span>';
    $btn_ligar = '';
    $btn_desligar = 'disabled';
  }
  else if($row['ligou'] != null && $row['desligou'] == null)
  {
    $status = '<span class="text-success">Ligada desde '.$row['ligou_formatado'].'</span>';
    $btn_ligar = 'disabled';
    $btn_desligar = '';
  }
  
  mysqli_close($con);
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Equipamento</title>
  <?php include("header.php");
      includes();
    ?>
    <script>
    function getHour()
    {
      atual = new Date();
      hora = atual.getHours();
      minuto = atual.getMinutes();
      segundo = atual.getSeconds();
      document.getElementById("hr_desligamento").value = atual.getFullYear()+"-"+(atual.getMonth()+1)+"-"+atual.getUTCDate()+" "+hora+":"+minuto+":"+segundo;
    }
    </script>
</head>
<body style="background-color: #f0f8ff">
  <?php
    topo('index.php',$row["cod_maquina"]);
  ?>
  <div class="col-xs-10 col-xs-offset-1">
    <h1 style="text-align:center"><?php echo $row["cod_maquina"]; ?></h1>
    <h4 style="text-align:center"><strong>Status: </strong> <?php echo $status; ?></h4>
    <div class="panel panel-default">
      <div class="panel-body">
      	<table width="100%">
      		<tr>
      			<td width="50%">
          			<a <?php echo $btn_ligar; ?> href="equipamentos_ligar.php?id_maquinas=<?php echo $_GET["id_maquinas"] ?>" class="btn btn-lg btn-success pull-left" style="width:98%;">Ligar<br><i class="fa fa-fw fa-2x fa-power-off"></i></a>
          		</td>
          		<td width="50%">
          			<div <?php echo $btn_desligar; ?> onclick="getHour();$('#modalDesligar').modal('show');" class="btn btn-lg btn-danger pull-right" style="width:98%">Desligar<br><i class="fa fa-fw fa-2x fa-power-off"></i></div>
          		</td>
          	</tr>
        </table>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalDesligar">
    <div class="modal-dialog">
      <div class="modal-content">
        <!--<div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Informe os dados para concluir o desligamento</h4>
        </div>-->
        <form method="post" action="equipamentos_desligar.php">
        <div class="modal-body">
            <label>Qual o motivo do desligamento?</label>
            <select class="form-control" name="motivo" required>
                <option value="">Escolha um motivo</option>
                <option value="Fim do experiente">Fim do expediente</option>
                <option value="Falta de Matéria-Prima">Falta de Matéria-Prima</option>
                <!--<option value="Reabastecimento">Reabastecimento</option>-->
                <option value="Manutenção">Manutenção</option>
            </select>
            <!--<label>Hora do desligamento</label>-->
            <input type="hidden" class="form-control" name="hr_desligamento" id="hr_desligamento" required>
            <label>Qual a quantidade produzida?</label>
            <input type="number" class="form-control" name="qtd_prod" required>
            <label>Qual a quantidade perdida?</label>
            <input type="number" class="form-control" name="qtd_perd" required>
            <label>Quantas vezes a máquina foi reabastecida?</label>
            <input type="number" value='0' class="form-control" name="qtd_reab" required>  
            <input type="hidden" name="id_maquinas" value="<?php echo $_GET["id_maquinas"] ?>">         
        </div>
        <div class="modal-footer">
          <input type="submit" value="Confirmar Desligamento" class="btn btn-lg btn-success btn-block">
          <div class="btn btn-lg btn-info btn-block" data-dismiss="modal">Cancelar</div>
      </div>
    </form>
    </div>
  </div>
</body>
</html>