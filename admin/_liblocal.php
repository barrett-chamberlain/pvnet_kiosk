<?php

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

function TOCSV($title,$ar)
{
    $fp = fopen('csv/'.$title.'.csv', 'w');

    foreach ($ar as $fields) {
        fputcsv($fp, $fields);
    }
    
    fclose($fp);
}

function CATEGORYTRANSLATION($num)
{
    $ar = array(
"Drones",
"Robotics",
"Vex-IQ",
"Egineering",
"3d Printing",
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
"3d Modeling & Animation",
"Photography",
"Video Production",
"ERROR-18",
"ERROR-19",
"Tinker camp",
"ERROR-21",
"Volunteering",
"Donation");

$ar["null"] = "# General Visitor";

return $ar[$num];
    
}


?>