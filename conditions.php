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
?>
</head>
<body style="background-color:#2ba9d9">
<div class="conteneur center pam" style="background-color:white; min-height:1080px;">
    <img src="composants/logo.png" style="min-height:100px;" class="left">
    <h1 class="right">FORMULAIRE</h1><br><br><br><br><br><br>
    <h2 class="title-h2 mtl ptl"><span>Ouverture</span> d'un dossier chez DDR Web</p></h2>
    <div class="formulaire2 mtl ptl pll">
    <p>*  champs obligatoires</p><br>
        <form method="post" action="contact.php">
            <p class="form-style2 mbs pas" >Nom *<span class="marge1"> | <input class="mll pll forml" type="text" name="nom" /></span></p>
        </form><br>
        <form method="post" action="contact.php">
            <p class="form-style2 mbs pas">Prénom<span class="marge2"> | <input class="mll pll forml" type="text" name="prenom" /></span></p>
        </form><br>
        <form method="post" action="contact.php">
            <p class="form-style2 mbs pas">E-mail *<span class="marge3"> | <input class="mll pll forml" type="email" placeholder="Ex : test@hotmail.fr" name="email" /></span></p>
        </form><br>
        <form method="post" action="contact.php">
            <p class="form-style2 mbs pas">Nom de la société *<span class="marge4"> |<input class="mll pll forml" type="text" name="prenom" /></span></p>
        </form><br>
    </div>
</div>
</body>


