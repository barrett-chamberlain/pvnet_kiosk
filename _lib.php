<?php

$OFFSET = -(7*60*60); // SERVER IS 8 HOURS IN ADVANCE (adjusted to 7 hours on 4-26)
// NOTE: DATES BEYOND A CERTAIN SUNDAY SHOULD BE ADJUSTED FORWARD TO MATCH DAYLIGHT SAVINGS 4-26

$WEBSITEURLJUMP = "http://edu.pvnet.com/kiosk/";

/*
    "r" (Read only. Starts at the beginning of the file)
    "r+" (Read/Write. Starts at the beginning of the file)
    "w" (Write only. Opens and clears the contents of file; or creates a new file if it doesn't exist)
    "w+" (Read/Write. Opens and clears the contents of file; or creates a new file if it doesn't exist)
    "a" (Write only. Opens and writes to the end of the file or creates a new file if it doesn't exist)
    "a+" (Read/Write. Preserves file content by writing to the end of the file)
    "x" (Write only. Creates a new file. Returns FALSE and an error if file already exists)
    "x+" (Read/Write. Creates a new file. Returns FALSE and an error if file already exists)
*/

function getLinesCSV($filename)
{
    $row = 1;
    if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
    }
}

function overwriteFile($fname,$buf)
{
    $file = fopen("dat/".$fname,"w");
    fwrite($file,$buf);
    fclose($file);
}

function appendFile($fname,$buf)
{
    $file = fopen("dat/".$fname,"a+");
    fwrite($file,"\n".$buf);
    fclose($file);
}

function leadingZeroes($num)
{
    if($num<100) $leadz = '0';
    if($num<10) $leadz .= '0';
    
    return $leadz.$num;
}

//formerly getArray
function getLines($fname)
{
    $buf = array();
    $myfile = fopen($fname, "r") or die("Unable to open file!");

    // Output one line until end-of-file
    while(!feof($myfile)) {
      $buf[] = fgets($myfile);
    }
    fclose($myfile);

    return $buf;
}

function getArray($fname)
{
    $buf = array();
    $myfile = fopen("dat/".$fname, "r") or die("Unable to open file!");

    // Output one line until end-of-file
    while(!feof($myfile)) {
      $buf[] = fgets($myfile);
    }
    fclose($myfile);

    return $buf;
}


function listFiles($dir)
{
    $ar = scandir($dir);
    return $ar;
}

function arToChildStr($ar)
{
    $sep="<ar>";
    $buf = "";
    $l = count($ar)-1;
    for($a=0;$a<$l;$a++)
    {
        $buf .=$ar[$a].$sep;
    }
    $buf.=$ar[$a];
    return $buf;
}

function lineToAr($ln)
{
    $ar = explode("<seperator>",$ln);
    
    foreach($ar as $k => $v)
    {
        $ar[$k] = explode("<equals>",$v);
        $ar2[$ar[$k][0]] = str_replace("<ar>","|",$ar[$k][1]);
    }
 
    return $ar2;
}

function calcDuration($tm)
{
    $var = (time()+$GLOBALS['OFFSET'])-$tm;

    return $var;
}

function FULLDAYstr($time)
{
    $T = $time+$GLOBALS["OFFSET"]; 
    return date("l",$T);
}

function DAYstr($time){
$T = $time+$GLOBALS["OFFSET"]; 
    return date("D, ",$T);
}

function TIMEstr($time)
{
    $T = $time+$GLOBALS["OFFSET"]; 
    return date("h:i a",$T);
}
function DATEstr($time)
{
    $T = $time+$GLOBALS["OFFSET"]; 
    return date("F d, Y",$T);
}
function DURATIONstr($intime,$outtime)
{ 
    $var = $outtime-$intime;
    return gmdate("H:i", $var);
}

function tm1($intime)
{
    $T = $intime+$GLOBALS["OFFSET"]; 
    echo date("h:i a",$T);
}

function tm2($intime)
{
    $T = $intime+$GLOBALS["OFFSET"]; 
    echo date("F d, Y",$T);
}

// DURATION CALCULATION
function tm3($intime)
{
    $T = $intime+$GLOBALS["OFFSET"]; 
    echo gmdate("H:i", calcDuration($T));
}

function arToStr($ar)
{
    $buf="";
    foreach($ar as $k=>$v)
    {
        if($v)
        {
            if(is_array($v))
            {
                $buf.= $k."<equals>";
                $buf.=arToChildStr($v);
                $buf.="<seperator>";
            }
            else
            {
                if(strlen($v)>1)
                {
                $buf.= $k."<equals>";
                $buf.=$v;
                $buf.="<seperator>";
                }
            }
        }
    }
    return $buf;
}

/*
unable to jump with     get values
*/

function HTML_TIMER()
{
    echo
    "<SCRIPT>
var timeleft = 5;
var downloadTimer = setInterval(function(){
  document.getElementById(\"progressBar\").value = 5 - --timeleft;
  if(timeleft <= 0)
    clearInterval(downloadTimer);
},1000);
</SCRIPT>";
}

function HTML_PROGRESS()
{
    echo "
                <progress value=\"0\" max=\"5\" id=\"progressBar\"></progress>   
";
}

function self()
{
    return $_SERVER['PHP_SELF'];
}

function jumpToSelf()
{
    $html = '<meta http-equiv=\'refresh\' content=\'1; url='.$WEBSITEURLJUMP.'\'>';
    echo $html;
    //return $html;
}

function thisUrl()
{
    return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}

function postToSession()
{
    foreach($_POST as $k => $v)
        $_SESSION[$k]=$v;
}

function sessionToText()
{
    
}

function s($cmp)
{
    return $_SESSION["CTG"][0]==$cmp;
}


function clearSession()
{
    $buf = arToStr($_SESSION);
    appendFile("LIST.dat",$buf);

    if(s("i")||s("vl")||s("s")||s("hs"))
    {
        appendFile("PRESENT.dat",$buf);
    }

    foreach($_SESSION as $k => $v)
        unset($_SESSION[$k]);
}

function dump()
{
    /*
    echo "session<pre>";
var_dump($_SESSION);
echo "</pre>";

echo "POST<pre>";
var_dump($_POST);
echo "</pre>";
*/
}

function dump2()
{
    
    echo "session<pre>";
var_dump($_SESSION);
echo "</pre>";

echo "POST<pre>";
var_dump($_POST);
echo "</pre>";

}

//PRESENT

function PRESENT_getList()
{
    $ar = getArray("PRESENT.dat");
    $ar2 = array();
    $count=0;
    foreach($ar as $k=>$v)
    {
        if(strlen($v)>1)
        {
            $ar2[$count++]=lineToAr($v);
        }
    }
    return $ar2;
}


function e($str)
{
    echo $str;
}

function NOTES_PUSH()
{
    $d = "./dat/notes";
    $ar = listFiles($d);

    $ar1 = $ar;
    $c1=count($ar1)-3;
    for($a1=$c1;$a1>=0;$a1--)
    {

        $b=$a1;
        $c=$a1+1;
        
        $from = '/notes/'.leadingZeroes($b).".txt";
        $to ='/notes/'.leadingZeroes($c).".txt";
        rename ('./dat'.$from,'./dat/'.$to);
    }
    
         //  echo '/notes/'.leadingZeroes(0).".txt";
    overwriteFile('/notes/'.leadingZeroes(0).".txt","");
}

/*

DUMP TEMPLATE

    echo "<pre>"; var_dump($listarray); echo "</pre>";

NESTED LOOPS TEMPLATE

    $ar1 = $aaa;
    $c1=count($ar1);
    for($a1=0;$a1<$c1;$a1++)
    {
        
    }

    $ar2 = $aaa;
    $c2=count($ar2);
    for($a2=0;$a2<$c2;$a2++)
    {
        
    }

    $ar3 = $aaa;
    $c3=count($ar3);
    for($a3=0;$a3<$c3;$a3++)
    {
        
    }

*/

?>