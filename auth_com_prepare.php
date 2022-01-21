<?php
	header('Access-Control-Allow-Origin: *');
	
	$Tipo = $_POST["tipo"];
	$Usu = $_POST["usuario"];
	$Pwd = $_POST["pwd"];
	
	// Connection vem em $conn
	include "connection.php";

	// Funções
	function existe($Usu, $conn){
		$Retorno = 0; // Default: não existe
		$sql = "SELECT * FROM Usuarios WHERE ( Usuario = '" . $Usu . "' )";
		$params = array(
			$Usu
			);
		$sth = $conn->prepare($sql);
		$sth->execute();
		if( $row = $sth->fetch() ){
			$Retorno = 1;
			}
		return $Retorno;
		}
	function confere($Usu, $Pwd, $conn){
		$Retorno = 0; // Default: não existe
		$sql = "SELECT * FROM Usuarios WHERE ( Usuario = '" . $Usu . "' AND Senha = '" . $Pwd . "' )";
		$params = array(
			$Usu,
			$Pwd
			);
		$sth = $conn->prepare($sql);
		$sth->execute();
		if( $row = $sth->fetch() ){
			$Retorno = 1;
			}
		return $Retorno;
		}
	function login($Usu, $Pwd, $conn){
		
		$sql = "SELECT * FROM Usuarios WHERE ( Usuario = '" . $Usu . "' AND Senha = '" . $Pwd . "' )";
		$params = array(
			$Usu,
			$Pwd
			);
		$sth = $conn->prepare($sql);
		$sth->execute();
		if( $row = $sth->fetch() ){
			// Redirect
			header("Location: http://intranet-se01/dvpi/Whatsapp/lstUsers.php?usu=".$Usu);
			die();			
			} else {
			echo "Usuário inexistente ou senha incorreta.";
			}
		
		}
	function cad($Usu, $Pwd, $Apel, $conn){
		echo "cadastro ". $Usu;
		if( existe($Usu, $conn) == 1 ){
			echo "Usuário já cadastrado";
			} else {
			$data = [	'Usuario' => $Usu,		'Senha' => $Pwd,	'Apelido' => $Apel	];		
			$sql = "INSERT INTO Usuarios ( Usuario, Senha, Apelido ) VALUES (:Usuario, :Senha, :Apelido)";
			$sth = $conn->prepare($sql);
			$sth->execute($data);	
			
			}
		}
	function change($Usu, $Pwd, $Nwd, $conn){
		echo "change ". $Usu;
		if( confere($Usu, $Pwd, $conn) == 1 ){
			$data = [
				'Usuario' => $Usu,
				'Senha' => $Pwd,
				'NewSenha' => $Nwd
			];			
			$sql = "UPDATE Usuarios SET Senha = :NewSenha WHERE ( Usuario = :Usuario AND Senha = :Senha )";
			$sth = $conn->prepare($sql);
			$sth->execute($data);				
			} else {
			echo "Usuário não existe ou senha não confere";
			}
		}
		
	switch ($Tipo) {
		// Login
		case "1061no":
			login($Usu, $Pwd, $conn);
			break;
		// Cadastro
		case "c4du5u":
			$Apel = $_POST["apel"];
			cad($Usu, $Pwd, $Apel,  $conn);
			break;
		// Altera senha
		case "417u5u":
			$Nwd = $_POST["newpwd"];
			change($Usu, $Pwd, $Nwd, $conn);
			break;
		}
	
?>