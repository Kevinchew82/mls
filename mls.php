<?php
header("Content-Type: text/json;charset=utf-8");
$id=$_GET['id'];
$ch = isset($_GET['ch'])?$_GET['ch']:ntv7;
$video = isset($_GET['video'])?$_GET['video']:HD;
$chs=array(

"ntv7"=>"(_9ERdFwnAbs1GZsc1AwhHV3B9NxnC6yuqfefZvcX2IQ)",//这里是变的内容
"tv8"=>"(_9ERdFwnAbs1GZsc1AwhHc-c9v4opGL-lq2FgBhsLVk)",//这里是变的内容
"tv9"=>"(_9ERdFwnAbs1GZsc1AwhHQs-lh11v04TjypdpemZsbw)",//这里是变的内容
"ds"=>"(jyCOMoYa2SFWfHvye_Gd0mpiQyn5Mu5kD5esSO8diIw)",//这里是变的内容
"nhkworld"=>"(pDyZxTTGl2hc8DOnzK37_f9YdrXmsMYVYsMdQvYtKJA)",//这里是变的内容
"dw"=>"(39iDNPbzS-KK9aqHY2NME6sEQnrSmA46qEOdumb5Aos)",//这里是变的内容
"aljazeera"=>"(pDyZxTTGl2hc8DOnzK37_ebRNLCeB2-yx6toaHlaxWU)",//这里是变的内容
"cna"=>"(7zHXJsrpGnW1sC_CkKIalutlRocbDFULzr3i3oLNeMU)",//这里是变的内容
        );

$vds=array(
	"HD"=>"2",//这里是清晰度
	"FHD"=>"3",//这里是清晰度
	"UHD"=>"4",//这里是清晰度
	"848x477"=>"2",//这里是清晰度
	"1280x720"=>"3",//这里是清晰度
	"1920x1080"=>"4",//这里是清晰度
		); 
 
$url="http://stream-01.sg1.dailymotion.com/sec$chs[$ch]/dm/3/".$id."/s/live-$vds[$video].m3u8";
header('location:'.$url);
 
?>
