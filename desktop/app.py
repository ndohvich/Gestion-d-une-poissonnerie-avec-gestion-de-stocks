import socket, threading, time, sys
from pathlib import Path
import uvicorn, webview

def free_port() -> int:
    with socket.socket() as s:
        s.bind(("127.0.0.1", 0)); return s.getsockname()[1]

def resource(path: str) -> Path:
    base = Path(getattr(sys, "_MEIPASS", Path(__file__).resolve().parents[1]))
    return base / path

def main() -> None:
    port = free_port()
    # Lance FastAPI dans le même processus, sur un port local libre.
    thread = threading.Thread(target=lambda: uvicorn.run("backend.main:app", host="127.0.0.1", port=port, log_level="warning"), daemon=True)
    thread.start(); time.sleep(1)
    url = f"http://127.0.0.1:{port}"
    # En production desktop, pywebview affiche l'application React servie par Vite en build statique.
    webview.create_window("TodolistApp", url, width=1320, height=860, min_size=(1000, 700))
    webview.start()
if __name__ == "__main__": main()
