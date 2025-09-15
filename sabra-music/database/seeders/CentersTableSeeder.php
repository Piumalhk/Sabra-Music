<?php

namespace Database\Seeders;

use App\Models\Center;
use Illuminate\Database\Seeder;

class CentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define our new centers
        $centers = [
            [
                'name' => 'Art Center',
                'location' => 'Main Campus',
                'description' => 'A versatile space for art exhibitions and performances.',
                'price_per_hour' => 50.00,
                'is_active' => true,
            ],
            [
                'name' => 'Matta',
                'location' => 'East Wing',
                'description' => 'Traditional performance space with excellent acoustics.',
                'price_per_hour' => 75.00,
                'is_active' => true,
            ],
            [
                'name' => 'Pnibharatha Open Air Theater',
                'location' => 'North Campus',
                'description' => 'Outdoor theater for performances under the stars.',
                'price_per_hour' => 100.00,
                'is_active' => true,
            ],
            [
                'name' => 'Prof J.W. Dyananda Somasundara Auditorium',
                'location' => 'Faculty of Arts',
                'description' => 'Modern auditorium with state-of-the-art audio-visual facilities.',
                'price_per_hour' => 150.00,
                'is_active' => true,
            ],
            [
                'name' => 'Other',
                'location' => 'Various',
                'description' => 'Other campus venues available upon request.',
                'price_per_hour' => 30.00,
                'is_active' => true,
            ],
        ];
        
        // Get existing centers
        $existingCenters = Center::all();
        
        // Update existing centers first
        for ($i = 0; $i < min(count($existingCenters), count($centers)); $i++) {
            $existingCenters[$i]->update($centers[$i]);
        }
        
        // Add any remaining new centers
        for ($i = count($existingCenters); $i < count($centers); $i++) {
            Center::create($centers[$i]);
        }
    }
}
