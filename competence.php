<?php
if (!defined('ROOT'))
	define('ROOT', './');
require ROOT.'config/common.php';

// Variables d'entete
$rubrique = 'competence';
$title = "Mes Compétences";
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
            <p class="mini-menup">Compétences</p>
            <ul class="mini-menu">
                <li><a href="#bvn">Mes compétences</a></li>
				<li><a href="#cv">Mon Curriculum vitae</a></li>
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
							<img src="composants/diapo6.png" alt="" class="diapo-img" id="bvn" style="width:150px;">
						</div>
						<div class="box3">
							<h3>Mes compétences dans les languages informatiques.</h3>
							<p>Ici vous découvrirez mes différentes compétences en informatique. Il s'agit bien sur des différents languages mais aussi de certains logiciels utiles à la création d'un site internet. Une compétence avec 3 étoiles ou plus équivaut à une compétence plus ou moins bien maitrisée. J'ai également joins mon <a style="text-decoration:none;color:black;font-size:1.1em;font-weight:bold;" href="#cv">Curriculum Vittae</a> pour plus de renseignement.</p>
                         </div>
					</div>
				</li>
            </ul>
        </div>
	</div>
</div>    

<div role="main" class="texte3 pam">
	<div class="conteneur center">
        <div class="row pts">
            <div class="caracteristiques col w50 pam" >
                <h2 class="title-h3" style="font-size:1.8em;"><span>I</span>ntégration</h2>
                <ul>
                    <li><img src="styles/logos/1.png" alt="logo" style="margin:10px;" />HTML 5
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileM.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                        </span>
                    </li>
                    <li><img src="styles/logos/2.png" alt="logo" style="margin:10px;"/>CSS 3
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileM.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                </ul>
            </div>
            
            <div class="caracteristiques col w50 pam" >
                <h2 class="title-h3" style="font-size:1.8em;"><span>D</span>éveloppement</h2>
                <ul>
                    <li><img src="styles/logos/3.png" alt="logo" style="margin:10px;"/>Javascript
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileM.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                    <li><img src="styles/logos/4.png" alt="logo" style="margin:10px;"/>PHP
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileM.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                    <li><img src="styles/logos/5.png" alt="logo" style="margin:10px;"/>MySQL
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileM.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row pts">
            <div class="caracteristiques col w50 pam" >
                <h2 class="title-h3" style="font-size:1.8em;"><span>D</span>esign</h2>
                <ul>
                    <li><img src="styles/logos/6.png" alt="logo" style="margin:10px;"/>Photoshop
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileM.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                        </span>
                    </li>
                    <li><img src="styles/logos/7.png" alt="logo" style="margin:10px;"/>Fireworks
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileM.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                    <li><img src="styles/logos/8.png" alt="logo" style="margin:10px;"/>RWD
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                </ul>
            </div>      
            <div class="caracteristiques col w50 pam" >
                <h2 class="title-h3" style="font-size:1.8em;"><span>A</span>utres languages</h2>
                <ul>
                    <li><img src="styles/logos/9.png" alt="logo" style="margin:10px;"/>C
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileM.png" alt="étoile" />
                        </span>
                    </li>
                    <li><img src="styles/logos/10.png" alt="logo" style="margin:10px;"/>C++
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                    <li><img src="styles/logos/11.png" alt="logo" style="margin:10px;"/>Python
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileM.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row pts">
            <div class="caracteristiques col w50 pam" >
                <h2 class="title-h3" style="font-size:1.8em;" id="cv"><span>C</span>ms</h2>
                <ul>
                    <li><img src="styles/logos/12.png" alt="logo" style="margin:10px;"/>Wordpress
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileM.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                    <li><img src="styles/logos/13.png" alt="logo" style="margin:10px;"/>typo3
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                </ul>
            </div>
            
            <div class="caracteristiques col w50 pam" >
                <h2 class="title-h3" style="font-size:1.8em;"><span>F</span>rameworks</h2>
                <ul>
                    <li><img src="styles/logos/14.png" alt="logo" style="margin:10px;"/>JQuery
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                        </span>
                    </li>
                    <li><img src="styles/logos/15.png" alt="logo" style="margin:10px;"/>Ajax
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                </ul>
            </div>
        </div> 
        
        <div class="row pts">
            <div class="caracteristiques col w50 pam" >
                <h2 class="title-h3" style="font-size:1.8em;"><span>A</span>utres compétences</h2>
                <ul>
                    <li><img src="styles/logos/16.png" alt="logo" style="margin:10px;"/>Unix
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="étoile" />
                        </span>
                    </li>
                    <li><img src="styles/logos/17.png" alt="logo" style="margin:10px;"/>Git
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileM.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                    <li><img src="styles/logos/18.png" alt="logo" style="margin:10px;"/>Anglais
                        <span class="etoile mtl">
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileP.png" alt="étoile" />
                            <img src="styles/etoileV.png" alt="" />
                        </span>
                    </li>
                </ul>
            </div>
        </div>
	</div>
</div>

<div role="main" class="textcomp pam">
	<div class="conteneur center">
        <p class="title-h3">Mon CV téléchargeable :</p>
     <p class="txtcenter mbm mrs center  pts"><a style="color:black" class="bouton3" href="http://ge.tt/api/1/files/7k6psUz1/0/blob?download"><img src="styles/pdf.png" />Télécharger</a></p>
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