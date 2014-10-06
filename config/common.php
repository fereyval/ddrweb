<?php
if (!defined('ROOT'))
    exit('The constant ROOT must be defined and point to a valid installation root directory.');

/*****************************************************************
* DEFINITION DU SERVEUR
******************************************************************/
define ('SERVEUR', isset($_SERVER['app_env']) ? $_SERVER['app_env'] : 'production');

/*****************************************************************
* INCLUSION FICHIER DE CONFIGURATION
******************************************************************/
@include ROOT.'config/config.php';
include ROOT."config/parametres.php";
include ROOT."config/parametres_ipsum.php";

/*****************************************************************
* DEFINITION DES CONSTANTES LOCAL
******************************************************************/
// Définit le fuseau horaire par défaut à utiliser.
//date_default_timezone_set('UTC');
date_default_timezone_set('America/Martinique');

/*****************************************************************
* GESTION DES ERREURS
******************************************************************/
// Définition du mode de production ou developpement
define ('MODE', SERVEUR != 'production' ? 'developpement' : 'production');
//define ('MODE', 'developpement');
include "php_erreur.php";

/*****************************************************************
* Supprime les magic_quotes_gpc
******************************************************************/
// Turn off magic_quotes_runtime
if (get_magic_quotes_runtime())
    set_magic_quotes_runtime(0);

// Strip slashes from GET/POST/COOKIE (if magic_quotes_gpc is enabled)
if (get_magic_quotes_gpc()) {
    function stripslashes_array($array)
    {
        return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array);
    }

    $_GET = stripslashes_array($_GET);
    $_POST = stripslashes_array($_POST);
    $_COOKIE = stripslashes_array($_COOKIE);
    $_REQUEST = stripslashes_array($_REQUEST);
}

/******************************************************************
* INCLUSIONS
******************************************************************/
include ROOT."config/fonctions.php";
include ROOT."config/classes/liste.class.php";
include ROOT."config/classes/lib.files.php";
include ROOT.'config/classes/errors.class.php';
include ROOT."config/classes/messages.class.php";

/*****************************************************************
* DEMARRAGE SESSION
******************************************************************/
session_start();

/*****************************************************************
* INSTANCIATION
******************************************************************/
// Instanciation de la class Message
$msg = new Messages();

/*****************************************************************
* CONNECTION BDD
******************************************************************/
// Load DB abstraction layer and connect
//require ROOT.'config/classes/common_db.php';
// Start a transaction
//$db->start_transaction();

/******************************************************************
* REPERTOIRES
******************************************************************/
define ("REP_PHOTOS" , ROOT.'media/');
define ("PATH_PHOTOS" , URL.'media/');
define ("REP_MEDIA_PLAYER" , ROOT.'media/');

/******************************************************************
* INITIALISATION DE VARIABLES
******************************************************************/
$description = $head = $title = $rubrique = $javascript = '';
