
<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
<?php jumpToSelf();
HTML_TIMER();
?>





</HEAD>

<BODY>

<form>
    <TABLE class="center" cellpadding=10 >
        <TR>
            <TD class="title" colspan=2 align='center'>
                Welcome, [<?php echo $_SESSION["FNAME"]?>]
            </TD>
        </TR>
        <TR>
            <TD colspan=2>

            </TD>
        </TR>
        <TR>
            <TD class="textfield" colspan=2 align="center">
                You have logged in at [<?php tm1($_SESSION["intime"])?>] on [<?php tm2($_SESSION["intime"])?>]<br>
                <br>
                 It's a pleasure to have you here<br>
                 remember to <b>[<i> log out </i>]</b> as you leave.<br>
            </TD>
        </TR>
        <TR>
            <TD colspan=2 align="center">
                <?php HTML_PROGRESS(); ?>
            </TD>
        </TR>
    </TABLE>
</form>

</BODY>