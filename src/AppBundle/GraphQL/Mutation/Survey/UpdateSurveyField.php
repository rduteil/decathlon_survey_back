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

class UpdateSurveyField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {
        $config->addArguments([
            'id' => [
                'type' => new NonNullType(new IdType()),
            ],
            'input' => [
                'type' => new NonNullType(new SurveyInputType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info) {
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_USER], $user);
        
        [
            'name'              => $name,
            'reference'         => $reference,
            'image'             => $image,
            'description'       => $description,
            'hangout'           => $hangout,
            'activationDate'    => $activationDate,
            'deactivationDate'  => $deactivationDate,
            'activationKey'     => $activationKey,
            'language'          => $language,
            'sections'          => $sections,
            'questions'         => $questions
        ] = $args['input'];

        $survey = $this->container->get('resolver.survey')->findSurvey($args['id']);
        $survey = $this->container->get('resolver.survey')->update(
            $survey,
            $name,
            $reference,
            $image,
            $description,
            $hangout,
            $activationDate,
            $deactivationDate,
            $activationKey,
            $language,
            $sections,
            $questions
        );
        return SurveyType::toArray($survey); 
    }

    public function getType() {
        return new SurveyType();
    }

    public function getName() {
        return 'updateSurvey';
    }

    public function getDescription() {
        return 'Update a Survey';
    }

}