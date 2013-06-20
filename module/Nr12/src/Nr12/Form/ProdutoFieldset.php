<?php
namespace Nr12\Form;

use Nr12\Model\Produto;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class ProdutoFieldset extends Fieldset implements InputFilterProviderInterface
{
	public function __construct(ObjectManager $objectManager)
	{
		parent::__construct('produto'); 

		$this->setHydrator(new DoctrineHydrator($objectManager, 'Nr12\Model\Produto'))
		->setObject(new Produto());

		$this->add(array(
			'type' => 'Zend\Form\Element\Text',
			'name' => 'descricao',
				'options' => array(
					'label' => 'Descrição do produto'
				),
		));

		$categoriaFieldset = new CategoriaFieldset($objectManager);
		/* $this->add(array(
			'type'    => 'Zend\Form\Element\Collection',
			'name'    => 'categorias',
			'options' => array(
				'count' => 2,
				'target_element' => $categoriaFieldset,				
			)
		)); */
		
		$this->add(
    		array(
        		'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        		'name' => 'name',
        		'options' => array(
            		'object_manager'  => $objectManager,
            		'target_class'    => 'Nr12\Model\Categoria',
            		'label_generator' => function($targetEntity) {
                		return $targetEntity->getCatId() . ' - ' . $targetEntity->getDescricao();
            		},
        		),
    		)
		);
		
	}

	public function getInputFilterSpecification()
	{
		return array(
			'descricao' => array(
				'required' => true
			),
		);
	}
}