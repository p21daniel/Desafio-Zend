<?php

namespace Blog\Form;

use Blog\Entity\Post;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Class PostForm
 * @package Blog\Form
 */
class PostForm extends Form
{
    /**
     * PostForm constructor.
     * @param string $name
     * @param array $options
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods(false));
        $this->setObject(new Post());

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'text',
            'options' => array(
                'label' => 'Texto',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'style' => 'margin: 5px',
                'placeholder' => 'Texto',
                'required' => 'required'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'title',
            'options' => array(
                'label' => 'Título',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'style' => 'margin: 5px',
                'placeholder' => 'Título',
                'required' => 'required'
            )
        ));

        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Inserir',
                'class' => 'btn btn-info'
            )
        ));
    }
}