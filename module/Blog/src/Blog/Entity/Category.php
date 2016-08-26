<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="category_key", type="string", length=20, nullable=false)
     */
    private $categoryKey;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name", type="string", length=100, nullable=false)
     */
    private $categoryName;
    
    
    public function getId() {
        return $this->id;
    }

    public function getCategoryKey() {
        return $this->categoryKey;
    }

    public function getCategoryName() {
        return $this->categoryName;
    }

    public function exchangeArray($data){
        foreach ($data as $key => $value){
            if(property_exists($this, $key)){
                $this->$key = ($value !== null) ? $value : null;
            }
        }
    }
    
    public function getArrayCopy(){
        return get_object_vars($this);
    }

}

