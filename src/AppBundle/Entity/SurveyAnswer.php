<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Survey;
use AppBundle\Entity\QuestionAnswer;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * SurveyAnswer
 *
 * @ORM\Table(name="surveyAnswers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SurveyAnswerRepository")
 */
class SurveyAnswer {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var bool
     * 
     * @ORM\Column(name="hangout", type="boolean")
     */
    private $hangout;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="lastUpdate", type="text")
     */
    private $lastUpdate;

    /**
     * @var Survey
     *
     * @ORM\ManyToOne(targetEntity="Survey", inversedBy="surveyAnswers")
     */
    private $survey;

    /**
     * @var QuestionAnswer[]
     * 
     * @ORM\OneToMany(targetEntity="QuestionAnswer", mappedBy="surveyAnswer", cascade={"persist", "remove"})
     * @ORM\OrderBy({"questionIndex" = "ASC"})
     */
    private $questionAnswers;

    public function __construct(bool $hangout, string $lastUpdate){
        $this->hangout = $hangout;
        $this->lastUpdate = $lastUpdate;
        $this->questionAnswers = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }

    public function getHangout(){
        return $this->hangout;
    }

    public function getLastUpdate(){
        return $this->lastUpdate;
    }

    public function getSurvey(){
        return $this->survey;
    }

    public function getQuestionAnswers(){
        return $this->questionAnswers;
    }

    public function setHangout(bool $hangout){
        $this->hangout = $hangout;
    }

    public function setLastUpdate(string $lastUpdate){
        $this->lastUpdate = $lastUpdate;
    }

    public function setSurvey(Survey $survey){
        $this->survey = $survey;
    }

    public function setQuestionAnswers(array $questionAnswers){
        $this->questionAnswers = $questionAnswers;
    }

    public function addQuestionAnswer(QuestionAnswer $questionAnswer){
        $questionAnswer->setSurveyAnswer($this);
        $this->questionAnswers->add($questionAnswer);
    }

    public function removeQuestionAnswer(QuestionAnswer $questionAnswer){
        $this->questionAnswers->removeElement($questionAnswer);
    }
}

