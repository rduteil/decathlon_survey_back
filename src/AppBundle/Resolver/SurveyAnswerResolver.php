<?php

namespace AppBundle\Resolver;

use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyAnswer;

class SurveyAnswerResolver extends AbstractResolver{

    public function add(Survey $survey, bool $hangout, array $questionAnswers){
        $lastUpdate = date("d-m-Y H:i:s");
        $surveyAnswer = new SurveyAnswer($hangout, $lastUpdate);
        $survey->addSurveyAnswer($surveyAnswer);

        foreach ($questionAnswers as $questionAnswer) {
            [
                'questionName'  => $questionName,
                'questionIndex' => $questionIndex,
                'questionType'  => $questionType
            ] = $questionAnswer;
            $questionAnswer = $this->container->get('resolver.questionAnswer')->add($questionName, $questionIndex, $questionType, $questionAnswer);
            $surveyAnswer->addQuestionAnswer($questionAnswer);
        }

        $this->persist($surveyAnswer);
        return $surveyAnswer;
    }

    public function findSurveyAnswer(int $id){
        return $this->findOneBy('SurveyAnswer', ['id' => $id]);
    }

    public function findSurveyAnswerBy(array $arr){
        return $this->findOneBy('SurveyAnswer', $arr);
    }

    public function findSurveyAnswers(){
        return $this->findAll('SurveyAnswer');
    }

}