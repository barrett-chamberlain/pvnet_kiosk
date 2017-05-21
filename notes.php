<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
</HEAD>
<BODY>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <table class="textfield center" cellpadding=0 cellspacing=10 >
    <tr><td align="center"><div class="title" style="font-size :50px;">Miscelleaneous Information</div></td></tr>
    <tr><td></td></tr>
    <tr><td>Notes:</td></tr>
    <tr><td><TEXTAREA style="width:700px; height:200px;" name="visitornotes"></TEXTAREA></td></tr>
    <tr><td>Staff Notes:</td></tr>
    <tr><td><TEXTAREA style="width:700px; height:200px;" name="visitorstaffnotes"></TEXTAREA></td></tr>

    <tr><td></td></tr>
    <tr><td align="right">
    <input type="hidden" value="notes" name="notes">
    <input type="submit" value="continue">
    </td></tr>
    </table>
    </form>
</BODY>