
<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
<style>
    .imgtable
    {
        border-style: solid;
        border-width: 1px;
        border-radius: 10px;
        box-shadow: 2px 2px 1px #888888;
        background-color:  #1e8449;

    }
    .imglabel
    {

        color: #ffffff;
        text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 30px;

        opacity: 0; filter: alpha(opacity=0); 
    }
</style>

<script>
var clicked = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

var images = ["IMG/00 Drones.jpg",
"IMG/01 Robotics.jpg",
"IMG/02 Vex IQ.jpg",
"IMG/03 Engineering.jpg",
"IMG/04 3D Printing.jpg",
"IMG/06 Game Design.jpg",
"IMG/07 Unity.jpg",
"IMG/08 Unreal Engine.jpg",
"IMG/09 Vive.jpg",
"IMG/10 Oculus.jpg",
"IMG/11 Minecraft.jpg",
"IMG/12 Java.jpg",
"IMG/13 C++.jpg",
"IMG/14 Web Design.jpg",
"IMG/15 Photoshop.jpg",
"IMG/16 3D Modeling & Animation.jpg",
"IMG/17 Photography.jpg",
"IMG/18 Video Production.jpg",
"",
"",
"IMG/21 Tinker Camp.jpg",
"",
"IMG/19 Volunteering.jpg",
"IMG/20 Donation.jpg",
];

function htn(num)
{
    if(clicked[num]!=1)
    {
        table = document.getElementById("table"+num);
        label = document.getElementById("label"+num);
        label.style.opacity=1;
        table.setAttribute('background','');
    }
}
function htf(num)
{
    if(clicked[num]!=1)
    {
        table = document.getElementById("table"+num);
        label = document.getElementById("label"+num);
        label.style.opacity=0;
        table.setAttribute('background',images[num]);
    }
}
function hc(num)
{
    table = document.getElementById("table"+num);
    label = document.getElementById("label"+num);
    box = document.getElementById("box"+num);
    if(clicked[num]==1)
    {
        label.style.opacity=0;
        table.setAttribute('background',images[num]);
        clicked[num]=0;
        box.checked=false;
    }
    else
    {
        label.style.opacity=1;
        table.setAttribute('background','');
        clicked[num]=1;
        box.checked=true;
    }
}

</script>



</HEAD>

<BODY>
<center>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <INPUT type="hidden" name="visitor">
    <TABLE class="" cellpadding=10 >
        <TR>
            <TD class="title" colspan=2 align='center'>
                <DIV>Areas of Interests</DIV>
            </TD>
        </TR>
        <TR>
            <TD colspan=2 class="textfield" align="center">
                <i>( please check all that apply )</i>
            </TD>
        </TR>
        <TR>
            <TD colspan=2>

            </TD>
        </TR>
        <TR>
            <TD colspan=2 align="center">

<!-- saved from url=(0058)https://studentdatabase-peijaychao.c9users.io/CHECKINGRID/ -->
<?php
$images = array(
array("./IMG/00 Drones.jpg","Drones"),
array("./IMG/01 Robotics.jpg","Robotics"),
array("./IMG/02 Vex IQ.jpg","Vex IQ"),
array("./IMG/03 Engineering.jpg","Engineering"),
array("./IMG/04 3D Printing.jpg","3D Printing"),
array("./IMG/06 Game Design.jpg","Game Design"),
array("./IMG/07 Unity.jpg","Unity"),
array("./IMG/08 Unreal Engine.jpg","Unreal Engine"),
array("./IMG/09 Vive.jpg","Vive"),
array("./IMG/10 Oculus.jpg","Oculus"),
array("./IMG/11 Minecraft.jpg","Minecraft"),
array("./IMG/12 Java.jpg","Java"),
array("./IMG/13 C++.jpg","C++"),
array("./IMG/14 Web Design.jpg","Web Design"),
array("./IMG/15 Photoshop.jpg","Photoshop"),
array("./IMG/16 3D Modeling &amp; Animation.jpg","3D Modeling &amp; Animation"),
array("./IMG/17 Photography.jpg","Photography"),
array("./IMG/18 Video Production.jpg","Video Production"),
array("",""),
array("",""),
array("./IMG/21 Tinker Camp.jpg","Tinker Camp"),
array("",""),
array("./IMG/19 Volunteering.jpg","Volunteering"),
array("./IMG/20 Donation.jpg","Donation")
);

$html = "<TABLE><TR>";
$l = count($images);
$c=0;
for($a=0;$a<$l;$a++)
{
    $html .= "<TD>
    <TABLE width=187 height=161 class='imgtable' id='table".$a."' background='".$images[$a][0]."'
ONMOUSEOVER='htn(".$a.");' ONMOUSEOUT='htf(".$a.");' ONCLICK='hc(".$a.")'>
        <TD align='center'>
            <DIV class='imglabel' id='label".$a."'>".$images[$a][1]."</DIV>
        </TD>
    </TABLE>
</TD>";
    if($c==3)
    {
        $html .="</TR><TR>";
        $c=0;
    }
    else {
        $c++;
    }
}
$html .= "</TR></TABLE>";
echo $html;

$html = "";
$l = count($images);
for($a=0;$a<$l;$a++)
{
    $html .="<input type='checkbox' name='box[]' id=box".$a." value=".$a." hidden>";
}
echo $html;
?>
                
            </TD>
        </TR>
        <TR><TD class="textfield">
            <center>
            My company would like to be a sponsor <INPUT type="checkbox" value="sponsor" name="sponsor">
            </center>
        </TD></TR>
        
        <TR><TD COLSPAN="2" align="center">
            <input type="submit" value="Continue">
            
        </TD></TR>
    </TABLE>
</form>

</BODY>