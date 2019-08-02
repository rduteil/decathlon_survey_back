<?php

namespace AppBundle\GraphQL\Query;

use AppBundle\GraphQL\Query;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\Object\AbstractObjectType;

class QueryType extends AbstractObjectType {
    /**
     * @param ObjectTypeConfig $config
     * 
     * @return mixed
     */
    public function build($config) {
        $config->addFields([
            new Folder\FoldersFromUsernameField(),
            new QuestionLibrary\QuestionLibrariesField(),
            new Service\ServiceField(),
            new Service\ServicesField(),
            new Survey\SurveyField(),
            new Survey\SurveyFromLinkField(),
            new Survey\SurveysField(),
            new User\UserField(),
            new User\UsersField(),
        ]);
    }
}