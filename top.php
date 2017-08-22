<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
</HEAD>

<BODY>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <INPUT type="hidden" name="top">
    <TABLE class="center" cellpadding=10 >
        <TR>
            <TD colspan=2 align='center'>
                <table><tr><td><img src="IMG/PVNETLOGO LOGO 006633.jpg"></td><td  class="title" >CHECK IN</td></tr></td></table>
            </TD>
        </TR>
        <TR>
            <TD colspan=2>

            </TD>
        </TR>
        <TR>
            <TD class="textfield">
                First Name
            </TD>
            <td><INPUT TYPE="text" name="FNAME" required></td>
        </TR>
        <TR>
            <TD class="textfield">
                Last Name 
                
            </TD>
            <td><INPUT TYPE="text" name="LNAME" required></td>
        </TR>
        <TR>
            <TD colspan=2 align="center">
                <TABLE cellpadding=6 >
                    <tr><td colspan="4" class="textfield">
                        <div style="color:#4F4F4F;">Are you a...</div>
                        
                    </td></tr>
                    <TR>
                        <td width=10>&nbsp;</td>
                        <TD class="titlesmall">
                            <INPUT TYPE="checkbox" name="CTG[]" value="vs"> Visitor,
                        </TD>
                        <td width=10>&nbsp;</td>
                        <TD class="titlesmall">
                            <INPUT TYPE="checkbox" name="CTG[]" value="i" > Intern,
                        </TD>
                        <td width=10>&nbsp;</td>
                        <TD class="titlesmall">
                            <INPUT TYPE="checkbox" name="CTG[]" value="s"> Student,
                        </TD>
                        <td width=10 >&nbsp;</td>
                        <TD class="titlesmall">
                            <INPUT TYPE="checkbox" name="CTG[]" value="hs"> Homeschool,
                        </TD>
                        <td width=10 >&nbsp;</td>
                        <TD class="titlesmall">
                            <INPUT TYPE="checkbox" name="CTG[]" value="vl"> Volunteer ?
                        </TD>
                    </TR>
                </TABLE>
            </TD>
        </TR>
        <TR><TD COLSPAN="2" align="center">
            <input type="submit" value="Continue">
            
        </TD></TR>
    </TABLE>
</form>

<div class="bottomright titlesmall">
    
<form name="logoffform" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<input type="hidden" name="logoutlist">&#8680; <a onclick="logoffform.submit()">log out</a> </form></div>

</BODY>