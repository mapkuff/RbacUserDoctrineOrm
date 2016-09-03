<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 09/03/2016
 * Time: 2:18 AM
 */

namespace RbacUserDoctrineOrm\Options;


use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{

    /**
     * @var boolean
     */
    private $enableDefaultUserEntity;

    /**
     * @return boolean
     */
    public function isEnableDefaultUserEntity()
    {
        return $this->enableDefaultUserEntity;
    }

    /**
     * @param boolean $enableDefaultUserEntity
     */
    public function setEnableDefaultUserEntity($enableDefaultUserEntity)
    {
        $this->enableDefaultUserEntity = $enableDefaultUserEntity;
    }



}