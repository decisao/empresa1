<html>
<head><title>AVLockGold 5.x - Key Generator - installcode based</title></head>
<body>
<?php

define('MAXDWORD',4294967295);

$mkr1 = '?#V0P1?{Q|}O~"2?R???3??SL?4??DK?!?5????§?JZ?7??W9I??Y8f?H?6F??';
$alf1 = ' 0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

$mkr2 = 'C31vOPQwxy_0z2defAB4KLMNno56RSTUstuVWlm7XêëèïîìÄÅYZabcDEFGHghijk89IJpqrüéâäàåçÉæÆôöòûùÿÖÜ';
$alf2 = ' !"#$%&'.chr(39).'()*+,-.0123456789:;<>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ^_abcdefghijklmnopqrstuvwxyz{|}~';

$alf = '0123456789ACDEFGHJKLMNPQRTUVWXYZ';

function makr($c) {
	global $alf;
  	$result ='';
  	$c = $c+10000;
  	for($i=1; $i<=32; $i++) {
  		$ps = (int)($c/$i);
  		$ps = ($ps % 32);
    	$ch = $alf[$ps];
    	$p = strpos($result,$ch);
    	$j = 0;
    	while (($p !== FALSE) && ($j < 33)) {
      		$j++;
      		$ch = $alf[$j%32];
      		$p = strpos($result,$ch);
		}
    	$result .= $ch;
	}
	return($result);
}

function alphatohex($s,$k) {
  	$result ='';
  	$mkr = makr($k);
  	$l = strlen($s);
  	$e = (int)($l/4);
  	for($i=0;$i<$e;$i++) {
    	$n =0;
    	for($j=4;$j>=1;$j--) {
      		$p = strpos($mkr,$s[$i*4+$j-1]);
      		if ($p !== FALSE) $n = $n*32+$p;
		}
    	$result .= dechex($n);
	}
	return($result);
}

function hextoalpha($s,$k) {
	$result = '';
	$mkr = makr($k);
	$l = strlen($s);
	for($i=0,$e=(int)($l/5); $i<$e; $i++) {
		$n = hexdec(substr($s,$i*5,5));
		for($j=0; $j<4; $j++) {
			$result .= $mkr[$n%32];
			$n = (int)($n/32);
		}
	}
	return($result);
}

function CalcUserID($uname) {
  	$result =0;
  	$uname = strtoupper($uname);
  	$s ='';
  	for($i=0,$end=strlen($uname); $i<$end; $i++)
    	if (($uname[$i] >= 'A') && ($uname[$i] <= 'Z')) $s .= $uname[$i];
  	$l = strlen($s);
  	if ($l<5) {
    	$s .= 'ABCDE';
    	$l = strlen($s);
  	}
  	$j = (int)($l/4);
	if ($j > 0)
		for($i=0; $i<$j; $i++) {
			$midres = hexdec(alphatohex(substr($s,$i*4,4),4875));
			$result = ($result+$midres); // % MAXDWORD;
		}
  	for($i=$j*4; $i < $l; $i++) {
  		$midres = ord($s[$i])+$i+1;
	  	$result = ($result + $midres); // % MAXDWORD;
	}
  	return($result);
}

function cerrar($k) {
	$result = 0;
	while($k>0) {
		$result += $k % 10;
		$k =(int)($k/10);
	}
	return($result);
}

function cierre($n) {
  $r = $n;
  while ($r>9) $r = cerrar($r);
  return(9-$r);
}

function GenRegularKey($Akind,$AAppID,$AiCode,$Adays,$Ausers,$Abegindate,$Amodule) {
	$Result = '';
	if ($AiCode=='') return(FALSE);
	$cod = hexdec($AiCode);
	if ($cod==0) return(FALSE);
	$n = $AAppID+$cod;
	$n = cierre($n+$Adays+$Ausers+$Amodule+$Akind+$Abegindate);
	$result = sprintf('%04X%02X%04X%02X%01X%06X%08X%01X',$Adays,$Ausers,$Abegindate,$Amodule,$n,$cod,$AAppID,$Akind);
	return($result);
}

function ascii2hex($a) {
	$result = '';
	for($i=0,$e=strlen($a); $i<$e; $i++) {
		$result .= sprintf('%02X',ord($a[$i]));
	}
	return($result);
}

function hextotxt($s) {
  	$alph = '!"#$%&()*+,-./0123456789:;<=>?@ABCDEFGHIKJLMNOPQRSTUVWXYZ[\]^_ab'.
            'cdefghijklmnopqrstuvwxyz{|}~¦ÇüéâäàåçêëèïîìÄÅÉæÆôöòûùÿÖÜø£Ø×ƒáíó';
  	$result = '';
  	$l = strlen($s);
  	$m = $l % 7;
  	if ($m > 0) {
    	$s = $s + substr('000000',0,7 - $m);
    	$l = strlen($s);
  	}
  	for($i=0,$e=(int)($l/7); $i<$e; $i++) {
    	$n = hexdec(substr($s,$i*7,7));
    	for($j=0; $j<4; $j++) {
      		$result .= $alph[$n % 128];
      		$n = (int)($n / 128);
		}
  	}
  	return($result);
}

function normicode($ico) {
  $result='';
  $l=strlen($ico);
  if ($l==13)
  {
    $s1=substr($ico,0,6);
    $s2=substr($ico,6,6);
    $ic1=hexdec($s1);
    $ic2=hexdec($s2);
    $ic2=$ic1 ^ $ic2;
    $s1=$s1.dechex($ic2);
    $s2=substr($ico,12,1);
    $i1=hexdec(substr($s1,0,2));
    $i2=hexdec(substr($s1,2,2));
    $i3=hexdec(substr($s1,4,2));
    $i4=hexdec(substr($s1,6,2));
    $i5=hexdec(substr($s1,8,2));
    $i6=hexdec(substr($s1,10,2));
    $ic=hexdec(substr($s1,0,2))+hexdec(substr($s1,2,2))+hexdec(substr($s1,4,2))+
    hexdec(substr($s1,6,2))+hexdec(substr($s1,8,2))+hexdec(substr($s1,10,2));
  }
  else if ($l==7)
  {
    $s1=substr($ico,0,6);
    $s2=substr($ico,6,1);
    $ic=hexdec(substr($s1,0,2))+hexdec(substr($s1,2,2))+hexdec(substr($s1,4,2));
  } else return('');
  $ext=$ic % 16;
  $ex = dechex($ext);
  if ($ex = $s2) 
  {
    $ext = !$ext % 16;
    $ex = dechex($ext);
  }   	  
  if ($ex = $s2) return(substr($ico,0,6));
  else return('');
}

if (isset($_GET['icode'])) {

	//***put here your own values***
  $enckey = 'm0ra15r315';
  $appid = 170166;
  $usrs = 1;
  $modul = 0;
  //  --Permanent key--
  //$days = 65535;  // authorized days
  //$startdate = 65535; // date from where starts the authorized period

  //  --Tempoprary key-- 14 days from the current date
  $days = 90;
  $startdate = (int) (gmdate("U")/86400)+25569; //current date (GMT) in delphi mode (days from 12/31/1899
  //  gmdate("U") = seconds from 01/01/1970 up to the current date (GMT)
  //  86400 = seconds by one day (60 * 60 * 24)
  //  25569 = days from 12/31/1899 to 01/01/1970
  //******************************

	$icode = $_GET['icode'];
	//$icod = substr($icode,0,6);
  $icod = normicode($icode);
  if ($icod != '') {
	  $unenc = GenRegularKey(1,$appid,$icod,$days,$usrs,$startdate,$modul);
	  $text = hextotxt($unenc);
	  $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
	  $iv = str_repeat(chr(0),$iv_size);
      $gkey = substr($enckey.'?@0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',0,$iv_size);
	  $crypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $gkey, $text, MCRYPT_MODE_CBC, $iv);
	  $final = ascii2hex($crypted);
	  $final = hextoalpha('A'.substr($final,0,16).'B'.substr($final,16,16).'C',4875);
	  $key = substr($final,0,7).'-'.substr($final,7,7).'-'.substr($final,14,7).'-'.substr($final,21,7);
	  echo "<pre>\n";
	  echo "Install Code: $icode\n";
	  echo "License : $key\n";
	  echo "\n</pre>\n";
  } else echo "incorrect Install Code\n";
}
?>
<hr>
<form>
<table border="0">
<tr><td>Install Code:</td><td><input type="text" name="icode"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Generate"></td></tr>
</table>
</form>
</body>
</html>
