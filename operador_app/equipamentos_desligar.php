<?php
if($_POST)
{
  date_default_timezone_set("America/Sao_Paulo");
  include('seguranca.php');
  protegePagina();

  $hr_desligamento = $_POST["hr_desligamento"];
  //$hr_desligamento = date("Y-m-d H:i:s");

  $con = abreConexao();
  $sql="
        SELECT id_maquinas_dados FROM maquinas_dados WHERE _id_maquinas='".$_POST["id_maquinas"]."' ORDER BY id_maquinas_dados DESC LIMIT 1
      ";
  $resultado = mysqli_query($con,$sql) or die("erro no select do id_maquinas_dados: ".mysqli_error($con));
  $row = mysqli_fetch_array($resultado,MYSQLI_ASSOC);
  $sql="
    UPDATE maquinas_dados SET desligou = '".$hr_desligamento."', 
    qtd_produzida = '".$_POST["qtd_prod"]."', 
    qtd_perdida = '".$_POST["qtd_perd"]."', 
    qtd_reabastecimento = '".$_POST["qtd_reab"]."', 
    motivo_desligamento = '".$_POST["motivo"]."'
    WHERE id_maquinas_dados=".$row["id_maquinas_dados"]." LIMIT 1
  ";
  mysqli_query($con,$sql) or die("erro no update inicial: ".mysqli_error($con));

  $sql="
      SELECT id_maquinas_dados,
      maquinas_dados.qtd_reabastecimento,
      TIME_TO_SEC(maquinas.tempo_programado) as tempo_programado,
      TIME_TO_SEC(maquinas.tempo_preparacao) as tempo_preparacao,
      TIME_TO_SEC(maquinas.tempo_reabastecimento) as tempo_reabastecimento,
      TIME_TO_SEC(maquinas.tempo_ciclo) as tempo_ciclo,
      TIME_TO_SEC(TIMEDIFF(desligou,ligou)) as tempo_ligado
      FROM maquinas_dados JOIN maquinas ON id_maquinas=_id_maquinas 
      WHERE _id_maquinas='".$_POST["id_maquinas"]."' ORDER BY id_maquinas_dados DESC LIMIT 1
    ";
  $resultado = mysqli_query($con,$sql) or die("erro no select dos dados: ".mysqli_error($con));
  $row = mysqli_fetch_array($resultado,MYSQLI_ASSOC);

  //Tempo de produção = (tempo total - (preparacao + reabastecimento))
  $tempo_produzindo = $row['tempo_ligado'] - ($row["tempo_preparacao"] + ($row["tempo_reabastecimento"] * $row['qtd_reabastecimento']));
  
  //Quantidade que deve produzir = (tempo produzindo / tempo para produzir um item)
  $qtd_deve_produzir = $tempo_produzindo/$row['tempo_ciclo'];

  if($_POST['qtd_prod'] == 0)
  {
    $sql="
      UPDATE maquinas_dados SET 
      tempo_preparacao = SEC_TO_TIME(".$row["tempo_preparacao"]."),
      tempo_produzindo = SEC_TO_TIME(".$tempo_produzindo."),
      tempo_reabastecimento = SEC_TO_TIME(".($row["tempo_reabastecimento"] * $row['qtd_reabastecimento'])."),
      qtd_deve_produzir = '".$qtd_deve_produzir."',
      tempo_prod_um_item = SEC_TO_TIME(".$row["tempo_ciclo"]."),
      disponibilidade='0',
      performance='0',
      qualidade='0',
      oee='0'
      WHERE id_maquinas_dados=".$row["id_maquinas_dados"]." LIMIT 1
    ";
    mysqli_query($con,$sql) or die("erro no segundo update (prod zerado): ".mysqli_error($con));
  }
  else
  {
    //Qualidade = ((Quantidade produzida-Quantidade perdida)/Quantidade produzida)*100
    $qualidade = (($_POST["qtd_prod"]-$_POST["qtd_perd"])/$_POST["qtd_prod"])*100;

    //Performance = (Quantidade produzida/(TEMPO QUE A MAQUINA DEVE PRODUZIR/TEMPO QUE LEVA PARA PRODUZIR UMA MATERIA)*100
    $performance = ($_POST["qtd_prod"]/($tempo_produzindo/$row['tempo_ciclo']))*100;

    //Disponibilidade = (Tempo produzindo/Tempo Ligado)*100
    $disponibilidade = ($tempo_produzindo/$row['tempo_ligado'])*100;

    //OEE = (Disponibilidade * Performance * Qualidade)
    $oee = (($disponibilidade/100) * ($performance/100) * ($qualidade/100))*100;

    /*//DEBUG  
    echo "$oee = $disponibilidade * $performance * $qualidade <br>";
    echo $oee;
    die();/**/

    $disponibilidade = number_format($disponibilidade,2);
    $performance = number_format($performance,2);
    $qualidade = number_format($qualidade,2);
    $oee = number_format($oee,2);

    $sql="
      UPDATE maquinas_dados SET 
      tempo_preparacao = SEC_TO_TIME(".$row["tempo_preparacao"]."),
      tempo_produzindo = SEC_TO_TIME(".$tempo_produzindo."),
      tempo_reabastecimento = SEC_TO_TIME(".($row["tempo_reabastecimento"] * $row['qtd_reabastecimento'])."),
      qtd_deve_produzir = '".$qtd_deve_produzir."',
      tempo_prod_um_item = SEC_TO_TIME(".$row["tempo_ciclo"]."),
      disponibilidade='".$disponibilidade."',
      performance='".$performance."',
      qualidade='".$qualidade."',
      oee='".$oee."'
      WHERE id_maquinas_dados=".$row["id_maquinas_dados"]." LIMIT 1
    ";
    mysqli_query($con,$sql) or die("erro no segundo update: ".mysqli_error($con));
  }
  mysqli_close($con);
  header("Location: index.php");
}
else
{
  die("Parâmetros inválidos");
}
?>