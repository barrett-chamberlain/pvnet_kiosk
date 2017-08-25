<?php
include('./_includes/connect.php');
include('_lib.php');
// confirmEmail($conn,$_GET['confirm_id']);
// echo $_GET['conf_id'];
$sql="SELECT * FROM combined_main where conf_id = '" . $_GET['conf_id'] . "'";
$result = $conn->query($sql);
// echo $sql . '<br />';
if ($result->num_rows > 0) { 
$sql = "UPDATE combined_main SET is_confirmed=1 WHERE conf_id='" . $_GET['conf_id'] . "'";
if ($conn->query($sql) === TRUE) {
    // echo "Record updated successfully";
} else {
    // echo "Error updating record: " . $conn->error;
}
?>
<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
</HEAD>

<BODY>

<form>
    <TABLE class="center" cellpadding=10 >
        <TR>
            <TD class="textfield" colspan=2 align="center">
                Thank you.  Your email address has been confirmed. Please <a style="color: red;" href="<?php echo INDEX;?>">click here</a> to return to the main menu.
            </TD>
        </TR>
    </TABLE>
</form>

</BODY>
<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"]. " - Name: " . $row["Adult_First_Name"]. " " . $row["Adult_Last_Name"]. "<br>";
    }
} else { ?>
<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
</HEAD>

<BODY>

<form>
    <TABLE class="center" cellpadding=10 >
        <TR>
            <TD class="textfield" colspan=2 align="center">
              We're sorry, an error has occurred - <a style="color: red;" href='mailto:education@pvnet.com'>click here</a> to email education@pvnet.com for assistance. Please <a style="color: red;" href="<?php echo INDEX;?>">click here</a> to return to the main menu.
            </TD>
        </TR>
    </TABLE>
</form>
</BODY>
<?php } ?>