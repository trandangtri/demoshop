<?php

use Spryker\Shared\Application\ApplicationConstants;

// Database
$config[ApplicationConstants::ZED_DB_USERNAME] = 'kdumamjalnknwk';
$config[ApplicationConstants::ZED_DB_PASSWORD] = '7pP7rEr-uBGPTJ23lHi-IoAcGe';
$config[ApplicationConstants::ZED_DB_DATABASE] = 'da4uqoq5tihuan';
$config[ApplicationConstants::ZED_DB_HOST]     = 'ec2-54-228-219-2.eu-west-1.compute.amazonaws.com';
$config[ApplicationConstants::ZED_DB_PORT]     = 5432;

// ElasticSearch
$config[ApplicationConstants::ELASTICA_PARAMETER__HOST]          = 'wdbqrzli:7p3ly67yefi7qanc@redwood-118570.eu-west-1.bonsai.io';
$config[ApplicationConstants::ELASTICA_PARAMETER__TRANSPORT]     = 'https';
$config[ApplicationConstants::ELASTICA_PARAMETER__PORT]          = '80';
$config[ApplicationConstants::ELASTICA_PARAMETER__INDEX_NAME]    = 'de_development_catalog';
$config[ApplicationConstants::ELASTICA_PARAMETER__DOCUMENT_TYPE] = 'page';

// Redis
$config[ApplicationConstants::YVES_STORAGE_SESSION_REDIS_PROTOCOL] = $config[ApplicationConstants::ZED_STORAGE_SESSION_REDIS_PROTOCOL] = 'redis';
$config[ApplicationConstants::YVES_STORAGE_SESSION_REDIS_HOST]     = $config[ApplicationConstants::ZED_STORAGE_SESSION_REDIS_HOST] = 'pub-redis-12403.eu-west-1-2.2.ec2.garantiadata.com';
$config[ApplicationConstants::YVES_STORAGE_SESSION_REDIS_PORT]     = $config[ApplicationConstants::ZED_STORAGE_SESSION_REDIS_PORT] = '12403';
$config[ApplicationConstants::YVES_STORAGE_SESSION_REDIS_PASSWORD] = $config[ApplicationConstants::ZED_STORAGE_SESSION_REDIS_PASSWORD] = '7R8DjE27mrP0f4Rq';
$config[ApplicationConstants::YVES_STORAGE_SESSION_REDIS_USERNAME] = $config[ApplicationConstants::ZED_STORAGE_SESSION_REDIS_USERNAME] = 'rediscloud';

// Jenkins
// ...

// Host
$yvesHost                                                 = 'spryker-demo.herokuapp.com';
$config[ApplicationConstants::YVES_SESSION_COOKIE_DOMAIN] = $yvesHost;
$config[ApplicationConstants::HOST_YVES]                  = 'http://' . $yvesHost;
$config[ApplicationConstants::HOST_STATIC_ASSETS]         = $config[ApplicationConstants::HOST_STATIC_MEDIA] = $yvesHost;

$config[ApplicationConstants::HOST_SSL_YVES]          = 'https://' . $yvesHost;
$config[ApplicationConstants::HOST_SSL_STATIC_ASSETS] = $config[ApplicationConstants::HOST_SSL_STATIC_MEDIA] = $yvesHost;

// Misc
$config[ApplicationConstants::ENABLE_WEB_PROFILER]  = false;
$config[ApplicationConstants::SHOW_SYMFONY_TOOLBAR] = false;