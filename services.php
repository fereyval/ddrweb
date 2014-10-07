<?php
if (!defined('ROOT'))
	define('ROOT', './');
require ROOT.'config/common.php';

// Variables d'entete
$rubrique = 'services';
$title = "les services";
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

<div role="main" class="texte" style="z-index:1; position: relative;">
	<div class="slideshow">
         <div class="slideshow_cadre">
                <div id="slide" class="slide" >
					<img src="composants/slider-1.jpg"  width="1080" height="478"  style="z-index:-1"/> 
                </div>
         </div>
	</div><!-- Fin slide //-->
</div>

<div role="main" class="texte2 pam" style="z-index:99; position: relative;">
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

<div role="main" class="texte3 pam">
    <div class="conteneur center plm">
        <h2 class="title-h2 txtcenter"><span>Formule</span> Simple</h2>
        <p>
            Dans cette formule vous avez les choix avec 3 maquettes graphiques de sites internets déjà pré concus. Vous n'avez qu'à fournir les photos, le texte et le thème désiré pour que votre site internet soit prêt en un rien de temps et à prix mini! Vous avez donc les choix entre ces 3 modèles ci-dessous:</p>
        </p>
        <div class="row pts">
            <div class="col w33 pam">
                <img src="styles/last/ddrweb2.jpg" alt="" class="forms">
            </div>
            <div class="col w33 pam" >
                <img src="styles/last/ddrweb2.jpg" alt="" class="forms">
            </div>
            <div class="col w33 pam" >
                <img src="styles/last/ddrweb2.jpg" alt="" class="forms">
                <a class="myButton right mts" style="color:white;" href="conditions.php">Souscrire à l'offre</a>
            </div>
        </div>
        <h2 class="title-h2 txtcenter"><span>Formule</span> Premium</h2>
        <p>Cette formule est une formule All inclusive elle comprend toute les étapes necessaires à la création d'un site à votre image.<p>
        <p>En souscrivant à cette formule vous aurez droit à :</p>
        <ul class="avant">
            <li>Frais de dossier</li>
            <li>Maquette graphique</li>
            <li>Suivi continu de l'avancement du site</li>
            <li>Intégration</li>
            <li>Développement</li>
            <li>Un nom de domaine personnalisé</li>
            <li>Une base de donnée</li>
            <li>Un hébergement chez OVH</li>
            <a class="myButton right mts" style="color:white;" href="conditions.php">Souscrire à l'offre</a>
            <li>Un référencement de qualité</li>
        </ul>
    </div>
</div>

<div role="main" class="texte6 pam">
	<div class="conteneur center">
		<div class="accordion" id="for2">
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

<?php include("include/baspage.php"); ?>