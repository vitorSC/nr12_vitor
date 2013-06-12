<?php
namespace Nr12\Controller;

use Nr12\Controller\EntityUsingController;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Zend\View\Model\ViewModel;
use Nr12\Model\Titulo;
use Nr12\Form\TituloForm;

/**
 * Controlador que gerencia os títulos
 *
 * @category Nr12
 * @package Controller
 * @author Vitor Schweder <vitor.scw@gmail.com>
 */
class TituloController extends EntityUsingController
{
	/**
	 * Mostra os titulos cadastrados
	 * @return array
	 */
	public function indexAction()
	{	
		$em = $this->getEntityManager();
		
		$titulo = new \Nr12\Model\Titulo();
					
		//$titulo->setDescricao('Harry potter');
		
		//$em->persist($titulo);
		//$em->flush();		

		$titulos = $em->getRepository('Nr12\Model\Titulo')->findBy(array(), array('descricao' => 'ASC'));
	
		return new ViewModel(array(
			'titulos' => $titulos,
		));
	}	
}