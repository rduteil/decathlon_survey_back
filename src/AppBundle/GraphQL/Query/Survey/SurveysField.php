<?php

namespace AppBundle\GraphQL\Query\Survey;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\Entity\Survey;
use AppBundle\GraphQL\Type\SurveyType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class SurveysField extends AbstractContainerAwareField {

    public function resolve($value, array $args, ResolveInfo $info) {
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([USerRoleEnum::ROLE_USER], $user);
        
        $surveys = $this->container->get('resolver.survey')->findSurveys();
        return array_map(function(Survey $survey) { return SurveyType::toArray($survey); }, $surveys);
    }

    public function getType() {
        return new ListType(new SurveyType());
    }

    public function getName() {
        return 'surveys';
    }

    public function getDescription() {
        return 'Return all surveys';
    }

}