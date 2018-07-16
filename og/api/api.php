<?php include_once("/var/www/html/site/mysql.php"); ?>
<?
$cmd = $_GET['cmd'];

if($cmd == "comments"){
	$id = $_GET['id'];
	$results = mysqli_query($link, "SELECT * FROM og WHERE id='".$id."'");		

while($row = $results->fetch_assoc()) {	
	echo $row['comment'];	
}
}
elseif($cmd == "articul"){
	$id = $_GET['id'];
	$results = mysqli_query($link, "SELECT * FROM og WHERE id='".$id."'");		

while($row = $results->fetch_assoc()) {	
	echo $row['articul'];	
	//echo 123;
}
}
elseif($cmd == "date"){
	$id = $_GET['id'];
	$results = mysqli_query($link, "SELECT * FROM og WHERE id='".$id."'");		

while($row = $results->fetch_assoc()) {	
	echo $row['posadka'];	
	//echo 123;
}
}
elseif($cmd == "articl"){
	$id = $_GET['art'];
	$results = mysqli_query($link, "SELECT * FROM og WHERE articul='".$id."'");		

while($row = $results->fetch_assoc()) {	
	echo ($row['id']);	
	//echo 123;
}
//$id = $id + 1;
//mysqli_query($link, "INSERT INTO `og`(`id`, `uchastok`, `name`, `posadka`, `comment`, `articul`) VALUES ('$id',0,'','','','')");
}
elseif($cmd == "add"){
	$nam = $_GET['name'];
	$results = mysqli_query($link, "SELECT * FROM og WHERE 1");		

while($row = $results->fetch_assoc()) {	
	$id = $row['id'] + 1;	
	//echo 123;
}
//$id = $id + 1;
mysqli_query($link, "INSERT INTO `og`(`id`, `uchastok`, `name`, `posadka`, `comment`, `articul`) VALUES ('$id',0,'$nam','','','')");
}
elseif($cmd == "update"){
$name = $_GET['name'];
$id = $_GET['id'];
$uchastok = $_GET['uchastok'];
$posadka = $_GET['posadkdata'];
$comment = $_GET['comment'];
$articul = $_GET['articul'];
echo mysqli_query($link, "UPDATE `og` SET `uchastok`='$uchastok',`name`='$name',`posadka`='$posadka',`comment`='$comment',`articul`='$articul' WHERE id='".$id."'");
}
elseif($cmd == "uchastok"){
	$id = $_GET['id'];
	$results = mysqli_query($link, "SELECT * FROM og WHERE id='".$id."'");		

while($row = $results->fetch_assoc()) {	
	/*if( $row['uchastok'] == "1"){
		echo ("Колхозная");
	}
	elseif( $row['uchastok'] == "0"){
		echo ("Берёзовая");
	}*/
	echo $row['uchastok'];
	//echo 123;
}
}
?>