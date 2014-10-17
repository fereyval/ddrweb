<!doctype html>
<html class="no-js" lang="fr">
<head>
    <meta charset="iso-8859-15">
    <meta name="description" content="<?php echo $description; ?>">
    <link rel="stylesheet" type="text/css" href="styles/knacss.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="icon" type="jpg" href="composants/favicon.png">
    <link rel="icon" type="jpg" href="composants/favicon.png">
    <?php echo $head; ?>
    <title><?php echo $title.' - '.NOM_SITE; ?></title>
</head>
<body>
<header role="banner" class="header line pam">
    <div class="conteneur center" style="background:transparent !important;">
        <p class="titre-principal">WELCOME ON<br> MY BLOG</p>
    </div>
</header><!-- Fin header //-->
<nav role="navigation" class="menu">
    <div class="conteneur2">
    <div class="conteneur center">
    <ul class="line"><!--
        --><li  class="inbl <?php if ($rubrique=='accueil') echo 'lien_actif'; ?>" ><a class="inbl <?php if ($rubrique=='accueil') echo 'lien_actif'; ?>" href="../index.php"><span>Accueil</span></a></li><!--
            --><li  class="inbl <?php if ($rubrique=='about') echo 'lien_actif'; ?>" ><a class="inbl <?php if ($rubrique=='about') echo 'lien_actif'; ?>" href="../about.php"><span>A propos</span></a></li><!--
            --><li  class="inbl <?php if ($rubrique=='blog') echo 'lien_actif'; ?>" ><a class="inbl <?php if ($rubrique=='blog') echo 'lien_actif'; ?>" href="index.php"><span>Blog</span></a></li><!--
            --><li  class="inbl <?php if ($rubrique=='services') echo 'lien_actif'; ?>" ><a class="inbl <?php if ($rubrique=='services') echo 'lien_actif'; ?>" href="../services.php"><span>Services</span></a></li><!--
            --><li  class="inbl <?php if ($rubrique=='contact') echo 'lien_actif'; ?>" ><a class="inbl <?php if ($rubrique=='contact') echo 'lien_actif'; ?>" href="../contact.php"><span>Contact</span></a></li>
         </ul>
    </div>
    </div>
</nav><!-- Fin menu //-->
<div class="conteneur center">
    <aside class="texte2 mod right w30 mls pam">
        
    </aside>

    <div role="main" class="texte mod mls pam pts">