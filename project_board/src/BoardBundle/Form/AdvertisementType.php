<?php

namespace BoardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AdvertisementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', ["label"=>"Tytuł"])->add('description', 'textarea', ["label"=>"Opis"])->add('expirationDate', 'datetime', ["label" => "Ważne do"])->add('user')->add('category', EntityType::class, ["label"=>"Kategoria", "class" => "BoardBundle:Category", "choice_label" => "name"]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BoardBundle\Entity\Advertisement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'boardbundle_advertisement';
    }


}
