<?php
// extensions des images autorisées au téléchargement
$IMAGE_TYPE = array('gif','jpg','jpeg','png');
// extensions des fichiers autorisées au téléchargement
$FICHIER_TYPE = array(
            'odt' => 'text',
            'odp' => 'presentation',
            'ods' => 'spreadsheet',
            
            'sxw' => 'application',
            'sxc' => 'application',
            'sxi' => 'application',
            
            'ppt' => 'presentation',
            'doc' => 'document',
            'docx' => 'document',
            'xls' => 'spreadsheet',         
            'rtf' => 'document',
            
            'pdf' => 'document',
            'ps' => 'image',
            'ai' => 'image',
            'eps' => 'image',
            
            'bin' => 'executable',
            'exe' => 'executable',
            
            'deb' => 'package',
            'gz' => 'package',
            'jar' => 'package',
            'rar' => 'package',
            'rpm' => 'package',
            'tar' => 'package',
            'tgz' => 'package',
            'zip' => 'package',
            
            'aiff' => 'audio',
            'ua' => 'audio',
            'mp3' => 'audio',
            'mid' => 'audio',
            'midi' => 'audio',
            'ogg' => 'audio',
            'wav' => 'audio',
            
            'swf' => 'video',
            'swfl' => 'video',
            
            'bmp' => 'image',
            'gif' => 'image',
            'jpeg' => 'image',
            'jpg' => 'image',
            'jpe' => 'image',
            'png' => 'image',
            'tiff' => 'image',
            'tif' => 'image',
            'xbm' => 'image',
            
            'css' => 'text',
            'js' => 'text',
            'html' => 'html',
            'htm' => 'html',
            'txt' => 'text',
            'rtf' => 'text',
            'rtx' => 'text',
            
            'mpg' => 'video',
            'mpeg' => 'video',
            'mpe' => 'video',
            'viv' => 'video',
            'vivo' => 'video',
            'qt' => 'video',
            'mov' => 'video',
            'mp4' => 'video',
            'm4v' => 'video',
            'flv' => 'video',
            'avi' => 'video',
            );
// extensions des facture autorisées au téléchargement
$FACTURE_TYPE = array('pdf');
/***********************************************************************************
*  FICHIERS
***********************************************************************************/
/**
* function formatFileName
* @access public
* @param string - nom de fichier à formater (avec ou sans extension)
* @param int - longueur maximale autorisée pour le nom de fichier
* @return string - nom de fichier formaté
* @desc Tronque éventuellement le nom de fichier, le convertit en minuscules et
*           y élimine les caractères potentiellement dangereux.
*/
function formatFileName($nom_fichier, $aMaxLength = 50) 
{
    $extension = (getExtension($nom_fichier) != '' ? '.'.getExtension($nom_fichier) : '');
    $name = basename($nom_fichier, $extension);
    $name = subStr($name, 0, $aMaxLength);
    $nom_fichier = strToLower($name.$extension);
    // enleve les accents
    $nom_fichier = strtr($nom_fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    //compatibilité PHP 5.3 => expressions régulières/rationnelle PCRE
    $nom_fichier = preg_replace('"\W"', '-', $nom_fichier);
    $nom_fichier = preg_replace('"[-]+"', '-', $nom_fichier);  // Supprime les doublon de -
    $nom_fichier = preg_replace('"^-"', '', $nom_fichier);     // Retire le premier -
    $nom_fichier = preg_replace('"-$"', '', $nom_fichier);     // retire le tiret de la fin
    return $nom_fichier;
}

/**
* Returns human readable file size.
*
* @param integer    $size       Bytes
* @return string
*/
function size($size)
{
    $kb = 1024;
    $mb = 1024 * $kb;
    $gb = 1024 * $mb;
    $tb = 1024 * $gb;
    
    if($size < $kb) {
        return $size." o";
    }
    else if($size < $mb) {
        return round($size/$kb,2)." Ko";
    }
    else if($size < $gb) {
        return round($size/$mb,2)." Mo";
    }
    else if($size < $tb) {
        return round($size/$gb,2)." Go";
    }
    else {
        return round($size/$tb,2)." To";
    }
}

/**
* Converts a human readable file size to bytes.
*
* @param string $v          Size
* @return integer
*/
function str2bytes($v)
{
    $v = trim($v);
    $last = strtolower(substr($v,-1,1));
    
    switch($last)
    {
        case 'g':
            $v *= 1024;
        case 'm':
            $v *= 1024;
        case 'k':
            $v *= 1024;
    }
    
    return $v;
}

/**
* Returns a file extension.
*
* @param string $f  File name
* @return string
* tester $ext = pathinfo('le_fichier.html', PATHINFO_EXTENSION);
*/
function getExtension($f)
{
    $f = explode('.',basename($f));
    if (count($f) <= 1) { return ''; }
    return strtolower($f[count($f)-1]);
}

/**
* Recherche un ou plusieurs fichier correspondant à un masque et des extensions
* @param string masque
* @param string chemin du fichier 
* @param array - extensions recherchées
* @param string $format pour les images ex = 100x95
* @param string $couleur pour les images ex = ffffff
* @return  array - nom des fichiers trouvés
* @desc un masque './*' permet de récupérer tous les fichiers 
*   retourne les noms complets des fichiers avec les extensions données
*/
function findFile($masque, $root = './', $ext = '', $format = false, $couleur =false)
{
    $files_news = false;
    if (is_array($ext)) 
        $extension = '.{'.implode(',',$ext).'}';    
    else $extension = '';   
    $files = glob($root.$masque.$extension, GLOB_BRACE);
    if (empty($files))
        return false;
    foreach ($files as $file) {
        if ($format) {
            $ext = getExtension($file);
            $name = basename($file,'.'.$ext);
            $file = $name.'_'.$format.($couleur ? '_'.$couleur : '').'.'.$ext;
        }
        $files_news[] = basename($file);
    }
    return $files_news; 
}

/**
* Supprime un ou plusieurs fichier correspondant à un masque et des extensions
* @param string masque
* @param string chemin du fichier 
* @param array - extensions recherchées
* @return  bool - si false, erreur sur la suppression d'un fichier'
*/
function delFile($masque, $root='./', $ext='')
{
    $files = findFile($masque, $root, $ext);
    if ($files) {
        foreach ($files as $file) {
            unlink($root.$file);
        }
    }
}

/**
* Traitement d'un fichier téléchargé
* @param string $champ = nom du champ d'upload du formulaire
* @param string $nom = nom du fichier à stocker. Si vide, sera le nom original 
* @param string $root = chemin du fichier 
* @return  array - $feedback
*/
function checkUploadFile($champ, $nom, $root)
{
    // Vérifie si le si le fichier a été téléchargé par HTTP POST
    if( is_uploaded_file($_FILES[$champ]['tmp_name']) and $_FILES[$champ]['error'] == UPLOAD_ERR_OK) {
        // Evite un trou de sécurité : pas le caractère null, ni de caractère de contrôle ou slashe et backslashe.
        if( !preg_match('# [ [\x00-\x1F\x7F-\x9F/\\] ] #', $_FILES[$champ]['name'])){
            // Récupére l'extension
            $ext = getExtension($_FILES[$champ]['name']); 
            // nom du fichier pour copie sur le serveur
            if ( !empty($nom) ) {
                // on donne le nom passé en parametre
                $nom_fichier = $nom.'.'.$ext;
            } else {
                // on donne le nom d'origine
                $nom_fichier = $_FILES[$champ]['name'];
            }
            // on copie le fichier dans le dossier de destination
            if ( !move_uploaded_file($_FILES[$champ]['tmp_name'], $root.$nom_fichier)) {
                return false;
            }
        } else return false;
    } else return false;
    $feedback['ext'] = $ext;
    $feedback['nom_fichier'] = $nom_fichier;
    return $feedback;
}

/**
* Vérifie si un fichier existe. Si l'existe le modifie en rajoutant [**] à la fin du nom
* @param string $fichier = chemin du fichier 
* @return  string - nom du fichier
*/
function file_exists_change($fichier)
{
    $name = basename($fichier);
    $dossier = dirname($fichier).'/';
    while (file_exists($fichier)) {
        $i = 1;
        $ext = getExtension($name);
        $name = basename($name,'.'.$ext);
        $exist = preg_match("/\[([0-9]*)\]$/",$name,$reg);
        if ($exist and !empty($reg[1])) {
            $i = $reg[1]+1;
            $name = substr($name,0,-strlen($reg[0]));
        }
        $name = $name.'['.$i.']'.'.'.$ext;
        $fichier = $dossier.$name;
    }
    return $name; 
}

/**
* Trie des fichiers en fonction de sa date de création
* @param array  $fichiers
* @param string $chemin 
* @param string $order - desc ou asc
* @return array
*/
function triDateFichiers($fichiers, $chemin='', $order="asc")
{
    $new_fichiers = array();
    foreach ($fichiers as $f) {
        $new_fichiers[filemtime($chemin.$f)] = $f;
    }
    $order == 'desc' ? krsort($new_fichiers) : ksort($new_fichiers);
    $fichiers = array_values($new_fichiers);
    return $fichiers;
}
                
/***********************************************************************************
*  IMAGES
***********************************************************************************/
/**
* Redimensionnement d'une image
* @param string $champ 
* @param string $img : chemin de l'image originale 
* @param integer $largeur_max : Largeur maximale pour la miniature
* @param integer $hauteur_max : Hauteur maximale pour la miniature
* @param string $nom : Nom donné à l'image redimensionnée
* @param bool $supprimer_original : Si est égal à true on supprime l'image originale
* @param bool $recadrage : Si est égal à true on supprime on recadre l'image (redecoupage de l'image aux dimensions indiquée)
* @return  bool 
* @desc  Redimensionne l'image d'apres $largeur_max et $hauteur_max. L'image rentrera toujours dans ces valeurs.
*        Pour redimensionner uniquement en fonction de la largeur, mettre height à 0.
*/
function redimImage($img, $largeur_max, $hauteur_max, $nom = false, $supprimer_original = false, $recadrage = false, $couleur = false)
{
    if (is_file($img)) { //Le fichier existe
        $largeur_max_ini = $largeur_max;
        $hauteur_max_ini = $hauteur_max;
        //getimagesize() renvoie FALSE si le fichier n'est pas une image
        list($largeur_orig,$hauteur_orig,$extension) = getimagesize($img);
        $ratio = $largeur_orig / $hauteur_orig;
        
        // On vérifie que le fichier est bien au format jpg ou png
        if ($extension == IMAGETYPE_GIF || $extension == IMAGETYPE_JPEG || $extension == IMAGETYPE_PNG) {
            switch ($extension) {
                case IMAGETYPE_GIF: //GIF
                $new_img = imagecreatefromgif($img);
                $extension_img = '.gif';
                break;
                case IMAGETYPE_JPEG: //JPEG
                $new_img = imagecreatefromjpeg($img);
                $extension_img = '.jpg';
                break;
                case IMAGETYPE_PNG: // PNG
                $new_img = imagecreatefrompng($img);
                $extension_img = '.png';
                break;
            }
            
            // La dimensions souhaitées sont plus grandes que l'originale 
            if ($hauteur_orig < $hauteur_max) {
                $hauteur_max = $hauteur_orig;
            }
            if ($largeur_orig < $largeur_max) {
                $largeur_max = $largeur_orig;
            }
                
            $decalX = 0;
            $decalY = 0;
            $largeur_img = $largeur_max;
            $hauteur_img = $hauteur_max;
            if ($largeur_max == 0 or $hauteur_max == 0) {
                // (si on a passé 0 en paramètre c'est que l'on veut que le paramètre s'adapte pour conserver le ratio)
                if ($largeur_max == 0 and $hauteur_max == 0){
                    $largeur_max = $largeur_orig;
                    $hauteur_max = $hauteur_orig;
                }
                elseif ($hauteur_max == 0) {
                    $hauteur_max = floor($largeur_max / $ratio);
                }
                elseif ($largeur_max == 0) {
                    $largeur_max = floor($hauteur_max * $ratio);
                }
                $largeur_img = $largeur_max;
                $hauteur_img = $hauteur_max;
            } elseif ($recadrage) {
                // Si on doit "cropper" l'image on cherche de cb de px on doit décaler l'image miniatures pour la centrer
                if ($ratio > $largeur_max / $hauteur_max) {
                    $hauteur_img = $hauteur_max;
                    $largeur_img = floor(($hauteur_max * $largeur_orig) / $hauteur_orig);
                    $decalX = ($largeur_img - $largeur_max) / 2;
                }
                if ($ratio < $largeur_max / $hauteur_max) {
                    $largeur_img = $largeur_max;
                    $hauteur_img = floor(($largeur_max * $hauteur_orig) / $largeur_orig);
                    $decalY = ($hauteur_img - $hauteur_max) / 2;
                }
            } else {
                //  Calcul du coef reducteur largeur et hauteur
                $coefW = $largeur_max > 0 ? $largeur_max / $largeur_orig : 1; 
                $coefH = $hauteur_max > 0 ? $hauteur_max / $hauteur_orig : 1; 
                // Choix du coef le plus petit
                $coef = $coefW > $coefH ? $coefH : $coefW;
                // Redimensionnement
                $largeur_img = floor($largeur_orig * $coef);
                $hauteur_img = floor($hauteur_orig * $coef);
                
                if ($couleur) {
                    if ($largeur_img < $largeur_max) {
                        $decalX = -($largeur_max - $largeur_img) / 2;
                    } else {
                        $decalY = -($hauteur_max - $hauteur_img) / 2;
                    }
                } else {
                    if ($largeur_img < $hauteur_img) {
                        $largeur_max = $largeur_img;
                    } else {
                        $hauteur_max = $hauteur_img;
                    }                    
                }
            }

            // On créé la nouvelle image et on la sauvegarde
            $src = imagecreatetruecolor($largeur_max,$hauteur_max);
            if ($couleur) {
                $back = imagecolorallocate($src, $couleur[0], $couleur[1], $couleur[2]);
                imagefilledrectangle($src, 0, 0, $largeur_max, $hauteur_max, $back);
            }
            imagecopyresampled($src,$new_img,-$decalX,-$decalY,0,0,$largeur_img,$hauteur_img,$largeur_orig,$hauteur_orig);
            // On créé le nom de l'image avec chemin complet
            $new_nom = dirname($img).'/'.($nom ? $nom : basename($img));
            switch ($extension) {
                case IMAGETYPE_GIF: //GIF
                    imagegif($src, $new_nom); 
                    break;
                case IMAGETYPE_JPEG: //JPEG
                    imagejpeg($src, $new_nom); 
                    break;
                case IMAGETYPE_PNG: // PNG
                    imagepng($src, $new_nom); 
                break;
            }
            
            // On libere la memoire utilisée par cette image.
            imagedestroy($src);
            
            // On supprime éventuellement l'image originale
            if ($supprimer_original == true and $nom) {
                unlink($img);
            }
        } else {
            return  false;
        }
    } else {
        return  false;
    }
    return true;
}

/**
* Convertit un chemin relatif en URL
* @param string $relPath = nom du fichier relatif
* @return  string - URL
* Ne fonctionne pas en local !!!
*/
function mapURL ($filepath) {
    $realpath = realpath($filepath);
    $dir;
   
    // Verify that the path passed is real and harvest the bottom directory
    if (is_file($realpath)) {
        $dir = dirname($realpath);
    }
    elseif (is_dir($realpath)) {
        $dir = $realpath;
    }

    // Make sure the path is not lower than the server root
    if (strlen($dir) < strlen($_SERVER['DOCUMENT_ROOT']))
        throw new Exception("Cannot create http path below server http root.");
       
    $path = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . substr($realpath, strlen($_SERVER['DOCUMENT_ROOT']));
   
    if (DIRECTORY_SEPARATOR == '\\')
        $path = str_replace('\\', '/', $path);

    return $path;
}  
?>