<?php

namespace AppBundle\Entity\Enums;

class QuestionTypeEnum {
    const QUESTION_VALUE = "QUESTION_VALUE";
    const QUESTION_CHOICE = "QUESTION_CHOICE";
    const QUESTION_RANK = "QUESTION_RANK";
    const QUESTION_FILE = "QUESTION_FILE";
    const QUESTION_SCALE = "QUESTION_SCALE";
    const QUESTION_DATE = "QUESTION_DATE";

    public static function toArray(){
        return [
            self::QUESTION_VALUE,
            self::QUESTION_CHOICE,
            self::QUESTION_RANK,
            self::QUESTION_FILE,
            self::QUESTION_SCALE,
            self::QUESTION_DATE,
        ];
    }

    public static function toName($value){
        return self::toArray()[$value];
    }
}

