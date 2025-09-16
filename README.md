# Laces

> The Laces starter kit — an opinionated set of improvements to the [official Laravel starter kit for Livewire](https://github.com/laravel/livewire-starter-kit).

## Why?

Because I kept creating this at the start of every new project, so I decided to make it easier for mysql. If anyone else finds it useful, great :)

## Features

This starter kit uses the official Livewire starter kit as a base, and improves it with the following strongly opinionated changes:

- Enforces PHP `strict_types` throughout
- Adds `APP_TIMEZONE` support to `.env`
- Uses class-based Livewire by default
- Enhances Pest testing setup
- Sets strong password defaults
- Removes GitHub workflows
- Installs Flux UI Pro
- Improves views to allow guests and replace static welcome page
- Installs Duster (providing `composer fix` and `composer lint`)
- Installs Prettier with Blade and Tailwind CSS support (providing `npm run format`)

## Maintenance

**The creation of this starter kit is now mostly automated by the [laces-cli](https://github.com/legecha/laces-cli) project.**

Whenever a new Laravel or Livewire starter kit version is released, this starter kit will update automatically.

As with all starter kits, after you include it during installation, the code is then yours — you won’t be pulling in
updates or wondering what best practices to use — change, fix, shout at and laugh at everything as you see fit.

## Installation

This starter kit is made to be used with the most recent Laravel and Livewire Starter Kit versions.

`laravel new --using=legecha/laces`

## Requests

I'm more than happy to consider changes to this starter kit, but remember it's pretty opinionated! You may be better
forking it and coming up with your own version if there are drastic differences.

It's best to send pull requests to the [laces-cli](https://github.com/legecha/laces-cli) tool because this starter kit
is automatically generated from there.
