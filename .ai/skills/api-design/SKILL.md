

---
name: api-design
description: RESTful API, resource route, resource controller, HTTP verb, route naming, response, validation, and API workflow conventions for this Laravel application. Use when creating or modifying APIs, API routes, resource controllers, API resources, request/response shapes, state-changing endpoints, or deciding between REST resources and RPC-style actions.
---

# API Design

Use this skill whenever designing or implementing API routes, controllers, request handling, response handling, or resource-oriented workflows.

This project favours strict RESTful resource design. Model state changes as resources and use correct HTTP verbs rather than custom RPC-style action endpoints.

## RESTful Resources

- APIs should follow strict RESTful resource conventions.
- Prefer proper resource controllers and HTTP verbs over hybrid or RPC-style endpoints.
- Model intent through resources and state rather than custom action methods.
- Avoid custom action endpoints such as:
  - `POST /posts/{post}/publish`
  - `POST /posts/{post}/approve`
  - `POST /posts/{post}/cancel`
- Prefer modelling these as resources instead.

## Resource Examples

- Prefer `POST /published-posts` instead of `POST /posts/{post}/publish`.
- Prefer `DELETE /published-posts/{publishedPost}` instead of `POST /posts/{post}/unpublish`.
- Prefer `POST /approved-orders` instead of `POST /orders/{order}/approve`.
- Prefer `DELETE /approved-orders/{approvedOrder}` instead of `POST /orders/{order}/unapprove`.

## Controllers

- Controllers must use singular resource names.
  - Prefer `ActivityController`.
  - Avoid `ActivitiesController`.
- Controllers must not extend from a project/base controller.
- Controllers should remain thin and delegate meaningful work to Actions.
- Controllers should coordinate HTTP concerns only:
  - Requests
  - Authorization
  - Validation handoff
  - Action invocation
  - Response construction
- Use Laravel resource controller conventions where practical.
- Remove unused or empty resource methods until they are needed.

## HTTP Verbs

Use HTTP verbs semantically.

- `GET` retrieves resources.
- `POST` creates resources.
- `PUT` replaces resources.
- `PATCH` partially updates resources.
- `DELETE` deletes resources.

Do not use `POST` as a generic action verb when a resource-oriented verb and route can express the workflow.

## Validation and Authorization

- Validate incoming API input through Laravel validation, Form Requests, Livewire where relevant, or explicit DTO construction.
- Validation rules should include both minimum and maximum constraints where applicable.
- Authorization should happen before state-changing Actions are invoked.
- Do not rely on controllers to contain meaningful business logic.

## Responses

- Keep response shapes explicit and predictable.
- Use Laravel API Resources where they improve consistency or encapsulate response shape.
- Return appropriate HTTP status codes.
- Keep user-facing response text localisable where relevant.
- Do not expose internal implementation details in API responses.

## State Changes

- State-changing API endpoints should delegate to Actions.
- Actions should handle transactions, persistence, and events.
- Successful state changes should dispatch or broadcast appropriate concrete events after persistence.
- Avoid hiding state changes in model events, observers, cascades, or controller methods.

## Exceptions

- Avoid RPC-style API design unless explicitly required by an external integration, webhook provider, or third-party contract.
- If a non-RESTful endpoint is required by an external system, keep it isolated and clearly named around that external contract.