
<?php
    //==========================================================================================
    
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
    $c1=count($ar1)-1;
    for($a1=0;$a1<$c1;$a1++)
    {
        if($namear[$ar1[$a1]]!="")
            $buf.=$namear[$ar1[$a1]].", ";
    }
    //if($namear[$ar1[$a1]]!="")
        $buf.=$namear[$ar1[$a1]]."";
    
    return "<br>(Interests) ".$buf."";
}


// USE THIS FUNCTION TO ADD TO AN ARRAY
function FIELDSTOTABLE($key,$val)
{
    if(DONOTIGNOREFIELD($key,$val))
    {

        // default 
        $buf=$key."|".$val;

        // blank overwrite default for specific fields 
        $IGNORELIST = array("address","city","state","zip","notes");
        if(in_array($key,$IGNORELIST))
        {
            $buf="";
        }
        
        if($key=="intime")
        {
            $GLOBALS["PRNT"][$GLOBALS["PRNTCOUNT"]][5]=$val;

            $buf="Visit Date: ".DATEstr($val)." ".TIMEstr($val);
        }
        if($key=="FNAME")
        {
            $GLOBALS["PRNT"][$GLOBALS["PRNTCOUNT"]][1]=$val;
            $buf="First Name: ".$val;
        }
        if($key=="LNAME")
        {
            $GLOBALS["PRNT"][$GLOBALS["PRNTCOUNT"]][2]=$val;
            $buf="Last Name: ".$val;
        }
        if($key=="box")
        {
            $buf = CONVERTBOX($val);
            $GLOBALS["PRNT"][$GLOBALS["PRNTCOUNT"]][4].=$buf;
        }
        if($key=="email")
        {
            $GLOBALS["PRNT"][$GLOBALS["PRNTCOUNT"]][0]=$val;
            $buf = "Email: ".$val;
        }
        if($key == "phone")
        {
            $GLOBALS["PRNT"][$GLOBALS["PRNTCOUNT"]][3]=$val;
            $buf = "Phone: ".$val;
        }


//=================================================
// add seperately to prospectives list with note on who the parent is
// this happens in piece meal what the heck
        $c3=8;
        for($a3=0;$a3<$c3;$a3++)
        {
//echo "<BR><BR>SBPR UPDATED".($GLOBALS["SBPRCOUNT"]+$a3)."<BR>";

            
//          $GLOBALS["SBPR"][$GLOBALS["SBPRCOUNT"]]
            if($key=="Prospective".$a3)
            {
                $buf = "Prospective ".$a3.": ".$val;
                $tmp = explode(" ",$val);
                $GLOBALS["SBPR"][$GLOBALS["SBPRCOUNT"]+$a3][1]=$tmp[0];
                $GLOBALS["SBPR"][$GLOBALS["SBPRCOUNT"]+$a3][2]=$tmp[1];
                
            }
            if($key=="GenderF".$a3)
            {
                $GLOBALS["SBPR"][$GLOBALS["SBPRCOUNT"]+$a3][7]="Female";
                $buf = "Gender: F";
            }            
            if($key=="GenderM".$a3)
            {
                $GLOBALS["SBPR"][$GLOBALS["SBPRCOUNT"]+$a3][7]="Male";
                $buf = "Gender: M";
            }
            if($key=="Age".$a3)
            {
                $GLOBALS["SBPR"][$GLOBALS["SBPRCOUNT"]+$a3][6]=$val;
                $buf = "Age: ".$val;
            }
            if($key=="propemail".$a3)
            {
                $GLOBALS["SBPR"][$GLOBALS["SBPRCOUNT"]+$a3][0]=$val;
                $buf = "Email: ".$val;
            }

            $GLOBALS["SBPR"][$GLOBALS["SBPRCOUNT"]+$a3][5]="Parent Name: ".$GLOBALS["PRNT"][$GLOBALS["PRNTCOUNT"]][1]." ".$GLOBALS["PRNT"][$GLOBALS["PRNTCOUNT"]][2];
        }
//=================================================

        if($key=="visitornotes")
        {
            $GLOBALS["PRNT"][$GLOBALS["PRNTCOUNT"]][5].="(visitor notes) ".$val;
            
            $buf="<br>(Notes)<pre>".$val."</pre>";
        }
        if($key=="visitorstaffnotes")
        {
            $GLOBALS["PRNT"][$GLOBALS["PRNTCOUNT"]][5].="
(staff notes 1) ".$val;
            $buf="(Staff Notes)<pre>".$val."</pre>";
        }
        
        //e("<br>".$buf);
        
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


// CSV TITLES
$CSVT = array("email", "First Name", "Last Name", "Phone", "Pick which courses you wish to receive more information about", "Notes", "Age", "gender", "member_since", "plaintext_preferred", "bounce_count", "status_name", "last_modified_at");

// PARENTS OR SUBMITTERS
$PRNT = array();
$PRNTCOUNT =0;
// PROSPECTIVES ASSOCIATED WITH PARENTS
$SBPR = array();
$SBPRCOUNT=0;
echo "<center>

";
//echo "<table cellpadding=5 border>";
$ar1 = $listarray;
$c1=count($ar1)-1;
for($a1=$c1;$a1>0;$a1--)
{
        $ar2 = $ar1[$a1];
        if(IGNORENONVISITORS($ar2))
        {
//    echo "<tr><td valign='middle'>
//
//";
            foreach($ar2 as $k => $v)
            {
//                e("<table >");
                (FIELDSTOTABLE($k,$v));
//                e("</table>");

            }
                $GLOBALS["PRNTCOUNT"]++;
                $GLOBALS["SBPRCOUNT"]+=8;// c3 from inside loop
                //echo "<BR><BR>SBPR UPDATED".$GLOBALS["SBPRCOUNT"]."<BR>";

/*
    echo "
";

// THESE NEED TO BE PASTED AT THE END OF THE NOTES
// GOOD TO REMOVE POTENTIALS FROM LIST AND USE PARENTS
// ARRAY WOULD HAVE THE SAME LENGTH
    echo "
(notes2) ".$NOTES_ARRAY[$Z++]."</td>

";
*/
    echo "</tr>";
        }
        
    $PRNT[$c1][3]="
(staff notes 2) ".$val;

}
echo "</table>

";

//==========================================================================================

function TITLETABLEDATAS()
{
    $buf = "";
    $ar1 = $GLOBALS["CSVT"];
    $c1=count($ar1);
    for($a1=0;$a1<$c1;$a1++)
    {
        $buf.="<TD>".$ar1[$a1]."</TD>";
    }
    return $buf;
}


    $buf="<TABLE border>";
    $buf.="<TR>".TITLETABLEDATAS()."</TR>";
    $ar3 = $PRNT;
    $c3=count($ar3);
    for($a3=0;$a3<$c3;$a3++)
    {
        $buf.="<TR>";
      
        $c4=count($ar3[$a3]);
        for($a4=0;$a4<13;$a4++)
        {
            $buf.="<TD>". $ar3[$a3][$a4]."</TD>";
        }
        $buf.="</TR>";
    }
        $buf.="</TABLE>";
    
    echo $buf;
    
    
//    var_dump($SBPR);

    $buf="<TABLE border>";
    $buf.="<TR>".TITLETABLEDATAS()."</TR>";
    $ar3 = $SBPR;
    $c3=count($ar3);
    for($a3=0;$a3<$c3;$a3++)
    {
        if($ar3[$a3][1]!="")
        {
            $buf.="<TR>";
              
                $c4=count($ar3[$a3]);
                for($a4=0;$a4<13;$a4++)
                {
                    $buf.="<TD> ".$ar3[$a3][$a4]."</TD>";
                }
                $buf.="</TR>";
        }
    }
        $buf.="</TABLE>";
    
    echo $buf;
?>