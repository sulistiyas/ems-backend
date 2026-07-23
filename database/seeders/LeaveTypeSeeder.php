<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        $leaveTypes = [
            ['name' => 'Annual Leave',     'code' => 'AL',  'default_days' => 12, 'is_paid' => true,  'description' => 'Cuti tahunan untuk karyawan aktif'],
            ['name' => 'Sick Leave',        'code' => 'SL',  'default_days' => 12, 'is_paid' => true,  'description' => 'Cuti sakit dengan surat keterangan dokter'],
            ['name' => 'Personal Leave',    'code' => 'PL',  'default_days' => 3,  'is_paid' => true,  'description' => 'Cuti pribadi untuk keperluan mendesak'],
            ['name' => 'Maternity Leave',   'code' => 'ML',  'default_days' => 90, 'is_paid' => true,  'description' => 'Cuti melahirkan sesuai peraturan ketenagakerjaan'],
            ['name' => 'Paternity Leave',   'code' => 'PTL', 'default_days' => 5,  'is_paid' => true,  'description' => 'Cuti ayah saat kelahiran anak'],
            ['name' => 'Marriage Leave',    'code' => 'MRL', 'default_days' => 3,  'is_paid' => true,  'description' => 'Cuti saat menikah'],
            ['name' => 'Bereavement Leave', 'code' => 'BL',  'default_days' => 3,  'is_paid' => true,  'description' => 'Cuti saat duka cita keluarga'],
            ['name' => 'Unpaid Leave',      'code' => 'UL',  'default_days' => 0,  'is_paid' => false, 'description' => 'Cuti tanpa dibayar untuk keperluan tertentu'],
        ];

        foreach ($leaveTypes as $type) {
            LeaveType::create($type);
        }
    }
}
