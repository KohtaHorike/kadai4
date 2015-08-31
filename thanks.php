<?php
session_start();
require_once("config.php");
require_once("config_user.php");
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
	</nav>
	<div id="main">
		<div id="thanks">
		<h2>新規登録フォーム</h2>
		<p>ご登録ありがとうございました</p>
		<p>5秒後に自動的にtopへと戻ります</p>
		<p>戻らない場合は<a href="login.php">こちら</a>をクリックしてください</p>
		</div><!--thanks fin-->
	</div><!--main fin-->
	<footer>
	</footer>
	<script>
	setTimeout(function redirect(){
		document.location="login.php";
	},5000);
	</script>
</body>
</html>