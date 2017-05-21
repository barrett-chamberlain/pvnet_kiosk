
<?php $PROSPLIMIT = 8; ?>

<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>  <!-- </script>src="_LIB/jquery-3.1.1.js"></script> -->
    <SCRIPT>
    
    var upper = <?php echo $PROSPLIMIT; ?>;
    var next = 1;
    
    $(document).ready(function(){

        $("#showbutton").click(function(){
            if(next>(upper-1)) 
                next = upper;
            else
            {
                $("#row"+next).show();
                next++;
            }
        });

        $("#hidebutton").click(function(){
            if(next<=1) 
                next=1;
            else
            {
                $("#row"+(next-1)).hide();
                next--;
            }
        });

    });
    </SCRIPT>

    <SCRIPT>
    function CONDITIONAL_CLEAR(a)
    {
            var E = document.getElementById(a);
            if(E.value=="... optional ...") E.value = "";
    }
    
    function FLIP_TEXTBOXES(a)
    {
             var E = document.getElementById(a);
             if(E.value=="... optional ...") {E.style.fontSize = "20px";  E.style.color = "#b9b9b9"; E.style.fontStyle = "italic"; } //
             else {E.style.fontSize = "";  E.style.fontStyle = ""; E.style.color = ""} //E.style.fontColor = "";
    }
    </SCRIPT>

</HEAD>

<BODY>
<center>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

<TABLE><TR><TD VALIGN="TOP" align="center"> <!-- SIDE BY SIDE TABLING -->


    <TABLE  cellspacing=10 >
        <TR>
            <TD class="title" colspan=2 align='center'>
                <div style="font-size :50px;">Contact Information</div>
            </TD>
        </TR>
        <TR>
            <TD colspan=2>

            </TD>
        </TR>
        <TR>
         <td align="center">

<table class="textfield" cellpadding=0 cellspacing=10 >
<tr><td colspan=2>
    
<table class="textfield round" cellpadding=10 cellspacing=10 width=600 bgcolor="#00802b" >
            <tr>
                <td>Email</td><td><input type=text name='email'></td>
            </tr>
            <tr>
                <td>Phone</td><td><input type=text name='phone'></td>
            </tr>
</table>    

</td></tr>    
            
            <tr><td ></td><td></td></tr>

            <tr><td colspan=2 align="center">

<table class="textfield" cellpadding=5 cellspacing=5 width=600>
    <tr>
        <TD >
        Address</td><td><input type='text' name='address' value='... optional ...' id='0' class='optional' onClick='CONDITIONAL_CLEAR(0);FLIP_TEXTBOXES(0);' onKeyDown='FLIP_TEXTBOXES(0);'></td>
    </tr>
    <tr>
        <td >City</td><td ><input type='text' name='city' value='... optional ...' id='1' class='optional' onClick='CONDITIONAL_CLEAR(1);FLIP_TEXTBOXES(1);' onKeyDown='FLIP_TEXTBOXES(1);'></td>
    </tr>
    <tr>
        <td >State</td><td ><input type='text' name='state' value='... optional ...' id='2' class='optional' onClick='CONDITIONAL_CLEAR(2);FLIP_TEXTBOXES(2);' onKeyDown='FLIP_TEXTBOXES(2);'></td>
    </tr>
    <tr>
        <td >Zip</td><td ><input type='text' name='zip' value='... optional ...' id='3' class='optional' onClick='CONDITIONAL_CLEAR(3);FLIP_TEXTBOXES(3);' onKeyDown='FLIP_TEXTBOXES(3);'></td>
    </tr>
</table>                
             <SCRIPT>
FLIP_TEXTBOXES(0);
FLIP_TEXTBOXES(1);
FLIP_TEXTBOXES(2);
FLIP_TEXTBOXES(3);
/*             var E = document.getElementById("0");
             if(E.value=="... optional ...") E.style.fontSize = "20px"; 
             var E = document.getElementById("1");
             if(E.value=="... optional ...") E.style.fontSize = "20px"; 
             var E = document.getElementById("2");
             if(E.value=="... optional ...") E.style.fontSize = "20px"; 
             var E = document.getElementById("3");
             if(E.value=="... optional ...") E.style.fontSize = "20px"; */

             </SCRIPT>   
                
            </td></tr>


            <tr><td ></td><td></td></tr>


<tr><td colspan=2 align="center">



<table bgcolor="#00802b" class="textfield round" cellpadding=10 cellspacing=10 width=600>
    <tr>
<td></td>
<!--
<td>Gender</td><td align="center">
<input type="checkbox" name='gender[]' value="male"> Male &nbsp; &nbsp; &nbsp;<input type="checkbox" name='gender[]' value="female"> Female</td>
-->
    </tr>
</table>



</td></tr>


            </table>
                    
            </TD>
        </TR>

</table>


</TD></tr><tr><TD VALIGN="top"> <!-- SIDE BY SIDE TABLING -->

<!-- START OF PROSPECTIVES -->

<TABLE  cellspacing=10>

<tr>
    <td class="title" align="center">
        <div style="font-size :50px;">Students</div>
        <div style="font-size :20px;">( relatives and/or students you are representing )</div>
    </td>
</tr>


<tr><td>


<table ><tr><td width=35></td><td>
<table padding=10 cellspacing=0 >
<?php

    $buf="";
    $c1=$PROSPLIMIT;
    for($a1=0;$a1<$c1;$a1++)
    {
        $buf .= '
<!----------------------------------------------------->
<tr id="row'.$a1.'"><td align="center">

<table  cellpadding=10 cellspacing=10 width=600 bgcolor="#00802b" class="round" ><td>
    <table class="textfield" cellpadding=10 cellspacing=10>
    <tr><td>
    Name: </td><td><input type="text" name="Prospective'.$a1.'"></td>
    </td></tr>
    <tr><td align="left" colspan=2>
        <table class="textfield" cellspacing=0 cellpadding=0><tr>
            <td>Gender:</td><td width=20></td><td width=205 align="left" >M <input type="checkbox" name="GenderM'.$a1.'"> F <input type="checkbox" name="GenderF'.$a1.'"></td>
            <td>Age:</td><td width=20></td>
            <td><input type="text" style="width:100px;" name="Age'.$a1.'"></td>
            </tr>
        </table>
    </td></tr>
    <tr><td>Email:</td><td><input type="text" name="propemail'.$a1.'"></td></tr>
    </table>
</td></table>
    
</td></tr>
<!----------------------------------------------------->
';
    }
    echo $buf;
?>
</table>
</td><td width=35 valign="bottom" align="right">
<table cellpadding=0 cellspacing=0>
<tr><td>
<input type="button" class="btn_sm" value="-" id="hidebutton" style="width:30px;">
</td></tr>
<tr><td height=10></td></tr>
<tr><td>
<input type="button" class="btn_sm" value="+" id="showbutton" style="width:30px;">
</td></tr>
</table>
</td></tr></table>


</td></tr>

    <tr><td align="right">

<tr><td>&nbsp;</td></tr>

<TR>
    <TD colspan=2 align="center">
        <input type="hidden" value="visitor2" name="visitor2">
        <input type="submit" value="continue">
    </TD>
</TR>

<tr><td>&nbsp;</td></tr>


</TABLE>

</TD></TR></TABLE> <!-- SIDE BY SIDE TABLING -->

</form>

<SCRIPT>
    for(var a=1; a<=upper;a++)
        $("#row"+a).hide();
</SCRIPT>


</BODY>



