<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _init_autoloader()
    {
        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
            'basePath'  => APPLICATION_PATH,
            'namespace' => '',
        ));
        $resourceLoader->addResourceType('my', 'my/', 'my');
    }
}
    