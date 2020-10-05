<?php

function Errorreporting()
{
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // Démarrage de la session
  //session_start();
  // Récupération des paramètres du site
  require_once('conf/AppSettings.php');
  // Chargement du controller pour définir la page destination
  require_once('controller/frontcontroller.php');
  // Chargement du controller dédié aux fonctions
  require_once('controller/functions.php');
}

function Controller()
{
  // Controller en fonction de la page appelée
  try {
    switch (isset($_GET['action']) ? $_GET['action'] : '') {
      case 'register':
  			AuthRegister();
  			break;

      case 'registerconfirm':
        RegisterConfirm($maindomain, $http);
        break;

      case 'registeractivation':
        if ($_GET['nickname'] AND $_GET['actkey']) {
  				ActivateUser($_GET['nickname'], $_GET['actkey']);
  			} else {
  				throw new Exception('Toutes les informations n\'ont pas été transmises pour l\'activation de votre compte');
  			}
  			break;

      default:
        MainHome();
    }
  } catch(Exception $e) {
    // Récupération et affchage du message d'erreur
    $errorMessage = $e->getMessage();
    require('view/front/ErrorView.php');
  }
}



function Header()
{
  echo '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Xbox One & Xbox Live | Succès, Actus & Jeux - Xboxlive.fr</title>
        <script src=\'https://www.google.com/recaptcha/api.js\'></script>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
        <meta charset=\"UTF-8\" />
        <link rel=\"stylesheet\" href=\"-/css/app.css\">
        <script src=\"-/js/app.min.js\"></script>
        <script src=\"//code.jquery.com/jquery-3.3.1.min.js\"></script>
        <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css\" />
        <script src=\"https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js\"></script>
    </head>
    <body class=\"page-index\">
    '
}
?>