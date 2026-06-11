---
name: eloquent-models
description: Eloquent model, migration, database, relationship, cast, UUID, and schema conventions for this Laravel application. Use when creating or modifying models, migrations, factories, seeders, relationships, casts, enums used by models, database constraints, deletion behaviour, or Eloquent persistence logic.
---

# Eloquent Models

Use this skill whenever creating or modifying Eloquent models, migrations, database schema, relationships, casts, factories, seeders, or model persistence behaviour.

This project favours explicit model structure, explicit persistence, UUID identifiers, strict static analysis, and application-managed behaviour over hidden database behaviour.

## Model Identity

- Application models should use UUID primary keys instead of auto-incrementing integer IDs.
- Prefer Laravel's `HasUuids` trait for UUID generation.
- Model primary keys should be represented as strings.
- UUID columns should be explicitly cast to `string`.
- Model `@property-read` annotations should reflect UUID string identifiers.
- Avoid integer-based auto-incrementing identifiers unless required by an external system or legacy constraint.

## Model Docblocks

- Every Eloquent model must define explicit `@property-read` annotations for all database-backed attributes.
- Model docblocks should accurately describe:
  - Scalar columns
  - Nullable columns
  - Casted attributes
  - Relationships where appropriate
  - Timestamp types
- Timestamp properties must use `CarbonImmutable`.
- Property annotations should align with the model casts.
- Use `@property-read` rather than mutable `@property` annotations to discourage direct property assignment.

## Casts

- Every Eloquent model must define explicit casts for all database-backed attributes where a meaningful cast exists.
- Use a `casts(): array` method rather than a `$casts` property.
- Cast definitions should be explicit even for commonly inferred scalar types.
- Timestamp columns must use `immutable_datetime` casts.
- UUID columns should be cast to `string`.
- Enum-backed columns should be cast to their enum classes.
- JSON columns should be cast explicitly to arrays, collections, DTO casts, value-object casts, or custom casts as appropriate.
- Cast definitions must align with `@property-read` annotations.

## Fillable and Guarded

- Models must not define fillable or guarded configuration.
- Do not use:
  - `#[Fillable]` attributes
  - `$fillable` properties
  - `fillable()` methods
  - `$guarded` properties
  - `guarded()` methods
- Models are globally unguarded.
- Mass assignment safety must come from validation, DTOs, Form Requests, Actions, and explicit data mapping.

## Persistence

- Do not mutate Eloquent models through direct property assignment followed by `save()`.
- Avoid patterns such as `$user->name = 'Leonard'; $user->save();`.
- Prefer explicit `create()` and `update()` calls for Eloquent changes.
- Keep persistence changes explicit, predictable, and friendly to Larastan/PHPStan.
- Business logic and meaningful state changes should be handled by Actions rather than being hidden inside models.

## Relationships

- Define clear Eloquent relationships for all model associations.
- Use precise relationship return types.
- Prefer explicit relationship names that reflect the domain.
- Avoid lazy-loading assumptions; eager load required relationships explicitly.
- Relationship methods should remain focused on relationship definition, not business logic.

## Migrations

- Keep schema normalised unless there is a clear reason not to.
- Use UUID primary keys for application tables.
- Add appropriate foreign keys, indexes, unique indexes, and constraints.
- Do not use database cascade behaviour.
- Do not use:
  - `cascadeOnDelete()`
  - `cascadeOnUpdate()`
  - `onDelete('cascade')`
  - `onUpdate('cascade')`
  - Equivalent raw cascade constraints
- Delete related records explicitly, in the correct order, inside Actions.
- Do not use soft deletes.
- Do not add `SoftDeletes` to models.
- Do not create `deleted_at` columns unless explicitly required by an external or legacy integration.
- Do not use database-level default values in migrations.
- Avoid `default()` in schema definitions.
- Defaults should be applied explicitly in application code, DTO construction, Actions, factories, or seeders.
- Migrations should include valid `down()` rollback behaviour where practical.
- Rollbacks should cleanly reverse schema changes.
- Avoid destructive or unsafe rollback behaviour.

## Enums and Model State

- Use string-backed enums for constrained model states.
- Cast enum columns to their enum classes.
- Avoid raw string state values where an enum would make allowed values explicit.
- Keep enum values stable and meaningful.

## Factories and Seeders

- Create factories for models that need test data.
- Use realistic fake data.
- Ensure factories can generate valid relationships.
- Use explicit default values in factories rather than migration defaults.
- Seeders should create complete, coherent example data when used for demos or local development.

## Laravel Essentials Assumptions

This project uses `nunomaduro/essentials` v1 with strict safety features enabled.

- Eloquent strict mode is enabled.
- Lazy loading should not be relied upon.
- Missing or silently discarded model attributes may throw exceptions.
- Carbon dates are immutable.
- HTTP requests are blocked during tests unless explicitly faked.