<link rel="stylesheet" href="estiloDlg.css">
<style>
	DIV#main {border-right: solid 1px forestgreen;margin:0 px;}
	H3 {margin: 0px;}
</style>
<center>
<h3>Whatpasa</h3>
<?php
	include "connection.php";
	$usuario = $_GET["usu"];

	function right($str,$n){
		$tam = strlen($str);
		$n = $n*(-1);
		return substr($str,$n);
		}
	// Inicio da Script
	$hoje = date('Ymd');
	$zero = "00000";
	
	


	// Lista todos os usuários, criando arquivos para quem
	// ainda não se conectou neste dia, ou seja, todos os usuários
	// são apoios para se ter a lista completa de conversas.
	$sql = "SELECT Usuario, Apelido FROM Usuarios";
	$sth = $conn->prepare($sql);
	$sth->execute();
	
	$matr1 = right($zero.$usuario,5);
	?>
	<div id="main">
		<?php
		while( $row = $sth->fetch() ){
			$matr2 = right($zero.$row["Usuario"],5);
			$Apel = $row["Apelido"];
			if( $matr1 != $row["Usuario"] ){
				echo "<p class=Apelido>";
				$NomeTxt = $matr1 > $matr2 ? $matr2 . "_" . $matr1 : $matr1 . "_" . $matr2;
				$NomeTxt = $hoje . "_" . $NomeTxt . ".txt";
				echo "<a href=\"dlgUsuUser.php?arq=" . $NomeTxt . "&matr2=" . $matr2 . "&matr1=" . $matr1 . "\">".$Apel." [".$matr2."]</a></p>";
				if( !file_exists($NomeTxt) ){
					$fp = fopen($NomeTxt, w);
					fclose($fp);
					}
				}
			
			}
		?>
	</div>
	<?php
?>
</center>