<?php
class Errors
{
	private $values = array();
	private $form = '';
	private $list_errors = array();
	private $list_errors_type = array();
	private $exist = false;
	private $nb_errors = 0;
	
	/**
	 * Constructeur de la class, spécifie les valeurs du formulaire
	 *
	 * @param array $values
	 * @param string $form
	 */
	public function __construct($values, $form)
	{
		$this->values = $values;
		$this->form = $form;
	}
	
	/**
	 * Ajout l'erreur a $this->list_error
	 *
	 * @param string $error
	 * @param mixed $values
	 * @param mixed $param
	 * @param string $type
	 */
	public function add($error, $champs, $type, $param=false)
	{
		$values = "";
		if (is_array($champs)) {
			$value_bis = array();
			
			foreach ($champs as $value) {
				$value_bis[] = $this->values[$value];
			}
			
			$values = $value_bis;
		}
		else
		{
			if (isset($this->values[$champs])) {
				$values = $this->values[$champs];
			}
		}
		
		if (!Checking::$type($values , $param)) {
			$champs2 = is_array($champs) ? implode(',',$champs) : $champs;
			if (!in_array($champs2,$this->list_errors_type)) {
				if (!isset($this->list_errors[$champs2]))
					$this->list_errors[$champs2] = $error;
				$this->exist = true;
				$this->nb_errors++;
			}
		}
	}
	
	/**
	 * Génère l'affichage des erreurs et vérifie qu'il est bien valide
	 *
	 * @return bool
	 */
	public function invalid()
	{
		if ($this->exist) {
			return $this->list_errors;
		}
		
		return false;
	}

	public function __get($name)
	{
		if (property_exists($this, $name)) {
			return $this->$name;
		}
	}
}

class Checking
{
	/**
	 * Vérifie si une valeur est vide / existe
	 *
	 * @param mixed $values
	 * @return bool
	 */
	public static function notEmpty($values)
	{
		// Si $values n'est pas un array
		if (!is_array($values)) {
			$value = trim($values);
			
			if (!empty($value) && isset($value))
			{
				return true;
			}
			
			return false;
		}
		
		foreach ($values as $value)
		{
			$value = trim($value);
			
			if (empty($value) || !isset($values)) {
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Vérifie si une valeur est égale à une autre
	 * 
	 * @param array $values
	 * @return bool
	 */
	public static function isEqual($values)
	{
		if ($values[0] !== $values[1]) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Vérifie si une valeur est égale à zéro
	 * 
	 * @param string $value
	 * @return bool
	 */
	public static function notZero($value)
	{
		if ($value === 0) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Vérifie que le mail est valide
	 * 
	 * @param string $mail
	 * @return bool
	 */
	public static function isMail($mail)
	{
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			return false;
		}
		
		return true;
	}

	/**
	 * Vérifie que l'URL est valide
	 * 
	 * @param string $url
	 * @return bool
	 */
	public static function isUrl($url)
	{
		if (!filter_var($url, FILTER_VALIDATE_URL)) {
			return false;
		}
		
		return true;
	}
		
	/**
	 * Vérifie que ce soit bien un entier
	 * 
	 * @param int $int
	 * @return bool
	 */
	public static function isInt($int)
	{
		if (!filter_var($int, FILTER_VALIDATE_INT)) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Vérifie que ce soit bien un décimal
	 * 
	 * @param int $int
	 * @return bool
	 */
	public static function isFloat($int)
	{
		if (!filter_var($int, FILTER_VALIDATE_FLOAT)) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Vérifie l'extension d'un fichier uploader
	 * 
	 * @params $index string
	 * @params $ext array - extensions
	 * @return bool
	 */
	public static function isExtension($index, $ext)
	{   
		if (empty($index['name'])) {
			return true;
		}
		
		$path_parts = pathinfo($index['name']);
		
		if (!in_array(strtolower($path_parts['extension']), $ext)) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Vérifie le poid d'un fichier uploader
	 * 
	 * @params $index string
	 * @params $max_size string - taille maximum de téléchargement
	 * @return bool
	 */
	public static function isSize($index, $max_size)
	{ 
		if (empty($index['name'])) {
			return true;
		}
		if ($index['size'] >= $max_size or $index['error'] == UPLOAD_ERR_FORM_SIZE or $index['error'] == UPLOAD_ERR_INI_SIZE) {
			return false;
		}
		
		return true;
	}

	/**
	 * Vérifie que la date est sous la forme  jj/mm/aaaa
	 * 
	 * @params $date string
	 * @return bool
	 */	
	public static function isDate($date)
	{
		$date=trim($date);
		if ( strlen($date) == 10 ){
			// On extrait
			$jour = substr($date,0,2);
			$mois = substr($date,3,2);
			$annee = substr($date,6,4);
			
			if(checkdate($mois,$jour,$annee)) //notez bien l'ordre des arguments : mois, jour, année
				return true;
		}
		return false;
	}
}
?>