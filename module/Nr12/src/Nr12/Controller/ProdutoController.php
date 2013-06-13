<?php
namespace Nr12\Controller;

use Nr12\Controller\EntityUsingController;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Zend\View\Model\ViewModel;
use Nr12\Model\Titulo;
use Nr12\Form\TituloForm;

/**
 * Controlador que gerencia os produtos
 *
 * @category Nr12
 * @package Controller
 * @author Vitor Schweder <vitor.scw@gmail.com>
 */
class ProdutoController extends EntityUsingController
{
	/**
	 * Mostra os produtos cadastrados
	 * @return array
	 */
	public function indexAction()
	{	
		$em = $this->getEntityManager();
		
		$produtos = new \Nr12\Model\Produto();
					
		//$produtos->setDescricao('Harry potter');
		
		//$em->persist($produtos);
		//$em->flush();		

		$produtos = $em->getRepository('Nr12\Model\Produto')->findBy(array(), array('descricao' => 'ASC'));
	
		return new ViewModel(array(
			'produtos' => $produtos,
		));
	}	
}