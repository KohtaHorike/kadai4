<?php 
session_start();
require_once("config.php");
require_once("config_user.php");
$dbh = connectDb();
if(empty($_SESSION["name"])){
	header("Location:login_alert.php");	
}else{
	if(preg_match("/^[1-9][0-9]*$/",$_GET["id"])){
	$detail = getDetail((int)$_GET["id"],$dbh);
	}else{
	$detail = getDetail(10,$dbh);
	}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/common.css">
</head>
<body>

	<nav>
		<h1><a href="index.php" alt="top">South East Asia press</a></h1>
		<div id="login">
		<form action="logout.php" method="POST">
			<p>こんにちは<?php echo $_SESSION["name"];?>さん</p>
			<input type="submit" name="logout" value="logout">
			</table>
		</form>
		</div><!--login fin-->
	</nav>	<div id="main">
	<div id="content">
	<h2><?php echo $detail["title"];?></h2>
	<span class="clearfix"><?php echo $detail["created"];?></span>
	<img src="<?php echo $detail["image"];?>">
	<p><?php echo $detail["content"];?></p>
<?php

?>
	</div>
	<aside>
	</aside>
	</div><!--main fin-->
	<footer>
	</footer>
</body>
</html>