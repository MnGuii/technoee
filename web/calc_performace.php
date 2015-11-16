<?php

include("seguranca.php"); // Inclui o arquivo com o sistema de seguran?a
protegePagina();

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Calcular performace</title>
  <?php include("header.php");
    includes();
  ?>
</head>
<body>
  <form method="post" action="calcula_performace.php">
    <label>Digite o tempo em que a máquina deve produzir</label><input type="text" name="" id="" class="form-control">
    <label>Digite a quantidade de matéria-prima produzida</label><input type="text" name="" id="" class="form-control">
    <label>Digite o tempo em que a máquina leva para produzir uma unidade</label><input type="text" name="" id="" class="form-control">
    <label>Resultado</label><input type="text" name="" id="" class="form-control">
  </form>
</body>
</html>