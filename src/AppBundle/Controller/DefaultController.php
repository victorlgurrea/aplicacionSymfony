<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Entity\Tapa;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;

class DefaultController extends Controller
{
    /**
     * @Route("/{pagina}", name="homepage")
     */
    public function indexAction(Request $request,$pagina=1)
    {
        //Captura del repositorio de la tabla Tapa contra la BD
        $tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
         $tapas = $tapaRepository->paginaTapas($pagina,3);
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig',array('tapas'=>$tapas,'paginaActual'=>$pagina));
    }

    /**
     * @Route("/nosotros", name="nosotros")
     */
    public function nosotrosAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/nosotros.html.twig');
    }

    /**
     * @Route("/contactar/{sitio}", name="contactar")
     */
    public function contactarAction(Request $request,$sitio="todos")
    {
      // replace this example code with whatever you need
      return $this->render('default/bares.html.twig',array("sitio"=>$sitio));
    }

    /**
     * @Route("/tapa/{id}", name="tapa")
     */
    public function tapaAction(Request $request,$id=null)
    {
      if($id!=null){
        //Captura del repositorio de la tabla Tapa contra la BD
        $tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
        // encuentra la tapa con id que le hemos pasado;
        $tapa = $tapaRepository->find($id);
        //Ahora le pasamos la tapa a la vista
        return $this->render('default/tapa.html.twig',array("tapa"=>$tapa));
      }else{
        // redirects to the "homepage" route
        return $this->redirectToRoute('homepage');
      }

    }

    /**
     * @Route("/categoria/{id}", name="categoria")
     */
    public function categoriaAction(Request $request,$id=null)
    {
      if($id!=null){
        //Captura del repositorio de la tabla Categoria contra la BD
        $categoriaRepository = $this->getDoctrine()->getRepository(Categoria::class);
        // encuentra la categoria con id que le hemos pasado;
        $categoria = $categoriaRepository->find($id);
        //Ahora le pasamos la categoria a la vista
        return $this->render('default/categoria.html.twig',array("categoria"=>$categoria));
      }else{
        // redirects to the "homepage" route
        return $this->redirectToRoute('homepage');
      }

    }

    /**
     * @Route("/ingrediente/{id}", name="ingrediente")
     */
    public function ingredienteAction(Request $request,$id=null)
    {
      if($id!=null){
        //Captura del repositorio de la tabla Categoria contra la BD
        $ingredienteRepository = $this->getDoctrine()->getRepository(Ingrediente::class);
        // encuentra la categoria con id que le hemos pasado;
        $ingrediente = $ingredienteRepository->find($id);
        //Ahora le pasamos la categoria a la vista
        return $this->render('default/ingrediente.html.twig',array("ingrediente"=>$ingrediente));
      }else{
        // redirects to the "homepage" route
        return $this->redirectToRoute('homepage');
      }

    }

    /**
     * @Route("/registro", name="registro")
     */
    public function registroAction(Request $request)
    {

        //Vamos a crear un nuevo usuario
        $usuario = new Usuario();
        // le pasamos el objeto tapa al creador de formularios quien con la ayuda de Form/UsuarioType hemos descrito como construir el formulario
        // creamos el fomulario
        $form = $this->createForm(UsuarioType::class, $usuario);
        //recogemos la información del submit
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          // 3) Encode the password (you could also do this via Doctrine listener)
          $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());
          $usuario->setPassword($password);
          // 3.b)
          $usuario->setUsername($usuario->getEmail());

          // 4) save the User!
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($usuario);
          $entityManager->flush();

         return $this->redirectToRoute('tapa',array('id'=>$tapa->getId()));
         }
        // replace this example code with whatever you need
        return $this->render('gestionTapas/nuevaTapa.html.twig', array('form' => $form->createView(),));
    }
}
