<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class CategoriaType extends AbstractType
{
    //el submit va a enviar los datos al mismo action del mismo controller que proviene osea
    //en GestionTapasController a nuevaTapaAction
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre', TextType::class)
        ->add('descripcion', CKEditorType::class)
        ->add('foto', FileType::class,array('attr'=>array('onchange'=>'onChange(event)')))
        ->add('save', SubmitType::class, array('label' => 'Nueva Categoria'))
        ;
    }
}
?>
