# TodolistApp Desktop

Application CRUD desktop premium avec authentification JWT, FastAPI local, React 18, SQLite persistante dans `%APPDATA%/TodolistApp/`, recherche sémantique ChromaDB et export PDF.

## Installation niveau 0

```bash
npm i
python -m venv .venv
.venv\Scripts\activate
pip install -r requirements.txt
```

## Développement

Terminal 1:
```bash
uvicorn backend.main:app --reload --host 127.0.0.1 --port 8000
```

Terminal 2:
```bash
npm run dev
```

Ouvre `http://127.0.0.1:5173`.

## Données seed

```bash
python scripts/seed.py
```

Compte créé: `demo@todolist.local` / `Password123!`.

Les 3 tâches d'exemple sont:
1. Préparer proposition client X
2. Revoir inventaire sprint
3. Planifier revue design

## Build frontend

```bash
npm run build
```

## Packaging Windows

```bash
pyinstaller packaging/todolist.spec --onefile --windowed
```

L'exécutable lance FastAPI sur un port local libre puis ouvre une fenêtre pywebview.

## Endpoints

- `POST /api/auth/register`, `POST /api/auth/login`, `GET /api/auth/me`
- `GET/POST/PUT/DELETE /api/todos`
- `POST /api/todos/search`
- `GET /api/export/pdf`
