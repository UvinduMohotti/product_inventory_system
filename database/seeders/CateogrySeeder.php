<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CateogrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories =[['name' => 'Mobile Phone'],['name' => 'Computer'], ['name' => 'Product 01']];
        DB::table('categories')->insert($categories);
    }
}
