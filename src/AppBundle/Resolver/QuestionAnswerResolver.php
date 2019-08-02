<?php

namespace AppBundle\Resolver;

use AppBundle\Entity\QuestionAnswer;
use AppBundle\Entity\Question;
use AppBundle\Entity\Enums\QuestionTypeEnum;

class QuestionAnswerResolver extends AbstractResolver {

    public function add(string $questionName, int $questionIndex, string $questionType, array $props){
        $questionAnswer = new QuestionAnswer($questionName, $questionIndex, $questionType);
        [
            'value'     => $value,
            'choice'    => $choice,
            'rank'      => $rank,
            'file'      => $file,
            'scale'     => $scale,
            'date'      => $date
        ] = $props;
        $questionAnswer->setProps($props);
        $this->persist($questionAnswer);
        return $questionAnswer;
    }
    
    public function findQuestionAnswerBy(array $arr){
        return $this->findOneBy('QuestionAnswer', $arr);
    }

    public function findQuestionAnswer($id){
        return $this->findOneBy('QuestionAnswer', ['id' => $id]);
    }
}