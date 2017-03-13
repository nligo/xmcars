<?php

namespace Cars\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CarsAdminBundle:Default:index.html.twig');
    }
}
