<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\GraphQL\Type\ServiceType;
use AppBundle\GraphQL\Type\UserType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\ListType\ListType;

class UserType extends AbstractObjectType {
    
    /**
     * @param ObjectTypeConfig $config
     *
     * @return mixed
     */
    public function build($config){
        $config->addFields([
            'id'            => new NonNullType(new IdType()),
            'username'      => new NonNullType(new StringType()),
            'email'         => new StringType(),
            'roles'         => new ListType(new NonNullType(new StringType())),
            'lastUpdate'    => new StringType(),
            'service'       => new NonNullType(new ServiceType()),
        ]);
    }

    public function getValues() {
        $values = UserType::toArray();
        return array_map(function($v, $k) {
            return [
                'value' => $k,
                'name' => $v
            ];
        }, $values, array_keys($values));
    }

    public function getDescription(){
        return 'User';
    }

    public static function toArray($user){
        return [
            'id'            => $user->getId(),
            'username'      => $user->getUsername(),
            'email'         => $user->getEmail(),
            'roles'         => $user->getRoles(),
            'lastUpdate'    => $user->getLastUpdate(),
            'service'       => $user->getService(),
        ];
    }
}