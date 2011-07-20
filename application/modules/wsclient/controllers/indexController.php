<?php

/**
 * Wsclient_IndexController
 *  
 * @author remi chautemps
 * @version 1.0
 */

class Wsclient_IndexController extends Zend_Controller_Action 
{
	protected $_url = "http://localhost:8888/ZEND-JSON-RPC/public/wsclient/index/json/";
	public function init()
	{
		$this->_helper->layout()->disableLayout();
	}
	
	/**
	 * JSON CLIENT
	 */
	public function jsonAction()
	{
		$server = new Zend_Json_Server();
		$server->setClass('My_Application_Model_Data');
		
		if ('GET' == $_SERVER['REQUEST_METHOD']) {
			
			$server->setTarget($this->_url)->setEnvelope(Zend_Json_Server_Smd :: ENV_JSONRPC_2);
			$smd = $server->getServiceMap();
			
			
			if (isset ($_GET['method'])) {
				
				//On recupere les methodes depuis le service map
				$arrSmd = Zend_Json::decode($smd);
				//Construction du tableau contenant les liens des methodes
				$links 	= '<h2>' .
							'Liste des methodes JSON' .
						'</h2>' .
						'<table>' .
							'<tr>';
				foreach($arrSmd["services"] as $serv => $value) {
					$links .= '<td width="100px" align="center">' .
								'<a href="'.$this->_url.'?method='.$serv.'">'.$serv.'</a>' .
							'</td>';
				}
				
				$links .= '</tr>' .
						'</table>';
				//Envoi du tableau a la vue
				$this->view->links =  $links;
				
				//On recupere la methode appelee
				$method 	= $_GET['method'];
				$nbParam 	= 0;  //Nombre de parametre de la methode
				
				//On cree un formulaire contenant les parametres
				$formtxt 	= '<form name="'.$method.'" method="post">' .
									'<table>';
				foreach ($smd->getService($method)->getParams() as $param) {
					$formtxt .= 		'<tr>' .
											'<td>'.$param['name'] . ' ('.$param['type'].') :</td>' .
											'<td><input type=text name="' . $param['name'] . '"></td>' .
										'<tr>';
					$nbParam++;
				}
				$formtxt .= 			'<tr>' .
											'<td></td>' .
											'<td><input type=submit value=Envoyer></td>' .
										'</tr>' .
									'</table>' .
							'</form>';
							
				//On envoi le formulaire a la vue json client
				$this->view->form 		=  $formtxt;
				//On envoi le nom de la methode traitee a la vue
				$this->view->method 	= $method;
				//On envoi le nombre de parametres du formulaire a la vue
				$this->view->nbParam 	= $nbParam;
			} else {
				$this->_helper->viewRenderer->setNoRender(true);
				header('Content-Type: application/json');
				echo $smd;
				return;
			}
		} else {
			$this->_helper->viewRenderer->setNoRender();
			echo $server->handle();
		}
	}
}
