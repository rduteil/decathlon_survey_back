<?php

namespace AppBundle\GraphQL\Mutation\Folder;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class RemoveFolderField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {
        $config->addArguments([
            'id' => [
                'type' => new NonNullType(new IdType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info) {
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_USER], $user);

        $folder = $this->container->get('resolver.folder')->findFolder($args['id']);
        return $this->container->get('resolver.folder')->delete($folder);
    }

    public function getType() {
        return new IdType();
    }

    public function getName() {
        return 'removeFolder';
    }

    public function getDescription() {
        return 'Delete a Folder';
    }
}