<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\Amenity;

class PropertyAmenitySeeder extends Seeder
{
    public function run()
    {
        $generalAmenities = Amenity::factory(12)->create();

        $properties = Property::all();
        foreach ($properties as $property) {
            $numberOfRooms = rand(1, 5) . " rooms";
            $roomAmenity = Amenity::create(['name' => $numberOfRooms]);

            $randomAmenities = $generalAmenities->random(4);

            $property->amenities()->sync(
                $randomAmenities->pluck('id')->toArray()
            );

            $property->amenities()->attach($roomAmenity->id);
        }

        $this->command->info('Seeded properties with 1 "Number of Rooms" and 4 random amenities each.');
    }
}

