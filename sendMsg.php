<?php
	$target = $_GET["target"]; //.": ".$_GET["msg"]."\r\n";
	$txt = $_GET["origin"].": ".$_GET["msg"]."\r\n";
	$arq = $_GET["arq"];
	$fp = fopen($arq, "a");
	$txt = mb_convert_encoding($txt, 'ISO-8859-1', 'auto');
	fwrite($fp, $txt);
	fclose($fp);
	// Lock de mensagem enviada
	//$lck = "LCK_" . $_GET["origin"] . "_" .$arq;
	$lck = "LCK_" . $target . "_" .$arq;
	$fp = fopen($lck, 'w');
	fwrite($fp, "SND\r\n");
	fclose($fp);
?>