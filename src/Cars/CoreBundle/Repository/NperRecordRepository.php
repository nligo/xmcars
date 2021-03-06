<?php

namespace Cars\CoreBundle\Repository;

use Cars\CoreBundle\Manager\NperRecordManagerInterface;

/**
 * NperRecordRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NperRecordRepository extends \Doctrine\ORM\EntityRepository implements NperRecordManagerInterface
{
    public function getNperRecord($condition = array())
    {
        $qb = $this->createQueryBuilder('gnr');
        $qb = $this->_getWhere($qb,$condition);
        $qb->orderBy('gnr.nper','DESC');
        $result = $qb->getQuery()->getResult();
        return !empty($result) ? $result : array();
    }

    /**
     * @author  gf
     *
     * 生成查询条件
     * @param $qb
     * @param array $condition
     * @return mixed
     */
    private function _getWhere($qb,$condition = array())
    {
        if(!empty($condition))
        {
            foreach ($condition as $k=>$v)
            {
                if(isset($k) && !empty($k) && isset($v) && !empty($v))
                {
                    $param  =   explode('_',$k);
                    switch ($param[1]){
                        case 'like':
                            $qb->andWhere('gnr.'.$param[0].' LIKE :'.$param[0])->setParameter($param[0], '%'.$v.'%');
                            break;
                        case 'equal':
                            $qb->andWhere('gnr.'.$param[0].' = :'.$param[0])->setParameter($param[0], $v);
                            break;
                        case 'start':
                            $qb->andWhere('gnr.'.$param[0].' >= :'.$param[0])->setParameter($param[0],strtotime($v));
                            break;
                        case 'end':
                            $qb->andWhere('gnr.'.$param[0].' <= :'.$param[0].'1')->setParameter($param[0].'1',strtotime($v));
                            break;
                    }
                }
            }
        }
        return $qb;
    }
}
