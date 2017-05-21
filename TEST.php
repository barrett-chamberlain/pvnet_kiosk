<?php

    include "_lib.php";

function TEST_WIPE_RESTORE($limit)
{
    $d = "./dat/notes";
    $ar = listFiles($d);

    $ar1 = $ar;
    $c1=$limit; //count($ar1);
    for($a1=$c1;$a1>=1;$a1--)
    {
        echo $a1."<br>";
        
        $b=$a1;
        $c=$a1;
        
/*        $b=$a1-2;
        $c=$a1-1;
        

        rename ( $from,$to );
*/
        $from = '/notes/'.leadingZeroes($b).".txt";
        $to ='/notes/'.leadingZeroes($c).".txt";
        
    overwriteFile($from,"");
        
        
    }
    
    overwriteFile('/notes/'.leadingZeroes(0).".txt","");
}




TEST_WIPE_RESTORE(42);
PUSH();

?>