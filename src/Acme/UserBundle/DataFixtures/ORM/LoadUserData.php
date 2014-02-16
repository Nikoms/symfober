<?php
/**
 * Created by PhpStorm.
 * User: Nikoms
 * Date: 16/02/14
 * Time: 15:57
 */

namespace Acme\UserBundle\DataFixtures\ORM;


use Acme\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface{


    function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setUsername('admin');
        $user->setPlainPassword('adminpass');
        $user->setEmail('nikoms@gmail.com');
        $user->setEnabled(true);
        $user->addRole(User::ROLE_SUPER_ADMIN);
        $manager->persist($user);

        $user = new User();
        $user->setUsername('user');
        $user->setPlainPassword('userpass');
        $user->setEmail('nicolas@deboose.com');
        $user->setEnabled(true);
        $manager->persist($user);


        $manager->flush();
    }


} 