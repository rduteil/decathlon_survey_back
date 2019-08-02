<?php

namespace AppBundle\GraphQL\Mutation;

use AppBundle\GraphQL\Mutation;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\Object\AbstractObjectType;

class MutationType extends AbstractObjectType {
    /**
     * @param ObjectTypeConfig $config
     * 
     * @return mixed
     */
    public function build($config) {
        $config->addFields([
            new Folder\AddFolderField(),
            new Folder\RemoveFolderField(),
            new Folder\UpdateFolderField(),
            new QuestionLibrary\AddQuestionLibraryField(),
            new QuestionLibrary\RemoveQuestionLibraryField(),
            new Service\AddServiceField(),
            new Service\RemoveServiceField(),
            new Service\UpdateServiceField(),
            new Survey\AddSurveyField(),
            new Survey\DuplicateSurveyField(),
            new Survey\RemoveSurveyField(),
            new Survey\UpdateSurveyField(),
            new Survey\ChangeSurveyFolderField(),
            new Survey\ShareSurveyField(),
            new SurveyAnswer\AddSurveyAnswerField(),
            new User\AddFirstAdminField(),
            new User\AddUserField(),
            new User\RemoveUserField(),
            new User\UpdateUserField(),
        ]);
    }
}