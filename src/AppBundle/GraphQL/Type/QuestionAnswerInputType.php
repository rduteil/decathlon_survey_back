<?php

namespace AppBundle\GraphQL\Type;

use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\FloatType;

class QuestionAnswerInputType extends AbstractInputObjectType {
    public function build($config){
        $config->addFields([
            'questionName'  => new NonNullType(new StringType()),
            'questionIndex' => new NonNullType(new IntType()),
            'questionType'  => new NonNullType(new StringType()),

            /**
             * Début des props
             */
            'value'         => new StringType(),
            'choice'        => new ListType(new BooleanType()),
            'rank'          => new ListType(new StringType()),
            'file'          => new ListType(new StringType()),
            'scale'         => new FloatType(),
            'date'          => new ListType(new StringType()),
        ]);
    }

    public function getDescription(){
        return 'QuestionAnswerInput';
    }  
}