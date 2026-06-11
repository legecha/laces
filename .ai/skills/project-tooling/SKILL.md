---
name: project-tooling
description: Project-specific command and tooling workflow for this Laravel application. Use when running or choosing Composer scripts, npm scripts, formatting, Rector, Duster, PHPStan, Larastan, Pest type coverage, Pest tests, browser tests, or final validation commands. Also use when deciding whether to run direct tools such as Pint, Pest, PHPStan, Rector, Prettier, or Artisan test commands.
---

# Project Tooling

Use this skill whenever a task involves running, recommending, or choosing project commands.

The project defines wrapper scripts in `composer.json` and `package.json`. These wrapper commands are authoritative and must be preferred over underlying tools unless there is a specific reason to bypass them.

## Command Precedence

- Prefer project wrapper commands over direct tool commands.
- Do not run direct tools such as Pint, Pest, PHPStan, Rector, Prettier, or `php artisan test` when a project wrapper command exists.
- Direct tool commands may be used only when:
  - Running a single filtered test.
  - Passing custom CLI arguments unsupported by the wrapper command.
  - Debugging the underlying tool directly.
  - The user explicitly requests the direct tool.
- When generic Laravel or Boost guidance conflicts with these commands, use the project commands from this skill.

## Formatting and Fixing

Use these commands when modifying code formatting or applying automated fixes.

- `composer code:style`
  - Runs Duster.
  - Duster internally runs TLint, PHP_CodeSniffer, PHP CS Fixer, and Pint.
  - Prefer this instead of running Pint or the underlying formatters directly.

- `composer code:upgrade`
  - Runs Rector to modernise and upgrade PHP code.

- `npm run code:fix`
  - Runs Prettier to format frontend resources within the `resources` directory.

- `composer fix`
  - Runs the full project formatting/fixing workflow:
    - `composer code:style`
    - `composer code:upgrade`
    - `npm run code:fix`

## Checking and Analysis

Use these commands when checking code without modifying it.

- `composer code:style:check`
  - Runs Duster in lint/check mode.
  - Prefer this instead of Pint check mode.

- `composer code:upgrade:check`
  - Runs Rector in dry-run mode.

- `composer code:type-analysis`
  - Runs PHPStan with Larastan.

- `composer code:type-coverage`
  - Runs Pest type coverage checks.

- `npm run code:check`
  - Runs Prettier in check mode for frontend resources within the `resources` directory.

## Testing

- `composer test:unit`
  - Runs Pest in parallel with coverage enabled.
  - Runs the project's unit, feature, and browser tests.
  - Prefer this instead of calling Pest directly or using `php artisan test`.

Use direct Pest commands only when filtering or passing custom flags is required.

## Full Validation

- `composer test`
  - Clears the Laravel config cache.
  - Runs:
    - `composer code:style:check`
    - `composer code:upgrade:check`
    - `composer code:type-analysis`
    - `composer code:type-coverage`
    - `composer test:unit`
    - `npm run code:check`

- `composer prep`
  - Runs:
    - `composer fix`
    - `composer test`
  - Use this as the preferred final validation step after code is written or modified.

## Practical Usage

- After small targeted code edits, run the narrowest relevant wrapper command first.
- After meaningful implementation work, prefer `composer prep` as the final validation command.
- If `composer prep` is too broad for the immediate task, use the most specific wrapper command that validates the changed area.
- Do not mark work complete if relevant project checks are failing.
- If a tool failure is unrelated to the current change, report it clearly rather than hiding or bypassing it.