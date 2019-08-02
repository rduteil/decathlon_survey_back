<?php

namespace AppBundle\GraphQL\Type;

use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;

class ServiceInputType extends AbstractInputObjectType {
    public function build($config){
        $config->addFields([
            'name'  => new NonNullType(new StringType()),
            'lastUpdate' => new StringType(),
        ]);
    }

    public function getDescription(){
        return 'ServiceInput';
    }  
}