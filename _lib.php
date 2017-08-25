<?php
$OFFSET = 0;
//-(7*60*60); // SERVER IS 8 HOURS IN ADVANCE (adjusted to 7 hours on 4-26)
// NOTE: DATES BEYOND A CERTAIN SUNDAY SHOULD BE ADJUSTED FORWARD TO MATCH DAYLIGHT SAVINGS 4-26

$WEBSITEURLJUMP = "https://back-office-pvnet.c9users.io/KIOSK/";

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
function jumpToSelf_15()
{
    $html = '<meta http-equiv=\'refresh\' content=\'15; url='.$WEBSITEURLJUMP.'\'>';
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
// Send emails through SimpleMail
function sendMail($to,$subj,$from,$reply='')
{
    require 'class.simple_mail.php';
    /* @var SimpleMail $mail */
    $mail = SimpleMail::make()
->setTo($to, $to_name)
->setSubject($subj)
->setFrom($from, 'Mail Bot')
->setReplyTo($reply, 'Mail Bot')
->setCc(['Recipient 2' => 'test2@example.com', 'Recipient 3' => 'test3@example.com'])
->setBcc(['Recipient 4' => 'test4@example.com'])
->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
->setHtml()
->setMessage('<strong>This is a test message.</strong>')
->setWrap(78);
    $send = $mail->send();
//echo $mail->debug();
// echo 'complete';
}

function insertRecord($connection,$session) {
    $studentAge1 = ($_SESSION['Age0'] == '') ? 0 : $_SESSION['Age0'];
    $studentAge2 = ($_SESSION['Age1'] == '') ? 0 : $_SESSION['Age1'];
    $studentAge3 = ($_SESSION['Age2'] == '') ? 0 : $_SESSION['Age2'];
    $studentAge4 = ($_SESSION['Age3'] == '') ? 0 : $_SESSION['Age3'];
    $studentAge5 = ($_SESSION['Age4'] == '') ? 0 : $_SESSION['Age4'];
    $studentAge6 = ($_SESSION['Age5'] == '') ? 0 : $_SESSION['Age5'];
    $studentAge7 = ($_SESSION['Age6'] == '') ? 0 : $_SESSION['Age6'];
    $studentAge8 = ($_SESSION['Age7'] == '') ? 0 : $_SESSION['Age7'];
    if (in_array(0, $_SESSION['box'])) {
        $areas_of_interest = 'Drones, ';
    }
    if (in_array(1, $_SESSION['box'])) {
        $areas_of_interest .= 'Robotics, ';
    }
    if (in_array(2, $_SESSION['box'])) {
        $areas_of_interest .= 'Vex IQ, ';
    }
    if (in_array(3, $_SESSION['box'])) {
        $areas_of_interest .= 'Engineering, ';
    }
    if (in_array(4, $_SESSION['box'])) {
        $areas_of_interest .= '3D Printing, ';
    }
    if (in_array(5, $_SESSION['box'])) {
        $areas_of_interest .= 'Game Design, ';
    }
    if (in_array(6, $_SESSION['box'])) {
        $areas_of_interest .= 'Unity, ';
    }
    if (in_array(7, $_SESSION['box'])) {
        $areas_of_interest .= 'Unreal Engine, ';
    }
    if (in_array(8, $_SESSION['box'])) {
        $areas_of_interest .= 'Vive, ';
    }
    if (in_array(9, $_SESSION['box'])) {
        $areas_of_interest .= 'Oculus, ';
    }
    if (in_array(10, $_SESSION['box'])) {
        $areas_of_interest .= 'Minecraft, ';
    }
    if (in_array(11, $_SESSION['box'])) {
        $areas_of_interest .= 'Java, ';
    }
    if (in_array(12, $_SESSION['box'])) {
        $areas_of_interest .= 'C++, ';
    }
    if (in_array(13, $_SESSION['box'])) {
        $areas_of_interest .= 'Web Design, ';
    }
    if (in_array(14, $_SESSION['box'])) {
        $areas_of_interest .= 'Photoshop, ';
    }
    if (in_array(15, $_SESSION['box'])) {
        $areas_of_interest .= '3D Modeling and Animation, ';
    }
    if (in_array(16, $_SESSION['box'])) {
        $areas_of_interest .= 'Photography, ';
    }
    if (in_array(17, $_SESSION['box'])) {
        $areas_of_interest .= 'Video Production, ';
    }
    if (in_array(20, $_SESSION['box'])) {
        $areas_of_interest .= 'Tinker Camp, ';
    }
    if (in_array(22, $_SESSION['box'])) {
        $areas_of_interest .= 'Volunteering, ';
    }
    if (in_array(23, $_SESSION['box'])) {
        $areas_of_interest .= 'Donation, ';
    }
    if (isset($_SESSION['GenderM0'])) {
        $student1_gender = 'Male';
    }
    if (isset($_SESSION['GenderF0'])) {
        $student1_gender = 'Female';
    }
    if (isset($_SESSION['GenderM1'])) {
        $student2_gender = 'Male';
    }
    if (isset($_SESSION['GenderF1'])) {
        $student2_gender = 'Female';
    }
    if (isset($_SESSION['GenderM2'])) {
        $student3_gender = 'Male';
    }
    if (isset($_SESSION['GenderF2'])) {
        $student3_gender = 'Female';
    }
    if (isset($_SESSION['GenderM3'])) {
        $student4_gender = 'Male';
    }
    if (isset($_SESSION['GenderF3'])) {
        $student4_gender = 'Female';
    }
    if (isset($_SESSION['GenderM4'])) {
        $student5_gender = 'Male';
    }
    if (isset($_SESSION['GenderF4'])) {
        $student5_gender = 'Female';
    }
    if (isset($_SESSION['GenderM5'])) {
        $student6_gender = 'Male';
    }
    if (isset($_SESSION['GenderF5'])) {
        $student6_gender = 'Female';
    }
    if (isset($_SESSION['GenderM6'])) {
        $student7_gender = 'Male';
    }
    if (isset($_SESSION['GenderF6'])) {
        $student7_gender = 'Female';
    }
    if (isset($_SESSION['GenderM7'])) {
        $student8_gender = 'Male';
    }
    if (isset($_SESSION['GenderF7'])) {
        $student8_gender = 'Female';
    }
    if (isset($_SESSION['sponsor'])) {
        $sponsor="yes";
    } else {
        $sponsor="no";
    }
    $_SESSION['conf_id'] = md5(uniqid(rand(), true));
    $sql = "INSERT INTO combined_main(Adult_First_Name,Adult_Last_Name,Adult_Interests,Adult_Email,Adult_Phone,Adult_Address_Line_1,Adult_City,Adult_State,Adult_Zip_Code,is_sponsor,Sponsor_Company_Name,Sponsor_Company_City,Sponsor_Company_Website,Sponsor_Notes,student1_name,student1_gender,student1_age, student1_email,student2_name,student2_gender,student2_age, student2_email,student3_name,student3_gender,student3_age, student3_email,student4_name,student4_gender,student4_age, student4_email,student5_name,student5_gender,student5_age, student5_email,student6_name,student6_gender,student6_age, student6_email,student7_name,student7_gender,student7_age, student7_email,student8_name,student8_gender,student8_age, student8_email,  misc_notes,misc_staff_notes,conf_id) VALUES ('$_SESSION[FNAME]','$_SESSION[LNAME]','$areas_of_interest','$_SESSION[email]','$_SESSION[phone]','$_SESSION[address]','$_SESSION[city]','$_SESSION[state]','$_SESSION[zip]','$sponsor','$_SESSION[CompanyName]','$_SESSION[CompanyCity]','$_SESSION[CompanyWebsite]','$_SESSION[Notes]','$_SESSION[Prospective0]','$student1_gender',$studentAge1,'$_SESSION[propemail0]','$_SESSION[Prospective1]','$student2_gender',$studentAge2,'$_SESSION[propemail1]','$_SESSION[Prospective2]','$student3_gender',$studentAge3,'$_SESSION[propemail2]','$_SESSION[Prospective3]','$student4_gender',$studentAge4,'$_SESSION[propemail3]','$_SESSION[Prospective4]','$student5_gender',$studentAge5,'$_SESSION[propemail4]','$_SESSION[Prospective5]','$student6_gender',$studentAge6,'$_SESSION[propemail5]','$_SESSION[Prospective6]','$student7_gender',$studentAge7,'$_SESSION[propemail6]','$_SESSION[Prospective7]','$student8_gender',$studentAge8,'$_SESSION[propemail7]','$_SESSION[visitornotes]','$_SESSION[visitorstaffnotes]','$_SESSION[conf_id]')";
    if ($connection->query($sql) === TRUE) {
        // echo "New record created successfully";
    } else {
        // echo "Error: " . $sql . "<br>" . $connection->error;
        // echo '<pre>';
        // echo $sql;
        // echo '</pre>';
    }
    sendConfirmationEmail($_SESSION['conf_id'],$_SESSION['email']);
}
// Sends confirmation email through SimpleMail
function sendConfirmationEmail($conf_id,$to)
{
    require 'class.simple_mail.php';
    /* @var SimpleMail $mail */
    $mail = SimpleMail::make()
->setTo($to, $to_name)
->setSubject('Please confirm your email address')
->setFrom('admin@pvnet.com', 'PVNet')
->setReplyTo('no-reply@pvnet.com', 'Do Not Reply')
// ->setCc(['Recipient 2' => 'test2@example.com', 'Recipient 3' => 'test3@example.com'])
// ->setBcc(['Recipient 4' => 'test4@example.com'])
->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
->setHtml()
->setMessage('Thank you for registering!<br />Please <a href="http://edu.pvnet.com/kiosk/confirm_email.php?conf_id=' . $conf_id  . '">click here</a> to confirm your email address.')
->setWrap(78);
    $send = $mail->send();
//echo $mail->debug();
// echo 'conf sent';
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