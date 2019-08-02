<?php

namespace AppBundle\GraphQL\Mutation\Folder;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\GraphQL\Type\FolderType;
use AppBundle\GraphQL\Type\FolderInputType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class AddFolderField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {
        $config->addArguments([
            'username' => [
                'type' => new NonNullType(new StringType()),
            ],
            'input' => [
                'type' => new NonNullType(new FolderInputType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_USER], $user);

        [
            'name'      => $name,
            'serviceId' => $serviceId,
            'folderId'  => $folderId,
        ] = $args['input'];

        $user = $this->container->get('resolver.user')->findUserBy(['username' => $args['username']]);
        $id = $user->getService()->getId();
        $service = $this->container->get('resolver.service')->findService($id);
        $folder = $this->container->get('resolver.folder')->add($name, $service->getId(), $folderId);
        return FolderType::toArray($folder);
    }

    public function getType() {
        return new FolderType();
    }

    public function getName() {
        return 'addFolder';
    }

    public function getDescription() {
        return 'Create a new Folder';
    }

}