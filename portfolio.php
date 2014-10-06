<?php
if (!defined('ROOT'))
	define('ROOT', './');
require ROOT.'config/common.php';

// Variables d'entete
$rubrique = 'portfolio';
$title = "Mes Projets";
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

<div role="main" class="texte plm">
	<div class="conteneur center pam">
        <div class="separation mls" style="border-left: 4px solid black;padding-left:10px;">
            <p class="mini-menup">Portfolio</p>
            <ul class="mini-menu">
                <li><a href="#bvn">Mes projets</a></li>
                <li><a href="#for">Formulaire et mentions légales</a></li>
            </ul>
        </div>
        <div class="sociaux">
            <ul class="sociaux-liste">
                <li><a href="https://www.facebook.com/fereyva"><img src="composants/facebook.png" alt="Facebook"></a></li>
				<li><a href="https://twitter.com/Firely23"><img src="composants/twitter.png" alt="Twitter"></a></li>
				<li><a href="https://github.com/firely23"><img src="composants/linkedin.png" alt="Linkedin"></a></li>
				</ul>
        </div>
    </div>
</div>

<div role="main" class="textportfolio plm ptm">
	<div class="conteneur center plm">
		<div class="carrousel">
			<ul class="lel" style="padding-left: 0px;">
				<li style="text-decoration:none; list-style-type:none;">
					<div class="diapo">
						<div class="box2">
							<img src="composants/diapo1.jpg" alt="" class="diapo-img" id="bvn">
						</div>
						<div class="box3">
							<h3>Ceci est mon portfolio!</h3>
							<p>Vous découvrirez ici tout les projets que j'ai pu réaliser ou ceux auquels j'ai contribué, ainsi qu'une brêve description de leurs fonctionnalitées. Ils y a des projets dans plusieurs langages comme les languages du web, le C, le C++ et des maquettes graphiques en photoshop / firework.</p>
                         </div>
					</div>
				</li>
            </ul>
        </div>
	</div>
</div>    

<div role="main" class="texte2portfolio pam">
	<div class="conteneur center">
        <h3 class="title-h3">- <span>Filtrer</span> nos projets -</h3>
        <ul id="portfolio-filter" class="txtcenter">
			<li><a href="#all" title="">Tous</a></li>
			<li><a href="#web" title="" rel="design">Html / css / php / js</a></li>
			<li><a href="#wp" title="" rel="partner">Wordpress</a></li>
			<li><a href="#c" title="" rel="political">Projets en C</a></li>
            <li><a href="#cplus" title="" rel="political">Projets en C++</a></li>
            <li><a href="#photo" title="" rel="political">Projets photoshop</a></li>
		</ul>
    </div>
</div>


<div role="main" class="texte3portfolio pam">
	<div class="conteneur center" id="slides">
        <ul id="portfolio-list" class="txtcenter" style=" margin-left:60px;">
            <li style="display: block;" class="web">
                <div style="width:164px;height:121px;" class="slide-left" >
                <a href="sites/bijoudexpo/index.html" style="text-decoration:none"><p><b>Un bijou d'expo:</b><br><br> Ce site à été fait dans le cadre d'une recherche de stage. Il présente une exposition de bijou ayant eu lieu à Reims le 18/06/14.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio1.jpg" alt=""></a>
                </div>
            </li>
            
            <li style="display: block;" class="web">
                <div style="width:164px;height:121px;" class="slide-right" >
                <a href="sites/mapremierepage/index2.html" style="text-decoration:none"><p><b>Projet Epiweb:</b><br><br>Cette page d'acceuil est mon premier projet. Fait exclusivement de html et css après une semaine d'apprentissage.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio2.jpg" alt=""></a>
                </div>
            </li> 
            
            <li style="display: block;" class="c">
                <div style="width:164px;height:121px;" class="slide-down" >
                <a href="sites/bijoudexpo/index.html" style="text-decoration:none"><p><b>Minishell 1</b><br><br>Projet d'Epitech réalisé exclusivement en C qui est le debut d'un terminal linux (fonctions cd / pwd / ls).</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio3.jpg" alt=""></a>
                </div>
            </li> 
            
            <li style="display: block;" class="photo">
                <div style="width:164px;height:121px;" class="slide-up" >
                <a href="my_site.fw.png" style="text-decoration:none"><p><b>Maquette Photoshop:</b><br><br> Maquette originale de ce site faite sur photoshop.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio4.jpg" alt=""></a>
                </div>
            </li>
            
            <li style="display: block;" class="wp">
                <div style="width:164px;height:121px;" class="slide-down-left" >
                <a href="http://sniper92coc.url.ph/" style="text-decoration:none"><p><b>Un site pour un jeu</b><br><br> Ce site à été fait avec wordpress pour un ami qui voulais juste un simple blog pour un jeu.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio5.jpg" alt=""></a>
                </div>
            </li>
            
            <li style="display: block;" class="web">
                <div style="width:164px;height:121px;" class="slide-down-right" >
                <a href="http://inkcaraibes-mq.com/" style="text-decoration:none"><p><b>Ink'martinique</b><br><br> Site réalisé pendant mon stage de 4 mois chez Pixell Martinique.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio6.jpg" alt=""></a>
                </div>
            </li> 
            
            <li style="display: block;" class="c">
                <div style="width:164px;height:121px;" class="slide-up-left" >
                <a href="sites/bijoudexpo/index.html" style="text-decoration:none"><p><b>Raytracer</b><br><br>Gros projet d'Epitech réalisé par groupe de 6, language informatique : C.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio7.jpg" alt=""></a>
                </div>
            </li> 
            
            <li style="display: block;" class="web">
                <div style="width:164px;height:121px;" class="slide-left" >
                <a href="http://antilles-recouvrement.com/" style="text-decoration:none"><p><b>Antille Recouvrement</b><br><br> Site réalisé pendant mon stage de 4 mois chez Pixell Martinique.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio8.jpg" alt=""></a>
                </div>
            </li>
            
            <li style="display: block;" class="c">
                <div style="width:164px;height:121px;" class="slide-right" >
                <a href="" style="text-decoration:none"><p><b>Minitalk</b><br><br>Projet d'Epitech en C consistant a faire communiquer 1 serveur et 1 client.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio9.jpg" alt=""></a>
                </div>
            </li> 
            
            <li style="display: block;" class="photo">
                <div style="width:164px;height:121px;" class="slide-down" >
                <a href="sites/fireframe.png" style="text-decoration:none"><p><b>Fireframe</b><br><br> Ceci est le fireframe d'un site fait sous fireworks un logiciel de Adobe Suite.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio10.jpg" alt=""></a>
                </div>
            </li> 
            
            <li style="display: block;" class="web">
                <div style="width:164px;height:121px;" class="slide-up" >
                <a href="sites/bijoudexpo/index.html" style="text-decoration:none"><p><b>Océanes Finances</b><br><br> Un premier vrai beau site auquel j'ai contribuer dans son intégration durant mon stage chez Pixell Martinique.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio11.jpg" alt=""></a>
                </div>
            </li>
            
            <li style="display: block;" class="c">
                <div style="width:164px;height:121px;" class="slide-down-left" >
                <a href="sites/bijoudexpo/index.html" style="text-decoration:none"><p><b>Le 42sh</b><br>Il est le plus gros projet Epitech de 1ère année, dans la continuitée du minishell il s'agit d'un terminal linux fait maison avec (presque) toute ces fonctionalitées.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio12.jpg" alt=""></a>
                </div>
            </li>
			
            <li style="display: block;" class="web">
                <div style="width:164px;height:121px;" class="slide-up-right" >
                <a href="http://www.ddrweb.fr/" style="text-decoration:none"><p><b>DDR Web</b><br><br> C'est le site sur lequel vous êtes il fut créer par moi et moi seul pendant ma periode de stage.</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio13.jpg" alt=""></a>
                </div>
            </li>
			
            <li style="display: block;" class="">
                <div style="width:164px;height:121px;" class="slide-down-right" >
                <a href="404.html" style="text-decoration:none"><p><b> Emplacement vide</b><br><br> Devenez client pour que votre site apparaisse ici!</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio14.jpg" alt=""></a>
                </div>
            </li> 
			
			<li style="display: block;" class="">
                <div style="width:164px;height:121px;" class="slide-down-right" >
                <a href="404.html" style="text-decoration:none"><p><b> Emplacement vide</b><br><br> Devenez client pour que votre site apparaisse ici!</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio14.jpg" alt=""></a>
                </div>
            </li> 
			
			<li style="display: block;" class="">
                <div style="width:164px;height:121px;" class="slide-down-right" >
                <a href="404.html" style="text-decoration:none"><p><b> Emplacement vide</b><br><br> Devenez client pour que votre site apparaisse ici!</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio14.jpg" alt=""></a>
                </div>
            </li> 
			
			<li style="display: block;" class="">
                <div style="width:164px;height:121px;" class="slide-down-right" >
                <a href="404.html" style="text-decoration:none"><p><b> Emplacement vide</b><br><br> Devenez client pour que votre site apparaisse ici!</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio14.jpg" alt=""></a>
                </div>
            </li> 
			
			<li style="display: block;" class="">
                <div style="width:164px;height:121px;" class="slide-down-right" >
                <a href="404.html" style="text-decoration:none"><p><b> Emplacement vide</b><br><br> Devenez client pour que votre site apparaisse ici!</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio14.jpg" alt=""></a>
                </div>
            </li> 
			
			<li style="display: block;" class="">
                <div style="width:164px;height:121px;" class="slide-down-right" >
                <a href="404.html" style="text-decoration:none"><p><b> Emplacement vide</b><br><br> Devenez client pour que votre site apparaisse ici!</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio14.jpg" alt=""></a>
                </div>
            </li> 
			
			<li style="display: block;" class="">
                <div style="width:164px;height:121px;" class="slide-down-right" >
                <a href="404.html" style="text-decoration:none"><p><b> Emplacement vide</b><br><br> Devenez client pour que votre site apparaisse ici!</p>
                <img style="border:1px black solid;" src="composants/portfolio/portfolio14.jpg" alt=""></a>
                </div>
            </li>  
        </ul>
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

<?php include("include/baspage.php"); ?>

