<?php
NOTES_PUSH();
?>


<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
    <?php 
    jumpToSelf_15();
    HTML_TIMER();
    ?>

</HEAD>

<BODY>

<form>
    <TABLE class="center" cellpadding=10 >
        <TR>
            <TD class="title" colspan=2 align='center'>
                Thank You For Your Interest
            </TD>
        </TR>
        <TR>
            <TD colspan=2>

            </TD>
        </TR>
        <TR>
            <TD class="textfield" colspan=2 align="center">
                 A confirmation email has been sent to your email address: <?php echo $_SESSION['email'] ?>. Your information has been submitted.  We hope you have a nice day.
            </TD>
        </TR>
        <TR>
            <TD colspan=2 align="center">
<?php HTML_PROGRESS();?>
            </TD>
        </TR>
    </TABLE>
</form>

</BODY>