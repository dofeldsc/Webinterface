<?php
class Validate {
    private $_passed = false,
            $_errors = array();
        
    public function check($source, $items = array()) {
        global $db;
        
        foreach ($items as $item => $rules) {
            foreach($rules as $rule => $rule_value) {
            	if (isset($source[$item])) {
            		$value = trim($source[$item]);
            	} else {
            		$value = NULL;
            	}
                $item = escape($item);
                
                if ($rule == 'required' && empty($value)) {
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
                } else if (!empty($value)) {
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
								$this->addError("{$item} darf maximal {$rule_value} Zeichen lang sein");
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