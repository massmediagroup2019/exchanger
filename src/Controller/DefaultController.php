<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route(path="/", methods={"GET"})
     */
    public function indexAction()
    {
        return $this->redirectToRoute('rates_list');
    }
}
