<?php
session_start();
require_once("config.php");
require_once("config_user.php");
$dbh=connectDb();
if($_SERVER["REQUEST_METHOD"]!="POST"){
	$token = getToken();
	$_SESSION["token"]=$token;
}else{
	if($_POST["token"]!=$_SESSION["token"]){
		echo "不正な送信が行われました。";
	}else{
	$err = [];
	$name = h($_POST["name"]);
	$email = h($_POST["email"]);
	$password = h($_POST["password"]);
	if($name==''){
		$err['name']='お名前を入力してください';
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$err['email']='メールアドレスの形式が正しくありません';
	}
	if($email==''){
		$err['email']='メールアドレスを入力してください';
	}
	if(checkEmail($dbh,$email)){
		$err['email']='このメールアドレスは登録済みです';
	}
	if($password==''){
		$err['password']='パスワードを入力してください';
	}else if(strlen($password)< 5){
		$err['password']='５文字以上で入力してください';		
	}

	if(empty($err)){
		array_pop($_POST);
		$_SESSION["me"]=$_POST;
		header("Location:confirm.php");
		exit;
		}
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
		<h1><a href="index.php">South East Asia press</a></h1>
	</nav>
	<div id="main">
		<div id="form">
		<h2>新規登録フォーム</h2>
		<form action="<?php echo $_SERVER["SCRIPT_NAME"];?>" method="POST" >
		<table>
			<tr>
				<td>お名前</td>
				<td><input type="text" name="name"placeholder="東南　亜太郎" size="50"
				value="<?php if(isset($err)){echo $_POST["name"];}?>" autofocus required>
				<?php if(isset($err["name"])){echo "<br><span class=\"err\">".$err["name"]."</span>";}?>
				</td>
			</tr>
			<tr>
				<td>メールアドレス</td>
				<td><input type="email" name="email"placeholder="asia@asean.com" size="50" 
				value="<?php if(isset($err)){echo $_POST["email"];}?>" required>
				<?php if(isset($err["email"])){echo "<br><span class=\"err\">".$err["email"]."</span>";}?>
				</td>
			</tr>
			<tr>
				<td>パスワード</td>
				<td><input type="password" name="password" placeholder="東南　亜太郎" size="50" required>
				<?php if(isset($err["password"])){echo "<br><span class=\"err\">".$err["password"]."</span>";}?>
				</td>
			</tr>
			<tr>
				<td>確認パスワード</td>
				<td><input type="password" name="checkPassword"placeholder="東南　亜太郎" size="50" onblur="check()"required>
				<br><a id="err"></a>
				</td>
			</tr>
			<tr>
				<input type="hidden" name="token" value="<?php echo $token;?>"><!--token  -->
				<td colspan="2"><input type="submit" name="submit" size="50"></td>
			</tr>
		</table>
		</form>
		</div><!--form fin-->
	</div><!--main fin-->
	<footer>
	</footer>
	<script>
	function check(){
		var form = document.forms[0];
		var err = document.getElementById("err");
//		err.innerHTML = "test";
		if(form[2].value!=form[3].value){
			err.innerHTML ="パスワードが一致しません";
			form[3].value.onfocus = true;
			return false;
		}else{
			err.innerHTML =""
			return false;			
		}
	}
		 	console.log(document.forms);
/*
		 for(var i = 0; i<form.length;i++){
		 	console.log(form[i]["name"]);
		 }*/
	</script>
</body>
</html>