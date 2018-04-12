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
      //Captura del repositorio de la tabla Tapa contra la BD
      $tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
      //Si quisieramos recuperar todas las tapas utilizar $tapaRepository->findAll()
      // encuentra todas las tapas con Top=1;
      $tapas = $tapaRepository->findAll();
      //var_dump($tapas); vemos que recogemos todas las tapas mostrandolas

      // replace this example code with whatever you need
      return $this->render('default/index.html.twig',array('tapas'=>$tapas));
  }

}

?>
