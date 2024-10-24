<?php

namespace App\Form;

use App\Entity\Gol;
use App\Entity\Usuario;
use App\Entity\Jornada;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class GolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cantidad')
            ->add('usuario', EntityType::class, [
                'class' => Usuario::class,
                'choice_label' => function (Usuario $usuario) {
                    return $usuario->getNombre() . ' ' . $usuario->getApellido();
                },
                'placeholder' => 'Seleccione un jugador'
            ])
            ->add('jornada', EntityType::class, [
                'class' => Jornada::class,
                'choice_label' => function (Jornada $jornada) {
                    return $jornada->getEquipo1()->getNombre() . ' vs ' . $jornada->getEquipo2()->getNombre().' - '.$jornada->getFecha()->format('d/m/Y');
                },
                'placeholder' => 'Seleccione una jornada',
                
            ])
            ->add('Guardar', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary'],
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gol::class,
        ]);
    }
}
