<?php
namespace Nr12\Form;

use Nr12\Model\Categoria;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class CategoriaFieldset extends Fieldset implements InputFilterProviderInterface
{
	public function __construct(ObjectManager $objectManager)
	{
		parent::__construct('categoria');
	
		$this->setHydrator(new DoctrineHydrator($objectManager, 'Nr12\Model\Categoria'))
		->setObject(new Categoria());
	
		$this->add(array(
			'type' => 'Zend\Form\Element\Hidden',
			'name' => 'categoria_id'
		));
	
		$this->add(array(
			'type'    => 'Zend\Form\Element\Text',
			'name'    => 'descricao',
			'options' => array(
				'label' => 'Categoria'
			 )
		));
	}
	
	public function getInputFilterSpecification()
	{
		return array(
			'categoria_id' => array(
				'required' => false
			),
	
			'descricao' => array(
				'required' => true
			)
		);
	}
}