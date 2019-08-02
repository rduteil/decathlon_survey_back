<?php

namespace AppBundle\Entity;

use AppBundle\Entity\SurveyAnswer;
use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionAnswer
 *
 * @ORM\Table(name="questionAnswers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionAnswerRepository")
 */
class QuestionAnswer {
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
     * @ORM\Column(name="questionName", type="text")
     */
    private $questionName;

    /**
     * @var int
     *
     * @ORM\Column(name="questionIndex", type="integer")
     */
    private $questionIndex;

        /**
     * @var string
     *
     * @ORM\Column(name="questionType", type="text")
     */
    private $questionType;

    /**
     * @var array
     *
     * @ORM\Column(name="props", type="json_array", nullable=true)
     */
    private $props;

    /**
     * @var SurveyAnswer
     * 
     * @ORM\ManyToOne(targetEntity="SurveyAnswer", inversedBy="questionAnswers")
     */
    private $surveyAnswer;

    public function __construct(string $questionName, int $questionIndex, string $questionType){
        $this->questionName = $questionName;
        $this->questionIndex = $questionIndex;
        $this->questionType = $questionType;
    }

    public function getId(){
        return $this->id;
    }

    public function getProps(){
        return $this->props;
    }

    public function getQuestionName(){
        return $this->questionName;
    }

    public function getQuestionIndex(){
        return $this->questionIndex;
    }

    public function getQuestionType(){
        return $this->questionType;
    }

    public function getSurveyAnswer(){
        return $this->surveyAnswer;
    }

    public function setProps(array $props){
        $this->props = $props;
    }

    public function setQuestionName(string $questionName){
        $this->questioName = $questionName;
    }

    public function setQuestionIndex(int $questionIndex){
        $this->questionIndex = $questionIndex;
    }
    
    public function setQuestionType(string $questionType){
        $this->questionType = $questionType;
    }

    public function setSurveyAnswer(SurveyAnswer $surveyAnswer){
        $this->surveyAnswer = $surveyAnswer;
    }
}

