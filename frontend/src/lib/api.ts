import axios from 'axios';
const origin = window.location.origin.startsWith('http://127.0.0.1') ? window.location.origin : 'http://127.0.0.1:8000';
export const api = axios.create({ baseURL: (window as any).__API_BASE__ || localStorage.getItem('apiBase') || origin });
api.interceptors.request.use((config) => { const token = localStorage.getItem('token') || sessionStorage.getItem('token'); if (token) config.headers.Authorization = `Bearer ${token}`; return config; });
