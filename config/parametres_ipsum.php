<?php
/**********************************************************************
*   PARAMETRES IPSUM
*   Ce fichier permet de d�terminer les constantes/variables communes.
*   Ces donn�ees sont ainsi accessibles dans tout le site.
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
define ("MAIL_TEST", 'test@pixellweb.com'); // Ne rien mettre quand tests termin�s.
define ("MAIL_OBJET", "Contact site Internet ".NOM_SITE);
define ("MAIL_REPLY", '');

// Divers
define("SALT", 'fgjugthk');

$CIVILITE = array('mme'=>'Mme' ,'mlle'=>'Mlle','mr'=>'Mr');

$DROITS = array(
    'admin' => 'Administrateur',
    'actualite' => 'Gestion des actualit�s'
);

define ('MAX_FILE_SIZE', 10000000);

// Boutique
define ("QTE_MAX" , 10 ) ;    // Qte max pour achat de produit
//define ("APAYER_MIN" , 1 ) ; // Montant en � � payer minimum
//define ("APAYER_MAX" , 10000 ) ; // Montant en � � payer maximum
define ("SOC_ORDRE" , 'xxxxxx' ) ;    // Ordre du ch�que
define ("RIB" , 'xxxxxx' ) ;    // IBAN + RIB
define ("MAIL_CMD_PIXELL", 'ebusiness@pixellweb.com'); // Destinataire des mails des commandes PIXELL
define ("IS_LIVRAISON_PLACE" , true ) ;    // Livraison sur place disponible
define ("BOUTIQUE_PAYS" , 112 ) ;    // Pays de la boutique

$COMMANDE_ETAT = array(
                    0 => 'Non confirm�e',
                    1 => 'Annul�e',
                    2 => 'Confirm�e & Non pay�e',
                    3 => 'Pay�e',
                    4 => 'Trait�e'
);

$TYPE_PAIEMENT = array(
                    1 => array(
                        'nom' => 'Carte bancaire',
                        'icone' => 'panier/composants/cartebleue.jpg'
                    ),
                    2 => array(
                        'nom' => 'Ch�que'
                    ),
                    3 => array(
                        'nom' => 'Sur place'
                    ),
                    4 => array(
                        'nom' => 'Virement'
                    )
                );
