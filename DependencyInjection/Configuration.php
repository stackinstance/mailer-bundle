<?php

<<<<<<< HEAD
namespace StackInstance\MailerBundle\DependencyInjection;
=======
/*
 * This file is part of the Api server bundle from Stack Instance.
 *
 * (c) 2016 Ray Kootstra
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StackInstance\ApiServerBundle\DependencyInjection;
>>>>>>> c6f2158958aa3a4baf49bc57b8c1b2cc46118e9f

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
<<<<<<< HEAD
        $rootNode = $treeBuilder->root('stack_instance_mailer');
=======
        $rootNode = $treeBuilder->root('stack_instance_api_server');
>>>>>>> c6f2158958aa3a4baf49bc57b8c1b2cc46118e9f

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
