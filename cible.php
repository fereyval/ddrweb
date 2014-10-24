<!DOCTYPE html>
<html>
    <head>
        <meta charset="iso-8859-1">
        <title>DDRWEB</title>
    </head>
    <body>
        <p>Nom : <b><?php echo htmlspecialchars( $_POST['nom'], ENT_COMPAT, 'ISO-8859-1'); ?></b></p>
        <p>Prénom : <?php echo  $_POST['prenom']; ?></p>
        <p>Mail : <?php echo htmlspecialchars( $_POST['email']); ?></p>
        <p>Société : <?php echo htmlspecialchars( $_POST['soc']); ?></p>
        <p>Sexe : <?php if (isset($_POST['homme']))
            {
                echo "homme";
            }
            elseif (isset($_POST['femme']))
            {
                echo "femme";
            }
        ?></p>
    </body>
</html>