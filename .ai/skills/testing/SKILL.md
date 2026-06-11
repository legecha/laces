---
name: testing
description: Pest, smoke test, browser test, Livewire test, feature test, architecture test, and validation workflow conventions for this Laravel application. Use when creating, modifying, running, or reviewing tests, deciding test coverage, verifying implementation completeness, or choosing between unit, feature, browser, smoke, Livewire, or architecture tests.
---

# Testing

Use this skill whenever adding, updating, running, or reviewing tests.

This project treats tests as part of the implementation. New behaviour should include appropriate tests, and important user-facing flows should include smoke coverage.

## Core Rules

- Use Pest for tests.
- Write tests alongside implementation work.
- Do not leave new behaviour untested unless explicitly requested.
- Prefer clear behaviour-focused tests over tests coupled to implementation details.
- Use Laravel and Livewire testing helpers where appropriate.
- Use factories for test data.
- Keep tests deterministic and parallel-safe.
- Do not weaken, remove, or bypass existing tests unless explicitly requested.

## Test Types

Use the most appropriate test type for the behaviour being implemented.

- Unit tests for isolated logic, value objects, DTO behaviour, scoring, and pure calculations.
- Feature tests for application workflows, persistence, authorization, validation, and HTTP-level behaviour.
- Livewire tests for component rendering, state, validation, Action invocation, and user interaction.
- Browser tests for JavaScript behaviour, end-to-end flows, and UI behaviour that cannot be confidently tested with normal feature or Livewire tests.
- Smoke tests for important pages, flows, and application entry points.
- Architecture tests for structural and quality constraints.

## Smoke Tests

- New application features should include smoke tests alongside their primary test coverage where appropriate.
- Smoke tests should verify that important pages, flows, or entry points load and function successfully at a high level.
- Smoke tests complement, but do not replace, unit, feature, Livewire, browser, or architecture tests.
- Keep smoke tests lightweight and focused on confidence-critical behaviour.

## Livewire Tests

- Livewire functionality must be covered with Livewire-aware Pest tests.
- Test important component rendering, validation, authorization, Action invocation, state transitions, redirects, and user flows.
- Prefer Livewire test helpers over manually constructing component internals.
- Test browser-only or JavaScript-heavy behaviour with browser tests when Livewire tests cannot cover it confidently.

## Browser Tests

- Add browser tests where browser behaviour, JavaScript interaction, or end-to-end user confidence requires them.
- Use browser tests for flows involving meaningful client-side behaviour, Alpine.js, Livewire JavaScript integration, sorting, optimistic updates, or complex UI interaction.
- Avoid browser tests for behaviour that can be tested faster and more reliably with unit, feature, or Livewire tests.

## Validation and Boundaries

- Validation behaviour must be tested for required inputs, invalid inputs, and boundary values.
- Validation rules should include both minimum and maximum constraints where applicable.
- Tests should cover realistic failure cases, not only happy paths.
- Authorization-sensitive behaviour must have authorization tests.

## Actions and Database Writes

- Actions that perform database writes must have tests for successful execution and failure behaviour.
- Where an Action performs multiple writes or coordinates other Actions, tests must verify rollback behaviour.
- Tests should verify important events or broadcasts after successful state changes.
- Tests should avoid asserting hidden database cascade behaviour because destructive relationship changes should be explicit in application code.

## Test Ordering

Tests should follow a logical flow:

1. Smoke tests
2. Happy-path tests
3. Validation tests
4. Authorization tests
5. Edge cases
6. Failure scenarios
7. Regression tests

Related tests should be grouped together and named consistently.

## Running Tests

Use the project tooling skill for commands.

- Prefer `composer test:unit` over direct Pest or `php artisan test` for the main test suite.
- Use direct Pest commands only when filtering or passing custom flags is required.
- Prefer `composer test` or `composer prep` when validating a broader change.

Do not mark implementation complete while relevant tests or validation commands are failing.