<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\GraphQL\Type\SectionInputType;
use AppBundle\GraphQL\Type\QuestionInputType;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\ListType\ListType;

class SurveyInputType extends AbstractInputObjectType {
    /**
     * @param ObjectTypeConfig $config
     *
     * @return mixed
     */
    public function build($config) {
        $config->addFields([
            'name'              => new NonNullType(new StringType()),
            'reference'         => new NonNullType(new StringType()),
            'image'             => new StringType(),
            'description'       => new StringType(),
            'hangout'           => new NonNullType(new BooleanType()),
            'activationDate'    => new StringType(),
            'deactivationDate'  => new StringType(),
            'activationKey'     => new StringType(),
            'language'          => new StringType(),
            'lastUpdate'        => new StringType(),
            'folderId'          => new NonNullType(new IntType()),
            'sections'          => new ListType(new SectionInputType()),
            'questions'         => new ListType(new QuestionInputType()),
        ]);
    }

    public function getDescription() {
        return 'SurveyInput';
    } 

}