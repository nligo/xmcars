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

    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('Cars\CoreBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $param = $request->request->get('cars_corebundle_user');
            $param['role'] = 'ROLE_ADMIN';
            $param['userType'] = 2;
            $result = $this->get('cars_core.manager_user')->createUser($param);
            if(isset($result['code']) && $result['code'] == 0)
            {
                return $result['data'];
            }
        }
        return $this->render('CarsAdminBundle:Adminuser:new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    public function editAction($id)
    {
        return $this->render('CarsAdminBundle:User:edit.html.twig', array(
            // ...
        ));
    }

    public function delAction($id)
    {
        return $this->render('CarsAdminBundle:User:del.html.twig', array(
            // ...
        ));
    }

    public function checkAction(Request $request)
    {
        $param = $request->request->get('param');
        if(!empty($param))
        {
            $paramArr = explode('_',$param);
            if(isset($paramArr[0]) && isset($paramArr[1]))
            {
                $info = $this->get('cars_core.manager_user')->getRepo()->findOneBy(array($paramArr[0]=>$paramArr[1]));
                if(!empty($info))
                {
                    echo 'false';exit;
                }
            }
        }
        echo 'true';exit;

    }

}
