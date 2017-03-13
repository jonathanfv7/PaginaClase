<?php
	class Validacion extends Singleton {
				private $_rules = array(); // _rules['nombre'] => 'required|alpha_space', _rules['apellidos'] => 'required|alpha_space'
				private $_errors = array();// _errors['nombre'] = array('value' => '','rule' => 'required') o _errors['nombre'] = array('value' => 'Pedro5','rule' => 'alpha_space') o _errors['nombre'] = array('value' => 'Pedro','rule' => 'ok')
				private $_oks = array(); // _oks['nombre'] =>'Luis', _oks['apellidos'] => "Sánchez Ruiz"
				private $_errorFoto=array();

		public function addRules($rules) {
			$this->_rules=$rules;
		}

		public function run($toValidate) {
			foreach ($toValidate as $field => $value) {
				if (!array_key_exists($field, $this->_rules)) continue;
				$rules = explode('|', $this->_rules[$field]);

				if (in_array('required', $rules)) {
					$this->_validate_required($field, $value);
					if (getArray($this->getErrorsByField($field), 'rule') == 'required')
						continue;
				}

			foreach ($rules as $rule) {
				if ($rule == 'required') continue;
					$method = '_validate_' . $rule;

					if (!method_exists(__CLASS__, $method)) continue;
					$this->$method($field, $value);
			}

			if (empty($this->getErrorsByField($field)))
				$this->_setError($field, $value, 'ok');
			}
		}

		public function isValid() {
			if (count($this->_oks) == count($this->_errors))
				return true;

			return false;
		}

		public function getStrRule($rule) {
			switch ($rule) {
			case 'alpha_space': return 'Solo puede contener letras (a-z) y espacios en blanco';
			case 'foto': return $this-> _errorFoto;
			case 'maxi_siete': return 'Introduzca un numero con un maximo de 7 cifras';
			case 'correo': return 'Introduzca un correo valido';
			case 'id': return 'Solo validos numeros enteros';
            case 'alphanum_space': return 'Puede introducir solo letras y numeros';
            case 'numerico': return 'Puede introducir solo un número';

			}
			return '';
		}

        public function restoreValue($name) {
            if(array_key_exists($name, $this->_errors)){
            	$value=$this->_errors[$name]['value'];
            	return $value;
			}
            return "";
        }
        public function restoreCheckboxes($name, $value, $default = false) {
//si _errors está vacío, es la primera vez que se visuliza el formulario
            if ($this->_errors) {
                if (array_key_exists($name, $this->_errors)) {
//si no se marca ninguna casilla, _errors[$name]['value'] no existe
                    if ($this->_errors[$name]['value'])
                        foreach ($this->_errors[$name]['value'] as $valor) {
                            if ($valor == $value)
                                return 'checked';
                        }
                }
// si el nombre del campo no está en _errors, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
            } elseif ($default)
                return 'checked';
        }

        public function restoreRadios($name, $value, $default = false) {
            if (array_key_exists($name, $this->_errors)) {
                if ($this->_errors[$name]['value'] == $value)
                    return 'checked';
// si el nombre del campo no está en _radios, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
            } elseif ($default)
                return 'checked';
            return '';
        }
        public function restoreSelects($name, $value, $default = false) {
            if (array_key_exists($name, $this->_errors)) {
                if ($this->_errors[$name]['value'] == $value)
                    return 'checked';
// si el nombre del campo no está en _radios, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
            } elseif ($default)
                return 'checked';
            return '';
        }
        public function restoreSelected($name, $value, $default = false) {
            if (array_key_exists($name, $this->_errors)) {
                if ($this->_errors[$name]['value'] == $value)
                    return 'selected';
// si el nombre del campo no está en _radios, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
            } elseif ($default)
                return 'selected';
            return '';
        }


        public function getOks() {
			return $this->_oks;
		}

		public function getErrorsByField($field) {
			return getArray($this->_errors, $field, array());
		}

		public function getErrors() {
			return $this->_errors;
		}

		private function _setError($field, $value, $rule) {
			$this->_errors[$field] = array(
				'value' => $value,
				'rule' => $rule
				);

			if ($rule=='ok') {
					$this->_oks[$field] = $value;
				}
		}

		private function _validate_alpha_space($field, $value) {
            if (!preg_match('/^[a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ\s]+$/i', $value))
				$this->_setError($field, $value, 'alpha_space');
		}

		private function _validate_correo($field, $value) {
            if (!preg_match('/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/', $value))
				$this->_setError($field, $value, 'correo');
		}

		private function _validate_integer($field, $value) {
			if (!preg_match('/^\d*$/', $value))
				$this->_setError($field, $value, 'integer');
		}


        private function _validate_required($field, $value) {
            $valor = $value;
            if (is_array($value)){
                $valor = implode(',', $value);
            }
            if (strlen($valor) == 0)
                $this->_setError($field, $value, 'required');
        }
        private function _validate_maxi_siete($field, $value) {
            if (!preg_match('/^[0-9]{0,7}$/i', $value))
                $this->_setError($field, $value, 'maxi_siete');
        }

        private function _validate_numerico($field, $value) {
            if (!preg_match('/^[0-9]+$/i', $value))
                $this->_setError($field, $value, 'numerico');
        }

        private function _validate_alphanum_space($field, $value) {
            if (!preg_match('/^[a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ0-9][a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ0-9\s]+$/i', $value))
                $this->_setError($field, $value, 'alphanum_space');
        }


		private function _validate_foto($field, $value) {
				if ($value["error"] == UPLOAD_ERR_OK) {
						if (($value["type"] != "image/pjpeg") and ($value["type"] != "image/jpeg")) {
									$this->_setError($field, $value, 'foto');
									$this->_errorFoto= "<b>Solo se permite subir fotos en JPG</b>";
						} elseif ( !move_uploaded_file($value["tmp_name"], "fotos/" . basename( $value["name"] ) ) ) {
									$this->_setError($field, $value, 'foto');
									$this->_errorFoto= "<b>Lo sentimos, hubo un problema al subir esa foto</b>" .$value["error"] ;
						} else
								$this->_setError($field, $value, 'ok');
				} else {
						$this->_setError($field, $value, 'foto');
						switch( $value["error"] ) {
							case UPLOAD_ERR_INI_SIZE:
								$this->_errorFoto = "<b>La foto es más grande de lo que permite el servidor.</b>";
								break;
							case UPLOAD_ERR_FORM_SIZE:
								$this->_errorFoto = "<b>La foto es más grande de lo que permite el formulario.</b>";
								break;
							case UPLOAD_ERR_NO_FILE:
								$this->_setError($field, $value, 'required');
								break;
							default:
								$this->_errorFoto = "Ponte en contacto con el administrador del servidor para obtener ayuda.";
				}
			}

		}


	}
?>
