# Laces

> The Laces starter kit - an opinionated set of improvements to the [official Laravel starter kit for Livewire](https://github.com/laravel/livewire-starter-kit).

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
- Improve views to allow guests and replace static welcome page
- Installs Duster (providing `composer fix` and `composer lint`)
- Installs Prettier with Blade and Tailwind CSS support (providing `npm run format`)

## Maintenance

**The creation of this starter kit is now mostly automated by the [laces-cli](https://github.com/legecha/laces-cli) project.**

Whenever a new Laravel or Livewire starter kit version is released, this starter kit will update automatically.

As with all starter kits, once you use it, the code is yours — you won’t be updating or maintaining anything further.

## Installation

This starter kit is made to be used with the most recent Laravel version.

`laravel new --using=legecha/laces`

## Requests

I'm happy to take pull requests for changes, but remember this is an opinionated starter kit. You are also welcome to
send pull requests to the [laces-cli](https://github.com/legecha/laces-cli) tool to provide non-default options or
customisations you may want for yourself, or to create your own starter packages.
