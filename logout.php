<?php
//セッションデストロイを実行
session_start();
 
$_SESSION = array();
 
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-86400, '/sns_php/');
}
 
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ログアウト</title>
</head>
<body>
	<h2>ログアウトしました</h2>
	<p>3秒後に自動で画面が切り替わります</p>
	<script>
	setTimeout(function redirect(){
		document.location="login.php";
	},3000);
	</script>
</body>
</html>

