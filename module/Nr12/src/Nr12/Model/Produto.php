<?php
namespace Nr12\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade Produto
 * @category Nr12
 * @package Model
 * @author Vitor Schweder <vitor.scw@gmail.com>
 *
 * @ORM\Table(name="nr12_produto")
 * @ORM\Entity
 */

class Produto {
	/**
	 * @var int
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $produto_id;
	
	/**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $descricao;

    /**
     * InputFilter
     * @var InputFilter
     */
    protected $inputFilter;
    
    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="produtos")
     * @ORM\JoinColumn(name="categoria", referencedColumnName="categoria_id")
     */
    protected $categoria;
    
    /**
     * Tranforma array em informações
     * @return void
     */
    public function exchangeArray($data) 
    {
    	$this->produto_id  = (!empty($data['produto_id'])) ? $data['produto_id'] : null;
    	$this->descricao   = (!empty($data['descricao'])) ? $data['descricao'] : null;
    	$this->categorias  = (!empty($data['categorias'])) ? $data['categorias'] : null;			
    }
    
    /**
     * Retorna atributos em forma de array
     * @return array
     */
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    
    
    /**
     * Seta validações dos campos
     * @return Produto
     */
    public function getInputFilter()
    {
    	if(!$this->inputFilter) {
    		$inputFilter = new InputFilter();
    		$factory     = new InputFactory();
    
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'produto_id',
    			'required' => true,
    			'filters'  => array(
    				array('name' => 'Int'),
    			),
    		)));
    
    		$inputFilter->add($factory->createInput(array(
    			'name'       => 'descricao',
    			'required'   => true,
    			'validators' => array(
    				array(
    					'name'    => 'StringLength',
    					'options' => array(
    					'encoding' => 'UTF-8',
    					'min'      => 1,
    					'max'      => 255
    					),
    				),
    			),
    		)));
    
    		$this->inputFilter = $inputFilter;
    	}
    	return $this->inputFilter;
    }
    
    /**
     * Retorna ID do Produto
     * @return int
     */
    public function getProdutoId() 
    {
    	return $this->produto_id;	
    }
    
    /**
     * Retorna a descrição do Produto
     * @return string
     */
    public function getDescricao()
    {
    	return $this->descricao;
    }
    
    /**
     * Seta descrição do Produto
     * @param descricao
     * @return Produto
     */
    public function setDescricao($descricao) 
    {
    	$this->descricao = $descricao;
    	
    	return $this;
    }
    
    /**
     * Retorna categorias do Produto
     * @return array
     */
    public function getCategoria()
    {
    	return $this->categoria;
    }
    
    /**
     * Adiciona uma categoria ao Produto
     * @param Categoria
     * @return Produto
     */
    public function addCatProduto($categoria)
    {
    	$this->categoria = $categoria;
    
    	return $this;
    }
}