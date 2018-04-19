<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tapa;
use AppBundle\Form\TapaType;


/**
 * @Route("/gestionTapas")
 */
class GestionTapasController extends Controller
{
  /**
   * @Route("/nuevaTapa", name="nuevaTapa")
   */
  // los datos del formulario vendran en el $request
  // objeto request en https://api.symfony.com/3.4/Symfony/Component/HttpFoundation/Request.html
  // envia los datos del formulario mediante $_POST en ParameterBag que recuperaremos toda la informacion con all()
  public function nuevaTapaAction(Request $request)
  {
    if(!is_null($request)){
      $datos=$request->request->all();
      var_dump($datos);
    }
      //Vamos a crear una nueva tapa
      $tapa = new Tapa();
      // le pasamos el objeto tapa al creador de formularios quien con la ayuda de Form/TapaType hemos descrito como construir el formulario
      // creamos el fomulario
      $form = $this->createForm(TapaType::class, $tapa);
      // replace this example code with whatever you need
      return $this->render('gestionTapas/nuevaTapa.html.twig', array('form' => $form->createView(),));
  }

}

?>
