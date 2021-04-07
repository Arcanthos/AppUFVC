<?php

namespace App\Form;


use App\Entity\DocumentCategory;
use App\Entity\Ressource;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class RessourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label'=>'Nom du Produit',
            ])
            ->add('category',EntityType::class,[
                'label'=>'Catégorie de document',
                'class'=>DocumentCategory::class,
                'choice_label' => 'name',
            ])
            ->add('price',\Symfony\Component\Form\Extension\Core\Type\IntegerType::class,[
                'label'=>'Prix (en token)',
            ])
            ->add('cover', DropzoneType::class, [
                'attr'=>['data-controller' =>' AddContentController'],
                'label'=>'Image de couverture',
                'mapped'=> false,
                'required'=> false,

            ])
            ->add('file', DropzoneType::class, [
                'attr'=>['data-controller' =>'AddContentController'],
                'label'=>'Fichier',
                'mapped'=> false,
                'required'=> false,

            ])
            ->add('tags', HiddenType::class,[
                'mapped'=>false
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Description du document'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ressource::class,
        ]);
    }
}
