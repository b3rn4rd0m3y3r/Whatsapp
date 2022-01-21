<!-- Script que fica na IFRAME sob a DIV de diálogo e que checa se existe alguma atualização -->
<meta http-equiv="refresh" content="8">
<style>
	SPAN { font-size: 10px; font-family: Verdana; }
</style>
<script>
	function manda(){
		const message = JSON.stringify({
			message: 'Hello from iframe',
			date: Date.now(),
			});
		//alert('oi');
		window.parent.postMessage(message, '*');
		}
</script>
<?php
	$arq = $_GET["arq"];
	echo "<span>".$arq."</span>";
	if( file_exists($arq) ){
		$fp = fopen($arq, 'r');
		$line = fgets($fp);
		echo $line;
		fclose($fp);
		if( substr($line,0,3) == "SND" ){
			echo "<script>manda();</script>";
			}
		// Redirect
		//header("Location: http://intranet-se01/dvpi/Whatsapp/deletaLck.php?arq=".$arq);
		$fp = fopen($arq, 'w');
		fclose($fp);
		}
?>