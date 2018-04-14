<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tapa;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/gestionTapas")
 */
class GestionTapasController extends Controller
{
  /**
   * @Route("/nuevaTapa", name="nuevaTapa")
   */
  public function nuevaTapaAction(Request $request)
  {
      //Vamos a crear una nueva tapa
      $tapa = new Tapa();
      // le pasamos el objeto tapa al creador de formularios quien con la ayuda de entity Tapa sabe los campos que necesita
      // creamos el fomulario
      $formBuilder = $this->createFormBuilder($tapa);
      $formBuilder->add('nombre', TextType::class);
      $formBuilder->add('descripcion', TextareaType::class);
      $formBuilder->add('ingredientes', TextareaType::class);
      $formBuilder->add('fechaCreacion', DateType::class);
      $formBuilder->add('save', SubmitType::class, array('label' => 'Nueva Tapa'));
      // el formulario se construye con la ayuda de la funcion getForm()
      $form = $formBuilder->getForm();
      // replace this example code with whatever you need
      return $this->render('gestionTapas/nuevaTapa.html.twig', array('form' => $form->createView(),));
  }

}

?>
