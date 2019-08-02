<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Survey;
use AppBundle\Entity\Question;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Section
 *
 * @ORM\Table(name="sections")
 * @ORM\Entity
 */
class Section {
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
     * @var int
     *
     * @ORM\Column(name="index", type="integer")
     */
    private $index;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="hangout", type="boolean")
     */
    private $hangout;

    /**
     * @var Survey
     * 
     * @ORM\ManyToOne(targetEntity="Survey", inversedBy="sections")
     */
    private $survey;

    /**
    * @var Question[]
    * 
    * @ORM\OneToMany(targetEntity="Question", mappedBy="section", cascade={"persist", "remove"})
    * @ORM\OrderBy({"name" = "ASC"})
    */
    private $questions;

    public function __construct(
        string $name,
        int $index,
        string $image,
        string $description,
        bool $hangout
    ){
        $this->name = $name;
        $this->index = $index;
        $this->image = $image;
        $this->description = $description;
        $this->hangout = $hangout;
        $this->questions = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }
    
    public function getName(){
        return $this->name;
    }

    public function getIndex(){
        return $this->index;
    }

    public function getImage(){
        return $this->image;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getHangout(){
        return $this->hangout;
    }

    public function getSurvey(){
        return $this->survey;
    }

    public function getQuestions(){
        return $this->questions;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setIndex(int $index){
        $this->index = $index;
    }

    public function setImage(string $image){
        $this->image = $image;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    public function setHangout(bool $hangout){
        $this->hangout = $hangout;
    }

    public function setSurvey(Survey $survey){
        $this->survey = $survey;
    }

    public function addQuestion(Question $question){
        $this->questions->add($question);
        $question->setSection($this);
    }

    public function removeQuestion(Question $question){
        $this->questions->removeElement($question);
    }
}