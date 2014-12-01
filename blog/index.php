<?php
if (!defined('ROOT'))
	define('ROOT', './');
require ROOT.'config/common.php';

// Variables d'entete
$rubrique = 'blog';
$title = "BLOG DDRWeb";
$description = "";
$head = '';
$javascript = '
<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
<script src="javascripts/jquery.slickhover.js" type="text/javascript"></script>
<script type="text/javascript">

$(window).load(function(){
  $(".slickHoverZoom").slickhover();
});

</script>';
include("include/entete.php");
?>

<?php
// On récupère les 5 derniers billets
$req = $bdd->query('SELECT id, titre, intro, image, auteur, DATE_FORMAT(date_creation, \'%d/%m\') AS date_creation_fr FROM billets ORDER BY date_creation_fr DESC LIMIT 0, 7');
while ($donnees = $req->fetch())
{
?>

<div class="box1">
    <a style="color:black;" href="commentaires.php?billet=<?php echo $donnees['id']; ?>"><img src="<?php echo $donnees['image'];?>" class="img-blog left slickHoverZoom" width="250" height="140"/></a>
    <div >
        <h1 class="h1-blog"><a class="h1-blog" href="commentaires.php?billet=<?php echo $donnees['id']; ?>"><?php echo htmlspecialchars($donnees['titre']); ?></a></h1>
        <p class="p-blog">By<a class="user"> <?php echo $donnees['auteur']; ?> </a>• <?php echo $donnees['date_creation_fr']; ?><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>"> • commentaires</a>
        <p class="txt-blog"><?php echo $donnees['intro'];?></p> 
    </div>
</div>

<?php
} // Fin de la boucle des billets
$req->closeCursor();
?>

<?php include("include/baspage.php"); ?>