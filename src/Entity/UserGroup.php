<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserGroupRepository")
 * @ORM\Table(name="user_group")
 */
class UserGroup
{

    public function __construct()
    {
        $this->users       = new ArrayCollection();
        $this->permissions = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255,unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string",length=400,nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="groups")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="user_group_users",
     *     joinColumns={@ORM\JoinColumn(name="group_id",referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_id",referencedColumnName="id")}
     *     )
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="Permission")
     * @ORM\JoinTable(name="user_group_permissions",
     *     joinColumns={@ORM\JoinColumn(name="group_id",referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="permission_id",referencedColumnName="id")}
     *     )
     */
    private $permissions;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return UserGroup
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return UserGroup
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return UserGroup
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     * @return UserGroup
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function addUser(User $user)
    {
        $this->getUsers()->add($user);
    }

    /**
     * @return ArrayCollection
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    public function addPermission(Permission $permission)
    {
        $this->getPermissions()->add($permission);
    }

    public function removePermission(Permission $permission)
    {
        return $this->getPermissions()->removeElement($permission);
    }

}
