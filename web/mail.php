<?php
$to="gui.ssantos@live.com";
$subject="teste";
$txt="nada";
$header="From: tcc@oeecdc.com";
$ms=mail($to,$subject,$txt,$header);
echo $ms;
?>
<br>Teste;