<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\GraphQL\Type\QuestionInputType;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\ListType\ListType;

class SectionInputType extends AbstractInputObjectType {
    /**
     * @param ObjectTypeConfig $config
     *
     * @return mixed
     */
    public function build($config) {
        $config->addFields([
            'name'          => new NonNullType(new StringType()),
            'index'         => new NonNullType(new IntType()),
            'image'         => new StringType(),
            'description'   => new StringType(),
            'hangout'       => new NonNullType(new BooleanType()),
            'lastUpdate'    => new StringType(),
            'questions'     => new ListType(new QuestionInputType()),
        ]);
    }

    public function getDescription() {
        return 'SectionInput';
    } 
}