<?php
/*************************************************************************************
*  GESTION DES ERREURS     Version pour PHP 5.3
*************************************************************************************/

// Chemin des repertoires de log
define ("LOG_", ROOT."config/log.php");
define ("LOG_TEMP", ROOT."config/log_temp.php");

// Constante non défini version PHP < 5.3
if (!defined('E_DEPRECATED')) {
	define ("E_DEPRECATED" , 8192 ) ;
}

// Gestionnaire d'erreur personalisé'
set_error_handler('my_error_handler');


if (MODE == 'developpement') {
	error_reporting(E_ALL | E_STRICT);
} else {
	error_reporting(E_ALL & ~E_DEPRECATED);
}
$error_nbr = false;

function my_error_handler($errno, $errstr, $errfile, $errline) {
	GLOBAL $error_nbr;

	// définition des type d'erreurs disponibles
	$error_msg = array(
		1 => 'E_ERROR',
		2 => 'E_WARNING',
		4 => 'E_PARSE',
		8 => 'E_NOTICE',
		16 => 'E_CORE_ERROR',
		32 => 'E_CORE_WARNING',
		64 => 'E_COMPILE_ERROR',
		128 => 'E_COMPILE_WARNING',
		256 => 'E_USER_ERROR',
		512 => 'E_USER_WARNING',
		1024 => 'E_USER_NOTICE',
		8192 => 'E_DEPRECATED'
	);
	// affichage classique d'une ligne d'erreur
	$mess = $error_msg[$errno].' '.$errstr.' in : '.$errfile.', on line : '.$errline;
	if (MODE == 'developpement')  echo '<p>'.$mess."</p>";

	// Journalisation des erreurs
	$DATE = time();
	$date = date("d-m-Y H:i:s", $DATE);
	$msg = '['.$date.'] '.$mess."\n";
	error_log($msg, 3, LOG_);

	// Affichage d'un message et envoie mail si c'est pas une notice
	if (!in_array($errno, array(E_NOTICE,E_USER_NOTICE,E_DEPRECATED)) and MODE == 'production') {
		if (!$error_nbr) {
			// Affiche les commentaires public
			preg_match('/<<<([^>]*)>>>/',$mess,$mess2);
			echo '<div class="messages error""><p><strong>'.(isset($mess2[1]) ? $mess2[1] : '').'</strong><br />Une erreur est survenue sur le script de cette page. Veuillez réessayer ultérieurement.<br/>Toutefois, si le problème persiste, contactez l\'administrateur du site. </p></div>';
			$error_nbr = true;
		}
		// Vérifie La date du dernier envoi de mail dans le fichier temporaire
		$log_temp = trim(file_get_contents(LOG_TEMP));
		if ($log_temp and (strtotime(substr($log_temp, 1, 19)) > ($DATE - (60 * 60 * 24)))) {      // 24 heure d'intervalle
			// Un mail a déja été envoyé il y a peu. Mets l'alerte en attente
			error_log($msg, 3, LOG_TEMP);
		} else {
			// Envoi du mail d'alerte'
			// Inscrit la date dans le fichier temporaire + écrasement fichier
			file_put_contents(LOG_TEMP, '['.$date."]\n");

			$headers  = "From: \"".NOM_SITE."\"<".MAIL_TO.">\n";
			$headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
			$headers .= "Content-Transfer-Encoding: 8bit";

			$msg .= "\n\n ". $_SERVER["SERVER_NAME"] ;

			$result = @mail(MAIL_ADMINISTRATEUR, 'Erreur : '.NOM_SITE, $log_temp.$msg, $headers);
		}
	}

	// Permet de stopper l'execution pour certains types d'erreurs
	if(in_array($errno, array(E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING, E_USER_ERROR)))  exit();
}
