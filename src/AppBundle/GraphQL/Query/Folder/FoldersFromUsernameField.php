<?php

namespace AppBundle\GraphQL\Query\Folder;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\Entity\Folder;
use AppBundle\GraphQL\Type\FolderType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class FoldersFromUsernameField extends AbstractContainerAwareField {

    public function build(FieldConfig $config){
        $config->addArguments([
            'username' => [
                'type' => new NonNullType(new StringType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([USerRoleEnum::ROLE_USER], $user);
        
        [
            'username' => $username
        ] = $args;
        
        $user = $this->container->get('resolver.user')->findUserBy($args);
        $id = $user->getService()->getId();
        $service = $this->container->get('resolver.service')->findService($id);
        $folders = $service->getFolders();
        return array_map(function(Folder $folder){return FolderType::toArray($folder);}, $folders->getValues());
    }

    public function getType(){
        return new ListType(new FolderType());
    }

    public function getName(){
        return 'foldersFromUsername';
    }

    public function getDescription(){
        return 'Return folders from a username';
    }

}