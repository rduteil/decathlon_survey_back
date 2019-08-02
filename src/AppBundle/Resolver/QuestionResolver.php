<?php

namespace AppBundle\Resolver;

use AppBundle\Entity\Question;

class QuestionResolver extends AbstractResolver {

    public function add(
        string $name,
        int $index,
        string $description,
        bool $mandatory,
        string $type,
        bool $hangout,
        string $askFor,
        int $linesNumber,
        int $columnsNumber,
        array $linesLabels,
        array $columnsLabels,
        array $linesImages,
        array $columnsImages,
        int $numberOfAnswers,
        bool $valuesAsImages,
        int $numberOfValues,
        array $values,
        string $topLabel,
        string $bottomLabel,
        array $fileTypes,
        bool $commentary,
        int $scaleMin,
        int $scaleMax,
        float $step,
        array $labelsValues,
        bool $selectedValue,
        bool $graduation,
        bool $gradient,
        int $gradientType,
        bool $dateInterval,
        string $dateMin,
        string $dateMax
    ){
        $question = new Question(
            $name,
            $index,
            $description,
            $mandatory,
            $type,
            $hangout,
            $askFor,
            $linesNumber,
            $columnsNumber,
            $linesLabels,
            $columnsLabels,
            $linesImages,
            $columnsImages,
            $numberOfAnswers,
            $valuesAsImages,
            $numberOfValues,
            $values,
            $topLabel,
            $bottomLabel,
            $fileTypes,
            $commentary,
            $scaleMin,
            $scaleMax,
            $step,
            $labelsValues,
            $selectedValue,
            $graduation,
            $gradient,
            $gradientType,
            $dateInterval,
            $dateMin,
            $dateMax
        );
        
        $this->flush();
        return $question;
    }

    public function duplicate(Question $question){
        $question = new Question(
            $question->getName(),
            $question->getIndex(),
            $question->getDescription(),
            $question->getMandatory(),
            $question->getType(),
            $question->getHangout(),
            $question->getAskFor(),
            $question->getLinesNumber(),
            $question->getColumnsNumber(),
            $question->getLinesLabels(),
            $question->getColumnsLabels(),
            $question->getLinesImages(),
            $question->getColumnsImages(),
            $question->getNumberOfAnswers(),
            $question->getValuesAsImages(),
            $question->getNumberOfValues(),
            $question->getValues(),
            $question->getTopLabel(),
            $question->getBottomLabel(),
            $question->getFileTypes(),
            $question->getCommentary(),
            $question->getScaleMin(),
            $question->getScaleMax(),
            $question->getStep(),
            $question->getLabelsValues(),
            $question->getSelectedValue(),
            $question->getGraduation(),
            $question->getGradient(),
            $question->getGradientType(),
            $question->getDateInterval(),
            $question->getDateMin(),
            $question->getDateMax()
        );
        $this->flush();
        return $question;
    }

    public function findQuestion(int $id) {
        return $this->findOneBy('Question', ['id' => $id]);
    }

    public function findQuestionBy(array $arr) {
        return $this->findOneBy('Question', $arr);
    }
}