<?php

namespace AppBundle\GraphQL\Mutation\QuestionLibrary;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\GraphQL\Type\QuestionLibraryType;
use AppBundle\GraphQL\Type\QuestionLibraryInputType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class AddQuestionLibraryField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {
        $config->addArguments([
            'input' => [
                'type' => new NonNullType(new QuestionLibraryInputType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_USER], $user);

        [
            'name'              => $name,
            'description'       => $description,
            'type'              => $type,
            'username'          => $username,
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
        ] = $args['input'];

        $questionLibrary = $this->container->get('resolver.questionLibrary')->add(
            $name,
            $description,
            $type,
            $username,
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
        return QuestionLibraryType::toArray($questionLibrary);
    }

    public function getType() {
        return new QuestionLibraryType();
    }

    public function getName() {
        return 'addQuestionLibrary';
    }

    public function getDescription() {
        return 'Create a new QuestionLibrary';
    }

}