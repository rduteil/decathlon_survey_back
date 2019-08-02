<?php

namespace AppBundle\GraphQL\Query\QuestionLibrary;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\Entity\QuestionLibrary;
use AppBundle\GraphQL\Type\QuestionLibraryType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class QuestionLibrariesField extends AbstractContainerAwareField {

    public function resolve($value, array $args, ResolveInfo $info) {
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([USerRoleEnum::ROLE_USER], $user);
        
        $questionLibraries = $this->container->get('resolver.questionLibrary')->findQuestionLibraries();
        return array_map(function(QuestionLibrary $questionLibrary) { return QuestionLibraryType::toArray($questionLibrary); }, $questionLibraries);
    }

    public function getType() {
        return new ListType(new QuestionLibraryType());
    }

    public function getName() {
        return 'questionLibraries';
    }

    public function getDescription() {
        return 'Return all QuestionLibraries';
    }

}