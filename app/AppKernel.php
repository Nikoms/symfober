<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new \Acme\UserBundle\AcmeUserBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new \FOS\RestBundle\FOSRestBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new \Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),


            // Add your dependencies
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\NotificationBundle\SonataNotificationBundle(),
            //...

            // If you haven't already, add the storage bundle
            // This example uses SonataDoctrineORMAdmin but
            // it works the same with the alternatives
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),

            new Sonata\PageBundle\SonataPageBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),

            // Then add SonataAdminBundle
            new Sonata\AdminBundle\SonataAdminBundle(),

            //Sonata Admin

            new Sonata\CacheBundle\SonataCacheBundle(),
            new Sonata\SeoBundle\SonataSeoBundle(),
            new Application\Sonata\PageBundle\ApplicationSonataPageBundle(),
            new Acme\DemoBundle\AcmeDemoBundle(),

        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
