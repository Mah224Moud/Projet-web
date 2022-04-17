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
            
        default:
            homePage();
            break;
            
    }
}
else
{
    homePage();
}



