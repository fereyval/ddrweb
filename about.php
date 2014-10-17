<?php
if (!defined('ROOT'))
	define('ROOT', './');
require ROOT.'config/common.php';

// Variables d'entete
$rubrique = 'about';
$title = "A propos";
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

<div role="main" class="texte3-about pam" style="background:white;">
	<div class="conteneur center">
        <div class="row pts">
            <div class="col w50 pam about-sep">
                <h2 class="title-h2"><span>P</span>ortfolio</h2>
                <img src="composants/portfolio.jpg" alt="faq">
                <p class="txtright mtm"><a class="bouton" href="portfolio.php">Lire la suite</a></p>
            </div>
            <div class="col w50 pam">
                <h2 class="title-h2"><span>C</span>ompétences</h2>
                <img src="composants/competence.jpg" alt="parlons-en">
                <p class="txtright mtm"><a class="bouton" href="competence.php">Lire la suite</a></p>
            </div>
        </div>
    </div>
</div>
<?php include("include/baspage.php"); ?>