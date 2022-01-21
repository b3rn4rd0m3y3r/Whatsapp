<?php
		$arq = $_GET["arq"];
		//sleep(20);
		$fp = fopen($arq, 'w');
		fclose($fp);
?>