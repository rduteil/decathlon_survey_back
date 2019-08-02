<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\Entity\Survey;
use AppBundle\Entity\Section;
use AppBundle\Entity\Question;
use AppBundle\Entity\SurveyAnswer;
use AppBundle\GraphQL\Type\FolderType;
use AppBundle\GraphQL\Type\SectionType;
use AppBundle\GraphQL\Type\QuestionType;
use AppBundle\GraphQL\Type\SurveyAnswerType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\ListType\ListType;

class SurveyType extends AbstractObjectType {

    /**
     * @param ObjectTypeConfig $config
     *
     * @return mixed
     */
    public function build($config){
        $config->addFields([
            'id'                => new NonNullType(new IdType()),
            'name'              => new NonNullType(new StringType()),
            'reference'         => new NonNullType(new StringType()),
            'link'              => new NonNullType(new StringType()),
            'image'             => new StringType(),
            'description'       => new StringType(),
            'hangout'           => new NonNullType(new BooleanType()),
            'activationDate'    => new StringType(),
            'deactivationDate'  => new StringType(),
            'activationKey'     => new StringType(),
            'language'          => new StringType(),
            'lastUpdate'        => new StringType(),
            'folder'            => new FolderType(),
            'sections'          => new ListType(new SectionType()),
            'questions'         => new ListType(new QuestionType()),
            'surveyAnswers'     => new ListType(new SurveyAnswerType()),
        ]);
    }

    public function getDescription(){
        return 'Survey';
    }

    public function getValues(){
        $values = SurveyType::toArray();
        return array_map(function($v, $k){
            return [
                'value' => $k,
                'name' => $v
            ];
        }, $values, array_keys($values));
    }

    public static function toArray(Survey $survey){
        return [
            'id'                => $survey->getId(),
            'name'              => $survey->getName(),
            'reference'         => $survey->getReference(),
            'link'              => $survey->getLink(),
            'image'             => $survey->getImage(),
            'description'       => $survey->getDescription(),
            'hangout'           => $survey->getHangout(),
            'activationDate'    => $survey->getActivationDate(),
            'deactivationDate'  => $survey->getDeactivationDate(),
            'activationKey'     => $survey->getActivationKey(),
            'language'          => $survey->getLanguage(),
            'lastUpdate'        => $survey->getLastUpdate(),
            'folder'            => $survey->getFolder(),
            'sections'          => array_map(function(Section $section){return SectionType::toArray($section);}, $survey->getSections()->getValues()),
            'questions'         => array_map(function(Question $question){return QuestionType::toArray($question);}, $survey->getQuestions()->getValues()),
            'surveyAnswers'     => array_map(function(SurveyAnswer $surveyAnswer){return SurveyAnswerType::toArray($surveyAnswer);}, $survey->getSurveyAnswers()->getValues())
        ];
    }
}