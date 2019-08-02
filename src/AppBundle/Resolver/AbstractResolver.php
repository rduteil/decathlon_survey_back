<?php

namespace AppBundle\Resolver;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class AbstractResolver {

    /** @var  EntityManagerInterface */
    public $em;

    /** @var Container */
    public $container;

    /** @var  TokenStorageInterface */
    public $tokenStorage;

    public function __construct(Container $container, TokenStorageInterface $tokenStorage){
        $this->container = $container;
        $this->tokenStorage = $tokenStorage;
    }

    public function init(EntityManagerInterface $em) {
        $this->em = $em;
    }

    protected function createNotFoundException($message = 'Not found exception') {
        return new \Exception($message, 404);
    }

    protected function createInvalidParamsException($message = 'Invalid params exception') {
        return new \Exception($message, 400);
    }

    protected function createAccessDeniedException($message = 'Access denied exception') {
        return new \Exception($message, 403);
    }

    public function getTokenUsername(){
        $token = $this->tokenStorage->getToken();
        if (!$token instanceof TokenInterface) {
            throw $this->createAccessDeniedException();
        }
        /** @var User $user */
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            throw $this->createAccessDeniedException();
        }
        return $user->getUsername();
    }

    public function findOneBy(string $entity, array $arr) {
        $found = $this->em->getRepository('AppBundle:'.$entity)->findOneBy($arr);
        if (!$found) {
            throw $this->createNotFoundException($entity.' not found');
        }
        return $found;
    }

    public function findAll(string $entity) {
        return $this->em->getRepository('AppBundle:'.$entity)->findBy(array());
    }

    public function remove($entity) {
        $this->em->remove($entity);
        $this->em->flush();
    }

    public function persist($entity) {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function flush() {
        $this->em->flush();
    }
}