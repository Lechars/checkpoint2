<?php


namespace App\Controller;

use App\Model\BeastManager;

/**
 * Class BeastController
 * @package Controller
 */
class BeastController extends AbstractController
{


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list() : string
    {
        $beastsManager = new BeastManager();
        $beasts = $beastsManager->selectAll();
        return $this->twig->render('Beast/list.html.twig', ['beasts' => $beasts]);
    }


    /**
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function details(int $id)  
    {
      $beastsManager = new BeastManager();
      $beast = $beastsManager->selectOneByIdwithMovieAndPlanet($id);

        return $this->twig->render('Beast/details.html.twig',['beast' => $beast]);
    }


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()  : string
    {
      $beastManager = new BeastManager;
      if(!empty($_POST))
      {
        var_dump($_POST);
        $beastManager-> addBeast();
      }
        return $this->twig->render('Beast/add.html.twig');
    }


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id) : string
    {   
      $beastManager = new BeastManager;
      if(!empty($_POST))
      {
        $beastManager-> editBeast($id);
      }
      $beast = $beastManager->selectOneByIdwithMovieAndPlanet($id);


        return $this->twig->render('Beast/edit.html.twig',['beast' => $beast]);
    }


}
