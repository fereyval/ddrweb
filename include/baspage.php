<footer role="contentinfo" class="footer line txtcenter">
	<p class="txtcenter left"><a style="color:#2ba9d9;" class="boutonfoot" href="blog.php">BLOG</a></p>
	<div class="conteneur center">
		<div class="row">
			<div class="col left w100">
				<div class="box6">
					<div >
						<div class="date"><strong>05</strong><span>October, 2014</span></div>
						<p><a href="#" class="link">Lorem ipsum</a><br>Sadipscing elitriam nonumy eirmod nonumy eirmod tempor invidunt labore.</p>
					</div>
				</div>
				<div class="box6">
					<div>
						<div class="date"><strong>06</strong><span>October, 2014</span></div>
						<p><a href="#" class="link">Lorem ipsum</a><br>Sadipscing elitriam nonumy eirmod nonumy eirmod tempor invidunt labore.</p>
					</div>
				</div>
				<div class="box6">
					<div >
						<div class="date"><strong>15</strong><span>november, 2014</span></div>
						<p><a href="#" class="link">Lorem ipsum</a><br>Sadipscing elitriam nonumy eirmod nonumy eirmod tempor invidunt labore.</p>
					</div>
				</div>
			</div>
			<div class="col w30" style="padding-top:50px;">
				<h3 class="title-h3"><span>CONTACT : </span>06 15 59 67 98</h3>
				<p class="right"><a href="mentions-legales.php" >Mentions légales</a> - Réalisé, hébergé et référencé par <a href="http://www.ddrweb.fr"><img src="composants/logo.png" alt="logo DDRweb" style="width:60px;"></a></p>
			</div>
		</div>
	</div>
	<p class="txtcenter right"><a style="color:#2ba9d9;" class="boutonfoot2" href="contact.php">CONTACT</a></p>
</footer>
<div class="social-barre">
        <ul>
            <li><a href="https://www.facebook.com"><img src="composants/facebook.png" alt="Facebook"></a></li>
            <li><a href="https://twitter.com"><img src="composants/twitter.png" alt="Twitter"></a></li>
            <li><a href="https://www.github.com/firely23"><img src="composants/linkedin.png" alt="Google +"></a></li>
        </ul>
</div>

    <script type='text/javascript' src='javascripts/jquery-1.7.2.min.js'></script>
	<script src="javascripts/filterable.pack.js" type="text/javascript" charset="utf-8"></script>
    <script src="javascripts/jquery.b1njAccordion.js"></script>
	 <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-34001528-16']);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <script type='text/javascript' src='javascripts/jquery.cycle.all.js'></script>
    <script type='text/javascript' >
     jQuery(function(){
          jQuery('#slide').cycle({ 
              fx:     'fade',
              timeout: 5000 , 
              pager: '#nav',
              before: pagerFactory 
          });
          
          function pagerFactory(idx, slide) {
              $('#caption').html(this.alt); 
              var s = idx > 3 ? ' style=\"display:none\"' : '';
              return '<a href=\"#\" '+s+' ></a>';
          }; 
    });
    </script>
    <?php echo $javascript; ?>
</body>
</html>