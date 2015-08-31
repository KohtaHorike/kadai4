<?php 
session_start();
require_once("config.php");
require_once("config_user.php");	
$dbh = connectDb();
if(empty($_SESSION["name"])){
	header("Location:login.php");	
}else{
	$posting = getArticle($dbh);
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
		<h1><a href="index.php">South East Asia press</a></h1>
		<div id="login">
		<form action="logout.php" method="POST">
			<p>こんにちは<?php echo $_SESSION["name"];?>さん</p>
			<input type="submit" name="logout" value="logout">
			</table>
		</form>
		</div><!--login fin-->
	</nav>	<div id="main">
	<div id="content">
<?php
	foreach ($posting as $key => $value) {
	echo "<article>";
?>
	<h2><?php echo $value["title"];?></h2>
	<p><?php echo substr($value["content"],0,400)."....";?></p>
	<a href="article.php?id=<?php echo $value["id"];?>"><span id="btn">続きはこちら</span></a>
<?php
	echo "</article>";
	}
?>
	</div>
	<aside>
	</aside>
	</div><!--main fin-->
	<footer>
	</footer>
</body>
</html>