<?php

namespace AppBundle\Resolver;

use AppBundle\Entity\User;
use AppBundle\Entity\Service;
use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Type\UserType;

class UserResolver extends AbstractResolver {

    public function add(string $username, string $password, string $email, int $serviceId){
        $lastUpdate = date("d-m-Y H:i:s");
        $roles = array(UserRoleEnum::ROLE_USER);
        $user = new User($username, $password, $email, $lastUpdate, $roles);
        $service = $this->container->get('resolver.service')->findService($serviceId);
        $service->addUser($user);
        $this->persist($user);
        return $user;
    }

    public function addFirstAdmin(string $username, string $password, string $serviceName){
        $lastUpdate = date("d-m-Y H:i:s");
        $email = '';
        $roles = array(UserRoleEnum::ROLE_ADMIN);
        $user = new User($username, $password, $email, $lastUpdate, $roles);
        $service = $this->container->get('resolver.service')->add($serviceName);
        $service->addUser($user);
        $this->persist($user);
        return $user;
    }

    public function update(User $user, string $username, string $password, string $email, array $roles, int $serviceId){
        /** Changing username of all questions stocked by this user */
        $formerUsername = $user->getUsername();
        $questionLibraries = $this->container->get('resolver.questionLibrary')->findQuestionLibraries();
        foreach($questionLibraries as $questionLibrary){
            if($questionLibrary->getUsername() === $formerUsername){
                $this->container->get('resolver.questionLibrary')->update($questionLibrary, $username);
            }
        }

        $user->setLastUpdate(date("d-m-Y H:i:s"));
        $user->setUsername($username);
        if(!empty($password)){
            $user->setPlainPassword($password);
        }
        $user->setEmail($email);
        $user->setRoles($roles);
        $user->getService()->removeUser($user);
        $service = $this->container->get('resolver.service')->findService($serviceId);
        $service->addUser($user);
        $this->flush();
        return $user;
    }

    public function delete(User $user) {
        /** Removing all questions stocked by this user */
        $username = $user->getUsername();
        $questionLibraries = $this->container->get('resolver.questionLibrary')->findQuestionLibraries();
        foreach($questionLibraries as $questionLibrary){
            if($questionLibrary->getUsername() === $username){
                $this->container->get('resolver.questionLibrary')->delete($questionLibrary);
            }
        }

        $user->getService()->removeUser($user);
        $id = $user->getId();
        $this->remove($user);
        return $id;
    }

    public function findUsers(){
        return $this->findAll('User');
    }

    public function findTokenUser(){
        return $this->findUserBy(['username' => $this->getTokenUsername()]);
    }

    public function findUser(int $id){
        return $this->findOneBy('User', ['id' => $id]);
    }

    public function findUserBy(array $arr){
        return $this->findOneBy('User', $arr);
    }

    public function filterNonAdmins(array $users){
        return array_filter($users, function ($user) {
            return !in_array(UserRoleEnum::ROLE_ADMIN, $user->getRoles());
        });
    }

    public function isAdmin(User $user){
        return in_array('ROLE_ADMIN', $user->getRoles());
    }
}
