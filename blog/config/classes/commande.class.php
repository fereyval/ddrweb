<?php
/**
* Class Commande de Ipsum
*
*/
class Commande
{
    protected $client;
    protected $frais_port = 0;
    protected $livraison = 0; // 0 = pas de livraison
    protected $etat = self::ETAT_NON_CONFIRME;
    protected $panier;
    protected $type_paiement = self::CB;
    protected $ht = null;
    protected $tva = null;
    protected $ttc = null;
    protected $apayer = null;
    protected $avec_tva = true;
    protected $commande_id = false;
    protected $reference = null;

    const CB = 1;
    const ETAT_NON_CONFIRME = 0;
    const ETAT_ANNULE = 1;
    const ETAT_CONFIRME = 2;
    const ETAT_PAYE = 3;
    const ETAT_TRAITE = 4;

    /**
    * Constructor function.
    * @param int $client id du client
    * @param object  $panier
    */
    public function __construct($client, Panier $panier)
    {
        $this->panier = $panier;
        $this->setClient($client);
        register_shutdown_function(array($this, "session"));
    }
    /**
    * Vide/initialisation de l'objet
    */
    public function vide()
    {
        $this->frais_port = 0;
        $this->livraison = 0; // 0 = pas de livraison
        $this->etat = self::ETAT_NON_CONFIRME;
        $this->type_paiement = self::CB;
        $this->ht = null;
        $this->tva = null;
        $this->ttc = null;
        $this->apayer = null;
        $this->avec_tva = true;
        $this->commande_id = false;
        $this->reference = null;
        $this->setPanier(new Panier);
        $this->setClient($this->client['id']);
    }

    /**
    * Mets à jour la bdd insert/update
    * @return bool
    */
    protected function setBdd()
    {
        GLOBAL $db;

        // Si la commande a été annulée on n'ubdate pas la commande (Paybox n'accepte pas les doublons de paiement)
        if ($this->commande_id and $this->type_paiement == self::CB) {
            $commande = $db->query("SELECT * FROM commande WHERE id='".$db->escape($this->commande_id)."' AND pbx_erreur != '' ");
            if ($db->num_rows($commande) ){
                $this->commande_id = false;
            }
        }
        $client = $this->getClient();
        $date_insert = date('Y-m-d H:i:s');
        if (!$this->commande_id) {
            $requete="INSERT INTO commande SET
                client_id='".$db->escape($client['id'])."'
                ,date_insert='".$date_insert."'
                ,email='".$db->escape($client['email'])."'
                ,civilite='".$db->escape($client['civilite'])."'
                ,nom ='".$db->escape($client['nom'])."'
                ,prenom ='".$db->escape($client['prenom'])."'
                ,adresse ='".$db->escape($client['adresse'])."'
                ,cp ='".$db->escape($client['cp'])."'
                ,ville ='".$db->escape($client['ville'])."'
                ,pays ='".$db->escape($client['pays'])."'
                ,pays_autre ='".$db->escape($client['pays_autre'])."'
                ,telephone ='".$db->escape($client['telephone'])."'
                ,commentaire ='".$db->escape($client['commentaire'])."'
                ,livraison ='".$db->escape($this->getLivraison())."'
                ,liv_nom ='".$db->escape($client['liv_nom'])."'
                ,liv_prenom ='".$db->escape($client['liv_prenom'])."'
                ,liv_adresse ='".$db->escape($client['liv_adresse'])."'
                ,liv_cp ='".$db->escape($client['liv_cp'])."'
                ,liv_ville ='".$db->escape($client['liv_ville'])."'
                ,liv_pays='".$db->escape($client['liv_pays'])."'
                ,liv_telephone ='".$db->escape($client['liv_telephone'])."'
                ,liv_commentaire ='".$db->escape($client['liv_commentaire'])."'
                ,type_paiement ='".$db->escape($this->getTypePaiement())."'
                ,tht ='".$db->escape($this->getHt())."'
                ,tva ='".$db->escape($this->getTva())."'
                ,ttc ='".$db->escape($this->getTtc())."'
                ,frais_port ='".$db->escape($this->getFraisPort())."'
                ,apayer ='".$db->escape($this->getApayer())."'
                ,admin_commentaire = ''
                ,etat ='".$this->getEtat()."'
            ";
            $db->query($requete);
            $this->commande_id = $db->insert_id();

            // Création n° de reference commande d'aprés id  + enregistrement
            $this->reference = str_pad($this->commande_id, 8, '0', STR_PAD_LEFT);
            $requete="UPDATE commande SET
                        reference='".$this->reference."'
                        WHERE id='".$this->commande_id."'
            ";
            $db->query($requete);

        } else {
            // La commande a déja été confirmée par le client mais le paiement n'a pas été éffectué. (annulation, erreur...)
            $requete = "UPDATE commande SET
                client_id='".$db->escape($client['id'])."'
                ,date_insert='".$date_insert."'
                ,email='".$db->escape($client['email'])."'
                ,civilite='".$db->escape($client['civilite'])."'
                ,nom ='".$db->escape($client['nom'])."'
                ,prenom ='".$db->escape($client['prenom'])."'
                ,adresse ='".$db->escape($client['adresse'])."'
                ,cp ='".$db->escape($client['cp'])."'
                ,ville ='".$db->escape($client['ville'])."'
                ,pays ='".$db->escape($client['pays'])."'
                ,pays_autre ='".$db->escape($client['pays_autre'])."'
                ,telephone ='".$db->escape($client['telephone'])."'
                ,commentaire ='".$db->escape($client['commentaire'])."'
                ,livraison ='".$db->escape($this->getLivraison())."'
                ,liv_nom ='".$db->escape($client['liv_nom'])."'
                ,liv_prenom ='".$db->escape($client['liv_prenom'])."'
                ,liv_adresse ='".$db->escape($client['liv_adresse'])."'
                ,liv_cp ='".$db->escape($client['liv_cp'])."'
                ,liv_ville ='".$db->escape($client['liv_ville'])."'
                ,liv_pays='".$db->escape($client['liv_pays'])."'
                ,liv_telephone ='".$db->escape($client['liv_telephone'])."'
                ,liv_commentaire ='".$db->escape($client['liv_commentaire'])."'
                ,type_paiement ='".$db->escape($this->getTypePaiement())."'
                ,tht ='".$db->escape($this->getHt())."'
                ,tva ='".$db->escape($this->getTva())."'
                ,ttc ='".$db->escape($this->getTtc())."'
                ,frais_port ='".$db->escape($this->getFraisPort())."'
                ,apayer ='".$db->escape($this->getApayer())."'
                ,admin_commentaire = ''
                ,etat ='".$this->getEtat()."'
            WHERE id='".$this->commande_id."'
            ";
            $db->query($requete);
        }
        // Suppression des produits commandées associé a la commande (pour éviter les doublons)
        if ($this->commande_id) {
            $requete = $db->query("DELETE FROM cmd_produit WHERE commande_id='".$this->commande_id."'");
        }
        foreach ($this->panier->getProduits() as $key => $produit ) {
            // Insertion des lignes de commande dans la bdd
            $requete="INSERT INTO cmd_produit SET
                commande_id='".$this->commande_id."'
                ,produit_id='".$db->escape($produit['id'])."'
                ,produit_detail_id='".$db->escape($key)."'
                ,reference='".$db->escape($produit['reference'])."'
                ,produit_nom='".$db->escape($produit['nom'])."'
                ,detail_nom='".$db->escape($produit['condi'])."'
                ,prix='".$db->escape($produit['prix'])."'
                ,quantite='".$db->escape($produit['quantite'])."'
            ";
            $db->query($requete);
            if ($this->getTypePaiement() != self::CB) {
                // maj stocks
                $db->query("UPDATE produit_detail SET stock=stock-".$produit['quantite']."
                                WHERE id='".$key."'");
            }
        }
    }

    /**
    * Calcul la commande
    */
    protected function calcul()
    {
        $panier = $this->panier;
        if ($this->avec_tva) {
            $this->ht = $panier->getTotalHt();
            $this->tva = $panier->getTva();
        } else {
            $this->ht = $panier->getTotal();
            $this->tva = 0;
        }
        $this->ttc = $panier->getTotal();
        $this->apayer = $this->ttc + $this->getFraisPort();
    }

    /**
    * Récupére les informations du client
    * @param int $client_id
    * @return bool
    */
    public function setClient($client_id)
    {
        GLOBAL $db;
        $clt = $db->query("SELECT * FROM client WHERE id='".$db->escape($client_id)."'");
        if ($db->num_rows($clt) ){
            $this->client = $db->fetch_assoc($clt);
            $this->setLivraison($this->client['livraison']);
        } else {
            trigger_error("<<< Class Commande::setClient >>> Le client $client_id n'existe pas.", E_USER_WARNING);
            return false;
        }
    }

    /**
    * Setter de livraison
    * @param sting $livraison
    * TODO bug si le pays de livraison n'est pas renseigné (cas de l'enlévement)
    */
    protected function setLivraison($livraison)
    {
        GLOBAL $db;

        $client = $this->getClient();
        $this->livraison = $livraison;
        $this->frais_port = $this->fraisPort($this->livraison, $this->panier->getPoids(), $client['liv_pays']);
        $liv_pays = $db->query("SELECT tva
                                    FROM port_pays
                                    WHERE pays_id = '".$db->escape($client['liv_pays'])."'
                               ");
        if ($db->num_rows($liv_pays) ){
            $liv_pays = $db->fetch_assoc($liv_pays);
            $this->avec_tva = $liv_pays['tva'] != 'o' ? false : true;
        } else {
            trigger_error("<<< Class Commande::setLivraison >>> Le pays $livraison n'existe pas.", E_USER_NOTICE);
            return false;
        }
        $this->calcul();
    }

    /**
    * La commande est elle terminée ?
    * une commande est terminée quand etat = payé ou etat = Non payée and type_paiement != cb
    * Il est indispensable de faire la requete dans le cas du retour de la banque
    * @param bool
    */
    public function isTermine()
    {
        GLOBAL $db;

        if ($this->commande_id) {
            $result = $db->query("SELECT etat
                                    FROM commande
                                    WHERE id = '".$db->escape($this->commande_id)."'
                                        AND (etat IN (".self::ETAT_PAYE.", ".self::ETAT_TRAITE.")
                                            OR (etat = ".self::ETAT_CONFIRME." AND type_paiement != ".self::CB."))
                                 ");
            if ($db->num_rows($result)) {
                return true;
            }
        }
        return false;
    }

    /**
    * Calcul des frais de ports
    * @param string $livraison - id de livraison (transporteur)
    * @param string $poids - poid total de la commande en kg
    * @param string $pays_livraison - id du pays de livraison
    * @return string prix du transport
    */
    public static function fraisPort($livraison, $poids, $pays_livraison)
    {
        GLOBAL $db;

        $poids = $poids / 1000;
        // Récupération de la zone de livraison
        $liv_pays=$db->query("SELECT zone_id, tva FROM port_pays WHERE  pays_id='".$pays_livraison."' AND tarifs_id='".$livraison."'");
        $liv_pays = $db->fetch_assoc($liv_pays);

        // Calcul des frais de port
        // Vérifie si il y a une livraison (cas de l'enlévement)
        if (!empty($poids) OR $livraison == 0) {
           // Recherche la tranche de poids concernée
            $requete="SELECT id
                        FROM port_tranches
                        WHERE '".$poids."' > mini AND '".$poids."' <= maxi AND supp != 'o' AND tarifs_id='".$livraison."'
                     ";
            $tranche = $db->query($requete);

            if ($db->num_rows($tranche) ){
                // Le poids rentre dans une tranche
                $tranche = $db->fetch_assoc($tranche);
                // Recherche du tarif associé à la tranche
                $requete="SELECT montant
                        FROM port_frais
                        WHERE id_tranche = '".$tranche['id']."' AND id_tarif = '".$livraison ."' AND id_zone = '".$liv_pays['zone_id'] ."'
                     ";
                $frais = $db->query($requete);
                $frais = $db->fetch_assoc($frais);
                $port =  $frais['montant'];
            }
            else {
               // Recherche de la plus grande tranche et de son tarif
               $requete="SELECT t.id, t.maxi, f.montant
                           FROM port_frais f
                           INNER JOIN port_tranches t
                          WHERE f.id_tranche = t.id AND f.id_tarif = '".$livraison."' AND f.id_zone = '".$liv_pays['zone_id'] ."'
                           ORDER BY t.maxi DESC LIMIT 1
                        ";
                $maxi = $db->query($requete);
                $maxi = $db->fetch_assoc($maxi);
                //print_r($maxi);
                // Cas ou les tranches ne se suivent pas (erreur dans la table port_tranches )
                if ($poids < $maxi['maxi'])
                    return false;
                else {
                    // Cas du supplément
                    $requete="SELECT id, mini
                           FROM port_tranches
                           WHERE supp = 'o' AND tarifs_id='".$livraison."'
                        ";
                    $supp = $db->query($requete);
                    $supp = $db->fetch_assoc($supp);
                    // Recherche du tarif associé au supplément
                    $requete="SELECT montant
                           FROM port_frais
                           WHERE id_tranche = '".$supp['id']."' AND id_tarif = '".$livraison."' AND id_zone = '".$liv_pays['zone_id'] ."'
                        ";
                    $frais = $db->query($requete);
                    $frais = $db->fetch_assoc($frais);
                    // Calcul des tranches supplémentaires
                    if (!empty($frais['montant'])) {
                        $port = $maxi['montant'] + (ceil(($poids - $maxi['maxi'])/$supp['mini']) * $frais['montant']);
                    }
                    else $port = 0;
                    //echo '$maxi : '.$maxi['maxi'];
                    //echo '<br />prix maxi : '.$maxi['montant'];
               }
            }
         }
         else $port = 0;

        return $port;
    }

    // GETTERS //
    public function getClient()
    {
        return $this->client;
    }
    public function getLivraison()
    {
        return $this->livraison;
    }
    public function getPanier()
    {
        return $this->panier;
    }
    public function getFraisPort()
    {
        return $this->frais_port;
    }
    public function getEtat()
    {
        return $this->etat;
    }
    public function getTypePaiement()
    {
        return $this->type_paiement;
    }
    public function getHt()
    {
        return $this->ht;
    }
    public function getTva()
    {
        return $this->tva;
    }
    public function getTtc()
    {
        return $this->ttc;
    }
    public function getApayer()
    {
        return number_format($this->apayer, 2, '.', '');
    }
    public function getReference()
    {
        return $this->reference;
    }
    public function getCommandeId()
    {
        return $this->commande_id;
    }

    // SETTERS //
    public function setEtat($etat)
    {
        if(!is_int($etat)) {
            trigger_error("<<< Class Commande::setEtat >>> L'etat $etat n'est pas un entier.", E_USER_WARNING);
            return false;
        }
        $this->etat = $etat;
        switch ($etat) {
            case self::ETAT_CONFIRME :
            case self::ETAT_PAYE :
                $this->setBdd();
                break;
        }
    }
    public function setTypePaiement($type_paiement)
    {
        if(!is_numeric($type_paiement)) {
            trigger_error("<<< Class Commande::setTypePaiement >>> Le type_paiement $type_paiement n'est pas un entier.", E_USER_WARNING);
            return false;
        }
        $this->type_paiement = $type_paiement;
    }
    public function setPanier(Panier $panier)
    {
        $this->panier = $panier;
        $this->calcul();
    }

    /**
    * Mise en session de la commande
    * Method appellé automatique à l'extinction du script par register_shutdown_function
    */
    public function session()
    {
        $_SESSION['COMMANDE'] = $this;
    }
}