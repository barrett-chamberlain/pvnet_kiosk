<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">

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
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <INPUT type="hidden" name="top">
    <TABLE class="center" cellspacing=10>
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


            <table class="textfield" cellpadding=0 cellspacing=10>

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
<!--        <td>Gender</td><td align="center">
        <input type="checkbox" name='gender[]' value="male"> Male &nbsp; &nbsp; &nbsp;<input type="checkbox" name='gender[]' value="female"> Female</td>
-->
    </tr>
</table>



</td></tr>


            </table>
                    
            </TD>
        </TR>
        <TR>
            <TD colspan=2 align="center">
                <input type="hidden" value="visitor2" name="visitor2">
                <input type="submit" value="continue">
            </TD>
        </TR>
    </TABLE>
</form>


</BODY>



