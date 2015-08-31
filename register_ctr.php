<?php 
session_start();
require_once("config.php");
require_once("config_user.php");
$dbh = connectDb();
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//password_hash 
$password = password_hash($_POST["password"],PASSWORD_DEFAULT);
if($_SERVER["REQUEST_METHOD"]!="POST"){
	echo"不正な送信です";
}else{
	try{
	 $sql ="INSERT INTO users(name,email,password,created,modified)
	 values(:name,:email,:password,now(),now())";
	 $stmt= $dbh->prepare($sql);
	 $params =array(
	 	":name"=>$_POST["name"],
	 	":email"=>$_POST["email"],
	 	":password"=>$password
	 	);
	 $stmt->execute($params);
	 header("Location:thanks.php");
	}catch(PDOException $e){
		echo $e->getMessage();
		exit;
	}
}
?>
