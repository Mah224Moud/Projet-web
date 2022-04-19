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

        case $_GET['location'] == "addUser":
            $password= password_hash("default", PASSWORD_DEFAULT);
            $age= "2000-01-01";
            $gender= "default";
            $pic= "./Public/Image/unknow.png";

            $inscriptionMember= inscriptionMember($gender, $_GET['firstName'], $_GET['lastName'], $age, $pic, $_GET['email'], $_GET['username'], $password); 

            addUser($inscriptionMember);
            break;

        case $_GET['location'] == "signalUpate":
            signalUpdate($_GET['idSignal']);
            break;

        case $_GET['location'] == "memberDelete":
           memberDelete($_GET['idUser']);


        case $_GET['location'] == "messageDelete":
            messageDelete($_GET['idMessage']);
            break;
            

        case $_GET['location'] == "forum":
            forum();
            break;

        case $_GET['location'] == "questions":
            questions();
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



