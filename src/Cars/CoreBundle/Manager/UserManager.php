<?php
/*
 * This file is NperRecord entity operator.
 *
 * (c)  coffey  Jon <coffey@nligo.com>
 */
namespace Cars\CoreBundle\Manager;

use Cars\CoreBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class UserManager implements UserManagerInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repo;

    /**
     * @var className
     */
    protected $class;

    protected $container;

    public function __construct(EntityManager $em, $class,$container) {
        $this->em = $em;
        $this->class = $class;
        $this->repo = $em->getRepository($class);
        $this->container = $container;
    }

    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * @author  coffey
     *
     * 创建一个用户
     * @param array $data
     * @return mixed
     */
    public function createUser(array $data)
    {
        if(isset($data['password']) && !empty($data['password']))
        {
            $user = new User();
            $encoder = $this->container->get('security.encoder_factory')
                ->getEncoder($user)
            ;
            $data['password'] = $encoder->encodePassword($data['password'], $user->getSalt());
        }
        return $this->repo->createUser($data);
    }

    public function deleteUser($userId = 0)
    {
        // TODO: Implement deleteUser() method.
    }

    public function findUserBy(array $criteria)
    {
        // TODO: Implement findUserBy() method.
    }
}