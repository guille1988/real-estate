# Real Estate Template

A Laravel template for building real estate websites: a public-facing site with property search, contact/inquiry/newsletter forms, and a **custom-built admin panel** to manage all the content and leads generated. Designed to be reused as a base across different real estate/brokerage projects, adapting branding, domain, and institutional content as needed.

> This is not a single client project — it's the base other real estate sites of this kind are built on.

## Table of contents

- [Overview](#overview)
- [Tech stack](#tech-stack)
- [Architecture](#architecture)
- [Domain model](#domain-model)
- [Admin panel](#admin-panel)
- [Infrastructure and Docker](#infrastructure-and-docker)
- [Getting started](#getting-started)
- [Useful commands](#useful-commands)
- [Testing and code quality](#testing-and-code-quality)
- [Environment variables](#environment-variables)
- [Roadmap / known limitations](#roadmap--known-limitations)
- [License](#license)

## Overview

The template covers both halves of a real estate site:

- **Public site**: home, services, about, contact, and a property search with filters (location, type, price, area, rooms) plus a detail page per property.
- **Backoffice**: a purpose-built admin panel (no third-party package like Filament/Nova) to manage properties with their images, amenities, and pricing, and to handle leads coming in through the site's various forms.

It's single-tenant/single-brand (not multi-tenant) and has no visitor accounts: the only authenticated users are the staff operating the admin panel.

## Tech stack

### Backend

| Component | Detail |
|---|---|
| Language / Framework | PHP ^8.5, Laravel ^13.0 |
| Frontend bridge | Inertia.js v2 (`inertiajs/inertia-laravel`) |
| Queues / monitoring | Laravel Horizon (Redis) |
| Auth | Custom session auth for the admin panel + Laravel Sanctum installed |
| DTOs / validation | `spatie/laravel-data` (one DTO per use case: Store/Update/Index/BulkDestroy) |
| Images | `intervention/image` (configurable Imagick/GD driver) |
| Typed frontend routes | `laravel/wayfinder` |

### Frontend

| Component | Detail |
|---|---|
| Framework | Vue 3 (Composition API) + TypeScript |
| SPA bridge | Inertia.js v2, with SSR enabled (`vite build --ssr`) |
| Build | Vite 6 (`laravel-vite-plugin`, `@laravel/vite-plugin-wayfinder`) |
| Styling | Tailwind CSS + `@tailwindcss/forms` |
| UI | Headless UI, Heroicons |
| Charts (admin dashboard) | Chart.js + vue-chartjs |
| Notifications | vue3-toastify |

### Infrastructure

| Component | Detail |
|---|---|
| Local environment | Laravel Sail (Docker Compose) |
| Database | MySQL 8.0 |
| Cache / session / queues | Redis (alpine) |
| Workers | Dedicated container running Horizon via Supervisor |
| Scheduler | Dedicated container running `schedule:run` in a loop |

## Architecture

The backend does **not** use the repository pattern or a third-party admin package. It follows its own layered architecture, designed to keep controllers thin and the domain testable:

```
Request → Controller → Data (DTO) → Builder (query) → Action (side effects) → Resource (output) → Inertia::render
```

- **`app/Http/Controllers`** — thin controllers with no business logic. Simple pages use single-action, invokable (`__invoke`) controllers (e.g. `HomeController`, `AboutController`, `Admin/DashboardController`); resources with multiple operations use regular resourceful controllers (e.g. `PropertyController`, `ContactController`, and most of `Admin/*`).
- **`app/Data`** — `spatie/laravel-data` DTOs that validate the request and type the payload. Split between the public site (`PropertyData`, `ContactMessageData`, ...) and the admin panel (`app/Data/Admin/*`, with Index/Store/Update/BulkDestroy variants per resource).
- **`app/Builders`** — custom query builders per model (attached via `#[UseEloquentBuilder]`), holding search/filter scopes (e.g. `PropertyBuilder::search()`, `::featured()`).
- **`app/Actions`** — one invokable class per side-effecting operation (bulk delete, dashboard stats calculation, image/profile storage).
- **`app/Http/Resources`** — shape the data sent to the frontend, split into public resources and `Resources/Admin/*`.
- **`app/Enums`** — the entire domain vocabulary lives in typed enums (`PropertyTypeEnum`, `PropertyLocationEnum`, `PricingDetailCategoryEnum`, etc.), including the Inertia page mapping (`PageEnum`).

Cross-cutting conventions:

- Every model uses `HasUuids` as its route key — no auto-incrementing IDs are ever exposed in URLs.
- `declare(strict_types=1)` and `final` classes throughout the domain code.
- Architectural conventions are enforced by a Pest test (`tests/Feature/ArchitectureTest.php`), not just by documentation.
- There's no `routes/api.php`: all data exchange with the frontend goes through Inertia over `routes/web.php`.

## Domain model

**Core — properties:**

- `Property` — the central entity (title, description, address, type, location, rooms, area, price, featured flag).
- `Image` — images belonging to a property, with one flagged as default.
- `Amenity` — features/amenities attached to a property.
- `PricingDetail` — pricing line items attached to a property, grouped by category.

**Leads (three distinct sources, all with `read_at` to track whether they've been read):**

- `Inquiry` — an inquiry made from a specific property's detail page.
- `PropertyMessage` — a lead from the general "find me a property" form (not tied to a specific property).
- `ContactMessage` — messages from the general contact form.
- `Subscriber` — newsletter subscription (email only).

**Institutional content (no CRUD in the admin panel, managed via seeders):**

- `Team` — team member profiles (used on the About page).
- `Client` — client/case-study logos.
- `Testimonial` — customer testimonials.
- `Faq` / `FaqItem` — frequently asked questions, reused on the home page and property detail page.
- `OfficeLocation` — offices/branches, shown on the contact page.

**Users:**

- `User` — staff/admin only (`is_admin`). There are no visitor accounts and no per-property `Agent` model: the site represents a single company/brokerage, not multiple agents.

## Admin panel

A purpose-built panel using Inertia + Vue under `/admin`, with session-based authentication (`web` guard). It's application code, not an installed package.

Manageable from the admin panel (CRUD + bulk delete where applicable):

- **Properties** — create/edit/delete properties.
- **Images** — upload and pick the default image per property.
- **Pricing Details** — pricing line items per property.
- **Amenities** — amenities per property.
- **Property Messages / Inquiries / Contact Messages** — lead inboxes, with a detail view, read tracking, and deletion (single and bulk).
- **Subscribers** — list and delete newsletter subscribers.
- **Dashboard** — stats (last 7 days and 12 months of messages, month-over-month change, unread counts) rendered with Chart.js.
- **Profile** — the logged-in admin's own data and avatar.

Team, Clients, Testimonials, FAQ, and Office Locations currently have **no screen in the admin panel**: they're "brand"/institutional content meant to be seeded when adapting the template to a new project.

## Infrastructure and Docker

The development environment runs entirely on **Laravel Sail** (`docker-compose.yml`), with 5 services:

| Service | Image / build | Role |
|---|---|---|
| `laravel.test` | Sail PHP 8.5 runtime | Application (HTTP + Vite dev server) |
| `mysql` | `mysql/mysql-server:8.0` | Database |
| `redis` | `redis:alpine` | Cache, session, and queues |
| `worker` | `docker/local/worker` | Runs Laravel Horizon via Supervisor (`docker/local/worker/supervisord.conf`) |
| `scheduler` | `docker/local/scheduler` | Runs `php artisan schedule:run` in a loop every 60s |

This setup is intended for **local development**. Today the repo does not include:

- A Dockerfile or build configuration for production (the `worker`/`scheduler` Dockerfiles are for local `docker-compose` use only).
- A CI/CD pipeline (no GitHub Actions or equivalent).
- Deployment configuration (no Forge, Vapor, Envoyer, or Deployer).

When adopting the template for a real project, these three things are the first to define, depending on where it will be hosted.

## Getting started

Requirements: Docker and Docker Compose.

```bash
# 1. Clone the repo and copy the environment file
cp .env.example .env

# 2. Adjust .env: APP_NAME, DB/Redis credentials if needed,
#    and especially ADMIN_PASSWORD (see the environment variables section)

# 3. Bring up the containers, install dependencies, migrate, and build
make init
```

`make init` brings up the containers (`sail up -d`), runs `make whole` (dependency update + full setup + tests), and finally starts `sail npm run dev`.

If you'd rather do it manually:

```bash
sail up -d
sail composer install
sail artisan migrate:fresh --seed
sail npm install
sail npm run dev
```

The site will be available at `http://localhost` (or whatever port `APP_PORT` is set to), and Horizon at `/horizon`.

## Useful commands

Shortcuts defined in the `Makefile` (all run inside the Sail containers):

| Command | What it does |
|---|---|
| `make init` | Brings up containers + full setup + `npm run dev` |
| `make al` | Formats seeder images, migrates and seeds from scratch, regenerates Wayfinder routes, clears caches |
| `make all` | `al` + the full test suite |
| `make whole` | `composer update` + `all` |
| `make migrate-seed` | `artisan migrate:fresh --seed` |
| `make wayfinder` | Regenerates the typed route helpers in `resources/js/Routes` |
| `make clear` | `artisan clear:all` |
| `make test` | `composer test` (see details below) |
| `make build` | `sail build --no-cache` |
| `make down` | `sail down` |

The most relevant `composer.json` / `package.json` scripts:

| Script | What it runs |
|---|---|
| `composer dev` | `artisan serve` + `queue:listen` + `artisan pail` + `npm run dev`, all in parallel |
| `composer test:lint` | Pint (`--test`) + `eslint` + `prettier --check` |
| `composer test:types` | Larastan/PHPStan |
| `composer test:quality` | Rector in `--dry-run` mode |
| `composer test:type-coverage` | Pest, requires 100% type coverage |
| `composer test:feature-unit` | Pest, requires 100% feature/unit coverage |
| `composer test` | Runs all of the above in sequence |
| `npm run build` | `vue-tsc` + Vite build (client and SSR) |
| `npm run lint` | ESLint over `resources/js` |

## Testing and code quality

- **Pest 4** as the test runner (on top of PHPUnit), with `Unit` and `Feature` suites, including an architecture test (`tests/Feature/ArchitectureTest.php`) that enforces the conventions described above.
- **100% coverage is required**, both type coverage (`test:type-coverage`) and feature/unit coverage (`test:feature-unit`) — `composer test` fails if it drops below that threshold.
- **Larastan/PHPStan** for static analysis, **Rector** for refactor/upgrade rule checks, **Pint** for PHP code style.
- **ESLint + Prettier** (with Tailwind and import-sorting plugins) for the frontend.

## Environment variables

Summary of what's relevant in `.env.example` (see the full file for the rest):

| Variable | Default | Note |
|---|---|---|
| `DB_CONNECTION` / `DB_HOST` | `mysql` | Points at Sail's `mysql` service |
| `CACHE_STORE` / `SESSION_DRIVER` / `QUEUE_CONNECTION` | `redis` | Everything runs on the `redis` service |
| `FILESYSTEM_DISK` | `local` | `AWS_*` variables are ready to enable S3, but empty by default |
| `MAIL_MAILER` | `log` | Supports Postmark/SES/Resend via `config/services.php` |
| `ADMIN_PASSWORD` | — | Password used to seed the initial admin user. **Change it before seeding any environment other than your local machine**; the example value committed in the repo should never be used as-is. |
| `BROADCAST_CONNECTION` | `reverb` | ⚠️ Present but **not functional** (see Roadmap). |

## Roadmap / known limitations

Things the template doesn't yet solve — worth keeping in mind before taking it to production or assuming they're already covered:

- **No CI/CD**: no pipeline is configured; `composer test` and the linters only run manually/locally.
- **No deployment configuration**: no Forge, Vapor, Envoyer, Deployer, or production Dockerfile.
- **Incomplete broadcasting**: `.env.example` ships `REVERB_*` variables and `BROADCAST_CONNECTION=reverb`, but the Reverb package isn't installed and there's no `config/broadcasting.php` or Echo client on the frontend. It's leftover, unimplemented config — either finish the integration or remove it from `.env.example`.
- **No i18n/localization**: there's no `lang/` directory or translation package; content is hardcoded/English-only.
- **No SEO package**: no sitemap or meta-tag management beyond the root Blade template.
- **No public API**: there's no `routes/api.php`; all data traffic goes through Inertia. If a future project needs to expose data to an external client (mobile app, integration), it has to be built from scratch (Sanctum is already installed as a base for that).

## License

No license has been defined for this repo yet. If the template is going to be distributed or reused across projects, define the terms explicitly (e.g. by adding a `LICENSE` file) before sharing it outside the team.
