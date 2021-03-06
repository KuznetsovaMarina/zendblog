<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity
 */
class Article
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
     * @var integer
     *
     * @ORM\Column(name="category", type="integer", nullable=true)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="article", type="text", length=65535, nullable=false)
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(name="short_article", type="text", length=65535, nullable=true)
     */
    private $shortArticle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_public", type="boolean", nullable=false)
     */
    private $isPublic = '0';
    
    public function getId() {
        return $this->id;
    }

    /*
     * @return \Blog\Entity\Category
     */
    public function getCategory() {
        return $this->category;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getArticle() {
        return $this->article;
    }
    
    public function getArticleForTable(){
        $article = strip_tags($this->getArticle());
        $article = mb_substr($article, 0, 15, 'UTF-8').'...';
        return $article;
    }
    
    public function getShortArticleForTable(){
        $article = strip_tags($this->getShortArticle());
        $article = mb_substr($article, 0, 20, 'UTF-8').'...';
        return $article;
    }

    public function getShortArticle() {
        return $this->shortArticle;
    }

    public function getIsPublic() {
        return $this->isPublic;
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

