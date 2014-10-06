<!doctype html>
<!--[if lte IE 7]> <html class="no-js ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if IE 9]> <html class="no-js ie9" lang="fr"> <![endif]-->
<!--[if gt IE 9]> <!--><html class="no-js" lang="fr"> <!--<![endif]-->
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
	<link href='http://fonts.googleapis.com/css?family=Lato:300italic' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php echo $head; ?>
    <title><?php echo $title.' - '.NOM_SITE; ?></title>
</head>
<body>
    <header role="banner" class="line ">
    <div class="conteneur center">	
		<div class="header-logo"><a href="index.php" title="Retour à la page d'accueil" ><img src="composants/logo.png"></a></div>
			
		<nav role="navigation" class="menu mbs">
			<ul class="line">
				<li  class="inbl <?php if ($rubrique=='accueil') echo 'lien_actif'; ?>" ><a class="inbl <?php if ($rubrique=='accueil') echo 'lien_actif'; ?>" href="index.php"><span>Accueil</span></a></li>
				<li  class="inbl <?php if ($rubrique=='portfolio') echo 'lien_actif'; ?>" ><a class="inbl <?php if ($rubrique=='portfolio') echo 'lien_actif'; ?>" href="portfolio.php"><span>Portfolio</span></a></li>
				<li  class="inbl <?php if ($rubrique=='competence') echo 'lien_actif'; ?>" ><a class="inbl <?php if ($rubrique=='competence') echo 'lien_actif'; ?>" href="competence.php"><span>Compétences</span></a></li>
				<li  class="inbl <?php if ($rubrique=='services') echo 'lien_actif'; ?>" ><a class="inbl <?php if ($rubrique=='services') echo 'lien_actif'; ?>" href="services.php"><span>Services</span></a></li>
				<li  class="inbl <?php if ($rubrique=='contact') echo 'lien_actif'; ?>" ><a class="inbl <?php if ($rubrique=='contact') echo 'lien_actif'; ?>" href="contact.php"><span>Contact</span></a></li>
			</ul>
		</nav><!-- Fin menu //-->
    </header><!-- Fin header //-->
    <!--[if lte IE 7]><div class="messages warning""><p>Nous avons détecté que vous utilisez IE7 (ou une version antérieure).<br/>Ce site ne s'affichera pas correctement car cette version est dépassée. Pour une meilleure utilisation du site, nous vous recommandons fortement d'utiliser un des navigateurs suivants  :<br /><a href="http://www.microsoft.com/windows/products/winfamily/ie/default.mspx">Internet Explorer</a> <a href="http://www.apple.com/safari/">Safari</a> <a href="http://www.google.com/chrome/">Google Chrome</a> <a href="http://www.mozilla.com/firefox/">Firefox</a> <a href="http://www.opera.com/download/">Opera</a></p></div> <![endif]-->