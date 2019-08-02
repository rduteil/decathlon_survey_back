<?php

namespace AppBundle\GraphQL\Mutation\SurveyAnswer;

use AppBundle\GraphQL\Type\SurveyAnswerType;
use AppBundle\GraphQL\Type\SurveyAnswerInputType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class AddSurveyAnswerField extends AbstractContainerAwareField {
    public function build(FieldConfig $config){
        $config->addArguments([
            'input' => [
                'type' => new NonNullType(new SurveyAnswerInputType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        [
            'questionAnswers'   => $questionAnswers,
            'hangout'           => $hangout,
            'surveyId'          => $surveyId,
        ] = $args['input'];
        $survey = $this->container->get('resolver.survey')->findSurvey($surveyId);
        return $this->container->get('resolver.surveyAnswer')->add($survey, $hangout, $questionAnswers);
    }

    public function getType(){
        return new SurveyAnswerType();
    }

    public function getName(){
        return 'addSurveyAnswer';
    }

    public function getDescription(){
        return 'Create a new SurveyAnswer';
    }
}