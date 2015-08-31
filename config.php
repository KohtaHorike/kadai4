<?php

//設定ファイル
function connectDb(){
	try{
		return new PDO(DSN,DB_USER,DB_PASSWORD);
	}
	catch(PDOExeption $e){
		echo $e->getMessage();
		exit;
	}
}

//スクリプトインジェクション回避
function h($s){
	return (htmlspecialchars($s,ENT_QUOTES,"UTF-8"));
}

function getUser($email,$password,$dbh){
	try{
	$sql = "SELECT * FROM users WHERE email=:email"; 
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(
			":email"=> $email,
		));
	$user = $stmt->fetch();
	return $user;
	}catch(PDOExeption $e){
		return $e->getMessage();
		exit;
	}

}
function getArticle($dbh){
	try{
	 $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $stmt = $dbh->query("SELECT * FROM article_tbl WHERE id>=5 LIMIT 5");
	 $article = $stmt->fetchAll();
	 return $article;
	}catch(PDOException $e){
		return $e->getMessage();
		exit;
	}
}
function getDetail($id,$dbh){
	try{
	 $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $sql  ="SELECT * FROM article_tbl WHERE id=:id";
	 $stmt = $dbh->prepare($sql);
	 $stmt->execute(array(
			":id"=> $id,
		));
	 $detail = $stmt->fetch();
	 return $detail;
	}catch(PDOException $e){
		return $e->getMessage();
		exit;
	}
}
//CSRF対策
function getToken(){
$bytes = openssl_random_pseudo_bytes(14);
return bin2hex($bytes);
}

//重複チェック
function checkEmail($dbh,$email){
	try{
	 $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $sql = "SELECT * FROM USERS WHERE email=:email";
	 $stmt =$dbh->prepare($sql);
	 $stmt->execute(array(":email"=>$email));
	 $detail = $stmt->fetch();
	 return $detail?true:false;
	}catch(PDOException $e){
		return $e->getMessage();
	}
}
?>
