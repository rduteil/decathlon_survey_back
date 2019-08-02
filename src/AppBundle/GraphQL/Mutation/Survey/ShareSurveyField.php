<?php

namespace AppBundle\GraphQL\Mutation\Survey;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\GraphQL\Type\SurveyType;
use AppBundle\GraphQL\Type\SurveyInputType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class ShareSurveyField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {
        $config->addArguments([
            'surveyId'  => [
                'type'  => new NonNullType(new IdType()),
            ],
            'serviceId' => [
                'type'  => new NonNullType(new IdType()),
            ]
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info) {
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_USER], $user);

        $survey = $this->container->get('resolver.survey')->findSurvey($args['surveyId']);
        $survey = $this->container->get('resolver.survey')->share($survey, $args['serviceId']);
        return SurveyType::toArray($survey); 
    }

    public function getType() {
        return new SurveyType();
    }

    public function getName() {
        return 'shareSurvey';
    }

    public function getDescription() {
        return 'Share a Survey';
    }

}