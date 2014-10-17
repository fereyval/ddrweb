<?php
/**
* Class Panier de Ipsum
*
*/
class Panier
{
    protected $total;
    protected $tva;
    protected $total_ht;
    protected $produits;
    protected $erreurs = false;
    protected $poids;
    protected $is_gestion_stock;

    const GESTION_STOCK = 1;
    
    /**
    * Constructor function.
    */
    public function __construct($is_gestion_stock = false)
    {
        $this->is_gestion_stock = $is_gestion_stock;
        $this->vide();
    }
    
    /**
    * Ajoute un produit au panier
    * Si la référence existe déja, elle est écrasée
    * @param int $reference_id
    * @param int $quantite
    * @return bool
    */
    public function addProduit($reference_id, $quantite)
    {
        GLOBAL $db;
        
        if (empty($quantite)) {
            return $this->delProduit($reference_id);
        }
        // Récupération des informations de la référence
        $detail = $db->query("
                                SELECT p.nom, p.id, p.tva, p.poids, pd.nom AS condi, pd.reference, pd.stock, pd.prix, pd.promo 
                                    FROM produit_detail pd
                                        INNER JOIN produit p
                                            ON p.id = pd.produit_id
                                    WHERE pd.id='".$db->escape($reference_id)."'
                                    LIMIT 1
                             ");
        if ($db->num_rows($detail)) {
            $detail = $db->fetch_assoc($detail);
            if(!is_numeric($quantite)) {
                $this->setErreur('La quantité du produit '.htmlXspecialchars($detail['nom']).' n\'est pas valide');
                return false;
            }
            if ($this->is_gestion_stock) {
                // Gestion du stock
                if ($detail['stock'] < $quantite) {
                    // Plus de stock pour ce produit, on mets au minimum la quantité
                    $this->setErreur('Le stock est insuffisant pour le produit '.$detail['nom'].' (réf : '.$detail['reference'].' '.$detail['condi'].'). La quantité maximum est '.$detail['stock'].'.');
                    if (empty($detail['stock'])) {
                        return false;
                    }
                    $quantite = $detail['stock'];
                }
            }
            $detail['prix_old'] = empty($detail['promo']) ? false : $detail['prix'];
            $detail['prix'] = empty($detail['promo']) ? $detail['prix'] : $detail['promo'];
            $detail['quantite'] = $quantite;
            $detail['montant'] = $detail['prix'] * $quantite;
            // Prix TTC = Prix HT * ( 1 + TVA/100 )
            // Prix HT = Prix TTC / ( 1 + TVA/100 )
            $detail['montant_ht'] = $detail['montant'] / (1 + ($detail['tva'] / 100));
            $detail['montant_tva'] = $detail['montant'] - $detail['montant_ht'];
            $detail['poids'] = $detail['poids'] * $quantite;
            $this->produits[$reference_id] = $detail;
            $this->calcul();
            return true;
        } else {
            return false;
        }
    }

    /**
    * Ajoute des produits au panier
    * @param array $produits = array(reference_id => quantite)
    * @return bool
    */
    public function addProduits(array $produits)
    {
        foreach ($produits as $reference_id => $quantite) {
            $this->addProduit($reference_id, $quantite);
        }
    }
    
    /**
    * Supprime un produit du panier
    * @param int $reference_id
    * @return bool
    */
    public function delProduit($reference_id)
    {
        if (isset($this->produits[$reference_id])) {
            unset($this->produits[$reference_id]);
            $this->calcul();
            return true;
        } else {
            return false;
        }
    }
    
    /**
    * Calcul le Panier
    */
    protected function calcul()
    {
        $this->total = $this->tva = $this->total_ht = $this->poids = 0;
        foreach($this->produits as $produit) {
            $this->total += $produit['montant'];
            $this->tva += $produit['montant_tva'];
            $this->total_ht += $produit['montant_ht'];
            $this->poids += $produit['poids'];
        }
    }           

    /**
    * Nombre de produit dans le panier
    * @return int nombre de produit
    */
    public function nbProduits()
    {
        return count($this->produits);
    }
            
    /**
    * Vide le panier
    */
    public function vide()
    {
        $this->total = 0;
        $this->tva = 0;
        $this->total_ht = 0;
        $this->produits = array();
        $this->poids = 0;
    }

    /**
    * Getter de total
    * @return double $total
    */
    public function getTotal()
    {
        return $this->total;
    }

    /**
    * Getter de tva
    * @return double $tva
    */
    public function getTva()
    {
        return $this->tva;
    }
    
    /**
    * Getter de total_ht
    * @return double $total_ht
    */
    public function getTotalHt()
    {
        return $this->total_ht;
    }
        
    /**
    * Getter de produits
    * @return array $produits
    */
    public function getProduits()
    {
        return $this->produits;        
    }
    
    /**
    * Getter de poids
    * @return double $poids
    */
    public function getPoids()
    {
        return $this->poids;
    }
    
    /**
    * Getter de erreurs
    * @return array $erreurs
    */
    public function getErreurs()
    {
        $erreurs = $this->erreurs;
        $this->erreurs = false;
        return $erreurs;
    }
    /**
    * Setter de erreurs
    * @param sting $erreur
    */
    public function setErreur($erreur)
    {
        $this->erreurs[] = $erreur;        
    }
    
    /**
    * Mise en session du panier
    * Method appellé automatique à l'extinction du script par register_shutdown_function
    */
    public function session()
    {
        $_SESSION['PANIER'] = $this;        
    }
}