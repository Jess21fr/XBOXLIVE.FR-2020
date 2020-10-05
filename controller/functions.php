<?php

  function generateRandomString($length) {
      return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  }

  function send_email($mailto, $subject, $message) {

  	$eol = "\r\n";

  	$headers = "MIME-Version: 1.0" . $eol;
  	$headers .= "Content-type:text/html;charset=UTF-8" . $eol;
  	$headers .= 'From: Xboxlive.fr <noreply@xboxlive.fr>' . $eol;
  	$headers .= 'Reply-To: noreply@xboxlive.fr' . $eol;
  	$headers .= 'Return-Path: noreply@xboxlive.fr' . $eol;

  	if(mail($mailto,$subject,$message,$headers)){
  		// Message if mail has been sent
  	}
  }
