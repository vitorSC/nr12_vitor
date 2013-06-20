<?php
namespace Nr12\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;
use Nr12\Model\Produto;

class CreateProdutoForm extends Form
{	
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('produto');
                        
        // The form will hydrate an object of type "Produto"
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Nr12\Model\Produto'))
		->setObject(new Produto());      

        // Add the user fieldset, and set it as the base fieldset
        $produtoFieldset = new ProdutoFieldset($objectManager);
        $produtoFieldset->setUseAsBaseFieldset(true);
        $this->add($produtoFieldset);		
        
        $this->add(array(
        	'name' => 'submit',        	
        	'attributes' => array(
        		'type' => 'submit',
        		'value' => 'Confirmar'
        	)
        ));
        // … add CSRF and submit elements …

        // Optionally set your validation group here
    }
}