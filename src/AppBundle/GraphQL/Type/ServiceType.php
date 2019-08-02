<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\Entity\Service;
use AppBundle\Entity\Folder;
use AppBundle\Entity\User;
use AppBundle\GraphQL\Type\FolderType;
use AppBundle\GraphQL\Type\UserType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\ListType\ListType;

class ServiceType extends AbstractObjectType {

    /**
     * @param ObjectTypeConfig $config
     *
     * @return mixed
     */
    public function build($config){
        $config->addFields([
            'id'            => new NonNullType(new IdType()),
            'name'          => new NonNullType(new StringType()),
            'lastUpdate'    => new StringType(),
            'folders'       => new ListType(new FolderType()),
            'users'         => new ListType(new UserType()),
        ]);
    }

    public function getDescription(){
        return 'Service';
    }

    public static function toArray(Service $service){
        return [
            'id'            => $service->getId(),
            'name'          => $service->getName(),
            'lastUpdate'    => $service->getLastUpdate(),
            'folders'       => array_map(function(Folder $folder){return FolderType::toArray($folder);}, $service->getFolders()->getValues()),
            'users'         => array_map(function(User $user){return UserType::toArray($user);}, $service->getUsers()->getValues()),
        ];
    }

}