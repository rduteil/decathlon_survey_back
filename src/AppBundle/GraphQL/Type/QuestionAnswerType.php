<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\Entity\QuestionAnswer;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\FloatType;

class QuestionAnswerType extends AbstractObjectType {
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
            /**
             * Fin des props
             */
        ]);
    }

    public function getDescription(){
        return 'QuestionAnswer';
    }

    public function getValues() {
        $values = QuestionAnswerType::toArray();
        return array_map(function($v, $k) {
            return [
                'value' => $k,
                'name' => $v
            ];
        }, $values, array_keys($values));
    }

    public function toArray(QuestionAnswer $questionAnswer) {
        /**
         * Début des props
         * */
        [
            'value'         => $value,
            'choice'        => $choice,
            'rank'          => $rank,
            'file'          => $file,
            'scale'         => $scale,
            'date'          => $date
        ] = $questionAnswer->getProps();
        /**
         * Fin des props
         */
        return [
            'id'            => $questionAnswer->getId(),
            'questionName'  => $questionAnswer->getQuestionName(),
            'questionIndex' => $questionAnswer->getQuestionIndex(),
            'questionType'  => $questionAnswer->getQuestionType(),
            /**
             * Début des props
             * */
            'value'         => $value,
            'choice'        => $choice,
            'rank'          => $rank,
            'file'          => $file,
            'scale'         => $scale,
            'date'          => $date
            /**
             * Fin des props
             */
        ];
    }
}