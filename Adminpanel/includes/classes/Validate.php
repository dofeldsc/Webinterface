<?php
class Validate {
    private $_passed = false,
            $_errors = array();
        
    public function check($source, $items = array()) {
        global $db;
        
        foreach ($items as $item => $rules) {
        	$imgPass = false;
            foreach($rules as $rule => $rule_value) {
            	if (isset($source[$item])) {
            		$value = trim($source[$item]);
            	} else {
            		$value = NULL;
            	}
                $item = escape($item);
                if (empty($value) && !$imgPass) {
   					switch ($rule) {
   						case 'required':
		   					switch ($item) {
		   						case 'oldpass':
									$this->addError("Altes Passwort wird benötigt");
									break;

								case 'password_new':
									$this->addError("Neues Passwort wird benötigt");
									break;

								case 'password_new_again':
									$this->addError("Neues Passwort bestätigen wird benötigt");
									break;

								default:
									$this->addError("{$item} wird benötigt");
									break;
							}
   							break;

   						case 'requiredImg':
   							if (empty($_FILES[$item]['name'])) {
			   					switch ($item) {
			   						case 'user_image':
										$this->addError("Du musst einen Avatar hochladen");
										break;

									default:
										$this->addError("Datei {$item} wird benötigt");
										break;
								}
   							} else {
   								$imgPass = true;
   							}
   							
   							break;
   						
   						default:
   							break;
   					}
                } else if (!empty($value) || $imgPass) {
                    switch ($rule) {
                        case 'min':
							if (strlen($value) < $rule_value)
							{
			   					switch ($item) {
									case 'password_new':
										$this->addError("Das neue Passwort muss mindestens {$rule_value} Zeichen lang sein");
										break;

									default:
										$this->addError("{$item} muss mindestens {$rule_value} Zeichen lang sein");
										break;
								}
							}
							break;
						case 'max':
							if (strlen($value) > $rule_value)
							{
			   					switch ($item) {
									case 'add_comment':
										$this->addError("Das Kommentar darf maximal {$rule_value} Zeichen lang sein");
										break;

									default:
										$this->addError("{$item} darf maximal {$rule_value} Zeichen lang sein");
										break;
								}
							}
							break;
						case 'matches':
							if($value != $source[$rule_value])
							{
								switch ($rule_value) 
								{
									case 'password_new':
										$this->addError("Das neue Passwort stimmen nicht überein!");
										break;
									
									default:
										$this->addError("{$rule_value} muss mit {$item} übereinstimmen");
										break;
								}
							}
							break;
						case 'unique':
							$query = "SELECT * FROM {$rule_value} WHERE {$item} = '{$value}'";
							$check = $db->getResultsArray($query);
							if (count($check))
							{
								$this->addError("Der Benutzer existiert bereits");
							}
							break;
						case 'check_hash':
							if(!check_hash($value,$rule_value))
							{
								$this->addError("Dein altes Password ist falsch");
							}
							break;
						case 'sizeMax':
							if($_FILES[$item]['size'] > $rule_value)
							{
								$tmp = formatBytes($rule_value);
			   					switch ($item) {
									case 'user_image':
										$this->addError("Der Avatar darf maximal {$tmp} groß sein");
										break;

									default:
										$this->addError("{$item} darf maximal {$tmp} groß sein");
										break;
								}
							}
							break;

						case 'imgType':
							$imgExt = strtolower(pathinfo($_FILES[$item]['name'],PATHINFO_EXTENSION));
							if(!in_array($imgExt,$rule_value))
							{
								$allowed = implode(', ',$rule_value);
			   					switch ($item) {
									case 'user_image':
										$this->addError("Der Avatar muss als {$allowed} hochgeladen werden.");
										break;

									default:
										$this->addError("{$item} muss als {$allowed} hochgeladen werden.");
										break;
								}
							}
							break;
						case 'portrait':
							list($width, $height) = getimagesize($_FILES[$item]['tmp_name']);
							if($width != $height)
							{
			   					switch ($item) {
									case 'user_image':
										$this->addError("Die Kanten des Avatars müssen gleich lang sein.");
										break;

									default:
										$this->addError("Die Kanten des {$item} müssen gleich lang sein.");
										break;
								}
							}
							break;
                    }
                }
            }
        }
        
        if (empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }
    
    private function addError($error) {
        $this->_errors[] = $error;
    }
    
    public function errors() {
        return $this->_errors;
    }
    
    public function passed() {
        return $this->_passed;
    }
}