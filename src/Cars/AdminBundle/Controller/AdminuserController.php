<?php

namespace Cars\AdminBundle\Controller;

use Cars\CoreBundle\Entity\User;
use Cars\CoreBundle\Entity\UserProfile;
use Symfony\Component\HttpFoundation\Request;

class AdminuserController extends BaseController
{
    public function listAction(Request $request)
    {
        $param = $request->get('searchParam');
        $page = $request->query->get('page');
        $param = isset($param) ? $param : array();
        $param['page'] = isset($page) ? $page : 1;
        $userlist = $this->get('cars_core.manager_user')->getRepo()->findBy(array('userType'=>2),array('createTime'=>'DESC'));
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $userlist,
            $request->query->getInt('page', $param['page'])
        );
        return $this->render('CarsAdminBundle:Adminuser:list.html.twig', array(
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
