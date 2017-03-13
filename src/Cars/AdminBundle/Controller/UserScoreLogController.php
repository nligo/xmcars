<?php

namespace Cars\AdminBundle\Controller;

use Cars\CoreBundle\Entity\UserScoreLog;
use Symfony\Component\HttpFoundation\Request;

class UserScoreLogController extends BaseController
{
    public function listAction(Request $request)
    {
        $param = $request->get('searchParam');
        if(!isset($param['scoreType_equal']))
        {
            $param['scoreType_equal'] = 0;
        }
        $list = $this->get('cars_core.manager_userscorelog')->getLogBy($param);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $list,
            $request->query->getInt('page', 1)
        );
        return $this->render('CarsAdminBundle:Userscore:list.html.twig', array(
            'searchParam' => $param,
            'pagination' => $pagination,
        ));
    }
}
