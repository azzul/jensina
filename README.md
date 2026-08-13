# Jensina Group — Website (Laravel 11)

Corporate website for **Jensina Group** (CV Anugerah Jensina Sejahtera & PT
Maju Jensina Jaya) — construction and building-material/heavy-equipment
expedition services in Karanganyar, Central Java.

This zip contains the **application code only** (`app/`, `routes/`,
`resources/`, `database/`, plus config stubs). It is meant to be dropped
into a fresh `laravel new` project, not run standalone — see setup below.

## What's included

| Area | Files |
|---|---|
| Meta/SEO/settings | `database/migrations/*_site_settings_table.php`, `app/Models/SiteSetting.php` |
| Products | migration + `Product`/`Category` models, `ProductController`, `products/index.blade.php`, `products/show.blade.php` |
| Clients | `Client` model, `ClientController`, `pages/our-client.blade.php` |
| CMS pages (about / privacy / terms / custom-content) | `Page` model, `PageController`, `pages/show.blade.php` |
| Contact form | `ContactMessage` model, `ContactController`, `pages/contact.blade.php` |
| Company profile PDF download | `DownloadController`, `site_settings.company_profile_pdf` |
| Locale (ID/EN) | `app/Http/Middleware/SetLocale.php`, `resources/lang/{id,en}`, `/{locale}/...` routes |
| Layout / SEO head / JSON-LD | `resources/views/layouts/app.blade.php` |
| CSS/JS (no framework) | `resources/css/app.css`, `resources/js/app.js` — copied as-is into `public/assets/css` / `public/assets/js`, no Node/build step |
| llms.txt | `public/llms.txt` |
| Demo content | `database/seeders/JensinaGroupSeeder.php` |

## Structure, as requested

```
layouts/app.blade.php        <- orchestrates everything
  └─ partials/header.blade.php
  └─ @yield('content')       <- filled by each page's own view (home/index,
                                 products/index, products/show, pages/show, ...)
  └─ partials/footer.blade.php
```

Every content view can `@push('head')` and `@push('json-ld')` into the
layout's `<head>` (see `products/show.blade.php` for a live example: it
pushes Product JSON-LD on top of the Organization + BreadcrumbList JSON-LD
that `layouts/app.blade.php` already renders on every page).

## SEO / speed decisions

- **Meta from DB, not hardcoded**: `site_settings` table feeds title suffix,
  default description, OG image, GTM/GA4/verification IDs, social links —
  cached with `Cache::rememberForever` so it's one query per app, not one
  per request (`SiteSetting::current()` / `SiteSetting::forget()` on write).
- **Canonical + hreflang** generated automatically for every page (id/en/x-default).
- **JSON-LD**: `Organization` + `BreadcrumbList` on every page (built from the
  `$breadcrumbs` array each controller passes in — same array feeds the
  visible breadcrumb nav, so they can never go out of sync), plus `Product`
  schema pushed only on product detail pages.
- **No CSS framework**: `resources/css/app.css` is hand-written, ~9KB
  uncompressed, only rules actually used in the views above.
- **No web fonts**: system font stack, avoids a render-blocking font request.
- **No build step**: `app.css` / `app.js` are served directly from
  `public/assets/` — no Node.js, no `npm install`, works on plain PHP/XAMPP.
  (Optional: switch to Vite later for fingerprinting/minification if the
  project grows — see comment in `layouts/app.blade.php`.)
- **Images**: `loading="lazy"` everywhere except the hero, explicit
  width/height to avoid layout shift.

## "Seamless scroll" implementation

The homepage sections use CSS `scroll-snap` (`.scroll-shell` / `.snap-section`
in `app.css`) for a smooth, one-section-at-a-time feel on desktop — **no JS
scroll-hijacking**, so it stays accessible and fast. Below 900px the snap is
disabled entirely (mobile users get normal, natural scrolling — snapping on
a phone tends to feel broken rather than "seamless"). A small
`IntersectionObserver` in `app.js` adds a gentle fade/slide-in as sections
enter view, and respects `prefers-reduced-motion`.

## Setup

```bash
composer create-project laravel/laravel jensina-group "^11.0"
cd jensina-group

# copy the contents of this zip over the fresh project, overwriting:
# app/, routes/web.php, resources/, database/migrations, database/seeders,
# bootstrap/app.php, bootstrap/providers.php, public/llms.txt,
# public/assets/, (merge composer.json if you changed deps)

cp .env.example .env
php artisan key:generate

# set DB credentials in .env, then:
php artisan migrate --seed
php artisan storage:link

php artisan serve
```

Then visit `http://localhost:8000` — it redirects to `/id`.

## Still needs real assets from you (all placeholders right now)

1. **Logo files** — upload the AJS and Maju Jensina Jaya marks to
   `storage/app/public/branding/` and set `site_settings.logo_path` /
   `favicon_path` (Tinker or a quick admin form — none is included here,
   this deliverable is the public-facing site only).
2. **Company profile PDF** — put it at
   `storage/app/public/company-profile.pdf` and set
   `site_settings.company_profile_pdf` to `company-profile.pdf`.
3. **Real client logos** — replace the `clients/placeholder.png` seeder rows
   with actual client logos once you have permission to display them.
4. **Product photos** — replace `thumbnail` / `gallery` paths in
   `products` with real project/equipment photos.
5. **`default_og_image`** in `site_settings` — a 1200×630 share image.
6. **GTM/GA4 IDs** — set `gtm_id` / `ga4_id` in `site_settings` once you
   have them (matches what you mentioned doing for other clients).

## Notes

- No admin panel is included — this is the storefront. Content is managed
  via the seeder / Tinker / a future admin panel (Laravel Nova, Filament,
  or a simple custom CRUD would all drop in cleanly against these models).
- The contact form has a honeypot field (`website`) against basic bots; add
  a captcha if spam becomes an issue.
- `map_lat` / `map_lng` in `site_settings` are approximate for
  Jaten/Karanganyar — adjust to the exact pin once you have it.
