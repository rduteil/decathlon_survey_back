<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * QuestionLibrary
 *
 * @ORM\Entity
 * @ORM\Table(name="questionLibraries")
 */
class QuestionLibrary {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="text")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="text")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="postDate", type="text")
     */
    private $postDate;

    /**
     * @var string
     * 
     * @ORM\Column(name="askFor", type="text", nullable=true)
     */
    private $askFor;

    /**
     * @var int
     * 
     * @ORM\Column(name="linesNumber", type="integer", nullable=true)
     */
    private $linesNumber;

    /**
     * @var int
     * 
     * @ORM\Column(name="columnsNumber", type="integer", nullable=true)
     */
    private $columnsNumber;

    /**
     * @var array
     * 
     * @ORM\Column(name="linesLabels", type="array", nullable=true)
     */
    private $linesLabels;

    /**
     * @var array
     * 
     * @ORM\Column(name="columnsLabels", type="array", nullable=true)
     */
    private $columnsLabels;

    /**
     * @var array
     * 
     * @ORM\Column(name="linesImages", type="array", nullable=true)
     */
    private $linesImages;

    /**
     * @var array
     * 
     * @ORM\Column(name="columnsImages", type="array", nullable=true)
     */
    private $columnsImages;

    /**
     * @var int
     * 
     * @ORM\Column(name="numberOfAnswers", type="integer", nullable=true)
     */
    private $numberOfAnswers;

    /**
     * @var bool
     * 
     * @ORM\Column(name="valuesAsImages", type="boolean", nullable=true)
     */
    private $valuesAsImages;

    /**
     * @var int
     * 
     * @ORM\Column(name="numberOfValues", type="integer", nullable=true)
     */
    private $numberOfValues;

    /**
     * @var array
     * 
     * @ORM\Column(name="values", type="array", nullable=true)
     */
    private $values;

    /**
     * @var string
     * 
     * @ORM\Column(name="topLabel", type="text", nullable=true)
     */
    private $topLabel;

    /**
     * @var string
     * 
     * @ORM\Column(name="bottomLabel", type="text", nullable=true)
     */
    private $bottomLabel;

    /**
     * @var array
     * 
     * @ORM\Column(name="fileTypes", type="array", nullable=true)
     */
    private $fileTypes;

    /**
     * @var bool
     * 
     * @ORM\Column(name="commentary", type="boolean", nullable=true)
     */
    private $commentary;

    /**
     * @var int
     * 
     * @ORM\Column(name="scaleMin", type="integer", nullable=true)
     */
    private $scaleMin;

    /**
     * @var int
     * 
     * @ORM\Column(name="scaleMax", type="integer", nullable=true)
     */
    private $scaleMax;

    /**
     * @var float
     * 
     * @ORM\Column(name="step", type="float", nullable=true)
     */
    private $step;

    /**
     * @var array
     * 
     * @ORM\Column(name="labelsValues", type="array", nullable=true)
     */
    private $labelsValues;

    /**
     * @var bool
     * 
     * @ORM\Column(name="selectedValue", type="boolean", nullable=true)
     */
    private $selectedValue;

    /**
     * @var bool
     * 
     * @ORM\Column(name="graduation", type="boolean", nullable=true)
     */
    private $graduation;

    /**
     * @var bool
     * 
     * @ORM\Column(name="gradient", type="boolean", nullable=true)
     */
    private $gradient;

    /**
     * @var int
     * 
     * @ORM\Column(name="gradientType", type="integer", nullable=true)
     */
    private $gradientType;

    /**
     * @var bool
     * 
     * @ORM\Column(name="dateInterval", type="boolean", nullable=true)
     */
    private $dateInterval;

    /**
     * @var string
     * 
     * @ORM\Column(name="dateMin", type="text", nullable=true)
     */
    private $dateMin;

    /**
     * @var string
     * 
     * @ORM\Column(name="dateMax", type="text", nullable=true)
     */
    private $dateMax;

    public function __construct(
        string $name,
        string $description,
        string $type,
        string $username,
        string $postDate,
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
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->username = $username;
        $this->postDate = $postDate;
        $this->askFor = $askFor;
        $this->linesNumber = $linesNumber;
        $this->columnsNumber = $columnsNumber;
        $this->linesLabels = $linesLabels;
        $this->columnsLabels = $columnsLabels;
        $this->linesImages = $linesImages;
        $this->columnsImages = $columnsImages;
        $this->numberOfAnswers = $numberOfAnswers;
        $this->valuesAsImages = $valuesAsImages;
        $this->numberOfValues = $numberOfValues;
        $this->values = $values;
        $this->topLabel = $topLabel;
        $this->bottomLabel = $bottomLabel;
        $this->fileTypes = $fileTypes;
        $this->commentary = $commentary;
        $this->scaleMin = $scaleMin;
        $this->scaleMax = $scaleMax;
        $this->step = $step;
        $this->labelsValues = $labelsValues;
        $this->selectedValue = $selectedValue;
        $this->graduation = $graduation;
        $this->gradient = $gradient;
        $this->gradientType = $gradientType;
        $this->dateInterval = $dateInterval;
        $this->dateMin = $dateMin;
        $this->dateMax = $dateMax;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getType(){
        return $this->type;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPostDate(){
        return $this->postDate;
    }

    public function getAskFor(){
        return $this->askFor;
    }

    public function getLinesNumber(){
        return $this->linesNumber;
    }

    public function getColumnsNumber(){
        return $this->columnsNumber;
    }

    public function getLinesLabels(){
        return $this->linesLabels;
    }

    public function getColumnsLabels(){
        return $this->columnsLabels;
    }

    public function getLinesImages(){
        return $this->linesImages;
    }

    public function getColumnsImages(){
        return $this->columnsImages;
    }

    public function getNumberOfAnswers(){
        return $this->numberOfAnswers;
    }

    public function getValuesAsImages(){
        return $this->valuesAsImages;
    }

    public function getNumberOfValues(){
        return $this->numberOfValues;
    }

    public function getValues(){
        return $this->values;
    }

    public function getTopLabel(){
        return $this->topLabel;
    }

    public function getBottomLabel(){
        return $this->bottomLabel;
    }

    public function getFileTypes(){
        return $this->fileTypes;
    }

    public function getCommentary(){
        return $this->commentary;
    }

    public function getScaleMin(){
        return $this->scaleMin;
    }

    public function getScaleMax(){
        return $this->scaleMax;
    }

    public function getStep(){
        return $this->step;
    }

    public function getLabelsValues(){
        return $this->labelsValues;
    }

    public function getSelectedValue(){
        return $this->selectedValue;
    }

    public function getGraduation(){
        return $this->graduation;
    }

    public function getGradient(){
        return $this->gradient;
    }

    public function getGradientType(){
        return $this->gradientType;
    }

    public function getDateInterval(){
        return $this->dateInterval;
    }

    public function getDateMin(){
        return $this->dateMin;
    }

    public function getDateMax(){
        return $this->dateMax;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    public function setType(string $type){
        $this->type = $type;
    }

    public function setUsername(string $username){
        $this->username = $username;
    }

    public function setPostDate(string $postDate){
        $this->postDate = $postDate;
    }

    public function setAskFor(string $askFor){
        $this->askFor = $askFor;
    }

    public function setLinesNumber(int $linesNumber){
        $this->linesNumber = $linesNumber;
    }

    public function setColumnsNumber(int $columnsNumber){
        $this->columnsNumber = $columnsNumber;
    }

    public function setLinesLabels(array $linesLabels){
        $this->linesLabels = $linesLabels;
    }

    public function setColumnsLabels(array $columnsLabels){
        $this->columnsLabels = $columnsLabels;
    }

    public function setLinesImages(array $linesImages){
        $this->linesImages = $linesImages;
    }

    public function setColumnsImages(array $columnsImages){
        $this->columnsImages = $columnsImages;
    }

    public function setNumberOfAnswers(int $numberOfAnswers){
        $this->numberOfAnswers = $numberOfAnswers; 
    }

    public function setValuesAsImages(bool $valuesAsImages){
        $this->valuesAsImages = $valuesAsImages;
    }

    public function setNumberOfValues(int $numberOfValues){
        $this->numberOfValues = $numberOfValues;
    }

    public function setValues(array $values){
        $this->values = $values;
    }

    public function setTopLabel(string $topLabel){
        $this->topLabel = $topLabel;
    }

    public function setBottomLabel(string $bottomLabel){
        $this->bottomLabel = $bottomLabel;
    }

    public function setFileTypes(array $fileTypes){
        $this->fileTypes = $fileTypes;
    }

    public function setCommentary(bool $commentary){
        $this->commentary = $commentary;
    }

    public function setScaleMin(int $scaleMin){
        $this->scaleMin = $scaleMin;
    }

    public function setScaleMax(int $scaleMax){
        $this->scaleMax = $scaleMax;
    }

    public function setStep(float $step){
        $this->step = $step;
    }

    public function setLabelsValues(array $labelsValues){
        $this->labelsValues = $labelsValues;
    }

    public function setSelectedValue(bool $selectedValue){
        $this->selectedValue = $selectedValue;
    }

    public function setGraduation(bool $graduation){
        $this->graduation = $graduation;
    }

    public function setGradient(bool $gradient){
        $this->gradient = $gradient;
    }

    public function setGradientType(int $gradientType){
        $this->gradientType = $gradientType;
    }

    public function setDateInterval(bool $dateInterval){
        $this->dateInterval = $dateInterval;
    }

    public function setDateMin(string $dateMin){
        $this->dateMin = $dateMin;
    }

    public function setDateMax(string $dateMax){
        $this->dateMax = $dateMax;
    }
}
