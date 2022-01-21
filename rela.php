<?php
	function right($str,$n){
		$tam = strlen($str);
		$n = $n*(-1);
		return substr($str,$n);
		}
	// Inicio da Script
	$hoje = date('Ymd');
	echo $hoje."<br>";
	$zero = "00000";
	$matr1 = right($zero.$_POST["usuario"],5);
	$matr2 = right($zero.$_POST["contato"],5);
	$NomeTxt = $matr1 > $matr2 ? $matr2 . "_" . $matr1 : $matr1 . "_" . $matr2;
	$NomeTxt = $hoje . "_" . $NomeTxt; 
	echo $NomeTxt;
	if( !file_exists($NomeTxt) ){
		$fp = fopen($NomeTxt, w);
		fclose($fp);
		}
?>