<?php

include_once "_lib.php";
include_once "_liblocal.php";

    $ar =  array_diff(listFiles("csv"),array(".",".."));

    $step1= array();
    
    $ar1 = getLinesCSV("csv/".$ar[0]);;
    $c1=count($ar1);
    for($a1=0;$a1<$c1;$a1+=2)
    {
        $step1[] = array_combine ( $ar1[$a1] , $ar1[$a1+1]);
    }
    
    $step2 = array();
    $ar1 = $step1;
    $c1=count($ar1);
    for($a1=0;$a1<$c1;$a1++)
    {
        $step2[$a1]["First Name"] = $ar1[$a1]["FNAME"];        
        $step2[$a1]["Last Name"] = $ar1[$a1]["LNAME"];
        $step2[$a1]["Email"] = $ar1[$a1]["email"];
        $step2[$a1]["Date"] = DATEstr_num($ar1[$a1]["intime"]);
    }
    
    echo "<pre>"; var_dump($step2); echo "</pre>";
    
?>