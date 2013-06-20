<?php
namespace Nr12\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
     * @ORM\ManyToOne(targetEntity="Nr12\Model\Produto", inversedBy="categorias")
     */
    protected $produto;
	
    /**
     * Allow null to remove association
     *
     * @param Produto $produto
     */
    public function setProduto(Produto $produto = null)
    {
    	$this->produto = $produto;
    }
        
    /**
     * @return Produto
    */
    public function getProduto()
    {
    	return $this->produto;
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