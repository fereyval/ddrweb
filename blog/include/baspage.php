        </div><!-- Fin texte //-->
    </div><!-- Fin conteneur //-->

<footer role="contentinfo" class="footer line txtcenter">
	<p class="txtcenter left"><a style="color:#2ba9d9;" class="boutonfoot" href="index.php">BLOG</a></p>
	<div class="conteneur center" style="background:transparent !important;">
		<div class="row">
			<div class="col left w100">
				<?php
				$req = $bdd->query('SELECT id, titre, intro, image, auteur, DATE_FORMAT(date_creation, \'%d\') AS date_creation_fr FROM billets ORDER BY date_creation_fr DESC LIMIT 0, 3');
				while ($donnees = $req->fetch())
				{
				?>
				<div class="box6">
					<div >
						<div class="date"><strong><?php echo $donnees['date_creation_fr']; ?></strong><span>October, 2014</span></div>
						<p><a class="link" href="commentaires.php?billet=<?php echo $donnees['id']; ?>"><?php echo htmlspecialchars($donnees['titre']); ?></a><br><?php echo $donnees['intro'];?></p>
					</div>
				</div>
				<?php
				}
				$req->closeCursor();
				?>
			</div>
			<div class="col w30" style="padding-top:50px;">
				<h3 class="title-h3"><span>CONTACT : </span>06 15 59 67 98</h3>
				<p class="right"><a href="mentions-legales.php" >Mentions légales</a> - Réalisé, hébergé et référencé par <a href="http://www.ddrweb.fr"><img src="composants/logo.png" alt="logo DDRweb" style="width:60px;"></a></p>
			</div>
		</div>
	</div>
	<p class="txtcenter right"><a style="color:#2ba9d9;" class="boutonfoot2" href="../contact.php">CONTACT</a></p>
</footer>

<div id="fb-foot"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <?php echo $javascript; ?>
</body>
</html>