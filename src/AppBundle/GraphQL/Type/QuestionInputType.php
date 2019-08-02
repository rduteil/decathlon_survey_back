<?php

namespace AppBundle\GraphQL\Type;

use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Scalar\FloatType;

class QuestionInputType extends AbstractInputObjectType {
    public function build($config) {
        $config->addFields([
            'name'              => new NonNullType(new StringType()),
            'index'             => new NonNullType(new IntType()),
            'description'       => new StringType(),
            'mandatory'         => new NonNullType(new BooleanType()),
            'type'              => new NonNullType(new StringType),
            'hangout'           => new NonNullType(new BooleanType()),
            /**
             * Début des props
             */
            'askFor'            => new StringType(),
            'linesNumber'       => new IntType(),
            'columnsNumber'     => new IntType(),
            'linesLabels'       => new ListType(new StringType()),
            'columnsLabels'     => new ListType(new StringType()),
            'linesImages'       => new ListType(new StringType()),
            'columnsImages'     => new ListType(new StringType()),
            'numberOfAnswers'   => new IntType(),
            'valuesAsImages'    => new BooleanType(),
            'numberOfValues'    => new IntType(),
            'values'            => new ListType(new StringType()),
            'topLabel'          => new StringType(),
            'bottomLabel'       => new StringType(),
            'fileTypes'         => new ListType(new BooleanType()),
            'commentary'        => new BooleanType(),
            'scaleMin'          => new IntType(),
            'scaleMax'          => new IntType(),
            'step'              => new FloatType(),
            'labelsValues'      => new ListType(new StringType()),
            'selectedValue'     => new BooleanType(),
            'graduation'        => new BooleanType(),
            'gradient'          => new BooleanType(),
            'gradientType'      => new IntType(),
            'dateInterval'      => new BooleanType(),
            'dateMin'           => new StringType(),
            'dateMax'           => new StringType(),
            /**
             * Fin des props
             */
        ]);
    }

    public function getDescription() {
        return 'QuestionInput';
    }
}