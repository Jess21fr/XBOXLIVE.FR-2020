<?php
  function dbConnect() {
    try {
    	$db = new PDO('mysql:host=109.234.164.30;dbname=meal6475_xlfr', 'meal6475_xlfr', 'fPYNw848CYsI');
      return $db;
    } catch (PDOException $e) {
      $errorMessage = $e->getMessage();
      echo $errorMessage;
    }
  }

  function getUserExists($db, $nickname, $email) {
  	$req = 'SELECT COUNT(users_id)
  		FROM users
  		WHERE users_username LIKE "'.$nickname.'"
  		OR users_email LIKE "'.$email.'"';

  	$reqnb = $db->query($req)->fetchColumn();
  	return $reqnb;
  }

  function RegisterNewUser($db, $nickname, $email, $password, $ConfirmString) {
  	$adduser = 'INSERT INTO users (users_username, users_password, users_email, users_active, users_actkey, users_register)
      VALUES ("'.$nickname.'", "'.password_hash($password, PASSWORD_DEFAULT).'", "'.$email.'", "0",  "'.$ConfirmString.'", UNIX_TIMESTAMP())';

  	$stmt = $db->prepare($adduser);
  	$stmt->execute();
  }

  function CheckUserActivate($db, $nickname, $activationkey) {
  	$req = 'SELECT COUNT(users_id)
  		FROM users
  		WHERE users_username LIKE "'.$nickname.'"
  		AND users_actkey = "'.$activationkey.'"';
  	$reqnb = $db->query($req)->fetchColumn();

  	return $reqnb;
  }

  function UserActivation($db, $nickname, $activationkey) {
  	$req = 'UPDATE users
  		SET users_active = "1", users_actkey = NULL
  		WHERE users_username = "'.$nickname.'" AND users_actkey = "'.$activationkey.'"
  		LIMIT 1';
  	$stmt = $db->prepare($req);
  	$stmt->execute();
  }
