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

        case $_GET['location'] == "comment":
            if(isset($_GET['idQuestion']) && $_GET['idQuestion']>0)
                question($_GET['idQuestion']);
            else
                forum();
            break;
            
        case $_GET['location'] == "publishComment":
            if(isset($_GET['idQuestion']) && $_GET['idQuestion']>0)
                publishComment($_GET['idQuestion'], $_GET['idUser']);
            break;

        case $_GET['location'] == "profile":
            profile();
            break;

        case $_GET['location'] == "deleteQuestion":
            if(isset($_GET['idQuestion']) && $_GET['idQuestion']>0)
                deletedQuestion($_GET['idQuestion']);
            break;


        case $_GET['location'] == "deleteComment":
            if(isset($_GET['idComment']) && $_GET['idComment']>0)
                deletedComment($_GET['idComment'], $_GET['idQuestion']);
            break;


        case $_GET['location'] == "adminForum":
            adminForum();
            break;


        case $_GET['location'] == "deleteQuestionByAdmin":
            if(isset($_GET['idQuestion']) && $_GET['idQuestion']>0)
                deletedQuestionByAdmin($_GET['idQuestion']);
            break;


        case $_GET['location'] == "adminComment":
            if(isset($_GET['idQuestion']) && $_GET['idQuestion']>0)
                questionAdminSide($_GET['idQuestion']);
            else
                adminForum();
            break;


        case $_GET['location'] == "deleteCommentByAdmin":
            if(isset($_GET['idComment']) && $_GET['idComment']>0)
            deletedCommentByAdmin($_GET['idComment'], $_GET['idQuestion']);
            break;

        case $_GET['location'] == "modify":
            modify();
            break;

        case $_GET['location'] == 'updated':
            applyModification();
            break;

        case $_GET['location'] == 'cours':
            cours();
            break;

        case $_GET['location'] == 'leCours':
            lessons($_GET['idCours']);
            break;

        case $_GET['location'] == 'adminCourses':
            if(isset($_SESSION['admin_username']))
                adminCourses();
            else
                homePage();
            break;

        case $_GET['location'] == 'disableCours':
            if(isset($_SESSION['admin_username'])){
                if(isset($_GET['idCours']) && $_GET['idCours']>0)
                    disableCours($_GET['idCours']);
            }else
                homePage();
            break;

        case $_GET['location'] == 'ableCours':
            if(isset($_SESSION['admin_username'])){
                if(isset($_GET['idCours']) && $_GET['idCours']>0)
                    ableCours($_GET['idCours']);
            }else
                homePage();
            break;

        case $_GET['location'] == 'deleteCours':
            if(isset($_SESSION['admin_username'])){
                if(isset($_GET['idCours']) && $_GET['idCours']>0)
                    deleteCours($_GET['idCours']);
            }else
                homePage();
            break;
        
        case $_GET['location'] == 'addCours':
            if(isset($_SESSION['admin_username'])){
                addCours();
            }else
                homePage();
            break;
        
        case $_GET['location'] == 'addingCours':
            if(isset($_SESSION['admin_username'])){
                addingCours();
                }else
                homePage();
            break;

        case $_GET['location'] == 'modifyCours':
            if(isset($_SESSION['admin_username'])){
                modifyCours($_GET['idCours']);
            }else
                homePage();
            break;

        case $_GET['location'] == 'modifyingCours':
            if(isset($_SESSION['admin_username'])){
                modifyingCours($_GET['idCours']);
            }else
                homePage();
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



