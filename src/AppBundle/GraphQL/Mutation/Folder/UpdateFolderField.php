<?php

namespace AppBundle\GraphQL\Mutation\Folder;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\GraphQL\Type\FolderType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class UpdateFolderField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {
        $config->addArguments([
            'id' => [
                'type' => new NonNullType(new IdType()),
            ],
            'folderId' => [
                'type' => new NonNullType(new IntType()),
            ],
            'name' => [
                'type' => new NonNullType(new StringType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_USER], $user);


        $folder = $this->container->get('resolver.folder')->findFolder($args['id']);
        $folder = $this->container->get('resolver.folder')->update($folder, $args['name'], $args['folderId']);
        return FolderType::toArray($folder);
    }

    public function getType() {
        return new FolderType();
    }

    public function getName() {
        return 'updateFolder';
    }

    public function getDescription() {
        return 'Update a Folder';
    }

}