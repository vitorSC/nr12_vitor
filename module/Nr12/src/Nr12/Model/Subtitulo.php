<?php
namespace Nr12\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade Subtitulo
 * @category Nr12
 * @package Model
 * @author Vitor Schweder <vitor.scw@gmail.com>
 *
 * @ORM\Table(name="nr12_subtitulo")
 * @ORM\Entity
 */
class Subtitulo {
	/**
	 * @var int
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $subtitulo_id;

	/**
	 * @var int
	 * @ORM\ManyToOne(targetEntity="Titulo", inversedBy="subtitulos")
	 * @ORM\JoinColumn(name="titulo_id", referencedColumnName="titulo_id")
	 */
	protected $titulo_id;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255)
	 */
	protected $descricao;

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	protected $descricao_completa;

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
		$this->subtitulo_id       = (!empty($data['subtitulo_id'])) ? $data['subtitulo_id'] : null;
		$this->descricao          = (!empty($data['descricao'])) ? $data['descricao'] : null;
		$this->descricao_completa = (!empty($data['descricao_completa'])) ? $data['descricao_completa'] : null;
		$this->titulo_id          = (!empty($data['titulo_id'])) ? $data['titulo_id'] : null;
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
		if(!$this->inputFilter){
			$inputFilter = new InputFilter();
			$factory     = new InputFactory();

			$inputFilter->add($factory->createInput(array(
					'name' => 'subtitulo_id',
					'required' => true,
					'filters' => array(
							array('name' => 'Int'),
					),
			)));

			$inputFilter->add($factory->createInput(array(
				'name' => 'titulo_id',
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

			$inputFilter->add($factory->createInput(array(
					'name' => 'descricao_completa',
					'required' => true,
					'filters' => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
			)));

			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}

	/**
	 * Retorna ID do Subtitulo
	 * @return int
	 */
	public function getSubtituloId()
	{
		return $this->subtitulo_id;
	}

	/**
	 * Retorna ID do titulo
	 * @return int
	 */
	public function getTituloId()
	{
		return $this->titulo_id;
	}

	/**
	 * Seta ID do titulo
	 * @param titulo_id
	 * @return Subtitulo
	 */
	public function setTituloId($titulo_id)
	{
		$this->titulo_id = $titulo_id;
	}

	/**
	 * Retorna descrição do subtitulo
	 * @return string
	 */
	public function getDescricao()
	{
		return $this->descricao;
	}

	/**
	 * Seta descrição do subtitulo
	 * @param descricao
	 * @return Subtitulo
	 */
	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;

		return $this;
	}

	/**
	 * Retorna descrição completa do subtitulo
	 * @return string
	 */
	public function getDescricaoCompleta()
	{
		return $this->descricao_completa;
	}

	/**
	 * Seta descrição completa do subtitulo
	 * @param descricao
	 * @return Subtitulo
	 */
	public function setDescricaoCompleta($descricao_completa)
	{
		$this->descricao_completa = $descricao_completa;

		return $this;
	}
}