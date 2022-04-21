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

    $session= $data_base->prepare('SELECT id, firstName, lastName, DATE_FORMAT(birthday, \'%d %b %Y\') AS birthday_, email, username, picture, gender, DATE_FORMAT(inscription_date, \'%d %b %Y\') AS date_ FROM members WHERE email=?');
    $session->execute([$email]);

    $getSession= $session->fetch();

    return $getSession;
}

function allMembers()
{
    $data_base= dataBaseConnexion();

    $members= $data_base->query('SELECT id, username, email, firstName, lastName, picture, DATE_FORMAT(inscription_date, \'%d %b %Y\') AS date_ FROM members');
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

    $message= $data_base->query('SELECT id, username, email, status_, firstName, lastName, messages , DATE_FORMAT(message_date, \'%d %b %Y à %Hh:%imin\') AS date_ FROM messages ORDER BY id desc');
    $message->execute();

    return $message;
}


function signalStatus($id)
{
    $data_base= dataBaseConnexion();

    $update= $data_base->prepare("UPDATE messages SET status_= 'verified' WHERE messages.id = ? ");
    $update->execute([$id]);

    return $update;
}


function deleteMember($id)
{
    $data_base= dataBaseConnexion();

    $delete= $data_base->prepare("DELETE FROM members WHERE id = ? ");
    $delete->execute([$id]);

    return $delete;
}


function deleteMessage($id)
{
    $data_base= dataBaseConnexion();

    $delete= $data_base->prepare("DELETE FROM messages WHERE id = ? ");
    $delete->execute([$id]);

    return $delete;
}



function totalMessage()
{
    $data_base= dataBaseConnexion();

    $number= $data_base->prepare("SELECT COUNT(*) AS total FROM messages");
    $number->execute();

    $total= $number->fetch();

    return $total;
}



function totalMembers()
{
    $data_base= dataBaseConnexion();

    $number= $data_base->prepare("SELECT COUNT(*) AS total FROM members");
    $number->execute();

    $total= $number->fetch();

    return $total;
}


function allQuestions()
{
    $data_base= dataBaseConnexion();

    $members= $data_base->query('SELECT questions.id as id, username, content, title, picture, DATE_FORMAT(question_date, \'%d %b %Y à %H:%i\') AS date_ FROM members, questions WHERE questions.userID= members.id ORDER BY id desc');
    $members->execute();

    return $members;
}


function addQuestion($userID, $title, $content)
{
    $data_base= dataBaseConnexion();
    $addQuestion= $data_base->prepare("INSERT INTO questions (userID, title, content) VALUES (?, ?, ?)");
    $addQuestion->execute([$userID, $title, $content]);

    return $addQuestion;
}


function totalQuestions()
{
    $data_base= dataBaseConnexion();

    $number= $data_base->prepare("SELECT COUNT(*) AS total FROM questions");
    $number->execute();

    $total= $number->fetch();

    return $total;
}


function singleQuestion($idQuestion)
{
    $data_base= dataBaseConnexion();
    $question= $data_base->prepare('SELECT questions.id as id, username, content, title, picture, DATE_FORMAT(question_date, \'%d %b %Y à %H:%i\') AS date_ FROM members, questions WHERE questions.userID= members.id AND questions.id =?');
    $question->execute([$idQuestion]);

    $questions= $question->fetch();

    return $questions;
}


function addComment($idQuestion, $idUser, $comment)
{
    $data_base= dataBaseConnexion();

    $addComment= $data_base->prepare("INSERT INTO comments (questionID, userID, comment) VALUES(?, ?, ?)");
    $addComment->execute([$idQuestion, $idUser, $comment]);

    return $addComment;
}


function allComments($idQuestion)
{
    $data_base= dataBaseConnexion();
    $comments= $data_base->prepare('SELECT id, questionID, userID, comment, DATE_FORMAT(comment_date, \'%d %b %Y à %H:%i\') AS date_ FROM comments WHERE questionID= ?');
    $comments->execute([$idQuestion]);

    return $comments;
}




function identifiedMember($idUser)
{
    $data_base= dataBaseConnexion();
    $members= $data_base->prepare('SELECT username, picture FROM members WHERE id=?' );
    $members->execute([$idUser]);

    $user= $members->fetch();
    return $user;
}