<?php
// include('_lib.php');
// include('./_includes/connect.php');
$sql = "SELECT * FROM timestamp where logged_in = 1";
$result = $conn->query($sql);
if(isset($_GET["id"])) {
    $sanitized_id = mysqli_real_escape_string($conn,$_GET["id"]);
    $sql = "UPDATE timestamp SET logged_in=0 WHERE id=" . $sanitized_id;
}
?>
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
        <TR>
            <td colspan=2 align="center">
<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //$row["time_logged_in"] = date("F j, Y, g:i a");
        $date = strtotime($row["time_logged_in"]);
        echo "Name: " . $row["fname"]. " " . $row["lname"]. " | Checked in: " . date("g:i a",$date). " | <a href=" . $_SERVER['PHP_SELF'] . "?id=" . $row["id"] . ">Logout</a><br>";
    }
} else {
    echo "No members are currently logged in.";
}

// $ar = getArray("PRESENT.dat");
// $count=0;
// foreach($ar as $k=>$v)
// {
//     if(strlen($v)>1)
//     {
//             $S = lineToAr($v);
//             $T = $S["intime"]+$OFFSET;
        
//             $buf.=
// "        <TR>
//             <TD class=\"textfield greyfont\" colspan=2 align=\"center\">
//                 <form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" style=\"padding: 5px 5px 5px 5px; font-size:25px;\">
//                 ".$S["FNAME"]." ".$S["LNAME"]." : checked in [ ".date("h:i a",$T)." ] on [ ".date("F d, Y",$T)." ], duration: ".gmdate("H:i", calcDuration($T))." hours, 
//                 <input type=\"hidden\" name=\"logout\" value=\"".$count++."\">
//                 <input type=\"submit\" value=\"log out\" style=\"font-size:20px;\">
//                 </form>
//             </TD>
//         </TR>
// ";
//     }
// }

// echo $buf;

?>
        </td>
        </TR>
        <TR>
            <TD colspan=2 align="center">
               
            </TD>
        </TR>
    </TABLE>

</BODY>