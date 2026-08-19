from functools import lru_cache
from pathlib import Path
import os, secrets
from pydantic_settings import BaseSettings

class Settings(BaseSettings):
    # Secret persistant généré au premier lancement pour signer les JWT.
    app_name: str = "TodolistApp"
    jwt_algorithm: str = "HS256"
    access_token_minutes: int = 60 * 24 * 7

    @property
    def data_dir(self) -> Path:
        root = os.getenv("APPDATA") or str(Path.home() / ".local" / "share")
        path = Path(root) / self.app_name
        path.mkdir(parents=True, exist_ok=True)
        return path

    @property
    def secret_key(self) -> str:
        secret_file = self.data_dir / ".secret"
        if not secret_file.exists():
            secret_file.write_text(secrets.token_urlsafe(48), encoding="utf-8")
        return secret_file.read_text(encoding="utf-8").strip()

settings = Settings()
