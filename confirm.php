<?php
session_start();
require_once("config.php");
require_once("config_user.php");
if(empty($_SESSION["me"])){
	header("location:register.php");
}else{
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
	</nav>
	<div id="main">
		<div id="form">
		<h2>新規登録フォーム</h2>
		<h3>ご確認の上「送信」ボタンをおしてください</h3>
		<form action="register_ctr.php" method="POST" onsubmit="check();">
		<table>
			<tr>
				<td>お名前</td>
				<td><?php echo $_SESSION["me"]["name"];?></td>
				<input type="hidden" name="name" value="<?php echo $_SESSION["me"]["name"];?>">
			</tr>
			<tr>
				<td>メールアドレス</td>
				<td><?php echo $_SESSION["me"]["email"];?></td>
				<input type="hidden" name="email" value="<?php echo $_SESSION["me"]["email"];?>">
			</tr>
			<tr>
				<input type="hidden" name="password" value="<?php echo $_SESSION["me"]["password"];?>">
				<td><input type="submit" name="submit"></td>
				<td><input type="button" value="修正する" onclick="back();"></td>
			</tr>
		</table>
		</form>
		</div><!--form fin-->
	</div><!--main fin-->
	<footer>
	</footer>
	<script>
	function back(){
		history.back();
	}
	</script>
</body>
</html>