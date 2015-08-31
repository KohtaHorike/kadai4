<?php 
session_start();

function getToken(){
$bytes = openssl_random_pseudo_bytes(14);
return bin2hex($bytes);
}

if($_SERVER["REQUEST_METHOD"]!="POST"){
	$token=getToken();
	$_SESSION["token"]=$token;
}else{
echo $_SESSION["token"]==$_POST["token"]?"正常な処理がなされました。"
:"不正な処理がなされました。";	
echo "<p>入力値:".$_POST["password"]."</p>";
$password = password_hash($_POST["password"],PASSWORD_DEFAULT);
echo "<p>password_hash処理 :{$password}</p>";

echo password_verify($_POST["password"],$password)?"認証":"認証失敗";
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
<?php if($_SERVER["REQUEST_METHOD"]!="POST"){ ?>
	<form action="<?php $_SERVER["SCRIPT_NAME"];?>" method="POST">
		<input type="text" name="name">
		<input type="password" name="password">
		<input type="hidden" name="token" value="<?php echo $token;?>">
		<input type="submit" value="submit">
	</form>
<?php }else{
	echo "送信後モード";
	}?>
</body>
</html>