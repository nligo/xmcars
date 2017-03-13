<?php

namespace Cars\AdminBundle\Controller;


class SecurityController extends BaseController
{
    public function loginAction()
    {
        return $this->render('CarsAdminBundle:Security:login.html.twig', array(
        ));
    }

    public function logoutAction()
    {
        return $this->render('CarsAdminBundle:Security:logout.html.twig', array(
        ));
    }
}