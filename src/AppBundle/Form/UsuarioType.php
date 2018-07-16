<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UsuarioType extends AbstractType
{
    //el submit va a enviar los datos al mismo action del mismo controller que proviene osea
    //en GestionTapasController a nuevaTapaAction
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
          ->add('email', EmailType::class)
          ->add('plainPassword', RepeatedType::class, array(
              'type' => PasswordType::class,
              'first_options'  => array('label' => 'Contraseña'),
              'second_options' => array('label' => 'Repite contraseña'),
          ))
        ->add('registrar', SubmitType::class, array('label' => 'Registrar'))
      ;
    }
}
?>
