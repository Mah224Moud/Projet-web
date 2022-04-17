<?php

function dataBaseConnexion()
{
    try
    {
        $data_base= new PDO('mysql:host=localhost;dbname=WebProject;charset=utf8', 'root', 'root');

        return $data_base;
    }
    catch(Exception $e)
    {
        die("Erreur : ".$e->getMessage());
    }
}


function inscriptionMember($gender, $fisrtName, $lastName, $birthday, $pic, $email, $username, $password)
{
    $data_base= dataBaseConnexion();
    $inscription= $data_base->prepare("INSERT INTO members (gender, firstName, lastName, birthday, picture, email, username, password_) VALUES(?, ?, ?, ?, ?, ?, ?, ?) ");
    $inscription->execute([$gender, $fisrtName, $lastName, $birthday, $pic, $email, $username, $password]);

    return $inscription;
}



function emailCheck($email)
{
    $data_base= dataBaseConnexion();
    $mail= $data_base->prepare("SELECT email, password_ FROM members WHERE email= ?");
    $mail->execute([$email]);

    $email= $mail->fetch();

    return $email;
}


function usernameCheck($username)
{
    $data_base= dataBaseConnexion();
    $user= $data_base->prepare("SELECT username FROM members WHERE username=? ");
    $user->execute([$username]);

    $username= $user->fetch();

    return $username;
}



function logCheck($email, $password)
{
    $data_base= dataBaseConnexion();

    $passwords= $data_base->prepare("SELECT email, password_ FROM members WHERE email=? AND password_=? ");
    $passwords->execute([$email, $password]);

    return $passwords;
}


function loginMember($email, $password)
{
    $data_base= dataBaseConnexion();
    $search= $data_base->prepare("SELECT email, password_ FROM members WHERE email=? AND password_=?");
    $search->execute([$email, $password]);

    $information= $search->fetch();

    return $information;
}

function sessionMember($email)
{
    $data_base= dataBaseConnexion();

    $session= $data_base->prepare("SELECT * FROM members WHERE email=?");
    $session->execute([$email]);

    $getSession= $session->fetch();

    return $getSession;
}
