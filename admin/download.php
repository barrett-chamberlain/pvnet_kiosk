<?php
include_once "_lib.php";
include_once "_liblocal.php";

$fulllist = getLines("../dat/LIST.dat");

$NOTES_ARRAY = LOAD_NOTE_ARRAY();

$c=count($fulllist);
for($a=0;$a<$c;$a++)
{
    $listarray[]=lineToAr($fulllist[$a]);
}

$ar1 = $listarray;
$c1=count($ar1)-1;

$notecount = 0; //count($NOTES_ARRAY)-1;

$nocategories = array();
$category = array();
$allcategories = array();

for($a1=$c1;$a1>0;$a1--)
{
        
        if(IGNORENONVISITORS($ar1[$a1]))
        {
            $totalcount++;
            $visitor_entry = $ar1[$a1];
            
            $keys = array();
            $values = array();
            
            
            foreach($visitor_entry as $k => $v)
            {
                if(strlen($k)>1)
                {
                    $keys[] = $k;
                    $values[] = $v;
                }
            }
            
            $allcategories[]=$keys;
            $allcategories[]=$values;
            
            if(!in_array("box",$keys))
            {
                $nocategories[] = $keys;            
                $nocategories[] = $values;
            }
            else
            {
                //echo $visitor_entry['box']."<br>";
                $destinationar = explode('|',$visitor_entry['box']);  
                foreach($destinationar as $destination)
                {
                    $categoryid = intval($destination); 
                    $category[$categoryid][] = $keys;
                    $category[$categoryid][] = $values;
                }
            }
        }
}

TOCSV(CATEGORYTRANSLATION('null'),$nocategories);

foreach($category as $k => $v)
{
    if(($k<18)||($k>21))
        TOCSV(CATEGORYTRANSLATION($k), $v);
}

TOCSV("# All Categories",$allcategories);



?>