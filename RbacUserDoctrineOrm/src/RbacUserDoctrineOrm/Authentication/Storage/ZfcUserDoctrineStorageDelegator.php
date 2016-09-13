<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 09/03/2016
 * Time: 12:59 AM
 */

namespace RbacUserDoctrineOrm\Authentication\Storage;


use Doctrine\ORM\EntityManagerInterface;
use RbacUserDoctrineOrm\Domain\AbstractRbacUser;
use RbacUserDoctrineOrm\Domain\Role;
use Zend\Authentication\Storage\StorageInterface;
use Zend\Stdlib\ArrayUtils;
use ZfcUser\Options\ModuleOptions;

class ZfcUserDoctrineStorageDelegator implements  StorageInterface
{
    /**
     * @var StorageInterface
     */
    private $wrappedStorage;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     *
     * @var ModuleOptions
     */
    private $zfcUserModuleOptions;

    public function __construct(StorageInterface $wrappedStorage, EntityManagerInterface $em,  ModuleOptions $zfcUserModuleOptions)
    {
        $this->wrappedStorage = $wrappedStorage;
        $this->em = $em;
        $this->zfcUserModuleOptions = $zfcUserModuleOptions;
    }

    public function isEmpty()
    {
        return $this->wrappedStorage->isEmpty();
    }

    public function read()
    {
        return $this->wrappedStorage->read();
    }

    public function write($contents)
    {
        $this->_write($contents);
    }

    /**
     * @param AbstractRbacUser $contents
     * @return void
     */
    private function _write(AbstractRbacUser $contents){
        /* @var $user AbstractRbacUser */
        $user = $contents;
        if ( !$this->em->contains($user)){
            $user = $this->em->find($this->zfcUserModuleOptions->getUserEntityClass(), $contents->getId());
            $this->_write($user);
        }

        $allGrantedRoles = [];
        $todoRoles = new \ArrayIterator($user->getDbRoles()->getValues());
        $todoRoles->rewind();
        while ($todoRoles->valid()){
            /* @var $role Role */
            $role = $todoRoles->current();
            if ( !array_key_exists($role->getName(), $allGrantedRoles)){
                $permissions = $role->getPermissions();
                if( !$permissions->isInitialized() ){
                    $permissions->initialize();
                }
                $allGrantedRoles[$role->getName()] = $role;
                foreach ($role->getChildren()->getValues() as $childRole) {
                    $todoRoles->append($childRole);
                }
            }
            $todoRoles->next();
        }

        $user = $this->em->detach($user);
        $roles = $user->getDbRoles();
        $roles->unwrap()->clear();
        $roles->setDirty(true);
        $roles->setInitialized(false);

        $user->_setAllGrantedRoles( ArrayUtils::merge($allGrantedRoles, $user->getProviderRoles())  );
        $this->wrappedStorage->write($user);
    }

    public function clear()
    {
        $this->wrappedStorage->clear();
    }

}
