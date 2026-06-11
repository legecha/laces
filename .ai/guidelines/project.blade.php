# Project Guidelines

This project uses Laravel Boost with project-specific guidelines and skills. These project rules override generic Laravel, Boost, Copilot, or framework defaults where they conflict.

## Project Context

- This is a Laravel application using modern Laravel, Livewire, FluxUI Pro, TailwindCSS, Alpine.js, Blaze, Pest, Larastan, Rector, Duster, and Laravel Boost.
- Build the application as a Livewire-first full-stack Laravel app.
- Prefer Laravel-native features, helpers, conventions, and abstractions before creating custom implementations.
- Prefer explicit, modern, immutable, statically analysable PHP.
- Prefer simple recommended framework patterns before advanced techniques.
- Use advanced framework features only when they improve clarity, responsiveness, performance, maintainability, or correctness.

## Always-On Standards

- Follow the project skills whenever working in their area.
- Keep user-facing output localisable, with English as the default language.
- Use project wrapper commands rather than underlying tools directly.
- Do not weaken quality gates, bypass static analysis, or suppress tooling errors unless explicitly requested.
- Do not leave unused stubs, empty resource methods, or placeholder implementations.
- Prefer cohesive working implementations over partial fragments.

## Technology Direction

- Use Livewire for application UI by default.
- Use full-page Livewire components for pages and screens where appropriate.
- Use FluxUI Pro components before creating custom UI elements.
- Use TailwindCSS for remaining styling and layout.
- Use Alpine.js for lightweight client-side behaviour when it avoids unnecessary Livewire round-trips.
- Avoid adding Vue, React, Stimulus, or other frontend frameworks unless explicitly requested.

## Development Workflow

- Use Composer and npm scripts defined by this project.
- Run the project validation command after meaningful code changes.
- If a task touches a specific area, load and follow the matching project skill before implementing.

## Response Style

- Keep explanations concise and practical.
- Do not include lengthy explanations unless asked.
- Do not restate obvious details.
- Prefer direct answers, short summaries, and actionable output.
- When code is required, provide the complete necessary code.
- When explaining code changes, summarise only what changed and why it matters.
- Avoid speculative, esoteric, or superfluous commentary.
- Offer deeper explanation only when requested.