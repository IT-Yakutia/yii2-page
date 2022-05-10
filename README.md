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
```json lines
"uraankhayayaal/yii2-page" : "*"
```
to the require section of your `composer.json` file.

Add Module in backend config `main.php`:
```php
return [
    ...
    'modules' => [
        ...
        'page' => \uraankhayayaal\page\Module::class,
        ...
    ],
    ...
];
```

In console config `main.php` add `migrationPath` value in `controllerMap` `migration` section:
```php
return [
    ...
    'controllerMap' => [
        ...
	    'migrate' => [
		    'class' => \yii\console\controllers\MigrateController::class,
		    'migrationPath' => [
				'@console/migrations',
				...
			    '@uraankhayayaal/page/migrations',
			    ...
		    ],
	    ],
    ],
```
And just run the command:
```sh
php yii migrate
```

Add in common `main.php`:
```php
return [
    ...
    'domain' => 'https://yourdomain.example',
    ...
];
```


Usage
-----



Add urls in your backend project:

```php
Url::toRoute('/page/back/index');
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
php yii fixture PageMenuItem --namespace='uraankhayayaal\page\tests\fixtures'
```
```sh
php yii fixture PageBlockChart --namespace='uraankhayayaal\page\tests\fixtures'
```
```sh
php yii fixture PageBlock --namespace='uraankhayayaal\page\tests\fixtures'
```

Add fixtures in docker:

```sh
php yii fixture PageMenuItem --namespace='uraankhayayaal\page\tests\fixtures' --interactive=0
```
```sh
php yii fixture PageBlockChart --namespace='uraankhayayaal\page\tests\fixtures' --interactive=0
```
```sh
php yii fixture PageBlock --namespace='uraankhayayaal\page\tests\fixtures' --interactive=0
```