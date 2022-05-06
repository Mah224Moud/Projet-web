<?php
session_start();

require("Model/model.php");

global $session;


function homePage()
{
    autoConnexion();
    require('View/home.php');
}


function login()
{
    require('View/login.php');
}


function signUp()
{
    require('View/signup.php');
}


function signUpCheck()
{
    $emailCheck= emailCheck($_POST['email']);
    $usernameCheck= usernameCheck($_POST['username']);

    $errors= [];


    //case vide
    if(empty($_POST['gender']))
    {
        $errors['gender']= "Merci de presicer la civilité";
    }
    if(empty($_POST['firstName']))
    {
        $errors['firstName']= "Le nom est obligatoire";
    }
    if(empty($_POST['lastName']))
    {
        $errors['lastName']= "Le prénom est obligatoire";
    }
    if(empty($_POST['birthday']))
    {
        $errors['birthday']= "La date de naissance est obligatoire";
    }
    if(empty($_POST['email']))
    {
        $errors['email']= "L'email est obligatoire";
    }
    else
    {
        $valid_email= "[a-z][a-z0-9]+@[a-z]+\.[a-z]+";
        if(!preg_match("#$valid_email#", $_POST['email']))
        {
            $errors['email']= "Attention !!! Adresse mail invalide";
        }
    }
    if(empty($_POST['username']))
    {
        $errors['username']= "Le pseudo est obligatoire";
    }
    if(empty($_POST['password']))
    {
        $errors['password']= "Le mot de passe est obligatoire";
    }
    if(empty($_POST['confirmPassword']))
    {
        $errors['confirmPassword']= "Veuillez confirmer votre mot de passe";
    }



    //verif supplémentaire
    if($_POST['confirmPassword'] != $_POST['password'])
    {
        $errors['differentsPassword']= "Les deux mots de passe sont differents";
    }
    if ($_FILES['picture']['name']!="" && $_FILES['picture']['size']==0)
    {
        $errors['picture_size']= "Fichier volumineux. Recommendation <= 2Mb";
    }
    if($_FILES['picture']['name']!="")
    {
        $picture= $_FILES['picture']['name'];
        $picExtension= new SplFileInfo($picture);
        $getPicExtension= $picExtension->getExtension();

        $possibleExtension= ['jpeg', 'jpg', 'png'];

        if(!in_array($getPicExtension, $possibleExtension))
            $errors['picture_extension']= "Les fomats autorisés: 'jpeg' 'jpg' 'png'";
    }
    


    //info existante
    if($emailCheck)
    {
        $errors['existed_mail']= "Cette addresse mail existe déjà";
    }
    if($usernameCheck)
    {
        $errors['existed_username']= "Ce pseudo existe déjà veuillez choisir un autre";
    }



    if( ($emailCheck === false) and ($usernameCheck ===false) )
    {
        if(empty($errors))
        {
            if($_FILES['picture']['name'] == "")
            {
                if($_POST['gender'] == "Mr")
                {
                    $pic= "./Public/Image/homme.jpg";
                    $password= password_hash($_POST['password'],  PASSWORD_DEFAULT);

                    $registrement= inscriptionMember($_POST['gender'], $_POST['firstName'], $_POST['lastName'], $_POST['birthday'], $pic, $_POST['email'], $_POST['username'], $password);

                    if ($registrement===false)
                        $checked= "Il y'a eu une erreur lors de la création du compte";
                    else
                    {
                        $checked= "Votre compte a été crée avec succes";
                        $createdAcount= true;
                    }
                }
                else
                {
                    $pic= "./Public/Image/femme.jpeg";
                    $password= password_hash($_POST['password'],  PASSWORD_DEFAULT);

                    $registrement= inscriptionMember($_POST['gender'], $_POST['firstName'], $_POST['lastName'], $_POST['birthday'], $pic, $_POST['email'], $_POST['username'], $password);

                    if ($registrement===false)
                        $checked= "Il y'a eu une erreur lors de la création du compte";
                    else
                    {
                        $checked= "Votre compte a été crée avec succes";
                        $createdAcount= true;
                    }
                }
            }
            else
            {
                $pic= "./Public/Image/".$_FILES['picture']['name'];
                $password= password_hash($_POST['password'],  PASSWORD_DEFAULT);

                $from= $_FILES['picture']['tmp_name'];
                $destination= "./Public/Image/".$_FILES['picture']['name'];
                move_uploaded_file($from, $destination);

                $registrement= inscriptionMember($_POST['gender'], $_POST['firstName'], $_POST['lastName'], $_POST['birthday'], $pic, $_POST['email'], $_POST['username'], $password);

                if ($registrement===false)
                    $checked= "Il y'a eu une erreur lors de la création du compte";
                else
                {
                    $checked= "Votre compte a été crée avec succes";
                    $createdAcount= true;
                }
                    
            }

        }
    }
    
    require('View/signup.php');
}


function loginCheck()
{
    $errors= [];

    if(empty($_POST['password']))
    {
        $errors['password']= "Le mot de passe est obligatiore";
    }
    if(empty($_POST['email']))
    {
        $errors['email']= "L'email est obligatoire";
    }
    else
    {
        $valid_email= "[a-z][a-z0-9]+@[a-z]+\.[a-z]+";
        if(!preg_match("#$valid_email#", $_POST['email']))
        {
            $errors['email']= "Attention !!! Adresse mail invalide";
        }
    }
    


    if(empty($errors))
    {
        $valid_email= "[a-z][a-z0-9]+@[a-z]+\.[a-z]+";
        if(!preg_match("#$valid_email#", $_POST['email']))
        {
            $errors['email']= "Attention !!! Adresse mail invalide";
        }
        else
        {
            $login= emailCheck($_POST['email']);
            if($login)
            {
                if($_POST['email']== $login['email'] && password_verify($_POST['password'], $login['password_']) )
                {
                    $connectedEmail= $login['email'];
                    $session= sessionMember($connectedEmail);

                    //Creation session
                    $_SESSION['connected']= $session;

                    $_SESSION['username']= $session['username'];
                    $_SESSION['picture']= $session['picture'];
                    $_SESSION['firstName']= $session['firstName'];
                    $_SESSION['lastName']= $session['lastName'];
                    $_SESSION['email']= $session['email'];
                    $_SESSION['id']= $session['id'];
                    $_SESSION['birthday']= $session['birthday_'];
                    $_SESSION['inscription_date']= $session['date_'];
                    $_SESSION['level']= $session['level_'];
                    $_SESSION['status']= $session['status_'];


                    //Creation cookie
                    setcookie("email", $_SESSION['email'], [
                        'expires' => time() + 365*24*3600,
                        'secure' => true,
                        'httponly' => true,
                    ]);

                    if($session['username'] == "admin")
                    {
                        $_SESSION['admin_username']= $session['username'];
                        header("Location: index.php?location=adminHome");
                    }
                    else
                    {
                        header("Location: index.php?location=homePage");
                    }
                }
                else
                {
                    $errors['password']= "Mot de passe incorrect";
                }  
            }
            else
            {
                $errors['not_existed_mail']= "Adresse mail inexistante";
            }
        }    
    }   
    require('View/login.php');
}


function logout()
{

    session_destroy();
    setcookie('email');
    $logout= true;
    require("View/home.php");
}


function adminHome()
{   
    require('View/adminHome.php');
}


function members()
{
    $members= allMembers();
    $total= totalMembers();
    require('View/members.php');
}


function contactUs()
{
    require('View/contactUs.php');
}


function contactCheck()
{
    $errors= [];
    if(isset($_SESSION['connected']))
    {
        if(empty($_POST['message']))
        {
            $errors['message']= "Vous n'avez écrit aucun message";
        }
        if(empty($errors))
        {
            $message= nl2br(htmlspecialchars($_POST['message']));
            $insert= insertMessage($_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['email'], $_SESSION['username'], $message);
            if($insert === false)
            {
                $notSend= "Votre message n'a pas été envoyé";
            }
            else
            {
                $isSend= "Votre message a été envoyé";
            }
        }
    }
    else
    {
        if(empty($_POST['firstName']))
        {
            $errors['firstName']= "Le nom est obligatoire";
        }
        if(empty($_POST['lastName']))
        {
            $errors['lastName']= "Le prénom est obligatoire";
        }
        if(empty($_POST['email']))
        {
            $errors['email']= "L'email est obligatoire";
        }
        else
        {
            $valid_email= "[a-z][a-z0-9]+@[a-z]+\.[a-z]+";
            if(!preg_match("#$valid_email#", $_POST['email']))
            {
                $errors['email']= "Attention !!! Adresse mail invalide";
            }
        }
        if(empty($_POST['message']))
        {
            $errors['message']= "Vous n'avez écrit aucun message";
        }
        if(empty($_POST['username']))
        {
            $errors['username']= "Le pseudo est obligatoire";
        }

        if(empty($errors))
        {
            $message= nl2br(htmlspecialchars($_POST['message']));
            $insert= insertMessage($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['username'], $message);

            if($insert === false)
            {
                $notSend= "Votre message n'a pas été envoyé";
            }
            else
            {
                $isSend= "Votre message a été envoyé";
            }
        }
    }

    require('View/contactUs.php');
}


function signal()
{
    $signal= allMessages();
    $members= allMembers();
    $emails= [];
    foreach($members as $member)
    {
        array_push($emails, $member['email']);
    }
    
    $total= totalMessage();
    require('View/signal.php');
}


function addUser($status)
{
    if ($status===false)
        $report= "Il y'a eu une erreur lors de la création du compte";
    else
    {
        $report= "Compte créer avec succes";
    }
    require('View/addUser.php');
}


function signalUpdate($id)
{
    $signalStatus= signalStatus($id);

    $confirm= "Problème résolu";
    require('View/signal.php');
    //header("Location: index.php?location=signal");
}


function memberDelete($id)
{
    $signalStatus= deleteMember($id);

    $confirm= "Utilisateur supprimer";
    require('View/members.php');
}


function messageDelete($id)
{
    $signalStatus= deleteMessage($id);

    $deleteMessage= "Vous avez supprimer un message";
    require('View/signal.php');
}


function forum()
{
    $questions= allQuestions();
    $total= totalQuestions();
    require('View/forum.php');
}


function questions()
{
    $errors= [];
    if(empty($_POST['title']))
    {
        $errors['title']= "Le titre est obligatoire";
    }
    if(empty($_POST['content']))
    {
        $errors['content']= "Le contenu est obligatoire";
    }

    if(empty($errors))
    {
        if(isset($_SESSION['connected']))
        {
            $title= htmlspecialchars($_POST['title']);
            $content= nl2br(htmlspecialchars($_POST['content']));
            $addQuestion= addQuestion($_SESSION['id'], $title, $content);

            if($addQuestion === false)
            {
                $status= "Votre question n'a pas été ajouté";
            }
            else
            {
                $status= "Votre question a été ajouté";
            }
        }
    }
    $questions= allQuestions();
    $total= totalQuestions();
    
    require('View/forum.php');
}


function question($idQuestion)
{
    $question= singleQuestion($idQuestion);

    $allComments = allComments($idQuestion);
    require('View/comment.php');
}


function publishComment($idQuestion, $idUser)
{
    $errors= [];
    if(empty($_POST['content']))
    {
        $errors['content']= "Vous n'avez écrit aucun commentaire";
    }
    else
    {
        $content= nl2br(htmlspecialchars($_POST['content']));
        $addComment = addComment($idQuestion, $idUser, $content);
        if($addComment===false)
        {
            $status= "Votre commentaire n'a pas été ajouté";
        }
        else
            $status= "Votre commentaire a été ajouté";
    }

    $question= singleQuestion($idQuestion);
    $allComments = allComments($idQuestion);
    require('View/comment.php');
}


function profile()
{
    require('View/profile.php');
}


function deletedQuestion($idQuestion)
{
    $deleteQuestion=deleteQuestion($idQuestion);

    if($deleteQuestion === false)
    {
        $statusDeletedQuestion= "Question non supprimé";
    }
    else
        $statusDeletedQuestion= "Question supprimé";

    require('View/forum.php');
}


function deletedComment($idComment, $idQuestion)
{
    $deleteComment=deleteComment($idComment);

    if($deleteComment === false)
    {
        $statusDeletedComment= "Commentaire non supprimé";
        $id= $idQuestion;
    }
    else
    {
        $statusDeletedComment= "Commentaire supprimé";
        $id= $idQuestion;
    }

    require('View/comment.php');
}


function adminForum()
{
    $questions= allQuestions();
    $total= totalQuestions();
    require('View/adminForum.php');
}


function deletedQuestionByAdmin($idQuestion)
{
    $deleteQuestion=deleteQuestion($idQuestion);

    if($deleteQuestion === false)
    {
        $statusDeletedQuestion= "Question non supprimé";
    }
    else
        $statusDeletedQuestion= "Question supprimé par admin";

    require('View/adminForum.php');
}


function questionAdminSide($idQuestion)
{
    $question= singleQuestion($idQuestion);

    $allComments = allComments($idQuestion);
    require('View/adminComment.php');
}


function deletedCommentByAdmin($idComment, $idQuestion)
{
    $deleteComment=deleteComment($idComment);

    if($deleteComment === false)
    {
        $statusDeletedComment= "Commentaire non supprimé";
        $id= $idQuestion;
    }
    else
    {
        $statusDeletedComment= "Commentaire supprimé par admin";
        $id= $idQuestion;
    }

    require('View/adminComment.php');
}


function modify()
{
    require('View/modifyProfile.php');
}


function applyModification()
{
    if(isset($_SESSION['connected']))
    {
        $errors= [];

        if ($_FILES['picture']['name']!="" && $_FILES['picture']['size']==0)
        {
            $errors['picture_size']= "Fichier volumineux. Recommendation <= 2Mb";
        }
        if($_FILES['picture']['name']!="")
        {
            $picture= $_FILES['picture']['name'];
            $picExtension= new SplFileInfo($picture);
            $getPicExtension= $picExtension->getExtension();

            $possibleExtension= ['jpeg', 'jpg', 'png', 'JPG', 'JPEG', 'PNG'];

            if(!in_array($getPicExtension, $possibleExtension))
                $errors['picture_extension']= "Les fomats autorisés: 'jpeg' 'jpg' 'png'";
        }


        if(empty($errors))
        {
            if(isset($_POST['firstName']) && (!empty($_POST['firstName'])))
            {
                $firstName= $_POST['firstName'];
                $update= updateFirstName($firstName, $_SESSION['id']);
                $updated= "Modification effectuer avec succes";
            }
            if(isset($_POST['lastName']) && (!empty($_POST['lastName'])))
            {
                $lastName= $_POST['lastName'];
                $update= updateLastName($lastName, $_SESSION['id']);
                $updated= "Modification effectuer avec succes";
            }
            if(isset($_POST['password']) && (!empty($_POST['password'])))
            {
                $password= password_hash($_POST['password'],  PASSWORD_DEFAULT);
                $update= updatePassword($password, $_SESSION['id']);
                $updated= "Modification effectuer avec succes";
            }

            if(isset($_FILES) && $_FILES['picture']['name'] != "")
            {
                $picture= "./Public/Image/".$_FILES['picture']['name'];
                $from= $_FILES['picture']['tmp_name'];

                move_uploaded_file($from, $picture);

                $update= updatePicture($picture, $_SESSION['id']);
                $updated= "Modification effectuer avec succes";
            }

            $connectedEmail= $_SESSION['email'];
            $session= sessionMember($connectedEmail);
            //Creation session
            $_SESSION['connected']= $session;
            $_SESSION['picture']= $session['picture'];
            $_SESSION['firstName']= $session['firstName'];
            $_SESSION['lastName']= $session['lastName'];
        }
        


        
    }

    require('View/modifyProfile.php');
}

function cours(){
    if(isset($_SESSION['connected']))
    {

        $suggest = suggestion($_SESSION['level']);
    }
        
    $cours = allCours();
    require('View/cours.php');
}


function adminCourses()
{
    $cours = allCours();
    require('View/adminCourses.php');
}


function lessons($idcours){
    $leCours = getCours($idcours);
    $lessons = getLessons($idcours);
    require('View/lessons.php');
}

function disableCours($idcours){
    $isDisabled = disableCourse($idcours);
    
    if($isDisabled)
        $confirm = "Cours désactivé";
    else
        $confirm = "Erreur !! cours non désactivé";

    require('View/adminCourses.php');
}

function ableCours($idcours){
    $isAbled = ableCourse($idcours);
    
    if($isAbled)
        $confirm = "Cours activé";
    else
        $confirm = "Erreur !! cours non activé";

    require('View/adminCourses.php');
}

function deleteCours($idcours){
    $isDeleted = deleteCourse($idcours);

    if($isDeleted)
        $confirm = "Cours effacé";
    else
        $confirm = "Erreur !! cours non effacé";

    require('View/adminCourses.php');
}

function addCours(){
    require('View/addCours.php');
}

function addingCours(){
    $title = htmlspecialchars($_POST['title']);
    $descrip = htmlspecialchars($_POST['desc']);
    $source = htmlspecialchars($_POST['source']);
    $level = htmlspecialchars($_POST['niveau']);


    $isAdded = addCourse($title, $descrip, $source, $level);
        if($isAdded)
            $confirm = "Cours ajouté";
        else
            $confirm = "Erreur !! Cours non ajouté";

    require('View/adminCourses.php');
}

function modifyCours($idcours){
    $cours = getCours($idcours);
    $lecours = $cours->fetch();
    require('View/modifyCourses.php');
}

function modifyingCours($idcours){
    $title = htmlspecialchars($_POST['title']);
    $descrip = htmlspecialchars($_POST['desc']);
    $source = htmlspecialchars($_POST['source']);
    $level = htmlspecialchars($_POST['niveau']);
    
    $isModified = modifyCourse($idcours, $title, $descrip, $source, $level);
        if($isModified)
            $confirm = "Cours modifié";
        else
            $confirm = "Erreur !! Cours non modifié";

    require('View/adminCourses.php');
}

function otherProfile($userID)
{
    $member= allMembersByID($userID);
    require('View/otherProfile.php');
}

function adminLessons($idcours){
    $leCours = getCours($idcours);
    $lessons = getLessons($idcours);
    require('View/adminLessons.php');
}

function disableLesson($idCours, $idLesson){
    $isDisabled = disableTheLesson($idLesson);
    
    if($isDisabled)
        $confirm = "Leçon désactivée";
    else
        $confirm = "Erreur !! leçon non désactivée";

    adminLessons($idCours);
}

function ableLesson($idCours, $idLesson){
    $isAbled = ableTheLesson($idLesson);
    
    if($isAbled)
        $confirm = "Leçon désactivée";
    else
        $confirm = "Erreur !! leçon non désactivée";

    adminLessons($idCours);
}

function removeLesson($idCours, $idLesson){
    $isRemoved = removeTheLesson($idLesson);
    
    if($isRemoved)
        $confirm = "Leçon désactivée";
    else
        $confirm = "Erreur !! leçon non désactivée";

    adminLessons($idCours);
}

function addLesson($idCours){
    require('View/addLesson.php');
}

function addingLesson($idcours){

    $title = htmlspecialchars($_POST['title']);
    $descrip = htmlspecialchars($_POST['desc']);

    if($_FILES['fichier']['name'] != ""){
        $from = $_FILES['fichier']['tmp_name'];
        $destination = "./Public/Files/".$_FILES['fichier']['name'];
        move_uploaded_file($from, $destination);
        $fichier = $destination;
    }
    else
        $fichier = "";

    $isAdded  = addingTheLesson($title, $descrip, $fichier, $idcours);
        if($isAdded)
            $confirm = "Leçon ajoutée";
        else
            $confirm = "Erreur !! Leçon non ajoutée";
        
    adminLessons($idcours);
}

function modifyLesson($idCours, $idLesson){
    $lesson = getLesson($idLesson);
    $lalesson = $lesson->fetch();
    require('View/modifyLessons.php');
}

function modifyingLesson($idCours, $idLesson){
    $title = htmlspecialchars($_POST['title']);
    $descrip = htmlspecialchars($_POST['desc']);
    
    if($_FILES['fichier']['name'] != ""){
        $from = $_FILES['fichier']['tmp_name'];
        $destination = "./Public/Files/".$_FILES['fichier']['name'];
        move_uploaded_file($from, $destination);
        $fichier = $destination;
    }
    else
        $fichier = "";

    $isModified = modifyTheLesson($idLesson, $title, $descrip, $fichier);
        if($isModified)
            $confirm = "Cours modifié";
        else
            $confirm = "Erreur !! Cours non modifié";

    adminLessons($idCours);
}


function quiz()
{
    $fichierXml= simplexml_load_file("./Public/Others/fichier.xml");
    $i= 0;
    require('View/quiz.php');
}


function quizCheck()
{
    $errors= [];
    if(empty($_POST["reponse1"]) || empty($_POST["reponse2"]) || empty($_POST["reponse3"]) || empty($_POST["reponse4"]) || empty($_POST["reponse5"]) || empty($_POST["reponse6"]) || empty($_POST["reponse7"]) || empty($_POST["reponse8"]) || empty($_POST["reponse9"]) || empty($_POST["reponse10"]))
    {
        $errors['emptyCase']= "Toutes les cases doivent être remplies";
    }
    else
    {
        $result= 0;
        for($n = 1; $n <=10; $n++)
        {   
            if($_POST["reponse$n"] == "vrai")
            {
                $result+= 10;
            }

        }

        $updateQuiz= updateQuiz($_SESSION['id'], $result);
        $_SESSION['status'] = "answered";
        $_SESSION['level']= $result;
    }
    
    $fichierXml= simplexml_load_file("./Public/Others/fichier.xml");
    $i= 0;
    require('View/quiz.php');
}



function quizResult()
{
    $fichierXml= simplexml_load_file("./Public/Others/fichier.xml");
    $i= 0;
    require('View/quizResult.php');
}



function aboutUs()
{
    require('View/aboutUs.php');
}



function autoConnexion()
{
    if(isset($_COOKIE['email']))
    {
        $session= sessionMember($_COOKIE['email']);
        $_SESSION['connected']= $session;

        $_SESSION['username']= $session['username'];
        $_SESSION['picture']= $session['picture'];
        $_SESSION['firstName']= $session['firstName'];
        $_SESSION['lastName']= $session['lastName'];
        $_SESSION['email']= $session['email'];
        $_SESSION['id']= $session['id'];
        $_SESSION['birthday']= $session['birthday_'];
        $_SESSION['inscription_date']= $session['date_'];
        $_SESSION['status'] = $session['status_'];
        $_SESSION['level'] = $session['level_'];
    }
}