<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\Entity\Question;
use AppBUndle\GraphQl\Type\SurveyType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Scalar\FloatType;

class QuestionType extends AbstractObjectType {
    public function build($config){
        $config->addFields([
            'id'                => new NonNullType(new IdType()),
            'name'              => new NonNullType(new StringType()),
            'index'             => new NonNullType(new IntType()),
            'description'       => new StringType(),
            'mandatory'         => new NonNullType(new BooleanType()),
            'type'              => new NonNullType(new StringType()),
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
            /***
             *  Fin des props
             */
            'survey'            => new NonNUllType(new SurveyType()),
            'section'           => new NonNullType(new SectionType()),
        ]);
    }

    public function getDescription() {
        return 'Question';
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

    public function toArray(Question $question) {
        return [
            'id'            => $question->getId(),
            'name'          => $question->getName(),
            'index'         => $question->getIndex(),
            'description'   => $question->getDescription(),
            'mandatory'     => $question->getMandatory(),
            'type'          => $question->getType(),
            'hangout'       => $question->getHangout(),
            /**
             * Début des props
             * */
            'askFor'            => $question->getAskFor(),
            'linesNumber'       => $question->getLinesNumber(),
            'columnsNumber'     => $question->getColumnsNumber(),
            'linesLabels'       => $question->getLinesLabels(),
            'columnsLabels'     => $question->getColumnsLabels(),
            'linesImages'       => $question->getLinesImages(),
            'columnsImages'     => $question->getColumnsImages(),
            'numberOfAnswers'   => $question->getNumberOfAnswers(),
            'valuesAsImages'    => $question->getValuesAsImages(),
            'numberOfValues'    => $question->getNumberOfValues(),
            'values'            => $question->getValues(),
            'topLabel'          => $question->getTopLabel(),
            'bottomLabel'       => $question->getBottomLabel(),
            'fileTypes'         => $question->getFileTypes(),
            'commentary'        => $question->getCommentary(),
            'scaleMin'          => $question->getScaleMin(),
            'scaleMax'          => $question->getScaleMax(),
            'step'              => $question->getStep(),
            'labelsValues'      => $question->getLabelsValues(),
            'selectedValue'     => $question->getSelectedValue(),
            'graduation'        => $question->getGraduation(),
            'gradient'          => $question->getGradient(),
            'gradientType'      => $question->getGradientType(),
            'dateInterval'      => $question->getDateInterval(),
            'dateMin'           => $question->getDateMin(),
            'dateMax'           => $question->getDateMax(),
            /**
             * Fin des props
            */
            'survey'            => $question->getSurvey(),
            'section'           => $question->getSection(),
        ];
    }
}