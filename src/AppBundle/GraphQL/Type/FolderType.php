<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\Entity\Service;
use AppBundle\Entity\Folder;
use AppBundle\Entity\Survey;
use AppBundle\GraphQL\Type\ServiceType;
use AppBundle\GraphQL\Type\SurveyType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\ListType\ListType;

class FolderType extends AbstractObjectType {

    /**
     * @param ObjectTypeConfig $config
     *
     * @return mixed
     */
    public function build($config){
        $config->addFields([
            'id'            => new NonNullType(new IdType()),
            'name'          => new NonNullType(new StringType()),
            'isRoot'        => new NonNullType(new BooleanType()),
            'lastUpdate'    => new StringType(),
            'service'       => new ServiceType(),
            'folder'        => new FolderType(),
            'folders'       => new ListType(new FolderType()),
            'surveys'       => new ListType(new SurveyType()),
        ]);
    }

    public function getDescription(){
        return 'folder';
    }

    public function getValues() {
        $values = FolderType::toArray();
        return array_map(function($v, $k) {
            return [
                'value' => $k,
                'name' => $v
            ];
        }, $values, array_keys($values));
    }

    public static function toArray(Folder $folder){
        return [
            'id'            => $folder->getId(),
            'name'          => $folder->getName(),
            'isRoot'        => $folder->getIsRoot(),
            'lastUpdate'    => $folder->getLastUpdate(),
            'service'       => $folder->getService(),
            'folder'        => $folder->getFolder(),
            'folders'       => array_map(function(Folder $childFolder){return FolderType::toArray($childFolder);}, $folder->getFolders()->getValues()),
            'surveys'       => array_map(function(Survey $survey){return SurveyType::toArray($survey);}, $folder->getSurveys()->getValues()),
        ];
    }

}