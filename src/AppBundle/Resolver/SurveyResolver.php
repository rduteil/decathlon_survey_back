<?php

namespace AppBundle\Resolver;

use AppBundle\Entity\Survey;
use AppBundle\Entity\Question;
use AppBundle\Entity\Helpers\Generate;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Debug\Exception\ContextErrorException;

class SurveyResolver extends AbstractResolver {

    public function add(
        string $name,
        string $reference,
        string $image,
        string $description,
        bool $hangout,
        string $activationDate,
        string $deactivationDate,
        string $activationKey,
        string $language,
        int $folderId
    ){
        $link = Generate::randomString(8);
        $lastUpdate = date("d-m-Y H:i:s");
        $survey = new Survey(
            $name, 
            $reference, 
            $link, 
            $image, 
            $description, 
            $hangout,
            $activationDate,
            $deactivationDate,
            $activationKey,
            $language,
            $lastUpdate
        );
        $folder = $this->container->get('resolver.folder')->findFolder($folderId);
        $folder->addSurvey($survey);

        $this->persist($survey);
        return $survey;
    }

    public function update(
        Survey $survey,
        string $name,
        string $reference,
        string $image,
        string $description,
        bool $hangout,
        string $activationDate,
        string $deactivationDate,
        string $activationKey,
        string $language,
        array $sections,
        array $questions
    ){
        $survey->setName($name);
        $survey->setReference($reference);
        $survey->setImage($image);
        $survey->setDescription($description);
        $survey->setHangout($hangout);
        $survey->setActivationDate($activationDate);
        $survey->setDeactivationDate($deactivationDate);
        $survey->setActivationKey($activationKey);
        $survey->setLanguage($language);
        $survey->setLastUpdate(date("d-m-Y H:i:s"));

        foreach($survey->getSections() as $section){
            $this->remove($section);
        }

        foreach($survey->getQuestions() as $question){
            $this->remove($question);
        }

        foreach($sections as $section){
            [
                'name'          => $name,
                'index'         => $index,
                'image'         => $image,
                'description'   => $description,
                'hangout'       => $hangout,
                'questions'     => $sectionQuestions
            ] = $section;

            $section = $this->container->get('resolver.section')->add(
                $name,
                $index,
                $image,
                $description,
                $hangout,
                $sectionQuestions
            );
            $survey->addSection($section);
        }

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
            $survey->addQuestion($question);
        }
        $this->flush();
        return $survey;
    }

    public function duplicate(Survey $survey){
        $name = $survey->getName().' (copie)';
        $link = Generate::randomString(8);
        $lastUpdate = date("d-m-Y H:i:s");
        $newSurvey = new Survey(
            $name, 
            $survey->getReference(), 
            $link,
            $survey->getImage(),
            $survey->getDescription(),
            $survey->getHangout(),
            $survey->getActivationDate(),
            $survey->getDeactivationDate(),
            $survey->getActivationKey(),
            $survey->getLanguage(),
            $lastUpdate
        );

        $survey->getFolder()->addSurvey($newSurvey);
        foreach($survey->getSections() as $section){
            $newSection = $this->container->get('resolver.section')->duplicate($section);
            $newSurvey->addSection($newSection);
        }
        foreach($survey->getQuestions() as $question){
            $newQuestion = $this->container->get('resolver.question')->duplicate($question);
            $newSurvey->addQuestion($newQuestion);
        }

        $this->persist($newSurvey);
        return $newSurvey;
    }

    public function changeFolder(Survey $survey, int $folderId){
        $survey->getFolder()->removeSurvey($survey);
        $folder = $this->container->get('resolver.folder')->findFolder($folderId);
        $folder->addSurvey($survey);

        $this->flush();
        return $survey;
    }

    public function share(Survey $survey, int $serviceId){
        $name = $survey->getName().' (partage)';
        $link = Generate::randomString(8);
        $lastUpdate = date("d-m-Y H:i:s");
        $newSurvey = new Survey(
            $name, 
            $survey->getReference(), 
            $link,
            $survey->getImage(),
            $survey->getDescription(),
            $survey->getHangout(),
            $survey->getActivationDate(),
            $survey->getDeactivationDate(),
            $survey->getActivationKey(),
            $survey->getLanguage(),
            $lastUpdate
        );

        $service = $this->container->get('resolver.service')->findService($serviceId);
        foreach($service->getFolders() as $folder){
            if($folder->getIsRoot() === true){
                $folder->addSurvey($newSurvey);
            }
        }

        foreach($survey->getSections() as $section){
            $newSection = $this->container->get('resolver.section')->duplicate($section);
            $newSurvey->addSection($newSection);
        }
        foreach($survey->getQuestions() as $question){
            $newQuestion = $this->container->get('resolver.question')->duplicate($question);
            $newSurvey->addQuestion($newQuestion);
        }

        $this->persist($newSurvey);
        return $newSurvey;        
    }

    public function delete(Survey $survey){
        $id = $survey->getId();
        try {
            $this->recursiveRemoving(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$id);
            $survey->getFolder()->removeSurvey($survey);
            $this->remove($survey);
            return $id;
        }
        catch(ContextErrorException $exception){
            $survey->getFolder()->removeSurvey($survey);
            $this->remove($survey);
            return $id;
        }
    }

    function recursiveRemoving($dir){ 
        if (is_dir($dir)){ 
            $objects = scandir($dir); 
            foreach ($objects as $object){ 
                if ($object != "." && $object != ".."){ 
                    if (is_dir($dir."/".$object)) $this->recursiveRemoving($dir."/".$object);
                    else unlink($dir."/".$object); 
                } 
            }
            rmdir($dir); 
        } 
    }

    public function findSurvey(int $id){
        return $this->findOneBy('Survey', ['id' => $id]);
    }

    public function findSurveyBy(array $arr){
        return $this->findOneBy('Survey', $arr);
    }

    public function findSurveys(){
        return $this->findAll('Survey');
    }
}
