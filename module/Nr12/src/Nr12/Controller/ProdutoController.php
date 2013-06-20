<?php
namespace Nr12\Controller;

use Nr12\Form\UpdateProdutoForm;

use Nr12\Controller\EntityUsingController;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Zend\View\Model\ViewModel;
use Nr12\Model\Produto;
use Nr12\Form\CreateProdutoForm;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

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

		$produtos = $em->getRepository('Nr12\Model\Produto')->findBy(array(), array('descricao' => 'ASC'));
	
		return new ViewModel(array(
			'produtos' => $produtos,
		));
	}

	public function addAction() 
	{			
		$objectManager = $this->getEntityManager();		
		$form = new CreateProdutoForm($objectManager);		
		
		$produto = new Produto();
		$form->bind($produto);
		
		$request = $this->getRequest();
		if ($request->isPost()) {			
			
			//$form->setInputFilter($produto->getInputFilter());			
			$form->setData($request->getPost());
			
			if ($form->isValid()) {							
				$this->getEntityManager()->persist($produto);
				$this->getEntityManager()->flush();
				
				$this->flashMessenger()->addSuccessMessage('Produto cadastrado com sucesso.');
				
				return $this->redirect()->toRoute('produto');
			}
		}
		
		return array(
			'form' => $form		
		);
		
	}
	
	public function editAction()
	{	
		$produto = $this->userService->get($this->params('produto_id'));
    	$form->bind($Produto);
		
		$form = new UpdateProdutoForm($this->getEntityManager());
		$form->get('submit')->setValue('Alterar');
		
		$request = $this->getRequest();
		if ($request->isPost()) {
				
			$form->setInputFilter($produto->getInputFilter());
			$form->setData($request->getPost());
				
			if ($form->isValid()) {				
				$this->getEntityManager()->flush();
	
				$this->flashMessenger()->addSuccessMessage('Produto alterado com sucesso.');
	
				return $this->redirect()->toRoute('produto');
			}
		}
	
		return array(
			'form' => $form
		);
	
	}
}