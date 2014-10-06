<?php
if (!defined('ROOT'))
	define('ROOT', './');
require ROOT.'config/common.php';

// Variables d'entete
$rubrique = 'accueil';
$title = "DDR Web accueil";
$description = "";
$head = '';
$javascript = '
    <script src=javascripts/jquery.b1njAccordion.js></script>
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
        </script>
		
    <script src="javascripts/jquery.featureCarousel.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var carousel = $("#carousel").featureCarousel({
        });
      });
    </script>';
include("include/entete.php");
?>


<div role="main" class="texte" style="z-index:1; position: relative;">
	<div class="slideshow">
         <div class="slideshow_cadre">
                <div id="slide" class="slide" >
					<img src="composants/slider-1.jpg"  width="1080" height="478"  style="z-index:-1"/> 
					<img src="composants/slider-2.jpg"  width="1080" height="478" />
					<img src="composants/slider-4.jpg"  width="1080" height="478" />
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
	<div class="conteneur center">
		<div class="row pts pll">
			<div class="col w50 ptm prm">
				<img src="styles/pourquoi.png" class="left">
				<h2 class="title-h2"><img><span>Pourquoi</span> DDR Web?<img></h2>
                <div class=" plm">
					
					<p>
                    DDR Web c'est l'abréviation des mots Développement / Design / Référencement qui correspondent aux phases même de la création d'un site web.
                    </p>
                    <p>
                    Cette sociétée propose différents services en rapport avec la conception de sites internet, que ce soit un simple blog wordpress, un site personnel ou même un E-commerce (simplifié). La chartre graphique, l'intégration et le développement de chaque sites web sont fait par moi. Pour plus d'informations sur les services que je propose, cliquez sur le bouton ci-dessous.
                    </p>
                </div>
				 <p class="txtcenter mbm left mll mtl"><img src="styles/button3.png"><a style="color:#FF9000" class="bouton1" href="#">Lire la suite</a></p>
			</div>
			<div class="col w50 ptm">
			<img src="styles/qui.png" class="left">
				<h2 class="title-h2"><img><span>Qui</span> suis-je?<img></h2>
                <div class="plm">
				
                    <p>
                    Je suis un étudiant de 2ème année à Epitech lyon, une école d'informatique qui propose un cursus d'expert en 5 ans durant lequel vous serez confronté à faire environ 1 an et demi de stage en entreprise.
                    </p>
                    <p >
                    Je code depuis près de 3 ans et ai appris les bases du Web grâce à l'association Epiweb Lyon et me suis formé durant un stage de 4 mois chez Pixellweb une entreprise également basée sur la conception de sites internet aux Antilles. Pour en savoir plus sur mes compétences, cliquez sur le lien ci-dessous.
                    </p>
                </div>
				<p class="txtcenter mbm left mll mtl"><img src="styles/button3.png"><a style="color:#FF9000" class="bouton1" href="#">Lire la suite</a></p>
			</div>
		</div>
        <div class="row pts pll">
			<div class="col w70 pam">
                <h2 class="title-h2"><span>Nos</span> Services</h2>
                <div class="box5">
                    <img src="composants/img1.jpg" alt="developpement" class="products"/>
                        <div class="left w90">
                        <h3 class="title-h3"><span>Formule Simple</span></h3>
                    <p style="margin-top: 0px;">La formule basique à petits prix et très rapide!</p>
                    </div>
                </div>
                <div class="box5">
                    <img src="composants/img2.jpg" alt="developpement" class="products"/>
                    <div class="left w90">
                        <h3 class="title-h3"><span>Formule Premium</span></h3>
                        <p style="margin-top: 0px;">La formule all inclusive, pour créer un site à votre image dans un délais imposé.</p>
                    </div>
                </div>
                <div class="box5">
                    <img src="composants/img3.jpg" alt="developpement" class="products"/>
                    <div class="left w90">
                        <h3 class="title-h3"><span>Abonnement DDRWeb</span></h3>
                        <p style="margin-top: 0px;">Un abonnement au mois qui permet un suivi et un entretien continu de votre site</p>
                    </div>
                </div>
                <p class="txtcenter mbm left mls mtl ptl"><img src="styles/button3.png"><a style="color:#FF9000" class="bouton1" href="#">Lire la suite</a></p>
            </div>
			<div class="col w30 ptm prm">
                <h2 class="title-h2"><span>B</span>log</h2>
                <div class="mts">
                    <div class="date"><strong>05</strong><span>October, 2014</span></div>
                    <p><a href="#" class="link">Lorem ipsum dolor sit amet consetetur</a><br>Sadipscing elitriam nonumy eirmod nonumy eirmod tempor invidunt labore.</p>
                </div>
                <div class="mts">
                    <div class="date"><strong>06</strong><span>October, 2014</span></div>
                    <p><a href="#" class="link">Lorem ipsum dolor sit amet consetetur</a><br>Sadipscing elitriam nonumy eirmod nonumy eirmod tempor invidunt labore.</p>
                </div>
                <p class="txtcenter mbm left mls mtl"><img src="styles/button3.png"><a style="color:#FF9000" class="bouton1" href="#">Lire la suite</a></p>
            </div>
        </div>
		<div class="mts">
			<h2 class="title-h2 txtcenter" id="rea"><span>Mes dernières</span> réalisations</h2>
			<div id="carousel">
			<div class="carousel-feature">
				<a href="sites/bijoudexpo/index.html"><img class="carousel-image" alt="Image Caption" src="styles/last/bijoudexpo.jpg"></a>
				
			</div>
			<div class="carousel-feature">
				<a href="http://antilles-recouvrement.com/"><img class="carousel-image" alt="Image Caption" src="styles/last/antillerecou.jpg"></a>
				
			</div>
			<div class="carousel-feature">
				<a href="#"><img class="carousel-image" alt="Image Caption" src="styles/last/ddrweb.jpg"></a>
				
			</div>
			<div class="carousel-feature">
				<a href="http://inkcaraibes-mq.com/"><img class="carousel-image" alt="Image Caption" src="styles/last/ink.jpg"></a>
				
			</div>
			<div class="carousel-feature">
				<a href="404.hmtl"><img class="carousel-image" alt="Image Caption" src="styles/last/vide.jpg"></a>
				
			  </div>
			</div>
            <!--<p class="txtcenter mbm left mll pll mtl"><img src="styles/button3.png"><a style="color:#FF9000" class="bouton1" href="#">Lire la suite</a></p>-->
		</div>
	</div>	
</div>

<?php include("include/baspage.php"); ?>