# Restiloc

Restiloc is a vehicle-restitution management system built as a school project (BTS SIO). It is made of two parts that live side by side in this repository:

1. **`restilloc_location-main/`** — a PHP + MySQL web application used by staff at a car-rental/expertise company to manage clients, vehicles, garages, expert appraisers and appointments ("rendez-vous de restitution").
2. **`DS_Restiloc/`** — a native Android app (Java) used by field experts to log in, look up a vehicle by its license plate, and browse the lists of clients, garages and experts by calling PHP endpoints on the same web application over HTTP.

There is no `package.json`/Node.js layer in this project — the backend is plain PHP (PDO + MySQL), the web front end is server-rendered HTML with Bootstrap 5 and jQuery, and the mobile client is a Gradle-based Android app.

## Features (verified in code)

Web application (`restilloc_location-main/`):
- Single-entry router (`index.php?page=...`) that includes the requested page fragment (`accueil`, `nv_client`, `nv_vehicule`, `liste_clients`, `liste_vehicule`, `nv_expert`, `nv_cabinet_expert`, `liste_expert`, `nv_garage`, `liste_garage`, `rdv_restitution`, etc.)
- Create/list/edit/delete clients (`nv_client.php`, `liste_clients.php`, `modification_client.php`, `supprimer_client.php`)
- Create/list/edit/delete vehicles, linked to a client and a make/model (`nv_vehicule.php`, `liste_vehicule.php`, `modification_vehicule.php`, `supprimer_vehicule.php`)
- Create/list/edit/delete garages (`nv_garage.php`, `liste_garage.php`, `modification_garage.php`, `supprimer_garage.php`)
- Create/list/edit/delete experts and expertise cabinets (`nv_expert.php`, `nv_cabinet_expert.php`, `liste_expert.php`, `modification_expert.php`, `supprimer_expert.php`)
- Search a vehicle by license plate, joined with its owning client (`search_vehicles.php`)
- Schedule a "restitution" appointment / open a restitution file (`rdv_restitution.php`, `dossier_restitution.php`)
- Cascading dropdown helpers (make → model → engine, client/expert/garage/date pickers) served as AJAX HTML fragments (`select_marque_vehicule.php`, `select_modele_vehicule.php`, `select_motorisation_vehicule.php`, `select_client_vehicule.php`, `select_expert_vehicule.php`, `select_societe_expert.php`, `select_lieu_rdv.php`)

Android app (`DS_Restiloc/`):
- Splash screen → login screen (`SplashScreen`, `Login`)
- Expert home screen with a vehicle-lookup-by-plate search (`AccueilExpert`)
- Browsing lists of clients, garages and experts, fetched as JSON from the PHP backend (`ListClient`, `ListGarage`, `ListExpert`)
- Adding a new garage from the app (`AddGarage`)
- A "restitution file" screen listing items/services performed (`ListePrestations`, `MainActivity`)

## Tech stack

**Web app** (`restilloc_location-main/`)
- PHP (PDO/MySQL — no framework)
- MySQL/MariaDB (schema + seed data in `restilloc_location-main/bdd/restilloc.sql`)
- Bootstrap 5.1.2 and jQuery 3.6.0 (vendored locally under `restilloc_location-main/bootstrap/`)
- Plain CSS/JS (`restilloc_location-main/css/`, `restilloc_location-main/js/`)

**Android app** (`DS_Restiloc/`)
- Java, Gradle (Android Gradle Plugin 7.1.2), `compileSdk`/`targetSdk` 32, `minSdk` 19
- AndroidX AppCompat, Material Components, ConstraintLayout
- Networking: `com.android.volley:volley`, `com.squareup.okhttp3:okhttp`, and the third-party `Advanced-HttpURLConnection` library (`com.github.VishnuSivadasVS:Advanced-HttpURLConnection`)
- `com.google.firebase:firebase-firestore` and `firebase-crashlytics-buildtools` are declared as dependencies, but no Firebase code/usage or `google-services.json` was found in the source — see GUIDE.md.

## Project structure

```
Restiloc/
├── restilloc_location-main/       PHP/MySQL web application
│   ├── index.php                  Router: includes "<page>.php" based on ?page=
│   ├── connexion_bdd.php          PDO/MySQL connection helper
│   ├── nv_*.php / ajout_nv_*.php  "Create" forms + insert handlers (client, vehicule, garage, expert, cabinet)
│   ├── liste_*.php / tableau_*.php  List pages + table-rendering partials
│   ├── modification_*.php         Edit forms/handlers
│   ├── supprimer_*.php            Delete handlers
│   ├── select_*.php               AJAX dropdown fragments (make/model/engine/client/expert/garage/date)
│   ├── client_list.php            JSON API: all clients (used by the Android app)
│   ├── garage_list.php            JSON API: all garages (used by the Android app)
│   ├── expert_list.php            JSON API: all experts (used by the Android app)
│   ├── search_vehicles.php        JSON API: vehicle + owner lookup by plate
│   ├── dossier_restitution.php    Creates a restitution record
│   ├── rdv_restitution.php        Appointment scheduling page
│   ├── bdd/restilloc.sql          MySQL schema + seed data
│   ├── bootstrap/5.1.2/           Vendored Bootstrap + jQuery
│   ├── css/, js/, images/         Static assets
│   └── ReadMe.txt                 Original setup notes (login + IP configuration)
│
└── DS_Restiloc/                   Android app (Gradle project)
    ├── app/build.gradle           Module dependencies, SDK versions, applicationId
    ├── app/src/main/AndroidManifest.xml
    └── app/src/main/java/fr/driss_soudani/ds_restiloc/
        ├── SplashScreen.java, Login.java, AccueilExpert.java
        ├── ListClient.java, ListGarage.java, ListExpert.java   (fetch JSON from the PHP API)
        ├── AddGarage.java, SearchVehicles.java, MainActivity.java, ListePrestations.java
        └── Client.java, Garage.java, Expert.java, Datas*.java  (models / in-memory singletons)
```

## Setup & run

### 1. Web application (`restilloc_location-main/`)

Requirements: a local PHP + MySQL stack (e.g. WampServer, XAMPP, MAMP) with PHP's `pdo_mysql` extension enabled. There is no build step and no PHP dependency manager (no `composer.json`) — the vendored front-end assets (Bootstrap, jQuery) are already checked into the repo.

1. Copy the `restilloc_location-main/` folder into your server's web root (e.g. `htdocs/` for XAMPP, or a WampServer virtual host directory).
2. Create a MySQL database named `restilloc` and import the schema/seed data:
   ```bash
   mysql -u root -p restilloc < restilloc_location-main/bdd/restilloc.sql
   ```
3. Check the DB credentials in `restilloc_location-main/connexion_bdd.php` (defaults: host `localhost`, user `root`, empty password, database `restilloc`) and adjust them to match your local MySQL setup.
4. Start Apache/MySQL and open `index.php` in a browser, e.g. `http://localhost/restilloc_location-main/index.php`.

### 2. Android app (`DS_Restiloc/`)

Requirements: Android Studio (or the Gradle wrapper) with Android SDK 32 installed; a device/emulator with `minSdk` 19+.

1. Open the `DS_Restiloc/` folder as a project in Android Studio, or build from the command line:
   ```bash
   cd DS_Restiloc
   ./gradlew assembleDebug
   ```
2. **Point the app at your web server.** The app currently hard-codes server URLs directly in the Java source instead of reading them from a config file — see `URL`/`URL_1`/`URL_2` constants in `Login.java` and `AccueilExpert.java`, and the literal URLs in `ListClient.java`, `ListGarage.java`, `ListExpert.java`, `AddGarage.java` and `SearchVehicles.java`. Replace the IP addresses in these files (`194.214.234.254` and `192.168.0.108` are leftover addresses from the original developers' network) with the LAN IP address of the machine running your PHP server. See `restilloc_location-main/ReadMe.txt` for the original developer note listing which files need this change.
3. Install the APK on a device/emulator that can reach your PHP server's IP on the network, and run the app.

### Demo login

`restilloc_location-main/ReadMe.txt` lists demo login credentials (`johndoe` / `secret`) for the mobile app's login screen; note that the corresponding `loginExpert.php` script the app posts to is not present in this repository (see GUIDE.md).
