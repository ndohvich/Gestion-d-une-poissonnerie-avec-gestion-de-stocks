import { create } from 'zustand';
import { api } from '../lib/api';
export type User = { id:number; email:string; username:string; total_tasks:number; completed_tasks:number };
type AuthState = { user: User | null; login:(e:string,p:string,r:boolean)=>Promise<void>; register:(e:string,u:string,p:string)=>Promise<void>; hydrate:()=>Promise<void>; logout:()=>void };
const save = (token:string, remember=true) => (remember ? localStorage : sessionStorage).setItem('token', token);
export const useAuth = create<AuthState>((set) => ({ user:null, async login(email,password,remember){ const {data}=await api.post('/api/auth/login',{email,password}); save(data.access_token, remember); set({user:data.user}); }, async register(email,username,password){ const {data}=await api.post('/api/auth/register',{email,username,password}); save(data.access_token); set({user:data.user}); }, async hydrate(){ if(localStorage.getItem('token')||sessionStorage.getItem('token')){ const {data}=await api.get('/api/auth/me'); set({user:data}); } }, logout(){ localStorage.removeItem('token'); sessionStorage.removeItem('token'); set({user:null}); } }));
