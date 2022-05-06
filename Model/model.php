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

    $session= $data_base->prepare('SELECT id, firstName, lastName, DATE_FORMAT(birthday, \'%d %b %Y\') AS birthday_, email, username, picture, gender, DATE_FORMAT(inscription_date, \'%d %b %Y\') AS date_, status_, level_ FROM members WHERE email=?');
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

    $members= $data_base->query('SELECT questions.id as id, userID, username, content, title, picture, DATE_FORMAT(question_date, \'%d %b %Y à %H:%i\') AS date_ FROM members, questions WHERE questions.userID= members.id ORDER BY id desc');
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
    $question= $data_base->prepare('SELECT questions.id as id, username, content, title, picture, DATE_FORMAT(question_date, \'%d %b %Y à %H:%i\') AS date_, members.id AS userID FROM members, questions WHERE questions.userID= members.id AND questions.id =?');
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
    $comments= $data_base->prepare('SELECT id, questionID, userID, comment, DATE_FORMAT(comment_date, \'%d %b %Y à %H:%i\') AS date_ FROM comments WHERE questionID= ? ORDER BY id desc');
    $comments->execute([$idQuestion]);

    return $comments;
}


function identifiedMember($idUser)
{
    $data_base= dataBaseConnexion();
    $members= $data_base->prepare('SELECT id, username, picture FROM members WHERE id=?' );
    $members->execute([$idUser]);

    $user= $members->fetch();
    return $user;
}


function numberCommentsforEachQuestion($idQuestion)
{
    $data_base= dataBaseConnexion();
    $number= $data_base->prepare("SELECT COUNT(*) as total FROM `comments` WHERE questionID= ?");
    $number->execute([$idQuestion]);

    $total= $number->fetch();

    return $total;
}


function deleteQuestion($idQuestion)
{
    $data_base= dataBaseConnexion();
    $question= $data_base->prepare("DELETE FROM questions WHERE id=?");
    $question->execute([$idQuestion]);

    return $question;
}


function deleteComment($idComment)
{
    $data_base= dataBaseConnexion();
    $comment= $data_base->prepare("DELETE FROM comments WHERE id=?");
    $comment->execute([$idComment]);

    return $comment;
}


function updateFirstName($fisrtName, $idUser)
{
    $data_base= dataBaseConnexion();
    $update= $data_base->prepare("UPDATE members SET firstName='$fisrtName' WHERE id=?");
    $update->execute([$idUser]);

    return $update;
}


function updateLastName($lastName, $idUser)
{
    $data_base= dataBaseConnexion();
    $update= $data_base->prepare("UPDATE members SET lastName='$lastName' WHERE id=?");
    $update->execute([$idUser]);

    return $update;
}


function updatePassword($password, $idUser)
{
    $data_base= dataBaseConnexion();
    $update= $data_base->prepare("UPDATE members SET password_='$password' WHERE id=?");
    $update->execute([$idUser]);

    return $update;
}


function updatePicture($picture, $idUser)
{
    $data_base= dataBaseConnexion();
    $update= $data_base->prepare("UPDATE members SET picture='$picture' WHERE id=?");
    $update->execute([$idUser]);

    return $update;
}


function allCours()
{
    $data_base = dataBaseConnexion();

    $cours = $data_base->query('SELECT id, statut, titre, description, DATE_FORMAT(date_creation, \'%d %b %Y \') AS date_creation, DATE_FORMAT(date_modif, \'%d %b %Y \') AS date_modif, source FROM cours');
    $cours->execute();
    
    return $cours;
}


function getCours($idcours)
{
    $data_base = dataBaseConnexion();

    $lecours = $data_base->prepare('SELECT id, statut, titre, description, DATE_FORMAT(date_creation, \'%d %b %Y \') AS date_creation, DATE_FORMAT(date_modif, \'%d %b %Y \') AS date_modif, source, points FROM cours WHERE id = ?');
    $lecours->execute([$idcours]);

    return $lecours;
}


function getLessons($idcours)
{
    $data_base = dataBaseConnexion();

    $lessons = $data_base->prepare('SELECT id, statut, titre, description, fichier FROM lessons WHERE idCours = ?');
    $lessons->execute([$idcours]);

    return $lessons;   
}

function getLesson($idlesson)
{
    $data_base = dataBaseConnexion();

    $lesson = $data_base->prepare('SELECT id, statut, titre, description, fichier FROM lessons WHERE id = ?');
    $lesson->execute([$idlesson]);

    return $lesson;   
}


function disableCourse($id)
{
    $data_base = dataBaseConnexion();

    $disable = $data_base->prepare("UPDATE cours SET statut='not active' WHERE id = ?");
    $disable->execute([$id]);

    return $disable;
}


function ableCourse($id)
{
    $data_base = dataBaseConnexion();

    $able = $data_base->prepare("UPDATE cours SET statut='active' WHERE id = ?");
    $able->execute([$id]);

    return $able;
}


function deleteCourse($id)
{
    $data_base = dataBaseConnexion();

    $delete = $data_base->prepare("DELETE FROM cours WHERE id = ?");
    $delete->execute([$id]);

    return $delete;
}


function addCourse($titre, $descr, $source, $level)
{
    $data_base = dataBaseConnexion();

    $adding = $data_base->prepare("INSERT INTO cours(statut, titre, description, source, points) VALUES ('not active', ?, ?, ?, ?)");
    $adding->execute([$titre, $descr, $source, $level]);
    
    return $adding;
}


function modifyCourse($idcours, $titre, $descr, $source, $level)
{
    $data_base = dataBaseConnexion();
    
    $modifying = $data_base->prepare('UPDATE cours SET titre = ?, description = ?, source = ?, points = ?, date_modif = CURRENT_DATE where id = ?');
    $modifying->execute([$titre, $descr, $source, $level, $idcours]);

    return $modifying;
}


function allMembersByID($userID)
{
    $data_base= dataBaseConnexion();

    $members= $data_base->prepare('SELECT id, firstName, lastName, DATE_FORMAT(birthday, \'%d %b %Y\') AS birthday_, email, username, picture, gender, DATE_FORMAT(inscription_date, \'%d %b %Y\') AS date_ FROM members WHERE id=?');
    $members->execute([$userID]);

    $member= $members->fetch();

    return $member;
}


function disableTheLesson($id)
{
    $data_base = dataBaseConnexion();

    $disable = $data_base->prepare("UPDATE lessons SET statut='not active' WHERE id = ?");
    $disable->execute([$id]);

    return $disable;
}


function ableTheLesson($id)
{
    $data_base = dataBaseConnexion();

    $able = $data_base->prepare("UPDATE lessons SET statut='active' WHERE id = ?");
    $able->execute([$id]);

    return $able;
}


function removeTheLesson($id)
{
    $data_base = dataBaseConnexion();

    $able = $data_base->prepare("DELETE FROM lessons WHERE id = ?");
    $able->execute([$id]);

    return $able;
}


function addingTheLesson($title, $descr, $fichier, $idcours)
{
    $data_base = dataBaseConnexion();

    $adding = $data_base->prepare("INSERT INTO lessons(statut, titre, description, fichier,  idCours) VALUES ('not active', ?, ?, ?, ?)");
    $adding->execute([$title, $descr, $fichier, $idcours]);
    
    return $adding;
}


function modifyTheLesson($idLesson, $titre, $descr, $fichier)
{
    $data_base = dataBaseConnexion();
    if($fichier != '')
    {
        $modifying = $data_base->prepare('UPDATE lessons SET titre = ?, description = ?, fichier = ? where id = ?');
        $modifying->execute([$titre, $descr, $fichier, $idLesson]);
    }
    else
    {
        $modifying = $data_base->prepare('UPDATE lessons SET titre = ?, description = ? where id = ?');
        $modifying->execute([$titre, $descr, $idLesson]);
    }
        
    return $modifying;
}



function updateQuiz($userID, $result)
{
    $data_base = dataBaseConnexion();

    $insert= $data_base->prepare("UPDATE members SET level_='$result', status_='answered' WHERE id=?");
    $insert->execute([$userID]);

    return $insert;
}

function suggestion($level)
{
    $data_base = dataBaseConnexion();
    
    $suggest = $data_base->prepare('SELECT id, statut, titre, description, DATE_FORMAT(date_creation, \'%d %b %Y \') AS date_creation, DATE_FORMAT(date_modif, \'%d %b %Y \') AS date_modif, source FROM cours WHERE points <= ?');
    $suggest->execute([$level]);

    return $suggest;
}