## Laravel Laces

> An opinionated custom start kit for Laravel projects, building on the official Laravel starter kit with Livewire and Flux UI

This repository is an alternative starting point to the [Laravel starter kit]([url](https://github.com/laravel/livewire-starter-kit)) that uses Livewire with Flux UI. This is a great starting point, but I was bored of performing the same actions when starting new projects so decided to create this custom starter kit, and now offer it to anyone else who might find it useful.

**The goal for this custom starter kit is to be an up-to-date version of the offical starter kit with the below enhancements.**

Check out the [To Do](#to-do) section to see my plans for this project, including automating the changes programatically instead of manually.

### Features

- Uses Livewire with clases, *not* Volt
- Uses Pest for testing
- Removes GitHub workflows
- Adds `APP_TIMEZONE` to app config
- Declare `strict_types` on *all* PHP files
- Use `RefreshDatabase` trait for both `Unit` and `Feature` tests
  - And create `unit` and `feature` testing groups respectively
- Installs [Tighten Duster]([url](https://github.com/tighten/duster))
  - Adds `declare_strict_types` PHP CS Fixer Rule
  - Adds Composer `fix` and `lint` commands to call Duster
- Installs Prettier with Tailwind and Blade support
  - Adds NPM `format` command to call prettier
- Adds Flux UI Pro
- Enforce better password defaults (minimum 10 chars, mixed case, symbols and numbers)
  - Update all tests and user seeder to reflect this
- Update app layout to allow guests
- Remove Laravel welcome page and use app layout for homepage

### Installation

Create a new project using this repos as your starter kit:

```
laravel new my-app --using=legecha/laces
```

- Add `APP_TIMEZONE` to your 
- [Setup Flux UI Pro]([url](https://fluxui.dev/dashboard))

### To Do

- Create scripts to automate the conversion of a standard starter kit to a release candidate with all the [features](#features) set up and ready to go.

### Contribute

As I said, this is a fairly opinionated set of changes to an official starter kit, but (in my opinion :D) they are in alignment with cool and clever people who've contributed ideas and standards to Laravel in the past, that become popular official features. So with that in mind, I certainly welcome your opinion, ideas and pull requests!
