<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Service;
use AppBundle\Entity\Survey;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Folder
 *
 * @ORM\Table(name="folders")
 * @ORM\Entity
 */
class Folder {
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
     * @ORM\Column(name="name", type="text")
     */
    private $name;

    /**
     * @var bool
     * 
     * @ORM\Column(name="isRoot", type="boolean")
     */
    private $isRoot;

    /**
     * @var string
     *
     * @ORM\Column(name="lastUpdate", type="text")
     */
    private $lastUpdate;

    /**
     * @var Service
     * 
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="folders")
     */
    private $service;

    /**
     * @var Folder
     * 
     * @ORM\ManyToOne(targetEntity="Folder", inversedBy="folders")
     */
    private $folder;

    /**
     * @var Folder[]
     * 
     * @ORM\OneToMany(targetEntity="Folder", mappedBy="folder", cascade={"persist", "remove"})
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $folders;

    /**
    * @var Survey[]
    * 
    * @ORM\OneToMany(targetEntity="Survey", mappedBy="folder", cascade={"persist", "remove"})
    * @ORM\OrderBy({"name" = "ASC"})
    */
    private $surveys;

    public function __construct(
        string $name,
        bool $isRoot,
        string $lastUpdate
    ){
        $this->name = $name;
        $this->isRoot = $isRoot;
        $this->lastUpdate = $lastUpdate;
        $this->folders = new ArrayCollection();
        $this->surveys = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getIsRoot(){
        return $this->isRoot;
    }

    public function getLastUpdate(){
        return $this->lastUpdate;
    }

    public function getService(){
        return $this->service;
    }

    public function getFolder(){
        return $this->folder;
    }

    public function getFolders(){
        return $this->folders;
    }

    public function getSurveys(){
        return $this->surveys;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setLastUpdate(string $lastUpdate){
        $this->lastUpdate = $lastUpdate;
    }

    public function setService(Service $service){
        $this->service = $service;
    }

    public function setFolder(Folder $folder){
        $this->folder = $folder;
    }

    public function addFolder(Folder $folder){
        $this->folders->add($folder);
        $folder->setFolder($this);
    }

    public function removeFolder(Folder $folder){
        $this->folders->removeElement($folder);
    }

    public function addSurvey(Survey $survey){
        $this->surveys->add($survey);
        $survey->setFolder($this);
    }

    public function removeSurvey(Survey $survey){
        $this->surveys->removeElement($survey);
    }
}

