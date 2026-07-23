# ERD — Employee Management System

> Auto-generated from migrations & models. Terakhir diupdate: 2026-07-23

## Diagram Relasi (Mermaid)

```mermaid
erDiagram
    users ||--o| employees : "has profile"
    departments ||--o{ employees : "has members"
    positions ||--o{ employees : "has holders"
    departments }o--|| employees : "head_of"

    employees ||--o{ schedules : "assigned"
    shifts ||--o{ schedules : "defines"

    employees ||--o{ attendance : "clocks_in"
    employees ||--o{ leave_requests : "submits"
    leave_types ||--o{ leave_requests : "categorizes"
    employees ||--o{ leave_requests : "approves"

    employees ||--o{ overtimes : "works"
    employees ||--o{ overtimes : "approves"

    employees ||--o{ payrolls : "receives"

    users {
        bigint id PK
        string name
        string email UK
        timestamp email_verified_at
        string password
        string remember_token
        timestamps
    }

    employees {
        bigint id PK
        string employee_id UK
        bigint user_id FK
        string first_name
        string last_name
        string email UK
        string phone
        date date_of_birth
        enum gender "male|female|other"
        text address
        bigint department_id FK
        bigint position_id FK
        date hire_date
        date end_date
        decimal salary
        enum status "active|inactive|terminated"
        string photo
        timestamps
        soft_deletes
    }

    departments {
        bigint id PK
        string name
        string code UK
        text description
        bigint head_id FK
        timestamps
        soft_deletes
    }

    positions {
        bigint id PK
        string name
        string code UK
        decimal min_salary
        decimal max_salary
        text description
        timestamps
        soft_deletes
    }

    shifts {
        bigint id PK
        string name
        string code UK
        time start_time
        time end_time
        decimal break_duration
        boolean is_active
        timestamps
        soft_deletes
    }

    schedules {
        bigint id PK
        bigint employee_id FK
        bigint shift_id FK
        date date
        enum status "scheduled|confirmed|absent"
        text notes
        timestamps
        soft_deletes
    }

    attendance {
        bigint id PK
        bigint employee_id FK
        date date
        timestamp clock_in
        timestamp clock_out
        decimal hours_worked
        enum status "present|late|absent|leave"
        text notes
        timestamps
        soft_deletes
    }

    leave_types {
        bigint id PK
        string name
        string code UK
        decimal default_days
        boolean is_paid
        boolean is_active
        text description
        timestamps
        soft_deletes
    }

    leave_requests {
        bigint id PK
        bigint employee_id FK
        bigint leave_type_id FK
        date start_date
        date end_date
        decimal days
        text reason
        enum status "pending|approved|rejected"
        bigint approved_by FK
        text approval_notes
        timestamps
        soft_deletes
    }

    overtimes {
        bigint id PK
        bigint employee_id FK
        date date
        time start_time
        time end_time
        decimal hours
        decimal rate_multiplier
        text reason
        enum status "pending|approved|rejected"
        bigint approved_by FK
        timestamps
        soft_deletes
    }

    payrolls {
        bigint id PK
        bigint employee_id FK
        string period
        decimal basic_salary
        decimal overtime_pay
        decimal allowances
        decimal deductions
        decimal tax
        decimal net_salary
        enum status "draft|processed|paid"
        date paid_at
        timestamps
        soft_deletes
    }
```

## Ringkasan Relasi

| Dari | Ke | Tipe | Foreign Key | Keterangan |
|---|---|---|---|---|
| `users` | `employees` | 1 : 0..1 | `employees.user_id` | Satu user bisa punya profil employee |
| `departments` | `employees` | 1 : N | `employees.department_id` | Satu departemen punya banyak karyawan |
| `positions` | `employees` | 1 : N | `employees.position_id` | Satu jabatan diisi banyak karyawan |
| `departments` | `employees` | N : 1 | `departments.head_id` | Departemen punya satu kepala (self-ref) |
| `employees` | `schedules` | 1 : N | `schedules.employee_id` | Karyawan punya banyak jadwal |
| `shifts` | `schedules` | 1 : N | `schedules.shift_id` | Satu shift dipakai banyak jadwal |
| `employees` | `attendance` | 1 : N | `attendance.employee_id` | Karyawan punya banyak catatan absensi |
| `employees` | `leave_requests` | 1 : N | `leave_requests.employee_id` | Karyawan mengajukan banyak cuti |
| `leave_types` | `leave_requests` | 1 : N | `leave_requests.leave_type_id` | Satu jenis cuti dipakai banyak pengajuan |
| `employees` | `leave_requests` | 1 : N | `leave_requests.approved_by` | Karyawan menyetujui banyak pengajuan cuti |
| `employees` | `overtimes` | 1 : N | `overtimes.employee_id` | Karyawan punya banyak lembur |
| `employees` | `overtimes` | 1 : N | `overtimes.approved_by` | Karyawan menyetujui banyak lembur |
| `employees` | `payrolls` | 1 : N | `payrolls.employee_id` | Karyawan punya banyak slip gaji |

## Unique Constraints

| Tabel | Kolom | Keterangan |
|---|---|---|
| `schedules` | `(employee_id, date)` | Satu jadwal per karyawan per hari |
| `attendance` | `(employee_id, date)` | Satu absensi per karyawan per hari |
| `payrolls` | `(employee_id, period)` | Satu slip gaji per karyawan per periode |

## Cascade Rules

| Relasi | On Delete | Penjelasan |
|---|---|---|
| `employees.user_id` → `users` | `CASCADE` | Hapus user = hapus data employee |
| `employees.department_id` → `departments` | `SET NULL` | Hapus departemen = employee tanpa departemen |
| `employees.position_id` → `positions` | `SET NULL` | Hapus jabatan = employee tanpa jabatan |
| `schedules.employee_id` → `employees` | `CASCADE` | Hapus employee = hapus semua jadwal |
| `schedules.shift_id` → `shifts` | `CASCADE` | Hapus shift = hapus semua jadwal terkait |
| `attendance.employee_id` → `employees` | `CASCADE` | Hapus employee = hapus semua absensi |
| `leave_requests.*` → parent | `CASCADE` | Hapus employee/leave_type = hapus pengajuan |
| `leave_requests.approved_by` → `employees` | `SET NULL` | Hapus approver = approval kosong |
| `overtimes.*` → parent | `CASCADE` | Hapus employee = hapus semua lembur |
| `overtimes.approved_by` → `employees` | `SET NULL` | Hapus approver = approval kosong |
| `payrolls.employee_id` → `employees` | `CASCADE` | Hapus employee = hapus semua slip gaji |

## Database Tables

### Authentication & System (Laravel Default)

| Tabel | Fungsi |
|---|---|
| `users` | Akun login (name, email, password) |
| `password_reset_tokens` | Token reset password |
| `sessions` | Session storage (database driver) |
| `cache` / `cache_locks` | Cache storage |
| `jobs` / `job_batches` / `failed_jobs` | Queue system |
| `personal_access_tokens` | Sanctum API tokens |

### Business Domain

| Tabel | Fungsi |
|---|---|
| `employees` | Data lengkap karyawan (profile, kontak, kontrak) |
| `departments` | Unit organisasi (HRD, Engineering, dll) |
| `positions` | Jabatan dengan range gaji |
| `shifts` | Definisi jam kerja (pagi, siang, malam) |
| `schedules` | Penugasan shift ke karyawan per hari |
| `attendance` | Log absensi masuk/keluar |
| `leave_types` | Jenis cuti (tahunan, sakit, dll) |
| `leave_requests` | Pengajuan cuti dengan approval flow |
| `overtimes` | Pengajuan lembur dengan approval flow |
| `payrolls` | Slip gaji per periode |
