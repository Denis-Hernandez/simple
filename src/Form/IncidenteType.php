<?php

namespace App\Form;

use App\Entity\Incidente;
use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IncidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tipo', ChoiceType::class, [
                'choices'  => [
                    'Roja' => 'roja',
                    'Amarilla' => 'amarilla',
                ],
                'placeholder' => 'Seleccione el tipo de incidente',
            ])
            ->add('descripcion')
            ->add('fechaincidente', DateType::class, [
                'widget' => 'choice',
                'format' => 'ddMMyyyy',
                'label'=>'Fecha de Incidente:',
                'attr' => ['class'=>'form-control']])
            ->add('fechasuspencion', DateType::class, [
                'widget' => 'choice',
                'format' => 'ddMMyyyy',
                'label'=>'Fecha de Suspencion:',
                'empty_data' => null,
                'required' => false,
                'placeholder' => [
                    'year' => 'Año', 
                    'month' => 'Mes', 
                    'day' => 'Día'
                ],
                'attr' => ['class'=>'form-control']])
            ->add('usuario', EntityType::class,[
                'class' => Usuario::class,
                'choice_label' => function (Usuario $usuario) {
                    return $usuario->getNombre() . ' ' . $usuario->getApellido();
                },
                'placeholder' => 'Seleccione Jugador'
            ])
            ->add('Guardar',SubmitType::class,[
                'attr' => ['class'=>'btn btn-primary'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Incidente::class,
        ]);
    }
}
