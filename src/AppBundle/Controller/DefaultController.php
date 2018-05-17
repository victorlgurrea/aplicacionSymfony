<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tapa;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //Captura del repositorio de la tabla Tapa contra la BD
        $tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
        //Si quisieramos recuperar todas las tapas utilizar $tapaRepository->findAll()
        // encuentra todas las tapas con Top=1;
        //$tapas = $tapaRepository->findByTop(1);
        //var_dump($tapas); vemos que recogemos todas las tapas mostrandolas
        $query = $tapaRepository->createQueryBuilder('t')
          ->where('t.top= 1')
          ->setFirstResult(0)
          ->setMaxResults(100)
          ->getQuery();
        $tapas = $query->getResult();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig',array('tapas'=>$tapas));
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

}
