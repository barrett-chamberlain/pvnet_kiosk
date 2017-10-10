<?php
$sql = "SELECT * FROM timestamp where id = " . $_SESSION['logout_id'];
$result = $conn->query($sql);
jumpStatic_15();
HTML_TIMER();
// echo '<pre>';
// echo '==============' . '<br />';
// echo 'SESSION' . '<br />';
// echo '==============' . '<br />';
// var_dump($_SESSION);
// echo '==============' . '<br />';
// echo 'POST' . '<br />';
// echo '==============' . '<br />';
// var_dump($_POST);
// echo 'session email: ' . $_SESSION['email'];
// echo '</pre>';
?>

<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
</HEAD>
<BODY>
    <form>
        <TABLE class="center" cellpadding=10 >
            <TR>
                <TD class="title" colspan=2 align='center'>
                    <?php    
                        if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) { 
                            $login_date = strtotime($row["time_logged_in"]);
                            $logout_date = strtotime($row["time_logged_out"]);
                            $dif = $logout_date - $login_date;
                            $dif_hours = floor($dif / 3600);
                            $dif_minutes_mod = $dif % 3600;
                            $dif_minutes = floor($dif_minutes_mod / 60);
                            $dif_seconds = $dif_minutes_mod % 60;
                            $update_dif = "UPDATE timestamp SET difference=" . $dif . " WHERE id=" . $sanitized_id;
                            if ($conn->query($update_dif) === TRUE) {

                            }
                    ?>
                    Logging off, <?php echo $row["fname"]; ?>
                </TD>
            </TR>
            <TR>
                <TD colspan=2></TD>
            </TR>
            <TR>
                <TD class="textfield" colspan=2 align="center">
                    You have logged out at <?php echo date("g:i a",$logout_date); ?><br>
                    <br>
                    duration: <?php echo $dif_hours ?> hours, <?php echo $dif_minutes ?> minutes, and <?php echo $dif_seconds ?> seconds.
                    <br>
                    <br>
                     we hope you had fun &amp; see you next time.
                </TD>
            </TR>
        <?php } } ?>
        <TR>
            <TD colspan=2 align="center">
<?php 
HTML_PROGRESS(); 
clearSession();    
?>
            </TD>
        </TR>
    </TABLE>
</form>

</BODY>