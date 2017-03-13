<?php

namespace Cars\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller
{
    /**
     * @author  coffey
     *
     * 获取em方法
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function _em()
    {
        $em = $this->getDoctrine()->getManager();
        return $em;

    }
}
