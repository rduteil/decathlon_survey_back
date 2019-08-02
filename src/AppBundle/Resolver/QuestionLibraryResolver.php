<?php

namespace AppBundle\Resolver;

use AppBundle\Entity\QuestionLibrary;

class QuestionLibraryResolver extends AbstractResolver {

    public function add(
        string $name,
        string $description,
        string $type,
        string $username,
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
        $postDate = date("d-m-Y H:i:s");
        $questionLibrary = new QuestionLibrary(
            $name,
            $description,
            $type,
            $username,
            $postDate,
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

        $this->persist($questionLibrary);
        return $questionLibrary;
    }

    public function delete(QuestionLibrary $questionLibrary){
        $id = $questionLibrary->getId();
        $this->remove($questionLibrary);
        return $id;
    }

    public function update(QuestionLibrary $questionLibrary, string $username){
        $questionLibrary->setUsername($username);
        $this->flush();
        return $questionLibrary;
    }

    public function findQuestionLibrary(int $id) {
        return $this->findOneBy('QuestionLibrary', ['id' => $id]);
    }

    public function findQuestionLibraryBy(array $arr) {
        return $this->findOneBy('QuestionLibrary', $arr);
    }

    public function findQuestionLibraries(){
        return $this->findAll('QuestionLibrary');
    }
}