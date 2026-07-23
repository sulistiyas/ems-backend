<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            ['name' => 'Staff',           'code' => 'STF', 'min_salary' => 3000000,  'max_salary' => 5000000,  'description' => 'Jabatan staf operasional'],
            ['name' => 'Senior Staff',    'code' => 'SRF', 'min_salary' => 5000000,  'max_salary' => 8000000,  'description' => 'Staf senior dengan pengalaman 3+ tahun'],
            ['name' => 'Supervisor',      'code' => 'SPV', 'min_salary' => 7000000,  'max_salary' => 10000000, 'description' => 'Pengawas tim dengan tanggung jawab manajerial'],
            ['name' => 'Manager',         'code' => 'MGR', 'min_salary' => 10000000, 'max_salary' => 18000000, 'description' => 'Manajer departemen atau divisi'],
            ['name' => 'Senior Manager',  'code' => 'SMGR','min_salary' => 15000000, 'max_salary' => 25000000, 'description' => 'Manajer senior dengan tanggung jawab strategis'],
            ['name' => 'Director',        'code' => 'DIR', 'min_salary' => 20000000, 'max_salary' => 35000000, 'description' => 'Direktur divisi atau unit bisnis'],
            ['name' => 'VP',              'code' => 'VP',  'min_salary' => 30000000, 'max_salary' => 50000000, 'description' => 'Wakil presiden bidang fungsional'],
            ['name' => 'Chief',           'code' => 'CXL', 'min_salary' => 40000000, 'max_salary' => 80000000, 'description' => 'C-level executive (CEO, CFO, CTO, dll)'],
        ];

        foreach ($positions as $pos) {
            Position::create($pos);
        }
    }
}
