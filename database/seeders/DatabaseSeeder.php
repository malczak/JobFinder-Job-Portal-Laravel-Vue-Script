<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Company;
use App\Models\Offer;
use App\Models\Post;
use App\Models\Role;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::truncate();

        $categories = [
            'Kelner / Kelnerka',
            'Kucharz',
            'Sprzedawca / Kasjer',
        ];
        foreach($categories as $category){
            Category::create(
                [
                'name'=> $category,
                'slug'=> Str::slug($category),
                'status'=> '1'
                ]
            );
        }

        $admin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email'=> 'super-admin@gastroworks.io',
            'role'=> 'super_admin',
            'status'=> '1',
            'password'=> bcrypt('lour-conifer-carving-squeal'),
            'email_verified_at'=> NOW()
        ]);
    }
}
