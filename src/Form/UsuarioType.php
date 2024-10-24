<?php

namespace App\Form;

use App\Entity\Usuario;
use App\Entity\Equipo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('nombre',TextType::class, ['label'=>'Nombre:','attr' => ['class'=>'form-control','placeholder'=>'ingrese nombres']])
            ->add('apellido',TextType::class, ['label'=>'Apellido:','attr' => ['class'=>'form-control','placeholder'=>'ingrese apellidos']])
            ->add('fecha_nac', BirthdayType::class, ['widget' => 'choice','format' => 'ddMMyyyy','label'=>'Fecha de Nacimiento:','attr' => ['class'=>'form-control']])
            ->add('equipo', EntityType::class,[
                'class' => Equipo::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione un equipo'
            ])
            ->add('Guardar',SubmitType::class,[
                'attr' => ['class'=>'btn btn-primary'],
            ])
        ;
        //dd($builder);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
