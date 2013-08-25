<?php

namespace Axioma\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class MainController
 * @package Axioma\MainBundle\Controller
 */

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('AxiomaMainBundle:Main:index.html.twig');
    }
}