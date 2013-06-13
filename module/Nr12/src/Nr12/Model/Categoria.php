<?php
namespace Nr12\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade Categoria
 * @category Nr12
 * @package Model
 * @author Vitor Schweder <vitor.scw@gmail.com>
 *
 * @ORM\Table(name="nr12_categoria")
 * @ORM\Entity
 */
class Categoria {
	/**
	 * @var int
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $categoria_id;	

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255)
	 */
	protected $descricao;
	
	/**
	 * @ORM\OneToMany(targetEntity="Produto", mappedBy="categoria")
	 */
	protected $produtos;

	/**
	 * InputFilter
	 * @var InputFilter
	 */
	protected $inputFilter;

	/**
	 * Tranforma array em informações
	 * @return void
	 */
	public function exchangeArray($data)
	{
		$this->categoria_id  = (!empty($data['categoria_id'])) ? $data['categoria_id'] : null;
		$this->descricao     = (!empty($data['descricao'])) ? $data['descricao'] : null;				
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
	 * @return Categoria
	 */
	public function getInputFilter()
	{
		if(!$this->inputFilter){
			$inputFilter = new InputFilter();
			$factory     = new InputFactory();

			$inputFilter->add($factory->createInput(array(
					'name' => 'categoria_id',
					'required' => true,
					'filters' => array(
							array('name' => 'Int'),
					),
			)));		

			$inputFilter->add($factory->createInput(array(
				'name' => 'descricao',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 1,
							'max' => 255
						),
					),
				),
			)));			

			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}

	/**
	 * Retorna ID da Categoria
	 * @return int
	 */
	public function getCatId()
	{
		return $this->categoria_id;
	}	

	/**
	 * Retorna descrição da Categoria
	 * @return string
	 */
	public function getDescricao()
	{
		return $this->descricao;
	}

	/**
	 * Seta descrição da Categoria
	 * @param descricao
	 * @return Categoria
	 */
	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;

		return $this;
	}
}