---
name: code-quality
description: PHP, Laravel, static analysis, type coverage, docblock, validation, localisation, strict typing, modern PHP, final/readonly, and coding-standard conventions for this Laravel application. Use when writing, refactoring, reviewing, or validating PHP code, applying project coding standards, resolving static-analysis issues, adding validation, or deciding Laravel/native implementation approaches.
---

# Code Quality

Use this skill whenever writing, refactoring, reviewing, or validating PHP code.

This project has a strict PHP and Laravel quality bar. Prefer explicit, modern, statically analysable code that follows Laravel conventions and passes the project quality gates.

## PHP Standards

- Every PHP file must use `declare(strict_types=1);`.
- Use the latest supported PHP version features proactively.
- Prefer modern PHP 8.5+ language features and standard library improvements where appropriate.
- Use modern constructs such as:
  - Attributes
  - Pipe operator
  - Constructor property promotion
  - Readonly properties and classes
  - Enums
  - `match`
  - Nullsafe operator
  - First-class callables
  - Named arguments where clarity improves
  - Modern array and string helper functions
- Avoid legacy patterns when a modern native PHP alternative exists.
- Prefer native PHP functionality over custom helper implementations where appropriate.
- Classes should be `final` by default.
- Classes should be `readonly` by default where possible.
- Only omit `final` or `readonly` when there is a clear technical reason.
- Prefer `private` visibility unless wider visibility is required.
- Prefer constructor injection and immutable dependencies.
- Avoid mutable object state unless it is genuinely required.
- When a class cannot be `readonly`, keep mutable state minimal and explicit.
- Do not use the `@` error suppression operator.

## Laravel Standards

- Prefer Laravel-native helpers, abstractions, and framework conventions over custom implementations where appropriate.
- Prefer built-in Laravel features before introducing custom patterns or third-party packages.
- Use Laravel helpers and expressive APIs where they improve readability and consistency.
- Prefer framework-supported approaches for:
  - Validation
  - Authorization
  - Events
  - Queues
  - Caching
  - Collections
  - Pipelines
  - HTTP clients
  - Casting
  - Routing
  - Dependency injection
  - Configuration
  - Database interactions
- Avoid reinventing functionality already provided cleanly by Laravel.
- Prefer readability and framework consistency over overly clever abstractions.
- Custom abstractions should only be introduced when they provide clear architectural or domain value beyond Laravel's built-in capabilities.

## Static Analysis and Type Coverage

- 100% type coverage is mandatory.
- Larastan/PHPStan runs at maximum strictness.
- Generated code must satisfy the project's configured static analysis, type coverage, architecture, and formatting checks.
- Do not weaken quality gates, suppress analysis errors, or bypass project tooling unless explicitly requested.
- Resolve static-analysis issues by improving types, design, or code clarity rather than hiding errors.

## Docblocks and Comments

- Every class method and property must have a concise descriptive docblock.
- Docblocks must describe intent or behaviour.
- Docblocks must not duplicate native parameter or return types unless PHP cannot express the type accurately.
- Add type docblocks only for arrays, collections, generics, iterable shapes, and other types PHP cannot express precisely.
- Comments must be useful.
- Comments must start with a capital letter and end with a full stop.
- Avoid obvious comments that merely repeat the code.

## Validation

- Validation rules should define both minimum and maximum constraints where applicable, not just maximum constraints.
- This applies to:
  - Laravel validation
  - Form Requests
  - Livewire validation
  - DTO validation
  - Custom validators
- Avoid one-sided validation ranges when sensible minimum constraints exist.
- Validation should define realistic and explicit boundaries wherever practical.

## Localisation

- All user-facing text must be written so it can be localised later, using English as the default language.
- Do not hardcode user-facing strings directly into Blade, Livewire components, controllers, Actions, DTOs, notifications, emails, validation messages, exceptions, or tests.
- Use Laravel's translation helpers for user-facing strings.
- In Blade templates, wrap user-facing text with `__()`, such as `{{ __('Message here') }}`.
- Use translation placeholders for dynamic values rather than string concatenation.
- Keep translation strings clear, complete, and written in natural English.
- Internal-only class names, variable names, enum names, and technical identifiers do not need translation.
- Test assertions for user-facing text should use the same translated strings where practical.

## Model-Related Quality

Use the Eloquent models skill for detailed model and migration rules.

Always preserve these high-level model quality principles:

- Models should remain explicit and statically analysable.
- Model attributes should be represented with `@property-read` annotations.
- Model casts should be explicit.
- Models should avoid direct property mutation.
- Models should not define fillable or guarded configuration.
- Mass assignment safety must come from validation, DTOs, Form Requests, Actions, and explicit data mapping.

## Laravel Essentials

This project uses `nunomaduro/essentials` v1 with strict safety features enabled.

- Eloquent strict mode is enabled.
- Lazy loading should not be relied upon.
- Missing or silently discarded model attributes may throw exceptions.
- Carbon dates are immutable.
- HTTP requests are blocked during tests unless explicitly faked.
- Models are globally unguarded.
- Safety must come from validation, DTOs, Form Requests, and Actions rather than `$fillable`.
- Laravel URL helpers should always be used for generated URLs.