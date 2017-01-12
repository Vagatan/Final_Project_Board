<?php

namespace BoardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AdvertisementType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', 'text', ["label" => "Tytuł", 'attr' => ['class' => 'form-control']])
                ->add('description', 'textarea', ["label" => "Opis", 'attr' => ['class' => 'form-control']])
                
                ->add('expirationDate', 'date', ['years' => range(date('Y'), date('Y') +5 ),'data' => new \DateTime('+1 week'), "label" => "Ważne do", 'attr' => ['class' => 'form-control']])
                
                ->add('category', EntityType::class, ["label" => "Kategoria", "class" => "BoardBundle:Category", "choice_label" => "name", 'attr' => ['class' => 'form-control selectpicker']]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BoardBundle\Entity\Advertisement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'boardbundle_advertisement';
    }

}
