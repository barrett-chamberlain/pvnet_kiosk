<?php
$studentinfo = PRESENT_getList();
//echo "<pre>";
//var_dump($studentinfo);

$ignoreId = $_POST["logout"];

$ar["outtime"] = time();
$ar["FNAME"] = $studentinfo[$ignoreId]["FNAME"];
$ar["LNAME"] = $studentinfo[$ignoreId]["LNAME"];

$logoutline = arToStr($ar);

appendFile("OUT.dat",$logoutline);

$buf ="";
$count++;
foreach($studentinfo as $k=>$v)
{
    if($k!=$ignoreId)
        $buf.= arToStr($v)."\n";
}

overwriteFile("PRESENT.dat",$buf);

//echo "</pre>";

//dump2();
//die();
?>

<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
    <?php jumpToSelf();
    HTML_TIMER();
    ?>
</HEAD>

<BODY>

<form>
    <TABLE class="center" cellpadding=10 >
        <TR>
            <TD class="title" colspan=2 align='center'>
                Logging off, [<?php
echo $studentinfo[$_POST['logout']]['FNAME'];
                ?>]
            </TD>
        </TR>
        <TR>
            <TD colspan=2>

            </TD>
        </TR>
        <TR>
            <TD class="textfield" colspan=2 align="center">
                You have logged out at [ <?php $logout = time(); tm1($logout)?> ] on [<?php tm2($logout)?>"]<br>
                <br>
                duration [<?php 
tm3($studentinfo[$_POST['logout']]['intime']);


?>] hours.<br>
                <br>
                 we hope you had fun & see you next time.
            </TD>
        </TR>
        <TR>
            <TD colspan=2 align="center">
<?php HTML_PROGRESS(); ?>
            </TD>
        </TR>
    </TABLE>
</form>

</BODY>