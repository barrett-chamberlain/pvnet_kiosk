<?
if(isset($_POST["data"]))
{
    var_dump($_POST);
}

?>


<head>
    <style>
input[type="checkbox"] {
    position: absolute;
    left: 100px/*-9999px*/;
}
input[type="checkbox"] + label {
      width:187px;
    height:161px;
        color: #FFFFFF;
        text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 30px;
        background: url(https://back-office-pvnet.c9users.io/KIOSK/IMG/00%20Drones.jpg) 0 0 no-repeat;
}
input[type="checkbox"]:checked + label {
    background-position: 0 100px; /*-32px*;
}

.lbl
{
    width:187px;
    height:161px;
}

    </style>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<input type="checkbox" id="checkbox-id" name="data" /> 
<input type="submit">
</FORM>
</div>
</body>

