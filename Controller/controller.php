<?php
require("Model/model.php");

function homePage()
{

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
                        $done= true;
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
                        $done= true;
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
                    $done= true;
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

function test()
{
    $test= $_FILES['picture']['name'];

    if($test == "" )
        $v = "vide";
    else
        $v= "non";
    //$test= "test";
    require('View/signup.php');
}