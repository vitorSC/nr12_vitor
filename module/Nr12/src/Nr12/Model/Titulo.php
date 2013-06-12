<?php
namespace Nr12\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade Titulo
 * @category Nr12
 * @package Model
 * @author Vitor Schweder <vitor.scw@gmail.com>
 *
 * @ORM\Table(name="nr12_titulo")
 * @ORM\Entity
 */

class Titulo {
	/**
	 * @var int
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $titulo_id;
	
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
     * @var array
     * @ORM\OneToMany(targetEntity="Subtitulo", mappedBy="titulo_id")
     */
    protected $subtitulos;
    
    /**
     * Tranforma array em informações
     * @return void
     */
    public function exchangeArray($data) 
    {
    	$this->titulo_id  = (!empty($data['titulo_id'])) ? $data['titulo_id'] : null;
    	$this->descricao  = (!empty($data['descricao'])) ? $data['descricao'] : null;
    	$this->subtitulos = (!empty($data['subtitulos'])) ? $data['subtitulos'] : null;			
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
     * @return Titulo
     */
    public function getInputFilter()
    {
    	if(!$this->inputFilter) {
    		$inputFilter = new InputFilter();
    		$factory     = new InputFactory();
    
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'titulo_id',
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
     * Retorna ID do Título
     * @return int
     */
    public function getTituloId() 
    {
    	return $this->titulo_id;	
    }
    
    /**
     * Retorna a descrição do Título
     * @return string
     */
    public function getDescricao()
    {
    	return $this->descricao;
    }
    
    /**
     * Seta descrição do título
     * @param descricao
     * @return Titulo
     */
    public function setDescricao($descricao) 
    {
    	$this->descricao = $descricao;
    	
    	return $this;
    }
    
    /**
     * Retorna subtitulos do título
     * @return array
     */
    public function getSubtitulos()
    {
    	return $this->subtitulos;
    }
    
    /**
     * Adiciona um subtitulo ao titulo
     * @param Subtitulo
     * @return Titulo
     */
    public function addSubtitulo($subtitulo)
    {
    	$this->subtitulos->add($subtitulo);
    
    	return $this;
    }
}