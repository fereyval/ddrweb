<?php
if (!defined('ROOT'))
	define('ROOT', './');
require ROOT.'config/common.php';

// Tests des variables du formulaire
if (isset($_POST['submit'])) {
    if (empty($_POST['age'])) {
        // Controle des saisies
        $errors = new Errors($_POST, 'saisie');
        $errors->add("Le nom est obligatoire.", 'nom', 'notEmpty');
        $errors->add("L'email est obligatoire.", 'email', 'notEmpty');
        $errors->add("L'email n'est pas valide.", 'email', 'isMail');
        $errors->add('Le message est obligatoire.', 'message', 'notEmpty');
        $msg->adds('e', $errors->invalid());

        // Envoie de l'email
        if (!$msg->hasErrors()) {
            $message =
                    "Nom : ".$_POST['nom']."\n".
                    "Prénom : ".$_POST['prenom']."\n".
                    "E-mail : ".$_POST['email']."\n".
                    "Téléphone : ".$_POST['telephone']."\n".
                    "Message : ".$_POST['message']."\n";

            if (MAIL_TEST != '') {
                $resultat=sendMail( MAIL_TEST, $_POST['nom'].' '.$_POST['prenom'], $_POST['email'], MAIL_OBJET, $message);
            }
            $resultat=sendMail( MAIL_TO,   $_POST['nom'].' '.$_POST['prenom'], $_POST['email'], MAIL_OBJET, $message);

            if($resultat != 1) {
                $msg->adds('e', 'Votre message<strong>n\'a pas été envoyé</strong>');
            } else {
                $msg->add('s', 'Votre message <strong>a été envoyé</strong>');
                unset($_POST);
            }
        }
    }
    else {
        $msg->adds('e', 'Le champ <strong>age</strong> ne doit pas être renseigné', 'age');
    }
}

// Variables d'entete
$rubrique = 'contact';
$title = "Contact";
$description = "";
$head = '
<style type="text/css">
.s_kill { display: none; }
</style>';
$javascript = '<script src=javascripts/jquery.b1njAccordion.js></script>
    <script>
        $(function() {
            $(".accordion").b1njAccordion({
                header      : "p",
                conteneur   : "div",
            });
        });
    </script>
    <script type="text/javascript">
        function change()
        {
         a = document.getElementById("test").getAttribute("src");
         if (a=="styles/btn.png") {
                      document.getElementById("test").src="styles/btn2.png";
                  }
 
                  else {
                 document.getElementById("test").src="styles/btn.png";
                  }
        }
        </script>';
include("include/entete.php");
?>
<div role="main" class="texte plm">
	<div class="conteneur center pam">
        <div class="separation mls" style="border-left: 4px solid black;padding-left:10px;">
            <p class="mini-menup">Contact</p>
            <ul class="mini-menu">
                <li><a href="#bvn">Coordonnées</a></li>
                <li><a href="#map">Géolocalisation</a></li>
                <li><a href="#for">Envoyer un message</a></li>
            </ul>
        </div>
        <div class="sociaux">
            <ul class="sociaux-liste">
				<li><a href="https://www.facebook.com/fereyva"><img src="composants/facebook.png" alt="Facebook"></a></li>
				<li><a href="https://twitter.com/Firely23"><img src="composants/twitter.png" alt="Twitter"></a></li>
				<li><a href="https://github.com/firely23"><img src="composants/linkedin.png" alt="Linkedin"></a></li></ul>
        </div>
    </div>
</div>

<div role="main" class="texte2 plm ptm">
	<div class="conteneur center plm">
		<div class="row pts">
			<div class="caracteristiques col w70 pam" >
				<h2 class="mll title-h2" id="for"><span>Envoyez-nous</span> un message</h2>
				<div  class="mll">
				<?php echo $msg->display('all', true, false); ?>
				<form class="saisie2" method="post" action="?">
					<p <?php  echo $msg->hasErrors('nom') ? 'class="form_erreur"' : '' ?>>
						<label for="nom" class="oblig" >Nom </label>
						<input name="nom" id="nom" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['nom']) ? $_POST['nom'] : '')?>">
					</p>
					<p>
						<label for="prenom">Prénom</label>
						<input name="prenom" id="prenom" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['prenom']) ? $_POST['prenom'] : '')?>">
					</p>
					<p class="s_kill">
						<label for="age">Age</label>
						<input name="age" id="age" type="text" value="">
					</p>
					<p <?php  echo $msg->hasErrors('email') ? 'class="form_erreur"' : '' ?>>
						<label for="email" class="oblig" >Courriel </label>
						<input name="email" id="email" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['email']) ? $_POST['email'] : '')?>">
					</p>
					<p>
						<label for="telephone">Téléphone </label>
						<input name="telephone" id="telephone" type="text" value="<?php echo htmlXspecialchars(!empty($_POST['telephone']) ? $_POST['telephone'] : '')?>">
					</p>
					<p <?php  echo $msg->hasErrors('message') ? 'class="form_erreur"' : '' ?>>
						<label for="message" class="oblig" >Message</label>
						<textarea name="message"  id="message" cols="40" rows="5" ><?php echo htmlXspecialchars(!empty($_POST['message']) ? $_POST['message'] : '')?></textarea>
					</p>
					<p>
						<label for="submit">&nbsp;</label>
						<input name="submit" id="submit" class="envoyer_mail" type="submit" value="Envoyer">
					</p>
				</form>
				</div>
			</div>
            <div class="caracteristiques col w30 pam" >
				<h2 class="title-h2" id="bvn"><span>Nos</span> coordonnées</h2>
				<div class="vcard">
					<div class="txtleft mll mts">
					<p>
						<strong class="fn"><?php echo SOC_NOM ?></strong>
					</p>
					<p>
						<strong>Adresse :</strong><br>
						<span class="street-address"><?php echo SOC_ADRESSE ?></span><br>
						<span class="postal-code"><?php echo SOC_CP ?></span> - <span class="locality"><?php echo SOC_VILLE ?></span><br>
						<strong>Téléphone :</strong> <span class="tel"><?php echo SOC_TEL ?></span><br>
						<strong>Courriel :</strong> <span class="email"><?php echo mailAntiSpam(SOC_EMAIL) ?></span>
					</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div role="main" class="texte3 pam">
	<div class="conteneur center">
		<div class="mll">
			<iframe id="map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2779.4914838197215!2d5.027704399999999!3d45.8414621!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4b9ba9b8f37af%3A0xa6d368918897b3a9!2s53+Rue+de+Pr%C3%A9+Mayeux%2C+01120+La+Boisse%2C+France!5e0!3m2!1sfr!2s!4v1411669244727" width="960" height="500" frameborder="0" style="border:0"></iframe>
		</div>
	</div>
</div>

<div role="main" class="texte4 pam">
	<div class="conteneur center">
		<div class="conteneur center pam" style="border: 1px solid white;">
            <div class="box">
                <img src="composants/icondev.png" alt="developpement" class="iconbar"/>
                <p class="title-p"><span>D</span>eveloppement</p>
            </div>
            <div class="box">
                <img src="composants/iconpaint.png" alt="developpement" class="iconbar" style="padding-left:50px;"/>
                <p class="title-p" style="text-align:left; padding-left:60px;"><span>D</span>esign</p>
            </div>
            <div class="box">
                <img src="composants/inconref.png" alt="developpement" class="iconbar"/>
                <p class="title-p"><span>R</span>eferencement</p>
            </div>
        </div>
	</div>
</div>

<div role="main" class="texte6 pam">
	<div class="conteneur center">
		<div class="accordion" id="for">
            <img src="styles/button.png" class="pad2"/>
			<p class="mbm mll fuck accordion-titre"><a style="color:#FFFFFF" class="bouton2"><img src="styles/btn.png" id="test" onclick="change();" class="pad"/>Pour démarrer un contrat, cliquez ici</a></p>
			<div class="formulaire1">
				<form method="post" action="contact.php">
					<p class="form-style" >Nom : <input type="text" name="nom" /></p>
				</form><br>
				<form method="post" action="contact.php">
					<p class="form-style">Prénom : <input type="text" name="prenom" /></p>
				</form><br>
				<form method="post" action="contact.php">
					<p class="form-style">E-mail : <input type="email" placeholder="Ex : test@hotmail.fr" name="email" /></p>
				</form><br>
				<a href="conditions.php"><input type="submit" value="Continuer" /></a>
			</div>
		</div>
	</div>
</div>
<?php
$msg->clear();
include("include/baspage.php");
?>