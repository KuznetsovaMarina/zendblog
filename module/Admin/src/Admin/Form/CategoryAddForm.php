<?php

namespace Admin\Form;

use Zend\Form\Form;
//use Zend\InputFilter\Factory as InputFactory;
//use Zend\InputFilter\InputFilter;
//use Admin\Filter\CategoryAddInputFilter;

class CategoryAddForm extends Form{
    
    public function __construct($name = null) {
        parent::__construct('categoryAddForm');
        
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'bs-example form-horizontal');
        
        //$this->setInputFilter(new CategoryAddInputFilter());
        
        $this->add(array(
            'name' => 'categoryKey',
            'type' => 'text',
            'options' => array(
                'min' => 3,
                'max' => 100,
                'label' => 'Ключ',
            ),
            
            'attributes' => array(
                'class' => 'form-control',
                'required' => 'required',  // => поле обязательно для заполнения
            ),
        ));
        
        $this->add(array(
            'name' => 'categoryName',
            'type' => 'Text',
            'options' => array(
                'min' => 3,
                'max' => 100,
                'label' => 'Название',
            ),
            
            'attributes' => array(
                'class' => 'form-control',
                'required' => 'required',
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