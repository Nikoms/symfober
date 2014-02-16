<?php
/**
 * Created by PhpStorm.
 * User: Nikoms
 * Date: 16/02/14
 * Time: 15:57
 */

namespace Acme\DemoBundle\DataFixtures\ORM;


use Acme\DemoBundle\Entity\Post;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPostData implements FixtureInterface{


    function load(ObjectManager $manager)
    {
        $post = new Post();
        $post->setTitle('First post (title)');
        $post->setBody('First post (body)');
        $manager->persist($post);

        $post = new Post();
        $post->setTitle('Deuxieme post (title)');
        $post->setBody('Deuxieme post (body)');
        $manager->persist($post);

        $manager->flush();
    }


} 