<?php

use Illuminate\Database\Seeder;
use App\Models\{
	User,
	Product,
	Config	
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            "username" => "admin",
            "email" => "admin@admin.com",
            "password" => "12345678",
            "phone" => "08976543210",
            "role" => "admin"
        ]);

        User::create([
           "username"  => "user",
           "email" => "user@user.com",
           "password" => "12345678",
           "phone" => "0897654321",                    
        ]);

        for($i=0;$i<100;$i++){
            User::create([
                "username" => "user".$i,
                "email" => "user".$i."@user.com",
                "password" => "12345678",
                "phone" => "08977667887".$i 
            ]);
        }

        Config::create([
            "name" => "site_name",
            "value" => "zbola"
        ]);

        Config::create([
            "name" => "hours",
            "value" => 5
        ]);

        Config::create([
            "name" => "payment_day",
            "value" => 3
        ]);

        Config::create([
            "name" => "maintaince",
            "value" => 0
        ]);

        for($i=1;$i<100;$i++){
            Product::create([
                "address" => "address ".$i,
                "star" => 0,
                "description" => "Deskripsi",
                "fasilitas" => "Fasilitas",
                "quesation" => "Pertanyaan",
                "price" => rand(50000,100000),
                "images" => json_encode([rand(1,10).".png"]),                
            ]);
        }
    }
}
