<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/model/frontmodel.php');

function MainHome() {
	require('view/front/MainHomeView.php');
}

function AuthRegister(){
	require('view/front/AuthRegisterView.php');
}

function RegisterConfirm($maindomain, $http){
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
			$db = dbConnect();

			//your site secret key
			$secret = '6Le8vQETAAAAAAWcWKNHiGPf_btcWaS67Qn6KgOS';
			//get verify response data
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);

			$userexists = getUserExists($db, $_POST['xlfrnickname'], $_POST['xlfremail']);

			//$RegisterUserID = intval(getRegisterMaxID())+1;
			$ConfirmString = generateRandomString(32);

			if($responseData->success AND $userexists == 0 /*AND isset($RegisterUserID)*/ AND isset($ConfirmString)) {
				//contact form submission code
				$nickname = $_POST['xlfrnickname'];
				$email = $_POST['xlfremail'];
				$password = $_POST['xlfrpassword'];

				$succMsg = $nickname.', l\'inscription s\'est bien déroulée et un mail a été enovyé pour activer votre compte. Attention, il se peut qu\'il soit dans les courriers indésirables.';

				RegisterNewUser($db, $nickname, $email, $password, $ConfirmString);

				$message = '<html><body><div>Pour pouvoir utiliser votre compte Xboxlive.fr, il suffit de l\'activer en cliquant sur ce lien.</div>
				<div><a href="'.$http.'://'.$maindomain.'/activation/'.$nickname.'/'.$ConfirmString.'/">https://'.$maindomain.'/activation/'.$nickname.'/'.$ConfirmString.'/</a></div>
				</body></html>';
				$subject = $nickname.' - Activation de votre compte Xboxlive.fr';

				send_email($email, $subject, $message);

			} elseif ($userexists > 0) {
				$errMsg = 'Il semblerait que ce nom d\'utilisateur ou cet e-mail soient déjà utilisés sur Xboxlive.fr';
			} else {
				$errMsg = 'Il semblerait que la vérification du captcha se soit mal déroulée. Veuillez réessayer s\'il vous plait.';
			}
		} else {
			$errMsg = 'Vous n\'avez pas coché la case reCAPTCHA.';
		}
	} else {
		$errMsg = '';
		$succMsg = '';
	}

	require('view/front/AuthRegisterView.php');
}

function ActivateUser($nickname, $activationkey) {
	$db = dbConnect();

	$active = CheckUserActivate($db, $nickname, $activationkey);

	if ($active == 1) {
		UserActivation($db, $nickname, $activationkey);
		$succMsg = 'Votre compte a été activé. Vous pouvez désormais vous connecter.';
	} else {
		$errMsg = 'L\'activation n\'est pas possible. Vérifiez le lien d\'activation ou bien contactez-nous.';
	}
	require('view/front/ActivateView.php');
}
