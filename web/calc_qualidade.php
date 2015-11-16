<?php

include("seguranca.php"); // Inclui o arquivo com o sistema de seguran?a
protegePagina();

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Calcular qualidade</title>
  <?php include("header.php");
    includes();
  ?>
</head>
<body>
  <form method="post" action="calcula_qualidade.php">
    <label>Digite a quantidade de matéria-prima produzida</label><input type="text" name="" id="" class="form-control">
    <label>Digite a quantidade de matéria-prima perdida</label><input type="text" name="" id="" class="form-control">
    <label>Resultado</label><input type="text" name="" id="" class="form-control">
  </form>
</body>
</html>