<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\GraphQL\Type\QuestionAnswerInputType;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\ListType\ListType;

class SurveyAnswerInputType extends AbstractInputObjectType {
    public function build($config){
        $config->addFields([
            'surveyId'          => new NonNullType(new IdType()),
            'hangout'           => new NonNullType(new BooleanType()),
            'lastUpdate'        => new StringType(),
            'questionAnswers'   => new ListType(new QuestionAnswerInputType()),
        ]);
    }

    public function getDescription(){
        return 'SurveyAnswerInput';
    }  
}