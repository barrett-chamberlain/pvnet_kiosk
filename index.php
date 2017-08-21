<?php
include('_lib.php');
include('./_includes/connect.php');
session_start();

// session_unset();
// echo '<pre>';
// echo '==============' . '<br />';
// echo 'SESSION' . '<br />';
// echo '==============' . '<br />';
// var_dump($_SESSION);
// echo '==============' . '<br />';
// echo 'POST' . '<br />';
// echo '==============' . '<br />';
// var_dump($_POST);
// echo 'session email: ' . $_SESSION['email'];
// echo '</pre>';
if(isset($_POST["student"]))
{
    /*$_SESSION["classn"] = $_POST["CLASSN"];*/
//    echo "confirm.php";
    include "confirm.php";
    dump();
    clearSession();
    die();
}

if(isset($_POST["sponsor"]))
{
    postToSession();
//    echo "sponsor.php";
    include "sponsor.php";
    dump();
    die();
}

/*
if(isset($_POST["visitor"]))
{
    postToSession();
    //$_SESSION["interests"] = $_POST["box"];
//    echo "contact.php";
    include "contact.php";
    dump();
    die();
}
*/

if(isset($_POST["visitor"]))
{
    postToSession();
    //$_SESSION["interests"] = $_POST["box"];
//    echo "contact.php";
    include "contact.1.php";
    dump();
    die();
}

if(isset($_POST['visitor2']))
{
    postToSession();
    include "notes.php";
    dump();
    die();
    
}

if(isset($_POST["notes"]))  // CONTACT PAGE PROCESSING
{
    postToSession();
    insertRecord($conn,_session);
    // sendMail($_SESSION['email'], 'Thank you for registering', 'admin@pvnet.com');
    include "visitorthankyou.php";
    dump();
    clearSession();
    die();
}

/*
if(isset($_POST["visitor2"]))  // CONTACT PAGE PROCESSING
{
    postToSession();
    //$_SESSION["interests"] = $_POST["box"];
//    echo "visitorthankyou.php";
    include "visitorthankyou.php";
    dump();
    clearSession();
    die();
}
*/

if(isset($_POST["logoutlist"]))
{
//    echo "present.php";
    include "present.php";
    dump();
    die();
    
}

if(isset($_POST["logout"]))
{
//    echo "thankyou.php";
    include "thankyou.php";
    dump();
    die();
    
}
  
if(isset($_POST["top"]))
{
    
    if(!is_array($_POST["CTG"]))
    {
        echo '
<HEAD>
    <LINK REL="stylesheet" TYPE="text/css" HREF="Style.css">
</HEAD>
<BODY>
<table class="textfield center">
<tr><td class="title" style="font-size:30px;">Form Submission Error:</td></tr>
<tr><td></td></tr>
<tr><td>Incomplete Form Information.<br>
Please select a category: (Visitor, Intern, Student and/or Volunteer)</td></tr>
</table>
</BODY>
';
        die();
    }

    
    
/*    $_SESSION["fname"] = $_POST["FNAME"];
    $_SESSION["lname"] = $_POST["LNAME"];
    $_SESSION["as"] = arToStr($_POST["CTG"],"|");
*/
    $_SESSION["intime"] = time();
    
    if(in_array("s",$_POST["CTG"])||in_array("hs",$_POST["CTG"]))
    {
        $destn = 's';
    }
    else
    {
        if(in_array("vs",$_POST["CTG"]))
        {
            $destn = 'vs';
        }
        else
        {
            $destn = 'd';
        }
    }
    
    
    switch($destn)
    {
        case("s"):
            postToSession();
//            echo "student.php";
            include "student.php";
            dump();
            break;

            
        case("vs"):
            postToSession();
//            echo "visitor.php";
            include "visitor.php";
            dump();
            break;
        
        default:
            postToSession();
//            echo "confirm.php";
            include "confirm.php";
            dump();
            clearSession();

    }
    die();
}
//echo "top.php";
include "top.php";
dump();

?>

