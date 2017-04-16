<?php

App::uses('Model', 'Model');

class Cliente extends AppModel {
	
    public $name = 'Cliente';
    public $useTable = 'cliente';
    public $primaryKey = 'id_cliente';
    public $useDbConfig = 'default';

    /** 
	 * Efetua login 
	 * @access public 
	 * @param String $email
	 * @param Array $conditions
	*/
	public function emailExistsRetornaDadosUsuario($email='')
	{

		try {

			if ( empty( $email ) ) {
                throw new LogicException("Valide as configurações do e-mail.", 1);                    
            }
	
			
			/**
			*
			* array filtro
			*
			**/
			$conditions = array(
		    	'fields' => array(
		    		'Cliente.id_cliente',
					'Cliente.id_shop_grupo',			
					'Cliente.id_shop',			
					'Cliente.id_default_grupo',			
					'Cliente.nome', 
					'Cliente.email',
					'Cliente.nivel',
					'Cliente.senha',
					'Cliente.ativo',
					'Cliente.security_key'
		    	),
		        'conditions' => array( 
		        	'Cliente.email' => base64_decode( $email )
		        )
		    );
			
			
			/**
    		*
    		* verifico se o usuario existe
    		*
    		**/
    		if ( $this->find('count', $conditions ) <= 0 ) {
                throw new NotFoundException("O e-mail ou a senha inseridos estão incorretos.", 1);
            } else {
    			return $this->find('first', $conditions );
    		}

        } catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);
        
        } catch (NotFoundException $e) {

            throw new Exception($e->getMessage(), 1);

		} catch (LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}
	
	}

}
