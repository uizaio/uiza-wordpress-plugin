# Uiza
----
## Introduction
This is documents the public API for Uiza version 4.0.
The Uiza API is organized around RESTful standard.
Our API has predictable, resource-oriented URLs, and uses HTTP response codes to indicate API errors.
JSON is returned by all API responses, including errors, although our API libraries convert responses to appropriate language-specific objects.

----
## Requirements
PHP 5.3.0 and later.

----
## Installation
You can install the bindings via Composer. Run the following command:

````
composer require uiza/uiza-php
````

----

## Usage
The library needs to be configured with your account's `appId` and `authorization` (API key).\

See details [here](http://dev-ap-southeast-1-api.uizadev.io/docs/).

## Getting Started

### Require library.

````
require __DIR__."/../vendor/autoload.php";
````

### Setup for your project

````
Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');
````

## Entity
These below APIs used to take action with your media files (we called Entity).

See details [here](https://github.com/uizaio/api-wrapper-php/blob/develop/doc/Entity.md).

## Category
Category has been splits into 4 types: `folder`, `playlist`, `tag` and `category`. These will make the management of entity more easier.

See details [here](https://github.com/uizaio/api-wrapper-php/blob/develop/doc/Category.md).

## Storage
You can add your storage (`FTP`, `AWS S3`) with UIZA.
After synced, you can select your content easier from your storage to [create entity](https://docs.uiza.io/v4/?php#create-entity).

See details [here](https://github.com/uizaio/api-wrapper-php/blob/develop/doc/Storage.md).

## Live Streaming
These APIs used to create and manage live streaming event.
* When a Live is not start : it's named as `Event`.
* When have an Event , you can start it : it's named as `Feed`.

See details [here](https://github.com/uizaio/api-wrapper-php/blob/develop/doc/Live.md).

## Callback

Callback used to retrieve an information for Uiza to your server, so you can have a trigger notice about an entity is upload completed and .

See details [here](https://github.com/uizaio/api-wrapper-php/blob/develop/doc/Callback.md).

## User Management
You can manage user with APIs user.

See details [here](https://github.com/uizaio/api-wrapper-php/blob/develop/doc/User.md).
