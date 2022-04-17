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

function allMembers()
{
    $data_base= dataBaseConnexion();

    $members= $data_base->query('SELECT id, username, firstName, lastName, picture, DATE_FORMAT(inscription_date, \'%d %b %Y\') AS date_ FROM members');
    $members->execute();

    return $members;
}


function insertMessage($fisrtName, $lastName, $email, $username, $message)
{
    $data_base= dataBaseConnexion();

    $insertMessage= $data_base->prepare("INSERT INTO messages(firstName, lastName, email, username, messages) VALUES (?, ?, ?, ?, ?) ");
    $insertMessage->execute([$fisrtName, $lastName, $email, $username, $message]);

    return $insertMessage;
}


function allMessages()
{
    $data_base= dataBaseConnexion();

    $message= $data_base->query('SELECT id, username, email, status_, firstName, lastName, messages , DATE_FORMAT(message_date, \'%d %b %Y à %Hh:%imin\') AS date_ FROM messages');
    $message->execute();

    return $message;
}