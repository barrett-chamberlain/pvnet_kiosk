
<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
</HEAD>

<BODY>
<center>
    <TABLE style="padding:50px;">
        <TR>
            <TD class="title" colspan=2 align='center'>
                <div style="font-size:50px;">Members In Attendance:</div>
            </TD>
        </TR>
        <TR>
            <TD colspan=2>
            &nbsp;
            </TD>
        </TR>
<?php

$ar = getArray("PRESENT.dat");
$count=0;
foreach($ar as $k=>$v)
{
    if(strlen($v)>1)
    {
            $S = lineToAr($v);
            $T = $S["intime"]+$OFFSET;
        
            $buf.=
"        <TR>
            <TD class=\"textfield greyfont\" colspan=2 align=\"center\">
                <form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" style=\"padding: 5px 5px 5px 5px; font-size:25px;\">
                ".$S["FNAME"]." ".$S["LNAME"]." : checked in [ ".date("h:i a",$T)." ] on [ ".date("F d, Y",$T)." ], duration: ".gmdate("H:i", calcDuration($T))." hours, 
                <input type=\"hidden\" name=\"logout\" value=\"".$count++."\">
                <input type=\"submit\" value=\"log out\" style=\"font-size:20px;\">
                </form>
            </TD>
        </TR>
";
    }
}

echo $buf;

?>

        <TR>
            <TD colspan=2 align="center">
               
            </TD>
        </TR>
    </TABLE>

</BODY>