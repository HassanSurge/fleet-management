<?php

namespace Database\Seeders;

use App\Models\Make;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class MakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makes = new Collection([
            'Toyota',
            'Honda',
            'Suzuki',
            'Tesla',
            'KTM'
        ]);

        $collection = $makes->map(function (string $make, int $index) {
            return [
                'id' => $index + 1,
                'name' => $make
            ];
        });

        Make::upsert($collection->toArray(), ['id'], ['name']);
    }
}
