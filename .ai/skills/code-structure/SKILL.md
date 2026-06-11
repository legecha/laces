

---
name: code-structure
description: Class, method, property, controller, model, Livewire component, DTO, value object, enum, and test ordering conventions for this Laravel application. Use when creating, reorganising, reviewing, or refactoring PHP classes, Livewire components, controllers, models, tests, methods, properties, or file structure.
---

# Code Structure

Use this skill whenever creating, reorganising, or reviewing code structure and element ordering.

Ordering of elements throughout the project is strict and should be followed consistently.

- Consistency is more important than personal preference.
- Existing project conventions should be followed where they already exist.
- When no explicit project convention exists, use widely accepted Laravel, Livewire, PHP, or PSR standards.
- Elements should first be grouped by their type or responsibility.
- Within a group, elements should be ordered alphabetically unless a more meaningful ordering rule exists.
- Avoid empty or unused code.
- Remove unused methods, properties, and stubs until they are genuinely needed.

## Controllers

Controllers should remain thin and primarily coordinate HTTP concerns.

Resource controller methods should appear in the same order as Laravel resource controller stubs:

1. `index`
2. `create`
3. `store`
4. `show`
5. `edit`
6. `update`
7. `destroy`

Additional methods should appear after the standard resource methods.

Unused resource methods should be removed rather than left empty.

## Models

Model members should appear in the following order:

1. Traits
2. Constants
3. Eloquent property overrides and configuration
   - `$table`
   - `$connection`
   - `$with`
   - Similar Eloquent configuration
4. Project-specific properties
5. Constructor
6. Eloquent method overrides
   - `casts()`
   - `getRouteKeyName()`
   - Query scopes
   - Similar framework overrides
7. Relationship methods
8. Attribute methods
9. Project-specific methods

Within each group, elements should be ordered alphabetically unless framework ordering is more meaningful.

## Livewire Components

Livewire components should follow the same structure throughout the project.

### Properties

1. `#[Locked]` properties
2. Private properties
3. Protected properties
4. Public properties

Within each group, properties should be ordered alphabetically.

### Computed Properties

5. Computed properties

### Lifecycle Hooks

Lifecycle hooks should appear in execution order:

6. Lifecycle hooks
   - `mount`
   - Trait lifecycle hooks
   - Property lifecycle hooks
   - `hydrate`
   - `boot`
   - `updating`
   - `updated`
   - `rendering`
   - `render`
   - `rendered`
   - `dehydrate`

### Behaviour

7. Actions
8. Event listeners
9. Validation methods and rules

### Helpers

10. Private helper methods
11. Protected helper methods

Within each section, methods should be ordered alphabetically unless lifecycle ordering requires otherwise.

## General PHP Classes

Classes that are not Models, Controllers, Livewire components, DTOs, Enums, or Value Objects should generally follow this structure:

1. Traits
2. Constants
3. Properties
   - Public
   - Protected
   - Private
4. Constructor
5. Public methods
6. Protected methods
7. Private methods

Within visibility groups, elements should be ordered alphabetically.

## DTOs and Value Objects

DTOs and Value Objects should generally follow this structure:

1. Properties
2. Constructor
3. Static constructors
   - `fromArray()`
   - `fromModel()`
   - Similar factory methods
4. Public methods
5. Private helper methods

Within each group, elements should be ordered alphabetically.

## Enums

Enums should generally follow this structure:

1. Cases
2. Public methods
3. Private helper methods

Enum cases should be ordered alphabetically unless domain lifecycle ordering is clearer.

## Tests

Tests should follow a logical flow:

1. Smoke tests
2. Happy-path tests
3. Validation tests
4. Authorization tests
5. Edge cases
6. Failure scenarios
7. Regression tests

Related tests should be grouped together and named consistently.

Regression tests may be placed next to the behaviour they protect when that improves readability.