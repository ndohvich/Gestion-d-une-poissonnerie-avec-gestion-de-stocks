from pydantic import BaseModel, EmailStr, Field

class UserCreate(BaseModel):
    email: EmailStr
    username: str = Field(min_length=2, max_length=80)
    password: str = Field(min_length=8, max_length=128)
class UserLogin(BaseModel):
    email: EmailStr
    password: str
class PasswordChange(BaseModel):
    current_password: str
    new_password: str = Field(min_length=8, max_length=128)
class UserUpdate(BaseModel):
    email: EmailStr | None = None
    username: str | None = Field(default=None, min_length=2, max_length=80)
class UserOut(BaseModel):
    id: int; email: str; username: str; total_tasks: int = 0; completed_tasks: int = 0
    model_config = {"from_attributes": True}
class Token(BaseModel):
    access_token: str; token_type: str = "bearer"; user: UserOut
class TodoBase(BaseModel):
    title: str = Field(min_length=1, max_length=180)
    description: str = ""
    due_date: str | None = None
    priority: str = Field(default="medium", pattern="^(low|medium|high)$")
    tags: list[str] = []
class TodoCreate(TodoBase): pass
class TodoUpdate(BaseModel):
    title: str | None = Field(default=None, min_length=1, max_length=180)
    description: str | None = None
    due_date: str | None = None
    priority: str | None = Field(default=None, pattern="^(low|medium|high)$")
    tags: list[str] | None = None
    completed: bool | None = None
    position: int | None = None
class TodoOut(TodoBase):
    id: int; completed: bool; position: int
    model_config = {"from_attributes": True}
class SearchIn(BaseModel):
    query: str = Field(min_length=2, max_length=300)
