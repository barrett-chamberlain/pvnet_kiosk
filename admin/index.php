
<A HREF='?l="LOGIN_LIST'>LOGIN LIST</A> | <A HREF='?l=VISITOR_NOTES'>VISITOR NOTES</A>

<?php
if(isset($_GET['l']))
{
    $l =  $_GET['l'];
    if($l == "VISITOR_NOTES")
{
    //==========================================================================================
    // COULDN'T GET INDEX 1 TO LOAD AND RECIEVE CORRECTLY
include "_lib.php";

function WRITE_NOTE_ARRAY()
{
    $ar1 = $_POST['notes'];
    $c1=count($ar1);
    for($a1=0;$a1<$c1;$a1++)
    {
        overwriteFile('/notes/'.leadingZeroes($a1).'.txt',$_POST['notes'][$a1]);
    }
}

function LOAD_NOTE_ARRAY()
{
    $dir= '../dat/notes';

    $buf = array();
    
    $ar1 = listFiles($dir);
    $c1=count($ar1);
    for($a1=2;$a1<$c1;$a1++)
    {
        $lines = getLines('../dat/notes/'.leadingZeroes($a1-2).".txt");

        $ar2 = $lines;
        $c2=count($ar2);
        for($a2=0;$a2<$c2;$a2++)
        {
            $buf[$a1-2] .= $lines[$a2];
        }
    }

    return $buf;
}

if(isset($_POST['notes']))
{
    WRITE_NOTE_ARRAY();
}


$fulllist = getLines("../dat/LIST.dat");

$listarray = array();


$c=count($fulllist);
for($a=0;$a<$c;$a++)
{
    $listarray[]=lineToAr($fulllist[$a]);
}

//echo "<pre>"; var_dump($listarray); echo "</pre>";

function DONOTIGNOREFIELD($key,$val)
{
    if(strlen($val)==0) return false;
    if($val=="visitor2") return false;
    if($val=="(optional)") return false;
    if($key=="CTG") return false;
    return true;
}

function CONVERTBOX($val)
{
$namear = array(
"Drones",
"Robotics",
"Vex IQ",
"Engineering",
"3D Printing",
"Game Design",
"Unity",
"Unreal Engine",
"Vive",
"Oculus",
"Minecraft",
"Java",
"C++",
"Web Design",
"Photoshop",
"3D Modeling &amp; Animation",
"Photography",
"Video Production",
"",
"",
"Tinker Camp",
"",
"Volunteering",
"Donation"
);


$ar1 = explode("|",$val);
$c1=count($ar1);
for($a1=0;$a1<$c1;$a1++)
{
    $buf.=$namear[$ar1[$a1]]." (category ".$ar1[$a1].")<br>";
}


return "<TABLE><TR><TD VALIGN='top'>Interests: </TD><TD>".$buf."</TD></TR></TABLE>";

    
}

function FIELDSTOTABLE($key,$val)
{
    if(DONOTIGNOREFIELD($key,$val))
    {
        e("<tr><td>");
        $buf=$key."|".$val;
            if($key=="intime")
            {
                $buf="Visit Date: ".DATEstr($val)." ".TIMEstr($val);
            }
            if($key=="FNAME")
            {
                $buf="First Name: ".$val;
            }
            if($key=="LNAME")
            {
                $buf="Last Name: ".$val;
            }
            if($key=="LNAME")
            {
                $buf="Last Name: ".$val;
            }
            if($key=="box")
            {
                $buf = CONVERTBOX($val);
            }
            if($key=="gender")
            {
                $buf = "Gender: ".$val;
            }
            if($key=="email")
            {
                $buf = "Email: ".$val;
            }
            if($key == "phone")
            {
                $buf = "Phone: ".$val;
            }
            if($key=="age")
            {
                $buf = "Age: ".$val;
            }

    $c3=8;
    for($a3=0;$a3<$c3;$a3++)
    {
        
            if($key=="Prospective".$a3)
            {
                $buf = "Prospective ".$a3.": ".$val;
            }
            if($key=="GenderF".$a3)
            {
                $buf = "Gender: F";
            }            
            if($key=="GenderM".$a3)
            {
                $buf = "Gender: M";
            }
            if($key=="Age".$a3)
            {
                $buf = "Age: ".$val;
            }
            if($key=="propemail".$a3)
            {
                $buf = "Email: ".$val;
            }
    }
            

            if($key=="address")
            {
                if($val!="... optional ...")
                    $buf = "Street Address: ".$val;
                else $buf="";
            }
            if($key=="city")
            {
                if($val!="... optional ...")
                    $buf = "City: ".$val;
                else $buf="";
            }
            if($key=="state")
            {
                if($val!="... optional ...")
                    $buf = "State: ".$val;
                else $buf="";
            }
            if($key=="zip")
            {
                if($val!="... optional ...")
                    $buf = "Zip Code: ".$val;
                else $buf="";
            }
            if($key=="notes")
            {
                $buf="";
            }
            if($key=="visitornotes")
            {
                $buf="<TABLE><TR><TD>Notes:</TD><TD><pre>".$val."</pre></TD></TR></TABLE>";
            }
            if($key=="visitorstaffnotes")
            {
                $buf="<TABLE><TR><TD>Staff Notes:</TD><TD><pre>".$val."</pre></TD></TR></TABLE>";
            }


        e($buf);
        e("</td></tr>");
    }
}

function IGNORENONVISITORS($ar)
{
//echo "<pre>"; var_dump($ar); echo "</pre>";

    if(isset($ar["CTG"]))
    {
        
        $val = $ar["CTG"];
        
        return is_int(strpos( $val , "vs"));
    
    }
    return false;
}

$NOTES_ARRAY = LOAD_NOTE_ARRAY();
$Z=0;

echo "<center>

<form action='".self()."?l=VISITOR_NOTES' method='post'>
";
echo "<table cellpadding=5>";
$ar1 = $listarray;
$c1=count($ar1)-1;
for($a1=$c1;$a1>0;$a1--)
{
        $ar2 = $ar1[$a1];
        if(IGNORENONVISITORS($ar2))
        {
    echo "<tr><td align='right' valign='middle'>

<table bgcolor='#339966' cellpadding=10><td>    
";
            foreach($ar2 as $k => $v)
            {
                e("<table >");
                (FIELDSTOTABLE($k,$v));
                e("</table>");
            }

    echo "
</td></table>

</td>";
    echo "
<td valign='middle'><textarea rows=12 cols=70 style='padding: 20px;' name='notes[]'>".$NOTES_ARRAY[$Z++]."</textarea></td>
<td><input type='submit' value='Save'></td>

";
    echo "</tr>";
        }
}
echo "</table>

</form>
";

//==========================================================================================

    
}
    else
    {
        include "index.2.php";
    }
}
else
{
    include "index.2.php";
}
?>