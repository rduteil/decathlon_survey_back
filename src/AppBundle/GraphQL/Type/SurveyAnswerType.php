<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\Entity\SurveyAnswer;
use AppBundle\Entity\QuestionAnswer;
use AppBundle\GraphQL\Type\QuestionAnswerType;
use AppBundle\GraphQL\Type\SurveyType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\ListType\ListType;

class SurveyAnswerType extends AbstractObjectType{

    /**
     * @param ObjectTypeConfig $config
     *
     * @return mixed
     */
    public function build($config){
        $config->addFields([
            'id'                => new NonNullType(new IdType()),
            'hangout'           => new NonNullType(new BooleanType()),
            'lastUpdate'        => new StringType(),
            'survey'            => new NonNullType(new SurveyType()),
            'questionAnswers'   => new ListType(new QuestionAnswerType()),
        ]);
    }

    public function getDescription(){
        return 'SurveyAnswer';
    }

    public static function toArray(SurveyAnswer $surveyAnswer){
        return [
            'id'                => $surveyAnswer->getId(),
            'hangout'           => $surveyAnswer->getHangout(),
            'lastUpdate'        => $surveyAnswer->getLastUpdate(),
            'survey'            => $surveyAnswer->getSurvey(),
            'questionAnswers'   => array_map(function(QuestionAnswer $questionAnswer) {return QuestionAnswerType::toArray($questionAnswer);}, $surveyAnswer->getQuestionAnswers()->getValues()),
        ];
    }
}