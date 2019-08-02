<?php

namespace AppBundle\GraphQL\Type;

use AppBundle\GraphQL\Type\ServiceType;
use AppBundle\GraphQL\Type\FolderType;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\IntType;

class FolderInputType extends AbstractInputObjectType {
    /**
     * @param ObjectTypeConfig $config
     *
     * @return mixed
     */
    public function build($config) {
        $config->addFields([
            'name'          => new NonNullType(new StringType()),
            'serviceId'     => new NonNullType(new IntType()),
            'folderId'      => new NonNullType(new IntType()),
        ]);
    }

    public function getDescription() {
        return 'FolderInput';
    } 
}