# Developer Guide

This guide covers configuration, how the two halves of Restiloc (PHP web app + Android app) fit together, and things a new contributor would need to know before making changes. Everything below was verified by reading the actual source in this repository.

## 1. The two applications in this repo

- **`restilloc_location-main/`** is a standalone PHP web app. It is the "system of record": all data lives in its MySQL database, and both the web UI and the Android app ultimately talk to it.
- **`DS_Restiloc/`** is a separate Android Studio/Gradle project. It is a thin client: it has no local database, and every screen either calls one of the PHP scripts in `restilloc_location-main/` over HTTP or reads from in-memory singleton "Datas*" classes (`DatasExpert`, `DatasVoiture`, `DatasExpertise`) that hold whatever the last HTTP response put into them.

They are not wired together by any build tooling — there's no monorepo script that runs both. You run a PHP+MySQL server for the web app, then point the Android app's hard-coded URLs at that server (see README.md "Setup & run").

## 2. Configuration

There is no `.env` file, no config JSON, and no dependency-injected settings object anywhere in this project. Configuration is hard-coded directly in source files:

### Database connection (`restilloc_location-main/connexion_bdd.php`)
```php
$host = "localhost";
$user = "root";
$password = "";
$bdd = "restilloc";
```
To point the web app at a different MySQL instance/database, edit these four variables directly. `connect_to_db()` builds a PDO DSN (`mysql:host=...;dbname=...;charset=UTF8`) and every other PHP script in the folder calls `connect_to_db()` (via `include('connexion_bdd.php')`) to get a connection — there is a single connection helper reused everywhere, so this is the only place DB config needs to change on the PHP side.

### Server base URLs (Android app)
The Android app has no `BuildConfig` field, `strings.xml` entry, or `local.properties` value for the API base URL — every screen that talks to the network hard-codes a full URL as a Java string literal:

| File | Constant / literal | Points at |
|---|---|---|
| `Login.java` | `URL` | `http://194.214.234.254/loginExpert.php` |
| `AccueilExpert.java` | `URL_1` | `http://194.214.234.254/restilloc_location-main/search_vehicles.php` |
| `AccueilExpert.java` | `URL_2` (declared, unused — see below) | `http://194.214.234.254/restilloc_location-main/dossier_restitution.php` |
| `ListClient.java` | inline string | `http://194.214.234.254/restilloc_location-main/client_list.php` |
| `ListGarage.java` | inline string | `http://194.214.234.254/restilloc_location-main/garage_list.php` |
| `ListExpert.java` | inline string | `http://194.214.234.254/restilloc_location-main/expert_list.php` |
| `AddGarage.java` | inline string | `http://192.168.0.108/restilloc_location-main/ajout_nv_garage.php` |
| `SearchVehicles.java` | inline string | `http://192.168.0.108/restilloc_location-main/search_vehicles.php` |

Two different IP addresses appear (`194.214.234.254` and `192.168.0.108`), which are leftover LAN/server addresses from whoever last ran this app — they will not work as-is. To run the app against your own server, search-and-replace these literals with your PHP server's reachable address (see `restilloc_location-main/ReadMe.txt`, which lists the same set of files as needing an IP update). There is no central place to change this in one edit.

`AndroidManifest.xml` sets `android:usesCleartextTraffic="true"`, which is required because all of the above URLs are plain `http://`, not `https://`.

**Gap to be aware of:** `AndroidManifest.xml` does not declare `<uses-permission android:name="android.permission.INTERNET"/>`. Every screen listed above performs network I/O, so without adding that permission the app will fail to make any HTTP request at runtime on a real device (this is a preexisting gap in the manifest, not something introduced by this documentation).

### Demo credentials
`restilloc_location-main/ReadMe.txt` documents a demo login (`johndoe` / `secret`) for the app's login screen. As noted in `API_REFERENCE.md`, the `loginExpert.php` script that `Login.java` posts to is not present in this repository, so the login screen cannot be exercised end-to-end without writing that script yourself against the `expert`/`cabinet_expertise` tables.

## 3. Database schema

Schema and seed data live in `restilloc_location-main/bdd/restilloc.sql` (MySQL/MariaDB, MyISAM tables). Tables, from the dump:

- `client` (`id_client`, `nom_client`, `prenom_client`, `adresse_client`, `cp_client`, `ville_client`, `tel_client`, `portable_client`, `email_client`)
- `vehicule` (`id_vehicule`, `immatriculation`, `motorisation`, `date_circulation`, `id_client` FK, `id_modele` FK)
- `marque` (`id_marque`, `nom_marque`) — vehicle makes (seeded with PEUGEOT, CITROEN, WOLFVAGEN, HONDA, VOLVO)
- `modele` (`id_modele`, `nom_modele`, `id_marque` FK) — vehicle models per make
- `garage` (`id_garage`, `nom_garage`, `adresse_garage`, `cp_garage`, `ville_garage`, `tel_garage`)
- `expert` (`id_expert`, `nom_expert`, `prenom_expert`, `tel_expert`, `mail_expert`, `id_cabinet` FK)
- `cabinet_expertise` (`id_cabinet`, `nom_cabinet`, `adresse_cabinet`, `cp_cabinet`, `ville_cabinet`, `tel_cabinet`)
- `rendez_vous` (`id_client`, `datetime`, `id_garage` FK, `id_expert` FK) — note `id_client` is both the primary key and (confusingly) not actually a foreign key to `client` in this table's definition
- `dossier_restitution` (`id_dossier`, `dossier_vehicule`, `dossier_expert`, `dossier_rendez_vous`, `dossier_date`, `piece`, `description`, `quantite`, `peinture`, `photo`, `id_vehicule` unique FK)

No migration tool is used — the `.sql` file is a full phpMyAdmin dump (structure + data) meant to be imported wholesale, and any schema change needs to be re-exported into it by hand.

## 4. How the web app is structured

`index.php` is the single entry point for the whole site. It reads `?page=<name>` from the query string (defaulting to `accueil`) and does `include($page_a_afficher . ".php")` to render that page inside a shared Bootstrap navbar/header/footer. This means:
- Every "page" script (`accueil.php`, `nv_client.php`, `liste_clients.php`, ...) is actually an HTML fragment, not a standalone document — it relies on `index.php` for `<html>`/`<head>`/navbar/footer.
- Navigating the site means following links like `./index.php?page=nv_client`.
- There is no `.htaccess`-based routing or clean URLs — everything goes through the `page` query parameter.

Data-entry pages (`nv_*.php`) submit forms to their matching `ajout_nv_*.php` handler, which validates nothing beyond PHP's default behavior and does a parameterized `INSERT` via PDO. List pages (`liste_*.php`) include a `tableau_*.php` partial that runs a `SELECT` and renders an HTML `<table>`. Edit and delete flows are separate scripts (`modification_*.php`, `supprimer_*.php`) rather than a single CRUD controller.

The `select_*.php` scripts are small AJAX endpoints called from `js/script.js` via jQuery `.load()`; they return raw `<option>` HTML fragments (not JSON) used to populate dependent dropdowns such as make → model. Only `select_citroen_js.php` is actually wired up in `script.js` (`select_marque()` only handles the `"CITROEN"` case) — the other `select_*.php` files exist but are not called from that function as written.

## 5. How the Android app is structured

- `SplashScreen` → `Login` → `AccueilExpert` is the intended navigation flow (per `AndroidManifest.xml`, `SplashScreen` is the launcher activity).
- `AccueilExpert` is the expert's home screen: it posts a license plate to `search_vehicles.php`, parses the JSON into the `DatasVoiture` singleton, and displays vehicle/client details. From there, buttons navigate to `ListGarage`, `ListExpert`, `ListClient`, or `AddGarage` (some of these navigations are placeholders — see the commented-out `PutData` calls in `AccueilExpert.java` for the "dossier expertise" flow, which currently just switches screens without calling `dossier_restitution.php`).
- `ListClient`, `ListGarage`, `ListExpert` each fetch their respective `*_list.php` endpoint with Volley's `StringRequest`, parse the JSON array, and bind it to a `RecyclerView`/`ListView` via a matching `*ListAdapter`.
- Model classes (`Client.java`, `Garage.java`, `Expert.java`) are plain data holders matching the JSON fields returned by the corresponding `*_list.php` script.
- `DatasExpert`, `DatasVoiture`, `DatasExpertise` are singleton holders (`getInstance()`) used to pass data between activities without Android's `Intent` extras — e.g. `AccueilExpert` populates `DatasVoiture` after a successful vehicle search, and other activities read from it later.
- Networking is done with three different libraries depending on the screen: the third-party `PutData` helper (`Login`, `AccueilExpert`), Volley (`ListClient`, `ListGarage`, `ListExpert`), and OkHttp (`AddGarage`) or the deprecated Apache `HttpClient` (`SearchVehicles`, via a `com.google.firebase...reloc.org.apache.http` shim bundled with the Crashlytics build tools dependency). There is no single networking layer — each screen was written independently.

## 6. Known gaps worth knowing before you build on this project

These are all verified directly from the code (not assumptions) and matter if you plan to extend or fix this project:

1. **`client_list.php`, `garage_list.php`, `expert_list.php` only return the last database row**, not the full table — the `$result` array is reassigned (not appended to) on each loop iteration before being JSON-encoded. See `API_REFERENCE.md` for the exact code pattern.
2. **`loginExpert.php` (used by `Login.java`) does not exist in this repository.** The login screen cannot work against a fresh checkout until that script is written.
3. **The Android manifest does not request `INTERNET` permission**, even though most screens make HTTP calls.
4. **Server URLs are hard-coded and inconsistent** (`194.214.234.254` in most files, `192.168.0.108` in `AddGarage.java`/`SearchVehicles.java`) — there is no shared constants file or build config for this.
5. **No `.gitignore`, dependency manifest, or lockfile exists for the PHP side** — third-party front-end assets (Bootstrap, jQuery) are vendored directly into the repo rather than fetched via a package manager.
6. Database credentials in `connexion_bdd.php` are plaintext defaults (`root` / empty password) suitable only for a local dev database — do not point this at a shared/production MySQL instance without changing them.

## 7. Attribution

Per the footer in `restilloc_location-main/accueil.php`, this was built as a "Projet Restiloc BTS SIO" by Dylan Oiknine, Siméon Friedrich, Betty Gheorghita and Eric Pava (2023); the Android app's Java package (`fr.driss_soudani.ds_restiloc`) and in-code comments (French) point to a later contributor, Driss Soudani, extending it with the mobile client.
