<?php
namespace Kix\ExceptionListenerExtension;

use Behat\Testwork\ServiceContainer\Extension as ExtensionInterface;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class ExceptionListenerExtension implements ExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__));
        $loader->load('services.xml');
    }

    /**
     * {@inheritDoc}
     */
    public function configure(ArrayNodeDefinition $builder)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getConfigKey()
    {
        return 'exception_listener';
    }

    /**
     * {@inheritDoc}
     */
    public function initialize(ExtensionManager $extensionManager)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $stepWrapperDefn = $container->getDefinition('kix.exception_listener.step_wrapper');

        $exceptionListeners = [];

        foreach ($container->findTaggedServiceIds('kix.exception_listener') as $id => $tags) {
            $exceptionListeners[] = new Reference($id);
        }

        $stepWrapperDefn->replaceArgument(2, $exceptionListeners);
    }

} 