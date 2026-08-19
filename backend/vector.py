from .config import settings
try:
    import chromadb
except Exception:  # chromadb reste une dépendance packagée; garde un fallback robuste.
    chromadb = None

class VectorIndex:
    def __init__(self):
        self.client = chromadb.PersistentClient(path=str(settings.data_dir / "chroma")) if chromadb else None
        self.collection = self.client.get_or_create_collection("todos") if self.client else None
    def _doc(self, todo) -> str:
        return f"{todo.title}\n{todo.description}\nTags: {todo.tags}\nPriorité: {todo.priority}"
    def upsert(self, todo) -> None:
        if self.collection:
            self.collection.upsert(ids=[f"{todo.user_id}:{todo.id}"], documents=[self._doc(todo)], metadatas=[{"user_id": todo.user_id, "todo_id": todo.id}])
    def delete(self, user_id: int, todo_id: int) -> None:
        if self.collection:
            self.collection.delete(ids=[f"{user_id}:{todo_id}"])
    def search(self, user_id: int, query: str, n: int = 20) -> list[int]:
        if not self.collection:
            return []
        result = self.collection.query(query_texts=[query], n_results=n, where={"user_id": user_id})
        return [int(m["todo_id"]) for m in result.get("metadatas", [[]])[0]]
vector_index = VectorIndex()
