
<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
</HEAD>

<BODY>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <INPUT type="hidden" name="student">
    <TABLE class="center" cellpadding=10 >
        <TR>
            <TD class="title" colspan=2 align='center'>
                STUDENT
            </TD>
        </TR>
        <TR>
            <TD colspan=2>

            </TD>
        </TR>
        <TR>
            <TD class="textfield">
                Class Title
            </TD>
            <td><INPUT TYPE="text" style="width:500px;" name="CLASSN"></td>
        </TR>
        <TR>
            <TD colspan=2 align="center">
            </TD>
        </TR>
        <TR><TD COLSPAN="2" align="center">
            <input type="submit" value="Continue">
            
        </TD></TR>
    </TABLE>
</form>

</BODY>