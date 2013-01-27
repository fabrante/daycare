<?php
return array(
    'modules' => array(
        'Application',
        'Rest',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
    'module_manager_options' => array(
        'enable_config_cache'      => false,
        'cache_dir'                => realpath(__DIR__ . '/../data/cache'),
        'enable_dependency_check'  => false,
        'enable_auto_installation' => false,
        'manifest_dir'             => realpath(__DIR__ . '/../data'),
    ),
);
