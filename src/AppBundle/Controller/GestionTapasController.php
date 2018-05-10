<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tapa;
use AppBundle\Form\TapaType;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;
use AppBundle\Form\IngredienteType;
use AppBundle\Form\CategoriaType;

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

      //Vamos a crear una nueva tapa
      $tapa = new Tapa();
      // le pasamos el objeto tapa al creador de formularios quien con la ayuda de Form/TapaType hemos descrito como construir el formulario
      // creamos el fomulario
      $form = $this->createForm(TapaType::class, $tapa);
      //recogemos la información del submit
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
      //rellenamos el entity tapa
      $tapa = $form->getData();
      $fotoFile=$tapa->getFoto();
      $fileName =$this->generateUniqueFileName().'.'.$fotoFile->guessExtension();
      // moves the file to the directory where brochures are stored
      $fotoFile->move(
          $this->getParameter('tapas_directory'),
          $fileName
      );

      $tapa->setFoto($fileName);
      $tapa->setFechaCreacion(new \DateTime());
       //almacenar nueva tapa
       $em = $this->getDoctrine()->getManager();
       $em->persist($tapa);
       $em->flush();

       return $this->redirectToRoute('tapa',array('id'=>$tapa->getId()));
       }
      // replace this example code with whatever you need
      return $this->render('gestionTapas/nuevaTapa.html.twig', array('form' => $form->createView(),));
  }


  /**
   * @Route("/nuevaCategoria", name="nuevaCategoria")
   */
  public function nuevaCatAction(Request $request)
  {
    //Vamos a crear una nueva categoria
    $categoria = new Categoria();
    // creamos el fomulario
    $form = $this->createForm(CategoriaType::class, $categoria);
    //recogemos la información del submit
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    //rellenamos el entity tapa
    $categoria = $form->getData();
    $fotoFile=$categoria->getFoto();
    $fileName =$this->generateUniqueFileName().'.'.$fotoFile->guessExtension();
    // moves the file to the directory where brochures are stored
    $fotoFile->move(
        $this->getParameter('tapas_directory'),
        $fileName
    );

    $categoria->setFoto($fileName);

     //almacenar nueva tapa
     $em = $this->getDoctrine()->getManager();
     $em->persist($categoria);
     $em->flush();

     return $this->redirectToRoute('categoria',array('id'=>$categoria->getId()));
     }
    // replace this example code with whatever you need
    return $this->render('gestionTapas/nuevaCategoria.html.twig', array('form' => $form->createView(),));


 }

 /**
  * @Route("/nuevoIngrediente", name="nuevaIngrediente")
  */
 public function nuevaIngAction(Request $request)
 {
   //Vamos a crear un nuevo ingrediente
   $ingrediente = new Ingrediente();
   // creamos el fomulario
   $form = $this->createForm(IngredienteType::class, $ingrediente);
   //recogemos la información del submit
   $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid()) {
   //rellenamos el entity tapa
   $ingrediente = $form->getData();

    //almacenar nuevo ingrediente
    $em = $this->getDoctrine()->getManager();
    $em->persist($ingrediente);
    $em->flush();

    return $this->redirectToRoute('ingrediente',array('id'=>$ingrediente->getId()));
    }
   // replace this example code with whatever you need
   return $this->render('gestionTapas/nuevoIngrediente.html.twig', array('form' => $form->createView(),));


}

  /**
   * @return string
  */
private function generateUniqueFileName()
{
  // md5() reduces the similarity of the file names generated by
  // uniqid(), which is based on timestamps
  return md5(uniqid());
}

}

?>
