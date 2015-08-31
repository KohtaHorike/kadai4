<?php
session_start();
require_once("config.php");
require_once("config_user.php");
$dbh =connectDb();
if($_SERVER["REQUEST_METHOD"]!=="POST"){
	$token = getToken();
	$_SESSION["token"]=$token;
}else{
	//CSRF対策
	if($_SESSION["token"]==$_POST["token"]){

		$email = h($_POST["email"]);
		$password = h($_POST["password"]);
		$account =getUser($email,$password,$dbh);
	//　password_verifyを利用

		if(password_verify($password,$account["password"])){
			$_SESSION["name"]= $account["name"];
			header("Location:index.php");
		}else{
			$ERR_MSG = "IDまたはパスワードが間違っております";
		}
	}else{
		//CSRF対策
		echo "不正な送信です";
	}
}
$posting = getArticle($dbh);
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
		<form action="<?echo $_SERVER["SCRIPT_NAME"];?>" method="POST">
			<table>
				<tr>
					<td>ID</td>
					<td>PW</td>
				</tr>
				<tr>
					<td><input type="email" name="email" value=""></td>
					<td><input type="password" name="password" value="" required></td>
					<input type="hidden" name="token" value="<?php echo $token;?>">
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="login" required>&nbsp;登録がお済みでない方は<a href="register.php">こちらから</a></td>
				</tr>
				<tr><td colspan="2"><?if(!empty($ERR_MSG)){echo "<p class=\"err\">{$ERR_MSG}</p>";}?></td></tr>
			</table>
		</form>
		</div><!--login fin-->
	</nav>
	<div id="main">
	<div id="content">
<?php
	foreach ($posting as $key => $value) :
	echo "<article>";
?>
	<h2><?php echo $value["title"];?></h2>
	<p><?php echo substr($value["content"],0,400)."....";?></p>
	<a href="login_alert.php"><span id="btn">続きはこちら</span></a>
<?php
	echo "</article>";
	endforeach;
?>
	</div>
	<aside>
	</aside>
	</div><!--main fin-->
	<footer>
	</footer>
</body>
</html>