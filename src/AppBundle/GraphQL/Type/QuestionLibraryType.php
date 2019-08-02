<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\Entity\QuestionLibrary;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Scalar\FloatType;

class QuestionLibraryType extends AbstractObjectType {
    public function build($config){
        $config->addFields([
            'id'                => new NonNullType(new IdType()),
            'name'              => new NonNullType(new StringType()),
            'description'       => new StringType(),
            'type'              => new NonNullType(new StringType()),
            'username'          => new NonNullType(new StringType()),
            'postDate'          => new NonNullType(new StringType()),
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
            /***
             *  Fin des props
             */
        ]);
    }

    public function getDescription() {
        return 'QuestionLibrary';
    }

    public function getValues() {
        $values = QuestionType::toArray();
        return array_map(function($v, $k) {
            return [
                'value' => $k,
                'name' => $v
            ];
        }, $values, array_keys($values));
    }

    public function toArray(QuestionLibrary $questionLibrary) {
        return [
            'id'                => $questionLibrary->getId(),
            'name'              => $questionLibrary->getName(),
            'description'       => $questionLibrary->getDescription(),
            'type'              => $questionLibrary->getType(),
            'username'          => $questionLibrary->getUsername(),
            'postDate'          => $questionLibrary->getPostDate(),
            /**
             * Début des props
             * */
            'askFor'            => $questionLibrary->getAskFor(),
            'linesNumber'       => $questionLibrary->getLinesNumber(),
            'columnsNumber'     => $questionLibrary->getColumnsNumber(),
            'linesLabels'       => $questionLibrary->getLinesLabels(),
            'columnsLabels'     => $questionLibrary->getColumnsLabels(),
            'linesImages'       => $questionLibrary->getLinesImages(),
            'columnsImages'     => $questionLibrary->getColumnsImages(),
            'numberOfAnswers'   => $questionLibrary->getNumberOfAnswers(),
            'valuesAsImages'    => $questionLibrary->getValuesAsImages(),
            'numberOfValues'    => $questionLibrary->getNumberOfValues(),
            'values'            => $questionLibrary->getValues(),
            'topLabel'          => $questionLibrary->getTopLabel(),
            'bottomLabel'       => $questionLibrary->getBottomLabel(),
            'fileTypes'         => $questionLibrary->getFileTypes(),
            'commentary'        => $questionLibrary->getCommentary(),
            'scaleMin'          => $questionLibrary->getScaleMin(),
            'scaleMax'          => $questionLibrary->getScaleMax(),
            'step'              => $questionLibrary->getStep(),
            'labelsValues'      => $questionLibrary->getLabelsValues(),
            'selectedValue'     => $questionLibrary->getSelectedValue(),
            'graduation'        => $questionLibrary->getGraduation(),
            'gradient'          => $questionLibrary->getGradient(),
            'gradientType'      => $questionLibrary->getGradientType(),
            'dateInterval'      => $questionLibrary->getDateInterval(),
            'dateMin'           => $questionLibrary->getDateMin(),
            'dateMax'           => $questionLibrary->getDateMax(),
            /**
             * Fin des props
            */
        ];
    }
}