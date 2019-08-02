<?php

namespace AppBundle\Entity;

use AppBundle\Entity\User;
use AppBundle\Entity\Folder;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Service
 * 
 * @ORM\Entity
 * @ORM\Table(name="services")
 */
class Service {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", unique=true)
     */
    private $name;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="lastUpdate", type="text")
     */
    private $lastUpdate;

    /**
     * @var Folder[]
     * 
     * @ORM\OneToMany(targetEntity="Folder", mappedBy="service", cascade={"persist", "remove"})
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $folders;
    
    /**
    * @var User[]
    * 
    * @ORM\OneToMany(targetEntity="User", mappedBy="service", cascade={"persist", "remove"})
    * @ORM\OrderBy({"username" = "ASC"})
    */
    private $users;

    public function __construct(string $name, string $lastUpdate){
        $this->name = $name;
        $this->lastUpdate = $lastUpdate;
        $this->folders = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getLastUpdate(){
        return $this->lastUpdate;
    }

    public function getFolders(){
        return $this->folders;
    }

    public function getUsers(){
        return $this->users;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setLastUpdate(string $lastUpdate){
        $this->lastUpdate = $lastUpdate;
    }
    
    public function addFolder(Folder $folder){
        $folder->setService($this);
        $this->folders->add($folder);
    }

    public function removeFolder(Folder $folder){
        $this->folders->removeElement($folder);
    }

    public function addUser(User $user){
        $user->setService($this);
        $this->users->add($user);
    }

    public function removeUser(User $user){
        $this->users->removeElement($user);
    }
}

