Page module for Yii2 with slug
==============================
Page module for Yii2 with slug

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```sh
php composer.phar require --prefer-dist uraankhayayaal/yii2-page "*"
```

or add

```
"uraankhayayaal/yii2-page": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply add in your console config:

```php
'controllerMap' => [
    /* ... */
    'migrate' => [
            // 'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                // '@console/migrations', // yii migrate/create app_init
                // '@yii/rbac/migrations',
                /* ... */
                '@uraankhayayaal/page/migrations', // yii migrate/create add_some_table --migrationPath=@uraankhayayaal/page/migrations
            ],
    ],
],
```

And just run the command:
```sh
php yii migrate
```

Set in common config params:

```php
return [
    /* ... */
    'domain' => 'https://yourdomain.example',
];
```

Add urls in your backend project:

```php
Url::toRoute('/page/back/index');
```

Add RBAC roles:

```
page
```

Custom view file:

```php
'custom_view_for_modules' => [
    'page_front' => [
        'view' => '@frontend/views/front_page/view',
    ],
],
```

Add fixtures:

```sh
php yii fixture PageMenuItem --namespace='uraankhayayaal\page\tests\fixtures' --interactive=0
php yii fixture PageBlockChart --namespace='uraankhayayaal\page\tests\fixtures' --interactive=0
php yii fixture PageBlock --namespace='uraankhayayaal\page\tests\fixtures' --interactive=0
```