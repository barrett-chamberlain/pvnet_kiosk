<center>

Activity List ( from [Most Recent] to [Least Recent] )<br>
<br>

<?php

include "../_lib.php";


function datToArray($fname)
{
    $buf = getLines($fname);
    foreach($buf as $k=>$v)
    {
        if(strlen($v)>1)
            $buf2[$k] = lineToAr($v);    
    }
    return $buf2;
}

function arToHtml($buf2)
{
    $h = "<TABLE BORDER>";
foreach($buf2 as $k=>$v)
{
    $h.="<TR>";
    foreach($v as $k1=>$v1)
    {
        $h.="<TD>$k1</TD><TD>$v1</TD>";
    }
    $h.="</TR>";
}
$h.="</TABLE>";
    return $h;
}

$inar = datToArray("../dat/LIST.dat");
$outar = datToArray("../dat/OUT.dat");

// append an inTime to combine the in and out array
foreach($outar as $k=>$v)
{
    $outar[$k]["intime"] = $v["outtime"];
}

// merge in and out array
$summary = array_merge($inar,$outar);

usort($summary, function ($a, $b) { return strcmp($a["intime"], $b["intime"]); });

$summary2 = array_reverse($summary);

//echo arToHtml($summary2);


/*

*/

$h = "<TABLE >";

$previousDay = "";
foreach($summary2 as $v)
{
    $currentDay=DAYstr($v['intime']);
    
    if($currentDay!=$previousDay)
    {
        $h.='<TR><TD COLSPAN=4 HEIGHT=1 style="background-color:#b2d7dc;" align=middle>'.FULLDAYstr($v['intime']).'<TD><TR>';
    }
    
    
    $class_highlight = "";
    if(isset($v['CLASSN']))
    {
        $class_highlight = ' style="background-color: yellow;" ';
    }
       

    $h.="<TR >";
    if(isset($v['outtime']))
    {
        $h.="<TD  bgcolor='#aec8f2' align='center'>OUT</TD>";
    }
    else
    {
        if(isset($v['CTG']))
        {
            if(is_int(strpos ($v['CTG'],'vs')))
            {
                $h.="<TD  bgcolor='#FFB2C4' align='center'>VISIT</TD>";
            }
            else
            {
                //students or homeschool hopefully
                if(is_int(strpos ($v['CTG'],'hs')))
                    $h.="<TD  bgcolor='#00FF00' align='center'>IN</TD>";
                else
                    $h.="<TD  bgcolor='#bee2b3' align='center'>IN</TD>";
            }
            
        }
        else 
        {
            $h.="<TD  bgcolor='#bee2b3' align='center'>IN*</TD>";
        }
    }

//        $h.="<TD >[".DATEstr($v['intime'])."] [".TIMEstr($v['intime'])."]</TD>";
//        $h.="<TD></TD>";

        $h.="<TD $class_highlight>[".DAYstr($v['intime']).DATEstr($v['intime'])."] [".TIMEstr($v['intime'])."]</TD>";

//        $h.="<TD>".DURATIONstr($v['intime'],)."</TD>"; NEED TO FIND OUT TIME FROM PREVIOUS ROW


    $h.="<TD $class_highlight>";
        $h.= $v["FNAME"]." ".$v["LNAME"];
    $h.="</TD>";

    if(is_int(strpos ($v['CTG'],'hs')))
    {    
        $class_description = "(Homeschool) ".$v["CLASSN"];
        $class_highlight =' style="background-color: #00FF00;" ';
    }   
    else
    {
        $class_description = $v["CLASSN"];
        //class highlight same
    }

    $h.= "<TD $class_highlight>".$class_description."</TD>";

    $h.="</TR>";  
    
    $previousDay = $currentDay;
}
$h.="</TABLE>";


echo $h;
?>