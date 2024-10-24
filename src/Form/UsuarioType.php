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
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('nombre',TextType::class, ['label'=>'Nombre:','attr' => ['class'=>'form-control','placeholder'=>'Ingrese nombres']])
            ->add('apellido',TextType::class, ['label'=>'Apellido:','attr' => ['class'=>'form-control','placeholder'=>'Ingrese apellidos']])
            ->add('fecha_nac', BirthdayType::class, ['widget' => 'choice','format' => 'ddMMyyyy','label'=>'Fecha de Nacimiento:','attr' => ['class'=>'form-control']])
            ->add('equipo', EntityType::class,[
                'label'=>'Equipo:',
                'class' => Equipo::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione un equipo'
            ])
            ->add('imagen', FileType::class, [
                'label' => 'Foto (archivo PNG o JPEG):',
                'mapped' => false,  // No está mapeado directamente a la entidad
                'required' => true,
                'attr' => ['accept' => 'image/*'], // Acepta solo imágenes
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
