<?php

namespace AppBundle\GraphQL\Query\Survey;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\GraphQL\Type\SurveyType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class SurveyField extends AbstractContainerAwareField {

    public function build(FieldConfig $config){
        $config->addArguments([
            'id' => [
                'type' => new NonNullType(new IdType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([USerRoleEnum::ROLE_USER], $user);

        $survey = $this->container->get('resolver.survey')->findSurvey($args['id']);
        return SurveyType::toArray($survey);
    }

    public function getType(){
        return new SurveyType();
    }

    public function getName(){
        return 'survey';
    }

    public function getDescription(){
        return 'Return a survey';
    }

}