<?php
namespace Nr12\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Entidade Produto 
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
     * @ORM\OneToMany(targetEntity="Nr12\Model\Categoria", mappedBy="produto", cascade={"persist"})
     */
    protected $categorias;
    
    public function __construct()
    {
    	$this->categorias = new ArrayCollection();
    }
    
    /**
     * @param Collection $categorias
     */
    public function addCategorias(Collection $categorias)
    {
    	foreach ($categorias as $categoria) {
    		$categorias->setProduto($this);
    		$this->categorias->add($categoria);
    	}
    }

    /**
     * @param Collection $categorias
     */
    public function removeCategorias(Collection $categorias)
    {
    	foreach ($categorias as $categoria) {
    		$categoria->setProduto(null);
    		$this->categorias->removeElement($categoria);
    	}
    }
    
    /**
     * @return Collection
     */
    public function getCategorias()
    {
    	return $this->categorias;
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
     * Seta id do Produto
     * @param int $id
     * @return Produto
     */
    public function setProdutoId($id)
    {
    	$this->id = $descricao;
    	 
    	return $this;
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
     * Retorna a descrição do Produto
     * @return string
     */
    public function getDescricao()
    {
    	return $this->descricao;
    }
       
}