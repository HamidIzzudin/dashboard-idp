<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Company
        $companyIds = $this->seedCompany();

        // Seed Departments
        $deptIds = $this->seedDepartments();

        // Seed Positions
        $posIds = $this->seedPositions();

        // Seed Roles
        $roleIds = $this->seedRoles();

        // Seed Users
        $userIds = $this->seedUsers($roleIds, $companyIds, $deptIds, $posIds);

        // Seed IDP Types
        $this->seedIdpTypes();

        $this->command->info('✅ DatabaseSeeder completed successfully!');
        $this->command->info('   • Company: 1');
        $this->command->info('   • Departments: 4');
        $this->command->info('   • Positions: 6');
        $this->command->info('   • Roles: 6');
        $this->command->info('   • Users: 5');
        $this->command->info('   • IDP Types: 3');
    }

    /**
     * Seed company table
     */
    private function seedCompany(): array
    {
        $companys = ['PT. Tiga Serangkai Pustaka Mandiri', 'PT. Wangsa Jatra', 'PT. Assalam', 'PT. K33 Distriibusi'];
        $compIds = [];

        foreach ($companys as $name) {
            $compIds[$name] = DB::table('company')->insertGetId([
                'nama_perusahaan' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return $compIds;
    }

    /**
     * Seed departments
     */
    private function seedDepartments(): array
    {
        $departments = ['Human Resources', 'Operations', 'Finance', 'Board of Directors'];
        $deptIds = [];

        foreach ($departments as $name) {
            $deptIds[$name] = DB::table('department')->insertGetId([
                'nama_department' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $deptIds;
    }

    /**
     * Seed positions
     */
    private function seedPositions(): array
    {
        $positions = [
            ['Staff', 1],
            ['Supervisor', 2],
            ['Manager', 3],
            ['General Manager', 4],
            ['BOD', 5],
            ['PDC', 6],
            ['BO Director', 7]
        ];
        $posIds = [];

        foreach ($positions as [$name, $grade]) {
            $posIds[$name] = DB::table('position')->insertGetId([
                'position_name' => $name,
                'grade_level' => $grade,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $posIds;
    }

    /**
     * Seed roles
     */
    private function seedRoles(): array
    {
        $roles = ['admin_pdc', 'talent', 'atasan', 'mentor', 'finance', 'bod', 'kandidat'];
        $roleIds = [];

        foreach ($roles as $r) {
            $roleIds[$r] = DB::table('role')->insertGetId([
                'role_name' => $r,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $roleIds;
    }

    /**
     * Seed users and link roles
     */
    private function seedUsers(array $roleIds, array $companyIds, array $deptIds, array $posIds): array
    {
        $users = [
            [
                'nama' => 'Admin PDC',
                'username' => 'admin.pdc',
                'email' => 'pdc@admin.com',
                'password' => Hash::make('password123'),
                'role_id' => $roleIds['admin_pdc'],
                'role' => 'admin_pdc',
                'perusahaan_id' => $companyIds['PT. Tiga Serangkai Pustaka Mandiri'],
                'department_id' => $deptIds['Human Resources'],
                'position_id' => $posIds['PDC'],
            ],
            [
                'nama' => 'Budi Santoso',
                'username' => 'budi.santoso',
                'email' => 'budisantoso@mail.com',
                'password' => Hash::make('password123'),
                'role_id' => $roleIds['kandidat'],
                'role' => 'kandidat',
                'perusahaan_id' => $companyIds['PT. Tiga Serangkai Pustaka Mandiri'],
                'department_id' => $deptIds['Operations'],
                'position_id' => $posIds['Supervisor'],
            ],
            [
                'nama' => 'Siti Rahayu',
                'username' => 'siti.rahayu',
                'email' => 'sitirahayu@mail.com',
                'password' => Hash::make('password123'),
                'role_id' => $roleIds['atasan'],
                'role' => 'atasan',
                'perusahaan_id' => $companyIds['PT. Tiga Serangkai Pustaka Mandiri'],
                'department_id' => $deptIds['Operations'],
                'position_id' => $posIds['Manager'],
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'username' => 'ahmad.fauzi',
                'email' => 'ahmadfauzi@mail.com',
                'password' => Hash::make('password123'),
                'role_id' => $roleIds['mentor'],
                'role' => 'mentor',
                'perusahaan_id' => $companyIds['PT. Tiga Serangkai Pustaka Mandiri'],
                'department_id' => $deptIds['Human Resources'],
                'position_id' => $posIds['General Manager'],
            ],
            [
                'nama' => 'Rizky Pratama',
                'username' => 'rizky.pratama',
                'email' => 'rizky@mail.com',
                'password' => Hash::make('password123'),
                'role_id' => $roleIds['bod'],
                'role' => 'bod',
                'perusahaan_id' => $companyIds['PT. Tiga Serangkai Pustaka Mandiri'],
                'department_id' => $deptIds['Board of Directors'],
                'position_id' => $posIds['BO Director'],
            ],
        ];

        $userIds = [];
        foreach ($users as $user) {
            $role = $user['role_id'];
            // unset($user['role_id']);

            $userId = DB::table('users')->insertGetId([
                ...$user,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $userIds[$role] = $userId;

            // Link user to role in user_role table
            DB::table('user_role')->insert([
                'id_user' => $userId,
                'id_role' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $userIds;
    }

    /**
     * Seed IDP types
     */
    private function seedIdpTypes(): void
    {
        DB::table('idp_type')->insert([
            [
                'type_name' => 'Exposure',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Mentoring',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Learning',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
