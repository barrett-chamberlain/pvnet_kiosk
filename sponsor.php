<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
</HEAD>

<BODY>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <INPUT type="hidden" name="top">
    <TABLE class="center" cellspacing=10>
        <TR>
            <TD class="title" colspan=2 align='center'>
                <DIV style="font-size:40px;">Sponsorship Information</DIV>
            </TD>
        </TR>
        <TR>
            <TD class="textfield" align="center">
                <i>Thank you for your Interest.</i>
            </TD>
        </TR>
        <TR>
            <TD colspan=2>

            </TD>
        </TR>
        <TR>
         <td>
            <table class="textfield" cellpadding=5 cellspacing=5><tr>
            <TD>
                    Company Name:
            </td>
            <td>
                    <input type=text name='CompanyName'>
            </td>
            </tr>
            <tr><td>City:</td>
            <td>
                    <input type=text name='CompanyCity'>
            </td></tr>
            <tr><td>
                                    Company Website:
            </td>
<td>                    <input type=text name='CompanyWebsite'>
</td>
</tr>           
            <tr><td colspan=2>
                Notes:<br>
                    <textarea name="Notes" id="Notes" rows=7 cols=45></textarea>   
            </td></tr>

            </table>
                    
            </TD>
        </TR>
        <TR>
            <TD colspan=2 align="center">
                <input type="hidden" value="visitor" name="visitor">
                <input type="submit" value="continue">
            </TD>
        </TR>
    </TABLE>
</form>


</BODY>



