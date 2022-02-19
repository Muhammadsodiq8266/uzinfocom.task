<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    'dsn' => 'pgsql:host=localhost;port=5432;dbname=uzinfo_github',
    'username' => 'postgres',
    'password' => '123456',
    'charset' => 'utf8',
    'enableSchemaCache' => false,

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
