<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\GraphQL\Type\ServiceType;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Scalar\IntType;

class UserInputType extends AbstractInputObjectType {
    public function build($config){
        $config->addFields([
            'username'      => new NonNullType(new StringType()),
            'password'      => new StringType(),
            'email'         => new StringType(),
            'roles'         => new ListType(new NonNullType(new StringType())),
            'serviceId'     => new NonNullType(new IntType()),
            'lastUpdate'    => new StringType(),
        ]);
    }

    public function getDescription(){
        return 'UserInput';
    }  
}