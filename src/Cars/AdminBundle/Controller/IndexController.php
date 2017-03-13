<?php

namespace Cars\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends BaseController
{
    public function indexAction()
    {
        return $this->render('CarsAdminBundle::layout.html.twig', array(
        ));
    }

    public function welcomeAction()
    {
        return $this->render('CarsAdminBundle::welcome.html.twig', array(
        ));
    }
}
