<!doctype html>
<head>
    <meta charset="iso-8859-15">
    <meta name="description" content="<?php echo $description; ?>">
    <link rel="stylesheet" type="text/css" href="styles/knacss.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
	<link href="styles/jquery.bxslider.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles/portfolio.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="styles/feature-carousel.css" charset="utf-8" />
	<script type='text/javascript' src='javascripts/jquery-1.7.2.min.js'></script>
	<link rel="icon" type="jpg" href="composants/favicon.png">
<?php
if (!defined('ROOT'))
    define('ROOT', './');
require ROOT.'config/common.php';

// Tests des variables du formulaire
if (isset($_POST['submit'])) {
    // Controle des saisies
    $errors = new Errors($_POST, 'saisie');
    $errors->add("Le nom est obligatoire.", 'nom', 'notEmpty');
    $errors->add("Le pr�nom est obligatoire.", 'prenom', 'notEmpty');
    $errors->add("L'adresse est obligatoire.", 'adresse', 'notEmpty');
    $errors->add("La ville est obligatoire.", 'ville', 'notEmpty');
    $errors->add("Le code postal est obligatoire.", 'cp', 'notEmpty');
    $errors->add("L'email est obligatoire.", 'email', 'notEmpty');
    $errors->add("L'email n'est pas valide.", 'email', 'isMail');
    $errors->add("Merci de s�l�ctionner un type de contrat", 'contrat', 'notEmpty');
    $errors->add("Vous n'avez pas fait de d�scription.", 'desc', 'notEmpty');
    $errors->add("Veuillez accepter les conditions de vente.", 'condition', 'notEmpty');
    $errors->add("Vous n'avez pas indiqu� votre status social.", 'classe', 'notEmpty');
    $msg->adds('e', $errors->invalid());

    // Envoie de l'email
    if (!$msg->hasErrors()) {
        if (!checkIfSpambot($_POST['email'], $_SERVER['REMOTE_ADDR'], $_POST['nom'], 30)) {
            $message =                   
                    "Civilit� : ".$_POST['civilite']."\n".
                    "Nom : ".$_POST['nom']."\n".
                    "Pr�nom : ".$_POST['prenom']."\n".
                    "T�l�phone fixe : ".$_POST['fixe']."\n".
                    "T�l�phone portable : ".$_POST['portable']."\n".
                    "Fax : ".$_POST['fax']."\n".
                    "Adresse Postale : ".$_POST['adresse']."\n".
                    "Ville : ".$_POST['ville']."\n".
                    "Code postal : ".$_POST['cp']."\n".
                    "E-mail : ".$_POST['email']."\n".
                    "Statut social : ".$_POST['classe']."\n".
                    "Soci�t� : ".$_POST['soc']."\n".
                    "Activit� : ".$_POST['activite']."\n".
                    "Type de site : ".$_POST['type']."\n".
                    "Usage : ".$_POST['util']."\n".
                    "Type de contrat : ".$_POST['contrat']."\n".
                    "Nom de domaine : ".$_POST['dom']."\n".
                    "Description : ".$_POST['desc']."\n".
                    "Condition accept� : ".$_POST['condition']."\n";
					

            $resultat=sendMail( MAIL_TO, $_POST['nom'], $_POST['email'], 'Ouverture dun dossier DDRWEB', $message);

            if($resultat != 1) {
                $msg->add('e', 'Votre demande <strong>n\'a pas �t� envoy�e une erreur est survenue.</strong>');
            } else {
                $msg->add('s', 'Votre demande <strong>a �t� envoy�e avec succ�s! Nous accuserons r�ception de votre demande sous 24h.</strong>');
                unset($_POST);
            }
        } else {
            $msg->add('e', 'Vous avez �t� detect� comme spammeur');
        }
    }
}

// Variables d'entete
$rubrique = '';
$title = "Ouverture d'un dossier";
$description = "";
$head = '';
$javascript = '<script src=javascripts/jquery.b1njAccordion.js></script>
    <script>
        $(function() {
            $(".accordion").b1njAccordion({
                header      : "p",
                conteneur   : "div",
            });
        });
    </script>';
?>
</head>
<body style="background-color:#2ba9d9;">
<div class="conteneur center pam" style="background-color:white; min-height:1080px;">
    <a href="index.php"><img src="composants/logo.png" style="min-height:100px;" class="left"></a>
    <h1 class="right">FORMULAIRE</h1><br><br><br><br><br><br>
    <h2 class="title-h2 mtl ptl"><span>Ouverture</span> d'un dossier chez DDR Web</p></h2>
    <form class="saisie myform" method="post" action="?">
        <?php echo $msg->display('all', true, false); ?>
		<div class="row pts">
			<div class="col w50">
				<fieldset>
					<legend class="title-h3" style="font-weight:bold; font-style:italic;"><span>Informations Client :</span></legend>
					<p class="radio">
						<label for="civilite">Civilit� :</label>
						<span>
							<label><input name="civilite" id="civilite" type="radio" value="Monsieur" <?php echo (!empty($_POST['civilite']) and $_POST['civilite'] == 'Monsieur') ? 'checked="checked"' : '' ?>>Monsieur</label>
							<br><label><input style="margin-left:58px;" name="civilite" type="radio" value="Madame" <?php echo (!empty($_POST['civilite']) and $_POST['civilite'] == 'Madame') ? 'checked="checked"' : '' ?>>Madame</label>
						</span>
					</p>
					<p <?php  echo $msg->hasErrors('nb_foyer') ? 'class="form_erreur"' : '' ?>>
						<label for="nom" >* Nom </label>
						<input name="nom" id="nom" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['nom']) ? $_POST['nom'] : '')?>">
					</p>
					<p <?php  echo $msg->hasErrors('prenom') ? 'class="form_erreur"' : '' ?>>
						<label for="prenom" >* Pr�nom </label>
						<input name="prenom" id="prenom" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['prenom']) ? $_POST['prenom'] : '')?>">
					</p>
					<p>
						<label for="fixe" >T�l�phone fixe </label>
						<input name="fixe" id="fixe" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['fixe']) ? $_POST['fixe'] : '')?>">
					</p>
					<p>
						<label for="portable" >T�l�phone portable </label>
						<input name="portable" id="portable" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['portable']) ? $_POST['portable'] : '')?>">
					</p>
					<p>
						<label for="fax" >Fax </label>
						<input name="fax" id="fax" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['fax']) ? $_POST['fax'] : '')?>">
					</p>
					<p <?php  echo $msg->hasErrors('adresse') ? 'class="form_erreur"' : '' ?>>
						<label for="adresse">* Adresse Postale</label>
						<textarea name="adresse"  id="adresse" cols="30" rows="2" ><?php echo htmlXspecialchars(!empty($_POST['adresse']) ? $_POST['adresse'] : '')?></textarea>
					</p>
					<p <?php  echo $msg->hasErrors('ville') ? 'class="form_erreur"' : '' ?>>
						<label for="ville">* Ville </label>
						<input name="ville" id="ville" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['ville']) ? $_POST['ville'] : '')?>">
					</p>
					<p <?php  echo $msg->hasErrors('cp') ? 'class="form_erreur"' : '' ?>>
						<label for="cp" >* Code postal </label>
						<input name="cp" id="cp" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['cp']) ? $_POST['cp'] : '')?>">
					</p>
					<p <?php  echo $msg->hasErrors('email') ? 'class="form_erreur"' : '' ?>>
						<label for="email">* E-mail </label>
						<input name="email" id="email" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['email']) ? $_POST['email'] : '')?>">
					</p>
					<p <?php  echo $msg->hasErrors('classe') ? 'class="form_erreur"' : '' ?> class="radio">
						<label for="classe">* Vous �tes un:</label>
						<span>
							<label><input name="classe" id="classe" type="radio" value="professionnel" <?php echo (!empty($_POST['classe']) and $_POST['classe'] == 'professionnel') ? 'checked="checked"' : '' ?>>Professionnel</label>
							<br><label><input style="margin-left:106px;" name="classe" type="radio" value="particulier" <?php echo (!empty($_POST['classe']) and $_POST['classe'] == 'particulier') ? 'checked="checked"' : '' ?>>Particulier</label>
						</span>
					</p>
				</fieldset>
			</div>
			<div class="col w50">
				<fieldset>
					<legend class="title-h3" style="font-weight:bold; font-style:italic;"><span>Renseignement sur le site</span></legend>
					<p <?php  echo $msg->hasErrors('contrat') ? 'class="form_erreur"' : '' ?> class="radio">
						<label for="contrat">* Type de contrat souhaiter</label>
						<span>
							<label><input name="contrat" id="contrat" type="radio" value="simple" <?php echo (!empty($_POST['contrat']) and $_POST['contrat'] == 'simple') ? 'checked="checked"' : '' ?>>Formule simple</label>
							<br><label><input style="margin-left:182px;" name="contrat" type="radio" value="premium" <?php echo (!empty($_POST['contrat']) and $_POST['contrat'] == 'premium') ? 'checked="checked"' : '' ?>>Formule Premium</label>
							<br><label><input style="margin-left:182px;" name="contrat" type="radio" value="transfert" <?php echo (!empty($_POST['contrat']) and $_POST['contrat'] == 'transfert') ? 'checked="checked"' : '' ?>>Transfert de dossier</label>
						</span>
					</p>
					<p>
						<label for="dom">Nom de domaine souhait�</label>
						<input name="dom" id="dom" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['dom']) ? $_POST['dom'] : '')?>">
					</p>
					<p <?php  echo $msg->hasErrors('desc') ? 'class="form_erreur"' : '' ?>>
						<label for="desc">* Breve description du site</label>
						<textarea name="desc"  id="desc" cols="40" rows="2" ><?php echo htmlXspecialchars(!empty($_POST['desc']) ? $_POST['desc'] : '')?></textarea>
					</p>
				</fieldset>
				<fieldset>
					<legend class="title-h3" style="font-weight:bold; font-style:italic;"><span>A remplir si vous �tes un Professionnel:</span></legend>
					<p>
						<label for="soc">Nom de la soci�t�</label>
						<input name="soc" id="soc" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['soc']) ? $_POST['soc'] : '')?>">
					</p>
					<p>
						<label for="activite" >Secteur d'activit�</label>
						<input name="activite" id="activite" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['activite']) ? $_POST['activite'] : '')?>">
					</p>
					<p>
						<label for="type">Type de site internet (boutique, blog, ...) </label>
						<input name="type" id="type" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['type']) ? $_POST['type'] : '')?>">
					</p>		
				</fieldset>
				<fieldset>		
					<legend class="title-h3" style="font-weight:bold; font-style:italic;"><span>A remplir si vous �tes un Particulier:</span></legend>
					<p>
						<label for="type">Type de site internet (boutique, blog, ...) </label>
						<input name="type" id="type" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['type']) ? $_POST['type'] : '')?>">
					</p>
					<p>
						<label for="util">Type d'usage du site internet</label>
						<input name="util" id="util" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['util']) ? $_POST['util'] : '')?>">
					</p>	
				</fieldset>
			</div>
		</div>
		<br>
		<p <?php  echo $msg->hasErrors('condition') ? 'class="form_erreur"' : '' ?> class="radio">
			<label for="contrat">* J'accepte les <a href="http://www.economie.gouv.fr/dgccrf/Publications/Vie-pratique/Fiches-pratiques/Conditions-generales-de-vente">conditions de ventes</a></label>
			<span>
				<label><input name="condition" id="condition" type="checkbox" value="accepter" <?php echo (!empty($_POST['condition']) and $_POST['condition'] == 'accepter') ? 'checked="checked"' : '' ?>></label>
			</span>
		</p>
		<br>
		<p class="txtleft mtm">
			<input name="submit" id="submit" class="bouton" type="submit" value="Envoyer">
		</p>
			<p style="font-style:italic;" class="right">* Champs obligatoires</p>
	</form>
			
</div>
<?php $msg->clear();?>
<?php include("include/baspage.php"); ?>
</body>


