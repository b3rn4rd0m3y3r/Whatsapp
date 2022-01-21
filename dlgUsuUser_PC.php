<meta charset="iso-8859-1">
<link rel="stylesheet" href="estiloDlg.css">
<style>
	DIV#main {
		border-left: solid 1px forestgreen;
		overflow-y: scroll;
		}
</style>
<?php
		header ('Content-type: text/html; charset=ISO-8859-1');
		$NomeTxt = $_GET["arq"];
		//echo $NomeTxt;
		$target = $_GET["matr2"];
		$origin = $_GET["matr1"];
?>
<script>
	var headerISO = 'application/x-www-form-urlencoded; charset=iso-8859-1';
	function init(){
		window.addEventListener('message', function (e) {
			 // Get the sent data
			const data = e.data;
			 document.location.reload(true);
			 //alert(data);
			// If you encode the message in JSON before sending them,
			// then decode here
			// const decoded = JSON.parse(data);
			});
		document.getElementById("main").scrollTo(0,400);
		}
	function envia(){
		const options = {
			method: 'post',
			headers: {
				'Content-type': headerISO
				}
			}
		// Chamada AJAX
		txtUrl = "sendMsg.php?msg="+document.getElementById("entry").value+"&arq=<?php echo $NomeTxt; ?>"+"&target=<?php echo $target; ?>"+"&origin=<?php echo $origin; ?>";
		fetch(txtUrl,options)
		  .then( function(response){
				if (!response.ok) { throw response }
				return response.text();  //we only get here if there is no error
			  })
			.then(function (result) {
				// Imprime a saída do programa PHP
				console.log(result);
				document.location.reload(true);
				})
			.catch(function() {
				console.log("error");
				alert('Registro não gravado em função de um destes erros');
				});
		}
</script>

<body onload="init();">
<center>
<h3>Whatpasa</h3>
<h4><?php  echo $target; ?></h4>
<div id="main">
<?php
		// Abre o arquivo Txt deste par de contatos
		$fp = fopen($NomeTxt, r);
		// Testa se existe e lista as linhas
		if ($fp) {
			while (($line = fgets($fp)) !== false) {
				echo "<p>" . $line . "</p>";
			}

		fclose($fp);
		} else {
			// error opening the file.
		} 		
		// Fecha o arquivo
		fclose($fp);
		
?>
</div>
<div id="send"><input id="entry" size=40>&nbsp;<input type="button" class="seta" value=">" onclick="envia();">
</div>
<!-- Era: echo $target . "_" . $NomeTxt; no final de arq= -->
<iframe  scrolling="no" width="360" height="25" src="chkNewMsg.php?arq=LCK_<?php echo $origin . "_" . $NomeTxt; ?>"></iframe>
</center>
</body>