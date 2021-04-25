<h1 align="center">Managed constant models</h1>
Allow to declare constants with named attributes via separate class model

[![Latest Stable Version](https://poser.pugx.org/nick-denry/managed-constant-models/version)](https://packagist.org/packages/nick-denry/managed-constant-models) [![Total Downloads](https://poser.pugx.org/nick-denry/managed-constant-models/downloads)](https://packagist.org/packages/nick-denry/managed-constant-models) [![Latest Unstable Version](https://poser.pugx.org/nick-denry/managed-constant-models/v/unstable)](//packagist.org/packages/nick-denry/managed-constant-models) [![License](https://poser.pugx.org/nick-denry/managed-constant-models/license)](https://packagist.org/packages/nick-denry/managed-constant-models)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist nick-denry/managed-constant-models
```

or add

```
"nick-denry/managed-constant-models": "^0.1.0"
```

to the require section of your `composer.json` file.

Usage
-----


1. Create managed constats model

    ```php
    <?php

    namespace app\models;

    use nickdenry\managedConstants\interfaces\ManagedConstantInterface;
    use nickdenry\managedConstants\traits\ManagedConstantTrait;

    /**
    * TaskStatus constant model
    */
    class TaskStatus implements ManagedConstantInterface
    {

        use ManagedConstantTrait;

        const ACTIVE = 0;
        const DONE = 1;
        const _ATTRIBUTES = [
            self::ACTIVE => [
                'class' => 'task-active',
                'label' => 'Активна',
            ],
            self::DONE => [
                'class' => 'task-done',
                'label' => 'Завершена',
            ],
        ];

    }

    ```

2. Use it with your another model class, i.e. yii2 model


    ```php
    <?php

    namespace app\models;

    use app\models\TaskStatus;

    /**
    * This is the model class for table "task".
    *
    * @property int $id
    * @property string $title
    * @property int|null $created_at
    * @property int|null $updated_at
    */
    class Task extends BaseTimestampedModel extends \yii\db\ActiveRecord
    {
        ...
        /**
        * Get task statuses.
        */
        public static function getStatuses()
        {
            return TaskStatus::class;
        }
        ...

    }

-----

3. Get constatns with the code


    ```php
    <?php

    $constValue = Task::getStatuses()::ACTIVE; //$constValue = 0;

    Task::getStatuses()::ACTIVE; // ACTIVE constant;
    Task::getStatuses()::DONE; // DONE constant;
    Task::getStatuses()::constants(); // Returns array ['ACTIVE' => 0, 'DONE' => 1]
    Task::getStatuses()::values(); // Returns array [0, 1]
    Task::getStatuses()::listAttributes($constValue); // Returns array ['class' => 'task-active', 'label' => 'Активна']
    Task::getStatuses()::attribute($constValue, 'class'); // Returns 'task-active'

    Task::getStatuses()::getList(); 
    // Returns [
    //    ['id' => 0, 'class' => 'task-active', 'label' => 'Активна', ]
    //    ['id' => 0, 'class' => 'task-done', 'label' => 'Завершена', ],
    // ]

    ```
