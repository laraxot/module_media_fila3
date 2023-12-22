---
title: Spatie Actions
description: Spatie Actions
extends: _layouts.documentation
section: content
lang: it
id: 10
parent_id: 0
---

# Spatie Actions {#spatie-actions}

To make and use a spatie action, you will need to have a Laravel project with the Spatie package installed. If you do not have a Laravel project or the Spatie package installed, you can follow these steps:

1. Install the Spatie package by running the following command:

```php
composer require spatie/laravel-actions
```

2. Create a new action class by extending the Spatie\LaravelActions\Action class and implementing the execute method. For example:

```php
namespace \Module\ExampleModule\Actions;

use Spatie\LaravelActions\Action;

class ImportSomething extends Action
{
    public function execute(string $disk)
    {
        // Perform the user synchronization here
    }
}
```

3. Use the action in your Laravel project by creating an instance of the action class and calling the execute method. For example:

```php
use \Module\ExampleModule\Actions\ImportSomething;

// Create an instance of the action
$importAction = new ImportSomething();

// Execute the action
$importAction->execute('images');
```

4. If you want to schedule the action to run automatically at regular intervals, you can use Laravel's task scheduling system to set up a schedule for the action. For example:

```php
// Define the schedule in the app/Console/Kernel.php file
protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        (new ImportSomething())->execute('video');
    })->daily();
}
```