<?php

namespace Admin\Form;

use Zend\Form\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

//use Admin\Filter\ArticleAddInputFilter;

class ArticleAddForm extends Form implements ObjectManagerAwareInterface{
    
    protected $objectManager;
    
    public function getObjectManager() {
        return $this->objectManager;
    }

    public function setObjectManager(ObjectManager $objectManager) {
        $this->objectManager = $objectManager;
    }
    
    public function __construct(ObjectManager $objectManager) {
        parent::__construct('articleAddForm');
        $this->setObjectManager($objectManager);
        $this->createElements();
    }

    public function createElements(){
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'bs-example form-horizontal');
        
        //$this->setInputFilter(new ArticleAddInputFilter());
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',  
            'name' => 'category',
            'options' => array(
                'label' => 'Категория',
                'empty_option' => 'Выберите категорию...', 
                'object_manager' => $this->objectManager,
                'target_class' => 'Blog\Entity\Category',
                'property' => 'categoryName',
            ),
            
            'attributes' => array(
                'class' => 'form-control',
                'required' => 'required',  // => поле обязательно для заполнения
            ),
        ));
        /*
        $this->add(array(
            'name' => 'category',
            'type' => 'Text',
            'options' => array(
                'min' => 3,
                'max' => 100,
                'label' => 'Категория',
            ),
            
            'attributes' => array(
                'class' => 'form-control',
                'required' => 'required',
            ),
        ));*/
        
        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'options' => array(
                'min' => 3,
                'max' => 100,
                'label' => 'Заголовок',
            ),
            
            'attributes' => array(
                'class' => 'form-control',
                'required' => 'required',
            ),
        ));
        
        $this->add(array(
            'name' => 'shortArticle',
            'type' => 'TextArea',
            'options' => array(
                'label' => 'Начало статьи',
            ),
            
            'attributes' => array(
                'class' => 'form-control-ckeditor',
            ),
        ));
        
        $this->add(array(
            'name' => 'article',
            'type' => 'TextArea',
            'options' => array(
                'label' => 'Статья',
            ),
            
            'attributes' => array(
                'class' => 'form-control-ckeditor',
            ),
        ));
        
        $this->add(array(
            'name' => 'isPublic',
            'type' => 'CheckBox',
            'options' => array(
                'label' => 'Опубликовать',
                'use_hidden_Element' => true,
                'checked_value' => 1,
                'unchecked_value' => 0,
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Сохранить',
                'id' => 'btn_submit',
                'class' => 'btn btn-primary',
            ),
        ));
    }
    
}
