from pathlib import Path
from fastapi import Depends, FastAPI, HTTPException, Response
from fastapi.responses import FileResponse
from fastapi.staticfiles import StaticFiles
from fastapi.middleware.cors import CORSMiddleware
from sqlalchemy import func
from sqlalchemy.orm import Session
from .auth import create_token, current_user, hash_password, verify_password
from .database import Base, engine, get_db
from .models import Todo, User
from .pdf import build_pdf
from .schemas import *
from .vector import vector_index

Base.metadata.create_all(bind=engine)
app = FastAPI(title="TodolistApp API")
app.add_middleware(CORSMiddleware, allow_origins=["http://127.0.0.1", "http://localhost", "file://"], allow_origin_regex=r"http://127\.0\.0\.1:\d+", allow_credentials=True, allow_methods=["*"], allow_headers=["*"])

def user_out(db: Session, user: User) -> UserOut:
    total = db.query(func.count(Todo.id)).filter(Todo.user_id == user.id).scalar() or 0
    done = db.query(func.count(Todo.id)).filter(Todo.user_id == user.id, Todo.completed == True).scalar() or 0
    return UserOut(id=user.id, email=user.email, username=user.username, total_tasks=total, completed_tasks=done)

def parse_tags(tags: str) -> list[str]: return [t for t in tags.split(",") if t]
def dump(todo: Todo) -> TodoOut: return TodoOut(id=todo.id, title=todo.title, description=todo.description, due_date=todo.due_date, priority=todo.priority, tags=parse_tags(todo.tags), completed=todo.completed, position=todo.position)

@app.post("/api/auth/register", response_model=Token)
def register(data: UserCreate, db: Session = Depends(get_db)):
    if db.query(User).filter(User.email == data.email.lower()).first(): raise HTTPException(409, "Email déjà utilisé")
    user = User(email=data.email.lower(), username=data.username, password_hash=hash_password(data.password)); db.add(user); db.commit(); db.refresh(user)
    return Token(access_token=create_token(user), user=user_out(db, user))
@app.post("/api/auth/login", response_model=Token)
def login(data: UserLogin, db: Session = Depends(get_db)):
    user = db.query(User).filter(User.email == data.email.lower()).first()
    if not user or not verify_password(data.password, user.password_hash): raise HTTPException(401, "Identifiants invalides")
    return Token(access_token=create_token(user), user=user_out(db, user))
@app.get("/api/auth/me", response_model=UserOut)
def me(user: User = Depends(current_user), db: Session = Depends(get_db)): return user_out(db, user)
@app.put("/api/auth/me", response_model=UserOut)
def update_me(data: UserUpdate, user: User = Depends(current_user), db: Session = Depends(get_db)):
    if data.email and data.email.lower() != user.email and db.query(User).filter(User.email == data.email.lower()).first(): raise HTTPException(409, "Email déjà utilisé")
    if data.email: user.email = data.email.lower()
    if data.username: user.username = data.username
    db.commit(); db.refresh(user); return user_out(db, user)
@app.put("/api/auth/password")
def change_password(data: PasswordChange, user: User = Depends(current_user), db: Session = Depends(get_db)):
    if not verify_password(data.current_password, user.password_hash): raise HTTPException(400, "Mot de passe actuel incorrect")
    user.password_hash = hash_password(data.new_password); db.commit(); return {"ok": True}

@app.get("/api/todos", response_model=list[TodoOut])
def list_todos(user: User = Depends(current_user), db: Session = Depends(get_db)):
    return [dump(t) for t in db.query(Todo).filter(Todo.user_id == user.id).order_by(Todo.position, Todo.created_at.desc()).all()]
@app.post("/api/todos", response_model=TodoOut)
def create_todo(data: TodoCreate, user: User = Depends(current_user), db: Session = Depends(get_db)):
    pos = db.query(func.count(Todo.id)).filter(Todo.user_id == user.id).scalar() or 0
    todo = Todo(user_id=user.id, title=data.title, description=data.description, due_date=data.due_date, priority=data.priority, tags=",".join(data.tags), position=pos); db.add(todo); db.commit(); db.refresh(todo); vector_index.upsert(todo); return dump(todo)
@app.put("/api/todos/{todo_id}", response_model=TodoOut)
def update_todo(todo_id: int, data: TodoUpdate, user: User = Depends(current_user), db: Session = Depends(get_db)):
    todo = db.query(Todo).filter(Todo.id == todo_id, Todo.user_id == user.id).first() or (_ for _ in ()).throw(HTTPException(404, "Tâche introuvable"))
    for key, value in data.model_dump(exclude_unset=True).items(): setattr(todo, key, ",".join(value) if key == "tags" and value is not None else value)
    db.commit(); db.refresh(todo); vector_index.upsert(todo); return dump(todo)
@app.delete("/api/todos/{todo_id}")
def delete_todo(todo_id: int, user: User = Depends(current_user), db: Session = Depends(get_db)):
    todo = db.query(Todo).filter(Todo.id == todo_id, Todo.user_id == user.id).first() or (_ for _ in ()).throw(HTTPException(404, "Tâche introuvable"))
    vector_index.delete(user.id, todo.id); db.delete(todo); db.commit(); return {"ok": True}
@app.post("/api/todos/search", response_model=list[TodoOut])
def search(data: SearchIn, user: User = Depends(current_user), db: Session = Depends(get_db)):
    ids = vector_index.search(user.id, data.query); return [dump(t) for t in db.query(Todo).filter(Todo.user_id == user.id, Todo.id.in_(ids)).all()]
@app.get("/api/export/pdf")
def export_pdf(user: User = Depends(current_user), db: Session = Depends(get_db)):
    pdf = build_pdf(user, db.query(Todo).filter(Todo.user_id == user.id).order_by(Todo.completed, Todo.position).all())
    return Response(pdf, media_type="application/pdf", headers={"Content-Disposition": "attachment; filename=todolist.pdf"})


_dist = Path(__file__).resolve().parents[1] / "dist"
if _dist.exists():
    app.mount("/assets", StaticFiles(directory=_dist / "assets"), name="assets")
    @app.get("/{full_path:path}", include_in_schema=False)
    def spa(full_path: str):
        return FileResponse(_dist / "index.html")
