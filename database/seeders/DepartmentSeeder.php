<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Human Resources',     'code' => 'HR',   'description' => 'Manajemen sumber daya manusia, rekrutmen, dan pengembangan karir'],
            ['name' => 'Finance & Accounting', 'code' => 'FIN',  'description' => 'Pengelolaan keuangan, pembukuan, dan pelaporan keuangan'],
            ['name' => 'Information Technology','code' => 'IT',   'description' => 'Pengembangan dan pemeliharaan sistem informasi serta infrastruktur teknologi'],
            ['name' => 'Marketing',           'code' => 'MKT',  'description' => 'Pemasaran, branding, dan promosi produk'],
            ['name' => 'Operations',          'code' => 'OPS',  'description' => 'Pengelolaan operasional harian dan proses bisnis'],
            ['name' => 'Sales',               'code' => 'SLS',  'description' => 'Penjualan, hubungan pelanggan, dan akuisisi klien'],
            ['name' => 'Legal',               'code' => 'LEG',  'description' => 'Penanganan hukum, kontrak, dan kepatuhan regulasi'],
            ['name' => 'Administration',      'code' => 'ADM',  'description' => 'Tata usaha, fasilitas, dan dukungan kantor'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}
