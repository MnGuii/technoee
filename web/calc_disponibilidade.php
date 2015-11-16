<?php

include("seguranca.php"); // Inclui o arquivo com o sistema de seguran?a
protegePagina();

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <title>Calcular disponibilidade</title>
  <?php include("header.php");
      includes();
    ?>
</head>
<body>
  <label>Digite o tempo em que a máquina deve produzir</label><input type="text" name="" id="" class="form-control">
  <label>Digite o tempo de preparação que a máquina teve para começar a funcionar</label><input type="text" name="" id="" class="form-control">
  <label>Digite o tempo que levou para fazer o reabastecimento da máquina</label><input type="text" name="" id="" class="form-control">
  <label>Resultado</label><input type="text" name="" id="" class="form-control">
</body>
</html>