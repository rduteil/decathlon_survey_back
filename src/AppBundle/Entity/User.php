<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use AppBundle\Entity\Service;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users")
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(name="email",
 *         column=@ORM\Column(
 *             name="email",
 *             nullable=true
 *         )
 *     ),
 *     @ORM\AttributeOverride(name="emailCanonical",
 *         column=@ORM\Column(
 *             name="emailCanonical",
 *             nullable=true
 *         )
 *     ),
 * })
 */
class User extends BaseUser {
    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="lastUpdate", type="text")
     */
    private $lastUpdate;

    /**
     * @var Service
     * 
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="users")
     */
    private $service;

    public function __construct(
        string $username,
        string $plainPassword,
        string $email,
        string $lastUpdate,
        array $roles
    ){
        parent::__construct();
        $this->setEnabled(true);
        $this->username = $username;
        $this->setPlainPassword($plainPassword);
        $this->email = $email;
        $this->lastUpdate = $lastUpdate;
        $this->roles = $roles;
    }

    public function getId(){
        return $this->id;
    }

    public function getLastUpdate(){
        return $this->lastUpdate;
    }

    public function getService(){
        return $this->service;
    }

    public function getRoles(){
        return $this->roles;
    }

    public function setLastUpdate(string $lastUpdate){
        $this->lastUpdate = $lastUpdate;
    }

    public function setService(Service $service){
        $this->service = $service;
    }

    public function setRoles(array $roles){
        $this->roles = $roles;
    }
}