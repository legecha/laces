---
name: actions-and-dtos
description: Action pattern, DTO, value object, enum, transaction, event, and domain workflow conventions for this Laravel application. Use when creating or modifying Actions, DTOs, value objects, enums, business logic, application workflows, state changes, transaction boundaries, event dispatching, or return types from domain operations.
---

# Actions and DTOs

Use this skill whenever implementing business logic, domain workflows, Actions, DTOs, value objects, enums, transactions, or event-driven side effects.

This project favours explicit workflows, immutable data, DTO return types, transactions around writes, and reusable context-agnostic Actions.

## Actions

- Use the Action pattern for domain logic and meaningful state changes.
- Actions live under `App\Actions`.
- Actions expose a single public `handle()` method.
- Actions should be reusable and context-agnostic.
- Controllers, Livewire components, commands, jobs, and listeners should delegate meaningful business logic to Actions.
- Prefer composing existing Actions over duplicating logic.
- Actions return DTOs by default.
- Actions performing database writes must wrap their contents in a database transaction.
- Successful state-changing Actions must broadcast concrete events after the database transaction has committed.
- Actions that perform database writes must have tests for successful execution and failure behaviour.
- Where an Action performs multiple writes or coordinates other Actions, tests must verify rollback behaviour.

## Action Naming

- Prefer REST-aligned Action names using `Create`, `Update`, and `Delete`.
- Prefer modelling intent through resource state.
- Prefer state/resource-based naming such as `CreatePublishedPost` over domain-verb naming such as `PublishPost`.
- Avoid domain verbs such as `Publish`, `Approve`, or `Assign` unless the REST-aligned name would be significantly less clear.

## Transactions and Side Effects

- Wrap multi-step writes in transactions.
- Keep database mutations and side effects clearly ordered.
- Do not dispatch events or broadcasts inside an uncommitted transaction when the side effect depends on committed data.
- Broadcast or dispatch state-change events after successful persistence.
- Delete related records explicitly, in the correct order, inside Actions.
- Avoid hiding destructive behaviour in model events, observers, database cascades, or implicit side effects.

## Events and Listeners

- Prefer events and listeners for decoupled side effects.
- Events should represent concrete domain or application events.
- Listeners should handle side effects that do not belong directly inside the initiating Action.
- Keep events focused on what happened, not what should happen next.
- Keep listeners focused on one side effect or responsibility where practical.

## DTOs

- DTOs live under `App\DataTransferObjects`.
- DTO class names and filenames must use the `Dto` suffix.
- DTOs must be `final readonly`.
- DTOs must use constructor property promotion.
- DTOs must be valid immediately after construction.
- Invalid or incomplete DTO state is not allowed.
- DTOs should not contain Eloquent models.
- DTOs may contain:
  - Scalars
  - Enums
  - Value objects
  - Other DTOs
  - Arrays of scalars, enums, value objects, or DTOs
- DTOs should be serialization-safe where practical and avoid framework-specific runtime state.
- DTOs should be used as return types from Actions by default.
- Static helper constructors such as `fromModel()` or `fromArray()` are acceptable when they improve clarity.

## Value Objects

- Use value objects for meaningful domain concepts with invariants.
- Value objects must be immutable.
- Value objects should be `final readonly` where possible.
- Value objects must validate their own invariants during construction.
- Invalid value object state must fail immediately using an exception.
- Prefer value objects over loose primitive values when the concept has domain meaning.

## Enums

- Use native PHP enums for constrained states.
- Prefer string-backed enums for persisted model state.
- Prefer enums over string constants or arbitrary string values.
- Enum values should represent stable domain states or options.
- Do not use raw strings where an enum would make allowed values explicit.

## Data Flow

- Prefer explicit typed data structures over loosely shaped arrays in application logic.
- Associative arrays are acceptable at framework boundaries, configuration boundaries, and serialization boundaries.
- Do not pass loosely shaped arrays through domain or application logic when a DTO or value object would be clearer.
- Keep mapping between requests, models, DTOs, and Actions explicit.
- Mass assignment safety must come from validation, DTOs, Form Requests, Actions, and explicit data mapping.