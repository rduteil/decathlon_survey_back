<?php

namespace AppBundle\GraphQL\Query\Survey;

use AppBundle\GraphQL\Type\SurveyType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class SurveyFromLinkField extends AbstractContainerAwareField {

    public function build(FieldConfig $config){
        $config->addArguments([
            'link' => [
                'type' => new NonNullType(new StringType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        $survey = $this->container->get('resolver.survey')->findSurveyBy($args);
        return SurveyType::toArray($survey);
    }

    public function getType(){
        return new SurveyType();
    }

    public function getName(){
        return 'surveyFromLink';
    }

    public function getDescription(){
        return 'Return a survey from a link';
    }

}