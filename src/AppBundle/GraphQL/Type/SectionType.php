<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\Entity\Survey;
use AppBundle\Entity\Section;
use AppBundle\Entity\Question;
use AppBundle\GraphQL\Type\SurveyType;
use AppBundle\GraphQL\Type\QuestionType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\ListType\ListType;

class SectionType extends AbstractObjectType {

    /**
     * @param ObjectTypeConfig $config
     *
     * @return mixed
     */
    public function build($config){
        $config->addFields([
            'id'            => new NonNullType(new IdType()),
            'name'          => new NonNullType(new StringType()),
            'index'         => new NonNullType(new IntType()),
            'image'         => new StringType(),
            'description'   => new StringType(),
            'hangout'       => new NonNullType(new BooleanType()),
            'survey'        => new NonNullType(new SurveyType()),
            'questions'     => new ListType(new QuestionType()),
        ]);
    }

    public function getDescription(){
        return 'section';
    }

    public function getValues() {
        $values = SectionType::toArray();
        return array_map(function($v, $k) {
            return [
                'value' => $k,
                'name' => $v
            ];
        }, $values, array_keys($values));
    }

    public static function toArray(Section $section){
        return [
            'id'            => $section->getId(),
            'name'          => $section->getName(),
            'index'         => $section->getIndex(),
            'image'         => $section->getImage(),
            'description'   => $section->getDescription(),
            'hangout'       => $section->getHangout(),
            'survey'        => $section->getSurvey(),
            'questions'     => array_map(function(Question $question){return QuestionType::toArray($question);}, $section->getQuestions()->getValues()),
        ];
    }

}