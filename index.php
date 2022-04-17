<?php 

require("Controller/controller.php");

if(isset($_GET['location']))
{
    switch($_GET['location'])
    {
        case $_GET['location'] == "homePage":
            homePage();
            break;
        
        case $_GET['location'] == "login":
            login();
            break;

        case $_GET['location'] == "signUp":
            signUp();
            break;

        case $_GET['location'] == "signUpCheck":
            //$info= inscriptionMember($_POST['gender'], $_POST['firstName'], $_POST['lastName'], $_POST['birthday'], $_POST['picture'], $_POST['email'], $_POST['username'], $_POST['password']);
            signUpCheck();
            break;
        
        case $_GET['location'] == "loginCheck":
            loginCheck();
            break;
        
        case $_GET['location'] == "logout":
            logout();
            break;
        
        case $_GET['location'] == "adminHome":
            if(isset($_SESSION['admin_username']))
            {
                adminHome();
            }
            else
                homePage();
            break;

        case $_GET['location'] == "allMembers":
            if(isset($_SESSION['admin_username']))
            {
                members();
            }
            else
                homePage();
            break;

        case $_GET['location']== "contactUs":
            contactUs();
            break;

        case $_GET['location'] == "contactCheck":
            contactCheck();
            break;

        case $_GET['location']== "signal":
            signal();
            break;

        default:
            homePage();
            break;
            
    }
}
else
{
    homePage();
}



