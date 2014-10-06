        </div><!-- Fin texte //-->

        <footer role="contentinfo" class="footer line pam txtcenter">
            <p><a href="mentions-legales.php" >Mentions légales</a> - Réalisé, hébergé et référencé par <a href="http://www.ddrweb.fr"><img src="composants/logo.png" alt="logo DDRweb" style="width:60px;"></a></p>
        </footer>
    </div><!-- Fin conteneur //-->
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
    <script type='text/javascript' src='javascripts/jquery-1.7.2.min.js'></script>
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