<?php
if (!defined('ROOT'))
	define('ROOT', './');
require ROOT.'config/common.php';

// Variables d'entete
$rubrique = '';
$title = "Mentions légales";
$description = "";
$head = '';
$javascript = '';
include("include/entete.php");
?>

<h1><span>M</span>entions l&eacute;gales</h1>

<p>(r&eacute;glement&eacute;es par la Loi n&deg;
2004-575 du 21 juin 2004 pour la confiance dans l'&eacute;conomie
num&eacute;rique)</p>

<p><strong>Edition :</strong><br />
Ce site est &eacute;dit&eacute; par <?php echo SOC_NOM ?><br />
<?php echo SOC_ADRESSE ?><br />
<?php echo SOC_CP ?> - <?php echo SOC_VILLE ?></p>

<!-- <p><strong>RCS : </strong> <?php echo SOC_RCS ?></p> -->

<p><strong>Num&eacute;ro SIRET :</strong> <?php echo SOC_SIRET ?></p>

<!-- <p><strong>Num&eacute;ro SIREN :</strong> <?php echo SOC_SIREN ?></p> -->

<!-- <p><strong>Capital social :</strong> <?php echo SOC_CAPITAL ?></p>  -->

<p><strong>Directeur de la publication :</strong> <?php echo SOC_DIRPUB ?></p>

<p><strong>Responsable de la r&eacute;daction :</strong> <?php echo SOC_REDAC ?></p>

<p><strong>T&eacute;l&eacute;phone :</strong> <?php echo SOC_TEL ?></p>

<p><strong>Fax :</strong> <?php echo SOC_FAX ?></p>

<p><strong>R&eacute;alisation, R&eacute;f&eacute;rencement
et h&eacute;bergement du site :</strong></p>

<p>Soci&eacute;t&eacute; Pixell<br />
B&acirc;timent Frigodom - Niveau 1<br />
Z.I.P. de la Pointe des Grives<br />
97200 Fort-de-France<br />
T&eacute;l. 05 96 75 14 20<br />
Fax 05 96 75 67 36</p>

<p><a href="http://www.pixellweb.com">http://www.pixellweb.com</a></p>


<p><strong>Déclaration du site à la CNIL</strong></p>
<p>Conformément aux dispositions de la Loi n&deg; 78-17 du 6 janvier 1978
relative &agrave; l'Informatique, aux Fichiers et aux
Libert&eacute;s, le traitement automatisé des données nominatives réalisé
à partir de ce site Internet a fait l'objet d'une déclaration auprés de la
Commission Nationale de l'Informatique et des Libertés (CNIL) sous le numéro <?php echo SOC_CNIL ?>.
</p>

<p><strong>Donn&eacute;es nominatives :</strong></p>
<p>En application de la Loi n&deg; 78-17 du 6 janvier 1978
relative &agrave; l'Informatique, aux Fichiers et aux
Libert&eacute;s, vous disposez des droits d'opposition (art. 26 de
la loi), d'acc&egrave;s (art.34 &agrave; 38 de la loi) et de
rectification (art. 36 de la loi) des donn&eacute;es vous
concernant. Ainsi, vous pouvez contacter la
soci&eacute;t&eacute; <?php echo SOC_NOM;?> pour que soient rectifi&eacute;es,
compl&eacute;t&eacute;es, mises &agrave; jour ou
effac&eacute;es les informations vous concernant qui sont
inexactes, incompl&egrave;tes, &eacute;quivoques,
p&eacute;rim&eacute;es ou dont la collecte ou l'utilisation, la
communication ou la conservation est interdite.</p>
<p>Les informations qui vous concernent sont uniquement
destin&eacute;es &agrave; la soci&eacute;t&eacute; <?php echo SOC_NOM;?>.
Nous ne transmettons ces informations &agrave; aucun tiers
(partenaires commerciaux, etc.).</p>
<?php
include 'include/baspage.php';
?>