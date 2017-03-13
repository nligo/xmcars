<?php

namespace Cars\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NperRecordController extends BaseController
{
    public function listAction(Request $request)
    {
        $searchParam = $request->get('searchParam');
        $searchParam = isset($searchParam) ? $searchParam : array();
        $list = $this->get('cars_core.manager_nperrecord')->getNperRecord($searchParam);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $list,
            $request->query->getInt('page', 1)
        );
        return $this->render('CarsAdminBundle:NperRecord:list.html.twig', array(
            'searchParam' => $searchParam,
            'pagination' => $pagination,
        ));
    }

}
