<?php
if (!defined('ROOT'))
	define('ROOT', './');
require ROOT.'config/common.php';

// Variables d'entete
$rubrique = 'blog';
$title = "BLOG DDRWeb";
$description = "";
$head = '';
$javascript = '';
include("include/entete.php");
?>

 
<?php
// Récupération du billet
$req = $bdd->prepare('SELECT id, titre, contenu, image, auteur, DATE_FORMAT(date_creation, \'%d/%m\') AS date_creation_fr, date_creation FROM billets WHERE id = ?');
$req->execute(array($_GET['billet']));
$billet = $req->fetch();

$req = $bdd->prepare('SELECT id, titre FROM billets WHERE date_creation < ? ORDER BY date_creation DESC LIMIT 1');
$req->execute(array($billet['date_creation']));
$billet_prev = $req->fetch();

$req = $bdd->prepare('SELECT id, titre FROM billets WHERE date_creation > ? ORDER BY date_creation DESC LIMIT 1');
$req->execute(array($billet['date_creation']));
$billet_next = $req->fetch();
?>

<div class="box1">
	<h2><a style="color:black;" href="commentaires.php?billet=<?php echo $billet['id']; ?>"><?php echo htmlspecialchars($billet['titre']); ?></a></h2>
	<p class="p-blog">By<a class="user"> <?php echo $billet['auteur']; ?> </a>• <?php echo $billet['date_creation_fr']; ?><a href="commentaires.php?billet=<?php echo $billet['id']; ?>"> • commentaires</a></p>
	<img src="<?php echo $billet['image'];?>" width="600" height="350" class="ptm" />
	<p class="txt-blog"><?php echo $billet['contenu'];?></p> 
</div>

<div class="box1 mls">
	<h2>Commentaires</h2>
	
	<?php
	$req->closeCursor();
	if (isset ($_POST['submit'])){
	
		$auteur=$_POST['auteur'];
		$email=$_POST['email'];
		$commentaire=$_POST['commentaire'];
		$today = date ("y-m-d");
		
		$req = $bdd->prepare ('INSERT INTO commentaires VALUES(NULL,"'.$billet['id'].'","'.$auteur.'","'.$email.'","'.$commentaire.'", "'.$today.'")'); 
		$req->execute(array($_GET['billet']));
		$billet = $req->fetch();
	}
	?>
	
	<?php
	$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête
	// Récupération des commentaires
	$req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
	$req->execute(array($_GET['billet']));

	while ($donnees = $req->fetch())
	{
	?>
	<p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
	<p><?php echo $donnees['commentaire']; ?></p>
	<?php
	} // Fin de la boucle des commentaires
	$req->closeCursor();
	?>
</div>

	<form method="post">
		<fieldset class="fieldset1 mbl">
			<fieldset class="fieldset2">				
				<input type="text" placeholder="pseudo" class="comment2" name="auteur"><br>
				<input type="email" placeholder="mail" class="comment2 mts" name="email"><br>
				<textarea name="commentaire" cols="50" rows="4" placeholder="enter your comment..." class="comment mbs"></textarea><br>
				<input name="submit" type="submit" value="publish" class="publish">
			</fieldset>
		</fieldset>
	</form>
		
	
	<div class="prevbutton left">
		<?php
		if ($billet_next) :?>
			<a href="commentaires.php?billet=<?php echo $billet['id'] + 1; ?> ">Prev</a>
			<p><?php echo $billet_next['titre'];?></p>
		<?php endif ?>
	</div>
	
	<div class="nextbutton right">	
		<?php
		if ($billet_prev) :?>
			<a href="commentaires.php?billet=<?php echo $billet_prev['id']; ?> ">Next</a>
			<p><?php echo $billet_prev['titre'];?></p>
		<?php endif ?>
	</div>
	
<?php include("include/baspage.php"); ?>