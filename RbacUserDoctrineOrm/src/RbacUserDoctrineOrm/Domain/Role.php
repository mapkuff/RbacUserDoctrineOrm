<?php
namespace RbacUserDoctrineOrm\Domain;

use Doctrine\ORM\PersistentCollection;
use Rbac\Role\RoleInterface;

class Role implements RoleInterface  {

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Role
     */
    protected $parent;

    /**
     * @var PersistentCollection
     */
    protected $children;

    /**
     * @var PersistentCollection
     */
    protected $permissions;


    /**
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Role $parent
     * @return self
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return Role
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param PersistentCollection $children
     * @return $this
     */
    public function setChildren($children)
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param PersistentCollection $permissions
     * @return self
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getPermissions()
    {
        return $this->permissions;
    }


    /**
     * Checks if a permission exists for this role or any child roles.
     *
     * @param  string $name
     * @return bool
     */
    public function hasPermission($name)
    {
        foreach ($this->getPermissions()->getValues() as $permission) {
            /* @var $permission Permission */
            if ($permission->getName() == $name) {
                return true;
            }
        }
        return false;
    }

    public function __toString()
    {
        return $this->name;
    }
    
}