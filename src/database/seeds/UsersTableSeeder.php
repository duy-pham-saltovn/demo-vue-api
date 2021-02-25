<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        User::truncate();

        $uuid = Uuid::uuid4();

        factory(User::class)->create([
            'uuid' => $uuid,
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'full_name' => 'Pham Duy',
            'activated' => 0
        ]);

//        factory(User::class, 50)->create();
    }
}
