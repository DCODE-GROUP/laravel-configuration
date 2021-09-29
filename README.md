# Laravel Configuration

This package provides a central way to store Laravel configuration and settings.

## Installation

You can install the package via composer:

```bash
composer require dcodegroup/laravel-configuration
```

Then run the install command.

```bash
php artsian laravel-configuration:install
```

This will publish the migration file.

Run the migrations

```bash
php artsian migrate
```

## Usage

A model is made available `Dcodegroup\LaravelConfiguration\Models\Configuration.php` You can use this as is or extend it via your own model.

Basic usage is like any other laravel model

```bash

Configuration::create([
  'name' => 'xero_leave_types',
  'value' => $data
]);

```

There are poly morphic fields on the table so you may also make a polymorphic relations to the configurations table if needed.