<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Gemini-IPTV</title>
<style type="text/css">
body {
	/*background-image: url(images/error.jpg);*/
}
a:link,a:visited{color:#007ab7;text-decoration:none;}
h1{
	position:relative;
	z-index:2;
	width:540px;
	height:0;
	margin:110px auto 15px;
	padding:230px 0 0;
	overflow:hidden;
	xxxxborder:1px solid;
	background-image: url(main.jpg);
	background-repeat: no-repeat;
}
h2{
	position:absolute;
	top:17px;
	left:187px;
	margin:0;
	font-size:0;
	text-indent:-999px;
	-moz-user-select:none;
	-webkit-user-select:none;
	user-select:none;
	cursor:default;
	width: 534px;
}
h2 em{display:block;font:italic bold 200px/120px "Times New Roman",Times,Serif;text-indent:0;letter-spacing:-5px;color:rgba(216,226,244,0.3);}
.link a{margin-right:1em;}
.link,.texts{width:540px;margin:0 auto 15px;color:#505050;}
.texts{line-height:2;}
.texts dd{margin:0;padding:0 0 0 15px;}
.texts ul{margin:0;padding:0;}
.portal{color:#505050;text-align:center;white-space:nowrap;word-spacing:0.45em;}
.portal a:link,.portal a:visited{color:#505050;word-spacing:0;}
.portal a:hover,.portal a:active{color:#007ab7;}
.portal span{display:inline-block;height:38px;line-height:35px;background:url(img/portal.png) repeat-x;}
.portal span span{padding:0 0 0 20px;background:url(img/portal.png) no-repeat 0 -40px;}
.portal span span span{padding:0 20px 0 0;background-position:100% -80px;}
.STYLE1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 65px;
}

* { margin:0; padding:0; list-style:none; font-size:14px;}/*---该css reset仅用于demo，请自行换成适合您自己的css reset---*/
html { height:100%;}
body { height:100%; text-align:center;}
.centerDiv { display:inline-block; zoom:1; *display:inline; vertical-align:middle; text-align:left; width:620px; padding:0px; font-size: 36px; color: #FFF;}
.hiddenDiv { height:100%; overflow:hidden; display:inline-block; width:1px; overflow:hidden; margin-left:-1px; zoom:1; *display:inline; *margin-top:-1px; _margin-top:0; vertical-align:middle;}
.Absolute-Center {  
  text-align:center; 
  margin:0 auto
}  
</style>

<?php

function generate_code($length = 4) {
    return rand(pow(10,($length-1)), pow(10,$length)-1);
}

include_once "cn_lang.php";
include_once 'admindir.php';
	
$a = new Adminer();
$addir = $a->ad;
include_once $addir . 'common.php';
	


include_once $a->ad . 'memcache.php';
$usememcache = 0;
$mem_timeout = 60;
$mem = new GMemCache();
if($mem->used() == 1)
{
	$ret = $mem->connect();
	if($ret == true)
	{
		$usememcache = 1;
	}
}
$mem->close();		
	
$mytable = "system_table";
$terlang = "zh_cn";
if($usememcache == 1)
{
	$memkey = md5($mytable . "query_data" . "name" . "terlang" . "value");
	$mem_value = $mem->get($memkey);
	if($mem_value != false)
	{
		$terlang = unserialize($mem_value);
	}
	else
	{
		$sql = new DbSql();
		$mydb = $sql->get_database();
		$sql->connect_database_default();
		$sql->create_table($mydb, $mytable, "name text, value text");
		$terlang = $sql->query_data($mydb, $mytable, "name", "terlang", "value");
		$sql->disconnect_database();
		$mem->set_timeout($memkey,serialize($terlang),$mem_timeout);
	}
}
else
{
		$sql = new DbSql();
		$mydb = $sql->get_database();
		$sql->connect_database_default();
		$sql->create_table($mydb, $mytable, "name text, value text");
		$terlang = $sql->query_data($mydb, $mytable, "name", "terlang", "value");
		$sql->disconnect_database();	
}
		
$lognum = get_set_xml_file($addir . "safe3.xml");
if($lognum == 0)
{
	if(isset($_GET["proxy"]) && strlen($_GET["proxy"]) > 0)
		header("Location: "."go_index.php?mac=".$_GET["mac"]."&cpuid=".$_GET["cpuid"]."&key=".$_GET["key"]."&mv=". $_GET["mv"] . "&proxy=" . $_GET["proxy"] . "&terlang=" . $terlang);
	else
		header("Location: "."go_index.php?mac=".$_GET["mac"]."&cpuid=".$_GET["cpuid"]."&key=".$_GET["key"]."&mv=". $_GET["mv"] . "&terlang=" . $terlang); 
	exit;
}
?>

<script type="text/javascript">
var focusnum = 0;
var focusnum_index = 0;

function on_keyenter() 
{
 	var inputCode=document.getElementById("inputCode").value;
	if(inputCode.length == 4)
	{
		//?mac=54:5a:a6:3e:97:bf&cpuid=0382d6c4e9027dcc&key=363ABgiugXjCPqp7KVzyQTZhMkeDhRpGFrjDhjsOU1CjKvT6EtSdauOn363ABgiu&mv=RXpdFr5bS2qIoeMGKlo0QTSwcZRJaiMdoVAbSb0INeMGauopQxEH1ZCrRs9oTroNSYHOoerpe98kQsSbRZnNaRaAol3d42HCPSamK8n6
 		window.location.href = "go_index.php?mac=" + "<?php echo $_GET["mac"] ?>" + "&cpuid=" + "<?php echo $_GET["cpuid"] ?>" + "&key=" + "<?php echo $_GET["key"] ?>" + "&mv=" + "<?php echo $_GET["mv"] ?>" 
								+ "&inputcode=" + inputCode + "&proxy=" + "<?php echo $_GET["proxy"] ?>" + "&terlang=" + "<?php echo $terlang ?>";
	}
	else
	{
		alert("<?php echo $lang_array["code_text1"]; ?>");
	}
}  

function FSubmit(e)
{
	if(e ==13|| e ==32)
	{
		on_keyenter();
	}
}

function init()
{
	document.getElementById("inputCode").focus(); 
	select_num_index(-1);
}

function ondown(e)
{
	switch(e.keyCode)
	{
		
		case 37: //left
			if(focusnum == 1)
			{
				focusnum_index--;
				if(focusnum_index < 0)
					focusnum_index = 11;
				select_num_index(focusnum_index);	
			}
		 	break;
		case 38:	//up
			focusnum = 0;
			focusnum_index = -1;
			select_num_index(focusnum_index);
			document.getElementById("inputCode").onfocus=function(){this.focus();} 
			document.getElementById("inputCode").focus(); 
			break;
		case 39:	//right
			if(focusnum == 1)
			{
				focusnum_index++;
				if(focusnum_index > 11)
					focusnum_index = 0;
				select_num_index(focusnum_index);
			}
			break;
		case 40:	//down
			focusnum = 1;
			focusnum_index = 0;
			select_num_index(focusnum_index);
			document.getElementById("inputCode").onfocus=function(){this.blur();}
			document.getElementById("inputCode").blur();
			break;
			
		case 13:
		case 32:
			if(focusnum == 1)
			{
				var number_value = document.getElementById("inputCode").value;
				if(focusnum_index >= 0 && focusnum_index <= 8)
				{
					document.getElementById("inputCode").value = number_value + (focusnum_index+1);
				}
				else if(focusnum_index == 9)
				{
					document.getElementById("inputCode").value = number_value + 0;
				}
				else if(focusnum_index == 10)
				{
					var num_lenght = number_value.length;
					number_value = number_value.substr(0,num_lenght-1);
					document.getElementById("inputCode").value = number_value;
				}
				else if(focusnum_index == 11)
				{
					on_keyenter();
				}
			}
			break;
		case 48:
		case 49:
		case 50:
		case 51:
		case 52:
		case 53:
		case 54:
		case 55:
		case 56:
		case 57:
			if(focusnum == 1)
			{
				var number_value = document.getElementById("inputCode").value;
				document.getElementById("inputCode").value = number_value + (e.keyCode-48);
				document.getElementById("inputCode").onfocus=function(){this.blur();}
			}
			break;
	} 
}

function red_background(num)
{
	document.getElementById("num"+num).style.backgroundColor="#ff0000";
}

function white_background(num)
{
	document.getElementById("num"+num).style.backgroundColor="#ffffff";
}

function input_num(num)
{

	if(focusnum == 0)
	{
	if(num >= 0 && num <= 8)
	{
		var number_value = document.getElementById("inputCode").value;
		document.getElementById("inputCode").value = number_value + (num+1);
		document.getElementById("inputCode").onfocus=function(){this.blur();}
	}
	else if(num == 9)
	{
		var number_value = document.getElementById("inputCode").value;
		document.getElementById("inputCode").value = number_value + 0;
	}
	else if(num == 10)
	{
		var number_value = document.getElementById("inputCode").value;
		var num_lenght = number_value.length;
		number_value = number_value.substr(0,num_lenght-1);
		document.getElementById("inputCode").value = number_value;
	}
	else if(num == 11)
	{
		on_keyenter();
	}
	}
	
	//red_background(num);
	
	//setTimeout(select_num_index(-1),1000)
}

function select_num_index(index)
{
	for(var ii=0; ii<12; ii++)
	{
		if(ii == index)
		{
			document.getElementById("num"+ii).focus(); 
			document.getElementById("num"+ii).style.backgroundColor="#ff0000";
		}
		else
		{
			document.getElementById("num"+ii).style.backgroundColor="#ffffff";
		}
	}
	
}
</script>
</head>
<body onLoad="init()" onkeydown="ondown(event)" onmousewheel="return false;">
	<br/>
    <br/>
    <br/>
    <br/>
 	<div class="centerDiv">
        <br/>
<?php    	    
		if($lognum != 1)
		{
			echo "<label style='font-size:28px;color:#FFF'>" . $lang_array["code_text3"] . "</label>";
		}
		else
		{
  			echo "<img src=\"captcha.php\" align=\"top\" style=\"vertical-align:top;\" />";
		}
?>
        <br/>
        <br/>
   		<label style="font-size:28px;color:#FFF"><?php echo $lang_array["code_text1"] ?>：</label><input style="font-size:28px;width:220px" type="text"  id="inputCode" onKeyDown="FSubmit(event.keyCode||event.which);"/>
    	<!--<input id="button" onClick="on_keyenter()" style="font-size:28px;width:80px" type="button" value="OK" />-->
 	
    <br/>
    <br/>
    </div>
	<table width="720" border="0" class="Absolute-Center">
  		<tr>
    		<td style="color:#000000;font-size:48px;text-align:center; width:120px; height:60px;" id="num0" onClick="input_num(0)" >1</td>
    		<td style="color:#000000;font-size:48px;text-align:center; width:120px; height:60px;" id="num1" onClick="input_num(1)" >2</td>
    		<td style="color:#000000;font-size:48px;text-align:center; width:120px; height:60px;" id="num2" onClick="input_num(2)">3</td>
    		<td style="color:#000000;font-size:48px;text-align:center; width:120px; height:60px;" id="num3" onClick="input_num(3)">4</td>
    		<td style="color:#000000;font-size:48px;text-align:center; width:120px; height:60px;" id="num4" onClick="input_num(4)">5</td>
    		<td style="color:#000000;font-size:48px;text-align:center; width:120px; height:60px;" id="num5" onClick="input_num(5)">6</td>
    		<td style="color:#000000;font-size:48px;text-align:center; width:120px; height:60px;" id="num6" onClick="input_num(6)">7</td>
    		<td style="color:#000000;font-size:48px;text-align:center; width:120px; height:60px;" id="num7" onClick="input_num(7)">8</td>
            <td style="color:#000000;font-size:48px;text-align:center; width:120px; height:60px;" id="num8" onClick="input_num(8)">9</td>
            <td style="color:#000000;font-size:48px;text-align:center; width:120px; height:60px;" id="num9" onClick="input_num(9)">0</td>
            <td style="color:#000000;font-size:32px;text-align:center; width:120px; height:60px;" id="num10" onClick="input_num(10)">Del</td>
            <td style="color:#000000;font-size:32px;text-align:center; width:120px; height:60px;" id="num11" onClick="input_num(11)">OK</td>
  		</tr>
	</table>
    
</body>
</html>