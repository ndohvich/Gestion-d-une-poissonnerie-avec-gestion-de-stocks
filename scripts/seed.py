from backend.auth import hash_password
from backend.database import Base, SessionLocal, engine
from backend.models import Todo, User
from backend.vector import vector_index
Base.metadata.create_all(bind=engine)
db=SessionLocal(); user=db.query(User).filter_by(email='demo@todolist.local').first() or User(email='demo@todolist.local',username='Demo',password_hash=hash_password('Password123!'))
db.add(user); db.commit(); db.refresh(user)
items=[('Préparer proposition client X','Synthétiser besoins, budget et planning VisionOS.','2026-09-01','high','client,vente'),('Revoir inventaire sprint','Vérifier les tickets terminés et les dépendances bloquées.','2026-08-25','medium','sprint,ops'),('Planifier revue design','Comparer écrans avec Linear, Vercel et Apple.','2026-08-28','low','design,ui')]
for i,it in enumerate(items):
    t=Todo(user_id=user.id,title=it[0],description=it[1],due_date=it[2],priority=it[3],tags=it[4],position=i); db.add(t); db.commit(); db.refresh(t); vector_index.upsert(t)
print('Seed créé: demo@todolist.local / Password123!')
