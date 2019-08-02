<?php

namespace AppBundle\Resolver;

use AppBundle\Entity\Section;
use AppBundle\Entity\Survey;
use AppBundle\Entity\Question;
use Doctrine\Common\Collections\ArrayCollection;

class SectionResolver extends AbstractResolver {

    public function add(
        string $name,
        int $index,
        string $image,
        string $description,
        bool $hangout,
        array $questions
    ){
        $section = new Section(
            $name,
            $index,
            $image,
            $description,
            $hangout
        );

        foreach($questions as $question){
            [
                'name'              => $name,
                'index'             => $index,
                'description'       => $description,
                'mandatory'         => $mandatory,
                'type'              => $type,
                'hangout'           => $hangout,
                'askFor'            => $askFor,
                'linesNumber'       => $linesNumber,
                'columnsNumber'     => $columnsNumber,
                'linesLabels'       => $linesLabels,
                'columnsLabels'     => $columnsLabels,
                'linesImages'       => $linesImages,
                'columnsImages'     => $columnsImages,
                'numberOfAnswers'   => $numberOfAnswers,
                'valuesAsImages'    => $valuesAsImages,
                'numberOfValues'    => $numberOfValues,
                'values'            => $values,
                'topLabel'          => $topLabel,
                'bottomLabel'       => $bottomLabel,
                'fileTypes'         => $fileTypes,
                'commentary'        => $commentary,
                'scaleMin'          => $scaleMin,
                'scaleMax'          => $scaleMax,
                'step'              => $step,
                'labelsValues'      => $labelsValues,
                'selectedValue'     => $selectedValue,
                'graduation'        => $graduation,
                'gradient'          => $gradient,
                'gradientType'      => $gradientType,
                'dateInterval'      => $dateInterval,
                'dateMin'           => $dateMin,
                'dateMax'           => $dateMax
            ] = $question;

            $question = $this->container->get('resolver.question')->add(
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
            $section->addQuestion($question);
        }

        $this->flush();
        return $section;
    }

    public function duplicate(Section $section){
        $newSection = new Section(
            $section->getName(),
            $section->getIndex(),
            $section->getImage(),
            $section->getDescription(),
            $section->getHangout()
        );

        foreach($section->getQuestions() as $question){
            $newQuestion = $this->container->get('resolver.question')->duplicate($question);
            $newSection->addQuestion($newQuestion);
        }

        $this->flush();
        return $newSection;
    }

    public function findSection(int $id){
        return $this->findOneBy('Section', ['id' => $id]);
    }

    public function findSectionBy(array $arr){
        return $this->findOneBy('Section', $arr);
    }
}