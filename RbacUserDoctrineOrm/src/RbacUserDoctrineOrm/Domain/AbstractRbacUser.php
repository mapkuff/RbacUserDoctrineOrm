<?php
namespace RbacUserDoctrineOrm\Domain;


use Doctrine\ORM\PersistentCollection;
use ZfcRbac\Identity\IdentityInterface;
use ZfcUser\Entity\User as ZfcUserEntity;

class AbstractRbacUser extends ZfcUserEntity implements IdentityInterface
{
    /**
     * @var PersistentCollection
     */
    protected $dbRoles;

    /**
     * @var Role[]||array
     */
    protected $_allGrantedRoles;

    /**
     * @var array
     */
    protected $providerRoles;

    /**
     * @return PersistentCollection
     */
    public function getDbRoles()
    {
        return $this->dbRoles;
    }

    /**
     * @param PersistentCollection $dbRoles
     * @return self
     */
    public function setDbRoles(PersistentCollection $dbRoles)
    {
        $this->dbRoles = $dbRoles;
        return $this;
    }

    /**
     * @return array
     */
    public function getProviderRoles()
    {
        return $this->providerRoles;
    }

    /**
     * @param array $providerRoles
     * @return self
     */
    public function setProviderRoles($providerRoles)
    {
        $this->providerRoles = $providerRoles;
        return $this;
    }

    /**
     * @param Role[]|string[] $_allGrantedRoles
     */
    public function _setAllGrantedRoles(array $_allGrantedRoles)
    {
        $this->_allGrantedRoles = $_allGrantedRoles;
    }

    public function getRoles()
    {
        return $this->_allGrantedRoles;
    }


}