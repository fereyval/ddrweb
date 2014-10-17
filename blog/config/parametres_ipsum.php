<?php
/**********************************************************************
*   PARAMETRES IPSUM
*   Ce fichier permet de déterminer les constantes/variables communes.
*   Ces donnéees sont ainsi accessibles dans tout le site.
**********************************************************************/
// Version
define ("VERSION" , "2.3" ) ;

// Site
if (SERVEUR == 'local')
    define ("URL" , "http://www.nomdurepertoire.5-4.lan/" ) ;
else
    define ("URL" , "http://www.nomdedomaine.com/" ) ;

// Destinataire des erreurs php
define ("MAIL_ADMINISTRATEUR", 'erreurphp@pixellweb.com');  // Ne pas modifier
define ("MAIL_TEST", 'test@pixellweb.com'); // Ne rien mettre quand tests terminés.
define ("MAIL_OBJET", "Contact site Internet ".NOM_SITE);
define ("MAIL_REPLY", '');

// Divers
define("SALT", 'fgjugthk');

$CIVILITE = array('mme'=>'Mme' ,'mlle'=>'Mlle','mr'=>'Mr');

$DROITS = array(
    'admin' => 'Administrateur',
    'actualite' => 'Gestion des actualités'
);

define ('MAX_FILE_SIZE', 10000000);

// Boutique
define ("QTE_MAX" , 10 ) ;    // Qte max pour achat de produit
//define ("APAYER_MIN" , 1 ) ; // Montant en ¤ à payer minimum
//define ("APAYER_MAX" , 10000 ) ; // Montant en ¤ à payer maximum
define ("SOC_ORDRE" , 'xxxxxx' ) ;    // Ordre du chéque
define ("RIB" , 'xxxxxx' ) ;    // IBAN + RIB
define ("MAIL_CMD_PIXELL", 'ebusiness@pixellweb.com'); // Destinataire des mails des commandes PIXELL
define ("IS_LIVRAISON_PLACE" , true ) ;    // Livraison sur place disponible
define ("BOUTIQUE_PAYS" , 112 ) ;    // Pays de la boutique

$COMMANDE_ETAT = array(
                    0 => 'Non confirmée',
                    1 => 'Annulée',
                    2 => 'Confirmée & Non payée',
                    3 => 'Payée',
                    4 => 'Traitée'
);

$TYPE_PAIEMENT = array(
                    1 => array(
                        'nom' => 'Carte bancaire',
                        'icone' => 'panier/composants/cartebleue.jpg'
                    ),
                    2 => array(
                        'nom' => 'Chèque'
                    ),
                    3 => array(
                        'nom' => 'Sur place'
                    ),
                    4 => array(
                        'nom' => 'Virement'
                    )
                );
