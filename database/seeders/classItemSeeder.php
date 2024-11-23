<?php

namespace Database\Seeders;

use App\Models\classItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class classItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     

        classItem::factory()->create();
            
    }
}
