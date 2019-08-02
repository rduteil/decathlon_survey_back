<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Section;
use AppBundle\Entity\Question;
use AppBundle\Entity\SurveyAnswer;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Survey
 *
 * @ORM\Entity
 * @ORM\Table(name="surveys")
 */
class Survey {
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
     * @var string
     *
     * @ORM\Column(name="reference", type="text", nullable=true)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="text", unique=true)
     */
    private $link;

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
     * @var string
     *
     * @ORM\Column(name="activationDate", type="text", nullable=true)
     */
    private $activationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="deactivationDate", type="text", nullable=true)
     */
    private $deactivationDate;

    /**
     * @var string
     * 
     * @ORM\Column(name="activationKey", type="text", nullable=true)
     */
    private $activationKey;


    /**
     * @var string
     *
     * @ORM\Column(name="language", type="text")
     */
    private $language;

    /**
     * @var string
     * 
     * @ORM\Column(name="lastUpdate", type="text")
     */
    private $lastUpdate;

    /**
     * @var Folder
     * 
     * @ORM\ManyToOne(targetEntity="Folder", inversedBy="surveys")
     */
    private $folder;

    /**
     * @var Section[]
     * 
     * @ORM\OneToMany(targetEntity="Section", mappedBy="survey", cascade={"remove", "persist"})
     * @ORM\OrderBy({"index" = "ASC"})
     */
    private $sections;

    /**
     * @var Question[]
     * 
     * @ORM\OneToMany(targetEntity="Question", mappedBy="survey", cascade={"remove", "persist"})
     * @ORM\OrderBy({"index" = "ASC"})
     */
    private $questions;

    /**
     * @var SurveyAnswer[]
     * 
     * @ORM\OneToMany(targetEntity="SurveyAnswer", mappedBy="survey", cascade={"persist", "remove"})
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $surveyAnswers;

    public function __construct(
        string $name, 
        string $reference, 
        string $link, 
        string $image, 
        string $description, 
        bool $hangout,
        string $activationDate,
        string $deactivationDate,
        string $activationKey,
        string $language,
        string $lastUpdate
    ) {
        $this->name = $name;
        $this->reference = $reference;
        $this->link = $link;
        $this->image = $image;
        $this->description = $description;
        $this->hangout = $hangout;
        $this->activationDate = $activationDate;
        $this->deactivationDate = $deactivationDate;
        $this->activationKey = $activationKey;
        $this->language = $language;
        $this->lastUpdate = $lastUpdate;
        $this->sections = new ArrayCollection();
        $this->questions = new ArrayCollection();
        $this->surveyAnswers = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getReference(){
        return $this->reference;
    }

    public function getLink(){
        return $this->link;
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

    public function getActivationDate(){
        return $this->activationDate;
    }

    public function getDeactivationDate(){
        return $this->deactivationDate;
    }

    public function getActivationKey(){
        return $this->activationKey;
    }

    public function getLanguage(){
        return $this->language;
    }

    public function getLastUpdate(){
        return $this->lastUpdate;
    }

    public function getFolder(){
        return $this->folder;
    }

    public function getSections(){
        return $this->sections;
    }

    public function getQuestions(){
        return $this->questions;
    }

    public function getSurveyAnswers(){
        return $this->surveyAnswers;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setReference(string $reference){
        $this->reference = $reference;
    }

    public function setLink(string $link){
        $this->link = $link;
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

    public function setActivationDate(string $activationDate){
        $this->activationDate = $activationDate;
    }

    public function setDeactivationDate(string $deactivationDate){
        $this->deactivationDate = $deactivationDate;
    }

    public function setActivationKey(string $activationKey){
        $this->activationKey = $activationKey;
    }

    public function setLanguage(string $language){
        $this->language = $language;
    }

    public function setLastUpdate(string $lastUpdate){
        $this->lastUpdate = $lastUpdate;
    }
    
    public function setFolder(Folder $folder){
        $this->folder = $folder;
    }

    public function addSection(Section $section){
        $this->sections->add($section);
        $section->setSurvey($this);
    }

    public function removeSection(Section $section){
        $this->sections->removeElement($section);
    }

    public function addQuestion(Question $question){
        $this->questions->add($question);
        $question->setSurvey($this);
    }

    public function removeQuestion(Question $question){
        $this->questions->removeElement($question);
    }
    
    public function addSurveyAnswer(SurveyAnswer $surveyAnswer){
        $this->surveyAnswers->add($surveyAnswer);
        $surveyAnswer->setSurvey($this);
    }

    public function removeSurveyAnswer(SurveyAnswer $surveyAnswer){
        $this->surveyAnswers->removeElement($surveyAnswer);
    }
}

