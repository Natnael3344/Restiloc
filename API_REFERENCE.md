# API Reference

This document covers the PHP scripts in `restilloc_location-main/` that behave as a genuine client-server HTTP API — i.e. the endpoints the **Android app** (`DS_Restiloc/`) actually calls over the network, verified by reading both the Java client code and the PHP handler for each.

All endpoints are plain PHP scripts (no router/framework, no versioning, no authentication middleware) served from the `restilloc_location-main/` directory. Base URL = wherever that directory is deployed, e.g. `http://<your-server-ip>/restilloc_location-main/`.

The rest of `restilloc_location-main/` (the `nv_*.php`, `liste_*.php`, `modification_*.php`, `select_*.php` pages, etc.) render HTML pages/fragments for the server-rendered web UI rather than a JSON API, and are not included here — see `GUIDE.md` for how those fit together.

---

## GET `client_list.php`

Returns all clients in the `client` table.

- **Request**: no parameters.
- **Response**: `200 OK`, `application/json` body (no explicit `Content-Type` header is set; PHP defaults to `text/html`, but the body is JSON text). Shape, from `client_list.php`:
  ```json
  [
    {
      "id_client": "15",
      "nom_client": "Friedrich",
      "prenom_client": "Siméon",
      "adresse_client": "12 rue séllenik",
      "cp_client": "67000",
      "ville_client": "Strasbourg",
      "tel_client": "",
      "portable_client": "",
      "email_client": ""
    }
  ]
  ```
- **Note (verified in code):** the handler builds a single `$result` array inside its `foreach` loop and overwrites it on every iteration, then does `json_encode(array($result))` after the loop — so the endpoint always returns an array containing only the **last row** from the `client` table, not the full list, despite the Android client (`ListClient.java`) iterating over the response as if it were a full array.

Consumed by: `DS_Restiloc/.../ListClient.java` (`Request.Method.GET`).

---

## GET `garage_list.php`

Returns garages from the `garage` table.

- **Request**: no parameters.
- **Response**: same pattern as `client_list.php` — JSON array, e.g.
  ```json
  [
    {
      "id_garage": "1",
      "nom_garage": "...",
      "adresse_garage": "...",
      "cp_garage": "...",
      "ville_garage": "...",
      "tel_garage": "..."
    }
  ]
  ```
- **Note (verified in code):** same bug as `client_list.php` — `$result` is overwritten each loop iteration, so only the last `garage` row is ever returned.

Consumed by: `DS_Restiloc/.../ListGarage.java` (`Request.Method.GET`).

---

## GET `expert_list.php`

Returns experts from the `expert` table.

- **Request**: no parameters.
- **Response**: JSON array, e.g.
  ```json
  [
    {
      "id_expert": "1",
      "nom_expert": "...",
      "prenom_expert": "...",
      "tel_expert": "...",
      "mail_expert": "..."
    }
  ]
  ```
- **Note (verified in code):** same "last row only" behavior as the two endpoints above.

Consumed by: `DS_Restiloc/.../ListExpert.java` (`Request.Method.GET`).

---

## POST `search_vehicles.php`

Looks up a vehicle by license plate and returns it joined with its owning client.

- **Request**: `application/x-www-form-urlencoded` body with:
  | Field | Type | Description |
  |---|---|---|
  | `search` | string | Exact `immatriculation` (license plate) to match |
- **Behavior**: only runs the query if `$_POST['search']` is set; matches `vehicule.immatriculation = :search_query` exactly (case-sensitive equality, no partial match), joined to `client` on `id_client`.
- **Response**: `200 OK`, JSON object (not an array) built from the last matching row, e.g.
  ```json
  {
    "immatriculation": "4HGIJX89PY",
    "motorisation": "...",
    "date_circulation": "22/08/2023/12:20",
    "id_client": "15",
    "id_modele": "...",
    "nom_client": "Friedrich",
    "prenom_client": "Siméon",
    "adresse_client": "...",
    "cp_client": "...",
    "ville_client": "...",
    "portable_client": "..."
  }
  ```
  If no row matches, `$result` stays an empty array and `echo json_encode($result)` outputs `[]`. If `search` is missing from the POST body, the script outputs nothing.

Consumed by: `DS_Restiloc/.../AccueilExpert.java` (via the `PutData` helper, POST) and `DS_Restiloc/.../SearchVehicles.java` (via a raw `HttpPost`, expecting a JSON *array* — inconsistent with the object shape actually returned).

---

## POST `ajout_nv_garage.php`

Inserts a new row into the `garage` table.

- **Request**: `application/x-www-form-urlencoded` body with all fields required (no validation/defaults in the PHP):
  | Field | Type |
  |---|---|
  | `nom_garage` | string |
  | `adresse_garage` | string |
  | `cp_garage` | string |
  | `ville_garage` | string |
  | `tel_garage` | string |
- **Response**: the script has no `echo`/output statement at all — a successful request returns an empty `200 OK` body. There is no error handling if a field is missing (PHP will emit an "undefined array key" notice and continue with an empty value) or if the insert fails.

Consumed by: `DS_Restiloc/.../AddGarage.java` (OkHttp POST with a `FormBody`).

---

## POST `dossier_restitution.php`

Inserts a new row into the `dossier_restitution` table (a vehicle restitution file: parts, description, quantity, paint/photo flags, appointment references).

- **Request**: `application/x-www-form-urlencoded` body, all fields required:
  | Field | Type |
  |---|---|
  | `dossier_vehicule` | string |
  | `dossier_expert` | string |
  | `dossier_rendez_vous` | string |
  | `dossier_date` | string |
  | `piece` | string |
  | `description` | string |
  | `quantite` | string |
  | `peinture` | string |
  | `photo` | string |
  | `id_vehicule` | int |
- **Behavior**: only runs if `$_POST['submit']` is set.
- **Response**: plain text, not JSON — `"Data inserted successfully"` on success, `"Error inserting data"` if the `INSERT` fails.

Note: this endpoint is defined and reachable, but in the current Android source the actual call to it (via `PutData`) is commented out in `AccueilExpert.java` — the button handlers that reference it (`traiterClickSurBtnAccederDossierExpertise`, etc.) currently just navigate to another screen instead of hitting the network. Documented here because the endpoint itself is real and live in the PHP code.

---

## Referenced but not present in this repository

`DS_Restiloc/.../Login.java` posts `username`/`password` to `http://194.214.234.254/loginExpert.php` and expects a JSON response with a `message` field equal to `"Login successful"`. **No `loginExpert.php` file exists anywhere in this repository** (searched both `restilloc_location-main/` and the rest of the tree). This endpoint is not documented above because its request/response contract can't be verified from the code — it was presumably only present on the original developers' server. See `GUIDE.md` for what this means for anyone standing the project back up.
