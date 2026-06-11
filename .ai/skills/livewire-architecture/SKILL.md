---
name: livewire-architecture
description: Livewire-first architecture rules for this Laravel application. Use when creating or modifying Livewire components, pages, forms, FluxUI interfaces, Alpine.js behaviour, Livewire routing, loading states, islands, JavaScript integration, Blaze-compatible UI, or Livewire tests. Also use when deciding whether to use Livewire, controllers, Blade views, API endpoints, Alpine.js, or custom JavaScript.
---

# Livewire Architecture

Use this skill whenever implementing application UI, page flows, Livewire components, or frontend interaction.

This project is Livewire-first. Prefer Livewire for application UI and use modern Livewire patterns deliberately, while keeping the simplest recommended approach as the default.

## Core Approach

- Build application UI with Livewire by default.
- Prefer full-page Livewire components for pages and screens.
- Use modern Livewire routing and page conventions, such as `pages::`, `Route::livewire()`, and built-in layout components, where appropriate.
- Use Livewire's default conventions for generated structure, file locations, naming, and emojis unless there is a strong reason to customise them.
- Prefer single-file components by default.
- Split a component into separate files only when it has become too large, too complex, or materially clearer when separated.
- Prefer current Livewire patterns over older Livewire approaches.
- Do not introduce controllers, plain Blade page flows, API endpoints, or JavaScript-heavy approaches when Livewire is a better fit.

## Feature Selection

- Use modern Livewire features when they solve a real requirement around clarity, responsiveness, performance, or maintainability.
- Do not use advanced Livewire features merely because they exist.
- Prefer the simplest recommended Livewire approach that satisfies the requirement.
- Keep components easy to read, test, and reason about.
- Prefer Livewire features over custom implementations when Livewire already provides the behaviour cleanly.

## Components and State

- Use Livewire Forms where they improve structure, validation, or reuse.
- Use computed properties for derived state.
- Keep public properties intentional, minimal, and safe to expose to the browser.
- Use Livewire attributes where they are the modern and recommended approach.
- Use component composition where it improves clarity or isolates responsibility.
- Avoid large multi-purpose components with many unrelated modes.
- Delegate meaningful business logic to Actions rather than embedding it in components.

## Loading and Performance

- Use `@placeholder` for meaningful loading states.
- Prefer FluxUI skeleton components in placeholders so loading states mimic the final layout.
- Prefer realistic skeletons over generic loading spinners.
- Apply lazy loading at the component call site using the `lazy` attribute rather than defining laziness inside the component itself.
- Bundle initially visible or related lazy subcomponents when useful, such as with `:lazy.bundle`.
- Use client-side Livewire directives such as `wire:cloak`, `wire:show`, and `wire:text` where they avoid unnecessary round-trips and improve responsiveness.
- Avoid unnecessary Livewire requests when behaviour can be handled safely on the client.

## Islands

- Use islands when they improve architecture or performance.
- Consider islands for expensive, independently loading, independently updating, or isolated UI regions.
- Be aware of named islands, lazy islands, nested islands, appending to islands, and prepending to islands.
- Prefer a normal component or standard render flow when islands would add complexity without meaningful benefit.

## Sorting and Optimistic Updates

- Use `wire:sort` for sortable interfaces where appropriate.
- Use `#[Renderless]` for actions that should not trigger a component render.
- Use `#[Async]` for asynchronous or optimistic update patterns where appropriate.
- Keep optimistic UI simple, predictable, and testable.
- Do not use asynchronous or renderless behaviour where a normal request/render cycle is clearer and fast enough.

## JavaScript

- Prefer Alpine.js for lightweight client-side interactivity.
- Use custom JavaScript only when Livewire and Alpine.js cannot solve the requirement cleanly.
- When custom JavaScript is required, place component-specific JavaScript in a `<script></script>` block inside the Livewire single-file component by default.
- Keep component-specific JavaScript colocated with the component unless there is a strong architectural reason to extract it.
- Prefer Livewire's modern JavaScript integration features over external JavaScript files where practical.
- Be aware of Livewire JavaScript features such as `wire:ref`, `this.$refs`, `this.$dirty`, `#[Json]` methods, `@assets`, `this.$js`, `wire:click="$js..."`, `$this->js()`, `this.intercept()`, `interceptMessage()`, and `interceptRequest()`.
- Use deep JavaScript interception APIs only for genuinely advanced integrations or behaviour that cannot be expressed more simply.

## FluxUI and Styling

- Use FluxUI Pro components before creating custom UI elements.
- Use TailwindCSS for remaining styling and layout.
- Keep UI structure consistent with existing FluxUI and Tailwind conventions.
- Do not introduce additional frontend frameworks such as Vue, React, or Stimulus.

## Blaze

- This project uses Blaze.
- FluxUI already uses Blaze-aware patterns automatically.
- Custom Blade and Livewire UI created for this project should use Blaze-compatible patterns by default.
- Avoid custom patterns that unnecessarily undermine Blaze optimisation.
- Only avoid Blaze-compatible approaches when there is an important reason.

## Localisation

- All user-facing text must be localisable, using English as the default language.
- In Blade and Livewire templates, wrap user-facing text with `__()`, such as `{{ __('Message here') }}`.
- Use translation placeholders for dynamic values rather than string concatenation.

## Testing

- Livewire functionality must be covered with Livewire-aware Pest tests.
- Test important component rendering, validation, authorization, Action invocation, and user flows.
- Include smoke tests for important Livewire pages and flows.
- Add browser tests where browser behaviour, JavaScript interaction, or end-to-end user confidence requires them.