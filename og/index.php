<?php include_once("/var/www/html/site/mysql.php"); ?>

<?

/*$type = $_GET['type'];

if($type == "data"){
$results = mysqli_query($link, "SELECT * FROM og ");		

while($row = $results->fetch_assoc()) {	
	echo $row['id'] . ";" . $row['uchastok'] . ";" . $row['name'] . ";" . $row['posadka'] . ";" . $row['comment'] . ";" . $row['articul'] . "\n";	
}

}*/
?>


<html>
<head>
<meta charset="utf-8">
</head>
<body>
<script type="text/javascript">
function sleep(millis) {
    var t = (new Date()).getTime();
    var i = 0;
    while (((new Date()).getTime() - t) < millis) {
        i++;
    }
}

function createXMLHttp() {
        if (typeof XMLHttpRequest != "undefined") { // для браузеров аля Mozilla
            return new XMLHttpRequest();
        } else if (window.ActiveXObject) { // для Internet Explorer (all versions)
            var aVersions = [
                "MSXML2.XMLHttp.5.0",
                "MSXML2.XMLHttp.4.0",
                "MSXML2.XMLHttp.3.0",
                "MSXML2.XMLHttp",
                "Microsoft.XMLHttp"
            ];
            for (var i = 0; i < aVersions.length; i++) {
                try {
                    var oXmlHttp = new ActiveXObject(aVersions[i]);
                    return oXmlHttp;
                } catch (oError) {}
            }
            throw new Error("Невозможно создать объект XMLHttp.");
        }
    }
// функция Ajax POST
function postAjax(url, oForm, callback) {
    // создаем Объект
    var oXmlHttp = createXMLHttp();
    // получение данных с формы
    var sBody = oForm;
    // подготовка, объявление заголовков
    oXmlHttp.open("POST", url, true);
    oXmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//oXmlHttp.addHeader("Access-Control-Allow-Origin", "*");
    // описание функции, которая будет вызвана, когда придет ответ от сервера
    oXmlHttp.onreadystatechange = function() {
        if (oXmlHttp.readyState == 4) {
            if (oXmlHttp.status == 200) {
                callback(oXmlHttp.responseText);
            } else {
                callback('error' + oXmlHttp.statusText);
            }
        }
    };
    // отправка запроса, sBody - строка данных с формы
    oXmlHttp.send(sBody);
}

function selected(name){
	//sleep(1000);
	postAjax('http://<?echo $_SERVER['HTTP_HOST'];?>/og/api/api.php?cmd=comments&id='+name, "", function(d){document.getElementById("comment").value = d;});
	postAjax('http://<?echo $_SERVER['HTTP_HOST'];?>/og/api/api.php?cmd=articul&id='+name, "", function(d){document.getElementById("articul").value = d;});
	postAjax('http://<?echo $_SERVER['HTTP_HOST'];?>/og/api/api.php?cmd=date&id='+name, "", function(d){document.getElementById("posadkdata").value = d;});
	postAjax('http://<?echo $_SERVER['HTTP_HOST'];?>/og/api/api.php?cmd=uchastok&id='+name, "", function(d){document.getElementById("uchastok").value = d;});	
}
function adds(a){
	postAjax('http://<?echo $_SERVER['HTTP_HOST'];?>/og/api/api.php?cmd=add&name=' + a, "", function(d){});	
}
function articl(a){
	postAjax('http://<?echo $_SERVER['HTTP_HOST'];?>/og/api/api.php?cmd=articl&art=' + a, "", function(d){selected(d); document.getElementById("select").options[d].selected = true;});	
}
function save(){
	var name = document.getElementById("select").options[document.getElementById("select").selectedIndex].innerHTML;
	var articul = document.getElementById("articul").value;
	var comment = document.getElementById("comment").value;
	var posadkdata = document.getElementById("posadkdata").value;
	var uchastok = document.getElementById("uchastok").value;
	
	postAjax('http://<?echo $_SERVER['HTTP_HOST'];?>/og/api/api.php?cmd=update&name=' + name + "&articul=" + articul + "&comment=" + comment + "&posadkdata=" + posadkdata + "&uchastok=" + uchastok + "&id=" + document.getElementById("select").options[document.getElementById("select").selectedIndex].value, "", function(d){alert(d);});	
}
selected(0);
</script>
<div id="visibs">
<p>Растение:  <select onchange="selected(this.options[this.selectedIndex].value)" name="send" id='select'>
	  <?
	    $results = mysqli_query($link, "SELECT * FROM og");

while($row = $results->fetch_assoc()) {
	if($row['name'] != ""){
    echo "<option  name='select' value=".$row['id'].">".$row['name']."</option>";
	}
}
	  ?>
   </select> Участок <select id="uchastok"> <option name='select' value="0">Берёзовая</option> <option name='select' value="1">Колхозная</option></select> Дата посадки <input type="date" id="posadkdata" name="calendar"> Комментарий <textarea rows="2" cols="45" value="" name="cmd" id='comment'> </textarea> Артикул <input type="text" value="" name="art" id='articul' /></p>
<p><input type="submit" value="Сохранить" OnClick="save()"></input></p>
   </div>
<div id="adds">
<p>Название <input size="25" type="text" value="" name="cmd" id='addname' /> <input type="submit" value="Добавить" OnClick="adds(document.getElementById('addname').value)"></input></p>
</div>
<?
if(!empty($_GET['art'])){
	echo '<script>sleep(1500); setTimeout(articl('.$_GET['art'].'), 2000)</script>';
}
?>
</body>
</html>