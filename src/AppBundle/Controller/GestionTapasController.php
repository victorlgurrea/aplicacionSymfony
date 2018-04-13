<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tapa;

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
      $formBuilder = $this->createFormBuilder($tapa);
      // el formulario se construye con la ayuda de la funcion getForm()
      $form = $formBuilder->getForm();
      // replace this example code with whatever you need
      return $this->render('gestionTapas/nuevaTapa.html.twig', array('form' => $form->createView(),));
  }

}

?>
