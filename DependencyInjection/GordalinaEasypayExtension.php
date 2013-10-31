<?php

/*
 * This file is part of the EasypayBundle package.
 *
 * (c) Samuel Gordalina <https://github.com/gordalina/EasypayBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gordalina\Bundle\EasypayBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class GordalinaEasypayExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration($container->getParameter('kernel.debug'));
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('gordalina.easypay.config.user', $config['user']);
        $container->setParameter('gordalina.easypay.config.entity', $config['entity']);
        $container->setParameter('gordalina.easypay.config.cin', $config['cin']);
        $container->setParameter('gordalina.easypay.config.language', $config['language']);
        $container->setParameter('gordalina.easypay.config.country', $config['country']);
        $container->setParameter('gordalina.easypay.client.sandbox', $config['sandbox']);
    }
}
