<?php
function nul(){}

/***********************************************************************************
*  DATES ET HEURES
***********************************************************************************/
/**
* Retourne au mieux le timestamp d'une date au format inconnu
*/
function timestamp($date, $alternative = 864000 )
{
	// cas du 30/01/2009 ou du 29-3-09 remplacé en aa/mm/jj
	if (ereg("^([0-9]{1,2})[-/]([0-9]{1,2})[-/]([0-9]{2,4})$", $date, $regs)) {
		// Cas du date en aa passé en 20aa
			$regs[3] = (strlen($regs[3]) == 2 ? 2000 + $regs[3] : $regs[3]);
		$date = $regs[3].'/'.$regs[2].'/'.$regs[1];
	}
	if (($timestamp = strtotime($date)) === false or $timestamp == -1) {
		if (is_numeric($date)) { // cas d'un timestamp
		   $timestamp = $date;
		}
		// Cas ou le format de la date n'est pas reconnu
		else  $timestamp = time() - $alternative;
	}
	return $timestamp;
}

/**
* Affiche une date littéralement à partir d'un timespamp
* Renvoie la date sous la forme "jour   n° du jour   mois   année"  en français
*/
function textDate($stamp)
{
	//
	$Jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
	$Mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
	$datefr = $Jour[date("w",$stamp)]." ".date("d",$stamp)." ".$Mois[date("n",$stamp)]." ".date("Y",$stamp);
	return $datefr;
}

/**
* Formate une date pour un affichage
* @param string $date (format sql DATE ou DATETIME)
* @param string $format de sortie (DATE, DATETIME, IDENTIQUE)
* @return string
*/
function formateDate($date, $format='IDENTIQUE')
{
	if ($date == '0000-00-00 00:00:00' or $date == '0000-00-00') return false;
	$timestamp = strtotime($date);
	if (!$timestamp or $timestamp  == -1)
		return false;
	if ((strlen($date) == 10 and $format == 'IDENTIQUE') or $format == 'DATE')
		$date =  date('d/m/Y', $timestamp);
	elseif 	((strlen($date) == 19 and $format == 'IDENTIQUE') or $format == 'DATETIME')
		$date = date('d/m/Y H:i:s', $timestamp);
	else return false;
	return $date;
}

/**
* Formate une date pour un stockage
* Renvoi YYYY-mm-jj HH:ii:ss a partir de jj/mm/aaaa HH:MM:SS ou  jj/mm/aaaa
* @param string $date
* @return string  (format sql DATE ou DATETIME)
*/
function formateDateStocke($date)
{
	$date = trim($date);
	if (strlen($date) != 19 and strlen($date) != 10  and strlen($date) != 8){
	 return false;
	}
	// On extrait
	$jour = substr($date, 0, 2);
	$mois = substr($date, 3, 2);
	if (strlen($date) == 8) {
		$annee = '20'.substr($date, 6, 2);
	} else {
		$annee = substr($date,6,4);
	}
	$date = substr_replace($date, $annee.'-'.$mois.'-'.$jour, 0);
	return $date;
}

/***********************************************************************************
*  EMAIL
***********************************************************************************/
/**
* Envoie d'un mail simple
* @param string $to - email de destination
* @param string $fromname - Nom de l'expéditeur
* @param string $from - Email de l'expéditeur
* @param string $subject - objet
* @param string $message
* @return bool
*/
function sendMail($to, $fromname = '', $from = '', $subject = '', $message = '')
{
	if (!empty($to)) {
		$headers  = "From: \"$fromname\"<$from>\n";
		$headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
		$headers .= "Content-Transfer-Encoding: 8bit";

		$result = mail($to, $subject, $message, $headers)
		or trigger_error('<<< Error Mail. The mail isn\'t successfully accepted for delivery >>>', E_USER_WARNING);
		return $result;
	} else {
		trigger_error('<<< Error Mail. The variable receivers of the mail is empty >>>', E_USER_WARNING);
		return false;
	}
}

/**
* Evite au robot de ne pas spamer une boite mail
* @param string $email
* @return  string
* @desc <a href="mailto:xxxx%40laposte%2Enet" ><span>xxxx</span>&#64;<span>laposte.net</span></a>
*/
function mailAntiSpam($email)
{
	$email1 = str_replace('@','%40',$email);
	$email1 = str_replace('.','%2E',$email1);
	$email2 = str_replace('@','</span>&#64;<span>',$email);
	$email = '<a href="mailto:'.$email.'"><span>'.$email.'</span></a>';
	return $email;
}


/***********************************************************************************
*  FONCTIONS DIVERSES
***********************************************************************************/
/**
* Vérifie si l'utilisateur à le bon droit
* @param string $droit
* @return  bool
*/
function isDroit($droit)
{
	if (!isset($_SESSION['USER']))
		return false;
	if (in_array("admin",$_SESSION['USER']['droits']) or in_array($droit,$_SESSION['USER']['droits']))
		return true;

	return false;
}

/**
* Redirection
*/
function redirect($chemin)
{
	header("location: ".$chemin);
	exit();
}

/**
*	Creation de mot de passe aleatoire d'une longeur donnee
*/
function getPass($nbcaracteres)
{
	$pass = '';
	$caracterespossibles = "abcdefghijklmnopqrstuvwxyzABDEFCDEFGHIJKMNPQRSTUVWXY0123456789"; // liste des caract&egrave;res que l'on peut utiliser <br />
	srand((double)microtime() * 1000000);
	for($i = 0; $i < $nbcaracteres; $i++) {
		$pass .= $caracterespossibles[rand() % strlen($caracterespossibles)];
	}
	return $pass;
}

/**
* Formattage d'un nombre
*  - $nul = "n" --> renvoie &nbsp; si 0
*  - $num !="n" --> renvoie 0 si 0
*/
function formatNombre($val, $decim = 2, $nul = "n", $mille = "", $car = "",$virg = ".")
{
	if ( $val == 0  && $nul != "o") {
	   return "";
	}
	$val = empty($val) ? 0 : $val;
	$val = str_replace( "," , "." , $val );
	return number_format ($val, $decim, $virg, $mille).$car ;
}

/**
* Convertie un code couleur héxa en rgb
* @param string $hex
* @return  array  returns an array with the rgb values
*/
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

/**
*	Tronque une chaine sans césure de mot, au caractère $longeur_max
*/
function tronquerTexte($texte, $longeur_max = 100)
{
	if (strlen($texte) > $longeur_max) {
    	$texte = substr($texte, 0, $longeur_max);
    	$dernier_espace = strrpos($texte, " ");
    	$texte = substr($texte, 0, $dernier_espace)."...";
	}
	return $texte;
}

/**
* Nettoyage du code html et le rend valide
* @param text $texte
* @param array $config
* @return  text  - Texte html nettoyé
*/
function cleanHtml($texte, $config = false)
{
	// Charge le fichier pour nettoyer le HTML
	//http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed/htmLawed_README.htm#s2.9
	include_once ROOT.'config/classes/htmLawed.php';
	if (!$config) {
		$config = array(
				'comment' => 1,   // commentaire html supprimé
				'cdata' => 1,   // commentaore cdata supprimé
				'safe' => 1,  //faille xss
				'elements' => 'a, em, strong, b, i, strike, p, ul, li, ol, img, h2, h3, br, hr',    // elements autorisé
				'deny_attribute' => '* -title -href -alt'     // attributs autorisé
		);
	}
	return htmLawed($texte, $config);
}

function parseTexte($texte) {
    $search = array('<h1>', '<h2>', '<h3>', '<h4>');
    $replace = array('<h1 class="texte-h1">', '<h2 class="texte-h2">', '<h3 class="texte-h3">', '<h4 class="texte-h4">');

    $texte = str_replace($search, $replace, $texte);

    return $texte;
}

/**
* Rendre compatible la fonction htmlspecialchars sans paramètre avec php 5.4
*/
function htmlXspecialchars($string, $ent = ENT_COMPAT, $charset = 'ISO-8859-1') {
    return htmlspecialchars($string, $ent, $charset);
}
function htmlXentities($string, $ent = ENT_COMPAT, $charset = 'ISO-8859-1') {
    return htmlentities($string, $ent, $charset);
}
function h($string, $ent = ENT_COMPAT, $charset = 'ISO-8859-1') {
    return htmlspecialchars($string, $ent, $charset);
}
function e($string, $ent = ENT_COMPAT, $charset = 'ISO-8859-1') {
    return htmlentities($string, $ent, $charset);
}

/**
* Affiche aléatoirement une pub d'un format donné
* @param string $format
* @return  string  - code html de la pub
*/
function getPub($format)
{
    GLOBAL $db;
    $result = $db->query("SELECT `html` FROM `pub` WHERE `pub_format_id` = '".$db->escape($format)."' ORDER BY RAND() LIMIT 1");
    if($db->num_rows($result)) {
        $pub = $db->fetch_assoc($result);
        return stripcslashes($pub['html']);
    }
    return false;
}

/**
* Vérifie si c'est un spambot
* utilise données de http://www.stopforumspam.com
* @param string $emailAddress - email à tester
* @param string $ipAddress - ip à tester
* @param string $userName - user à tester
* @param string $confidence Score de confiance en pourcentage ; 0 = tous
* @return bool
*/
function checkIfSpambot($emailAddress, $ipAddress, $userName, $confidence = 0)
{

    $adresse = 'http://www.stopforumspam.com/api?';
    $query = array(
                'confidence' => 'true',
                'f' => 'xmldom',
                );

    if (!empty($emailAddress)) {
        $query['email'] = urlencode($emailAddress);
    }
    if (!empty($ipAddress)) {
        $query['ip'] = urlencode($ipAddress);
    }
    if (!empty($userName)) {
        $query['username'] = urlencode($userName);
    }
    foreach($query as $key => $value) {
        $adresse .= $key.'='.$value.'&';
    }

    $xml_string = file_get_contents($adresse);
    if ($xml_string) {
        $xml = new SimpleXMLElement($xml_string);
        if ($xml->success == 1) {
            foreach ($xml->children() as $value) {
                if ($value->appears == "1" and  $value->confidence >= $confidence) {
                    // spammeur detecté
                    return true;
                }
            }
        }
    }
    return false;
}
