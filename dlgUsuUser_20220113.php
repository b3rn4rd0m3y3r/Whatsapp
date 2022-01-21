<meta charset="iso-8859-1">
<link rel="stylesheet" href="estiloDlg.css">
<style>
	IMG#cam {vertical-align: top;cursor: pointer;}
	INPUT#ark {display: none;}
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
		txtUrl    = "sendMsg.php?msg="+document.getElementById("entry").value;
		txtUrl += "&arq=<?php echo $NomeTxt; ?>"+"&target=<?php echo $target; ?>";
		txtUrl += "&origin=<?php echo $origin; ?>";
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
		function sendImg(){
			var img = getById("ark");
			var o = (window.URL || window.webkitURL).createObjectURL(img.files[0]);
			var embed = document.createElement("EMBED");
			embed.src = o.valueOf();
			embed.height = "150";
			embed.width = "150";
			getById("main").appendChild(embed);
			console.log(getById("main"));
			}
		function getById(obj){
			return document.getElementById(obj);
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
<div id="send">
<input id="entry" size=25><INPUT id="ark" type="file" onchange="sendImg();"><INPUT type="button" style="background-image: url('camera.jpg');background-size: 30px 30px;color: transparent;width: 32px;height:32px;border-color: transparent;" onclick="getById('ark').click();">&nbsp;<input type="button" class="seta" value=">" onclick="envia();">
</div>
<!-- Era: echo $target . "_" . $NomeTxt; no final de arq= -->
<iframe  scrolling="no" width="345" height="25" src="chkNewMsg.php?arq=LCK_<?php echo $origin . "_" . $NomeTxt; ?>"></iframe>
<iframe id="frm2" name="frm2" width=5 height=5></iframe>
</center>
</body>