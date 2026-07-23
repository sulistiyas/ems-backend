# AGENTS.md — Employee Management System v2

Konteks project untuk AI coding agent. Baca dan ikuti aturan ini sebelum generate atau edit kode apa pun.

## Tentang Project

EMS v2 adalah aplikasi manajemen pegawai dengan arsitektur terpisah:
- **Backend**: Laravel (REST API only, tidak ada Blade view)
- **Frontend**: React (Vite) sebagai SPA, konsumsi API via Axios
- **Database**: PostgreSQL
- **Auth**: Laravel Sanctum (token-based, untuk SPA)

Komunikasi backend-frontend murni JSON melalui REST API. Tidak ada server-side rendering.

## Arsitektur Backend (WAJIB DIIKUTI)

Gunakan pola **Repository-Service-Controller**:
- **Repository**: akses data langsung (Eloquent query), tanpa interface — cukup class biasa
- **Service**: business logic, memanggil Repository, dipanggil oleh Controller
- **Controller**: tetap tipis (thin controller), hanya menerima request, validasi, panggil Service, kembalikan JSON response

Struktur folder di dalam `app/`:
```
app/
├── Http/
│   ├── Controllers/Api/
│   └── Requests/          → Form Request untuk validasi
├── Services/
├── Repositories/
└── Models/
```

Aturan tambahan:
- Semua Controller ada di dalam `Http/Controllers/Api/`, karena ini API-only project
- Validasi input pakai Form Request class, bukan validasi inline di controller
- Response API konsisten, gunakan format:
```json
{
  "success": true,
  "message": "...",
  "data": {}
}
```
- Error response juga konsisten (status code sesuai — 422 validasi, 401 unauthorized, 404 not found, dst)
- Gunakan Eloquent relationship dan eager loading, hindari N+1 query
- Migration harus reversible (isi method `down()` dengan benar)

## Arsitektur Frontend (WAJIB DIIKUTI)

Struktur folder di dalam `src/`:
```
src/
├── api/          → axios instance + fungsi pemanggil API per resource
├── components/   → komponen reusable (Button, Table, Modal, dll)
├── pages/        → halaman utama (Login, Dashboard, Employees, Shifts)
├── store/        → Zustand store (auth state, dll)
├── hooks/        → custom hooks (misal useEmployees, useShifts)
└── routes/       → konfigurasi React Router
```

Aturan tambahan:
- Gunakan **function component** dan **hooks**, jangan class component
- State management global pakai **Zustand**, jangan Redux kecuali diminta eksplisit
- Styling pakai **Tailwind CSS**, jangan bikin file CSS terpisah kecuali benar-benar perlu
- Semua pemanggilan API lewat folder `api/`, jangan langsung axios call di dalam komponen
- Buat custom hook untuk logic fetching data (contoh: `useEmployees()` yang handle fetch, loading, error state)
- Gunakan React Router untuk semua navigasi antar halaman

## Konvensi Umum

- Penamaan variabel dan fungsi: **camelCase** di JS/React, **snake_case** untuk kolom database, **PascalCase** untuk nama class PHP dan komponen React
- Commit message singkat dan jelas, bahasa Inggris (contoh: `feat: add employee CRUD endpoint`)
- Jangan generate kode yang mengubah struktur project di luar konvensi di atas tanpa konfirmasi
- Kalau ada ambiguitas soal requirement, tanyakan dulu sebelum asumsi

## Yang TIDAK boleh dilakukan

- Jangan pakai Blade view untuk apa pun (project ini API only)
- Jangan pakai class component di React
- Jangan taruh business logic di dalam Controller
- Jangan taruh axios call langsung di komponen React
- Jangan install library tambahan tanpa disebutkan secara eksplisit di request