<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addresses = [
            [
                'lot' => '123',
                'block' => 'A',
                'street' => 'Sample Street',
                'subdivision' => 'Sample Subdivision',
                'barangay' => 'Sample Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4102',
                'profile_id' => 1,
            ],
            [
                'lot' => '456',
                'block' => 'B',
                'street' => 'Example Street',
                'subdivision' => 'Example Subdivision',
                'barangay' => 'Example Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4103',
                'profile_id' => 2,
            ],
            [
                'lot' => '789',
                'block' => 'C',
                'street' => 'Test Street',
                'subdivision' => 'Test Subdivision',
                'barangay' => 'Test Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4104',
                'profile_id' => 3,
            ],
            [
                'lot' => '1011',
                'block' => 'D',
                'street' => 'Demo Street',
                'subdivision' => 'Demo Subdivision',
                'barangay' => 'Demo Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4105',
                'profile_id' => 4,
            ],
            [
                'lot' => '1314',
                'block' => 'E',
                'street' => 'Illustration Street',
                'subdivision' => 'Illustration Subdivision',
                'barangay' => 'Illustration Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4106',
                'profile_id' => 5,
            ],
            [
                'lot' => '1516',
                'block' => 'F',
                'street' => 'Design Street',
                'subdivision' => 'Design Subdivision',
                'barangay' => 'Design Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4107',
                'profile_id' => 6,
            ],
            [
                'lot' => '1718',
                'block' => 'G',
                'street' => 'Sample Street',
                'subdivision' => 'Sample Subdivision',
                'barangay' => 'Sample Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4108',
                'profile_id' => 7,
            ],
            [
                'lot' => '1920',
                'block' => 'H',
                'street' => 'Example Street',
                'subdivision' => 'Example Subdivision',
                'barangay' => 'Example Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4109',
                'profile_id' => 8,
            ],
            [
                'lot' => '2122',
                'block' => 'I',
                'street' => 'Test Street',
                'subdivision' => 'Test Subdivision',
                'barangay' => 'Test Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4110',
                'profile_id' => 9,
            ],
            [
                'lot' => '2324',
                'block' => 'J',
                'street' => 'Demo Street',
                'subdivision' => 'Demo Subdivision',
                'barangay' => 'Demo Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4111',
                'profile_id' => 10,
            ],
            [
                'lot' => '2526',
                'block' => 'K',
                'street' => 'Illustration Street',
                'subdivision' => 'Illustration Subdivision',
                'barangay' => 'Illustration Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4112',
                'profile_id' => 11,
            ],
            [
                'lot' => '2728',
                'block' => 'L',
                'street' => 'Design Street',
                'subdivision' => 'Design Subdivision',
                'barangay' => 'Design Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4113',
                'profile_id' => 12,
            ],
            [
                'lot' => '2930',
                'block' => 'M',
                'street' => 'Sample Street',
                'subdivision' => 'Sample Subdivision',
                'barangay' => 'Sample Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4114',
                'profile_id' => 13,
            ],
            [
                'lot' => '3132',
                'block' => 'N',
                'street' => 'Example Street',
                'subdivision' => 'Example Subdivision',
                'barangay' => 'Example Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4115',
                'profile_id' => 14,
            ],
            [
                'lot' => '3334',
                'block' => 'O',
                'street' => 'Test Street',
                'subdivision' => 'Test Subdivision',
                'barangay' => 'Test Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4116',
                'profile_id' => 15,
            ],
            [
                'lot' => '3536',
                'block' => 'P',
                'street' => 'Demo Street',
                'subdivision' => 'Demo Subdivision',
                'barangay' => 'Demo Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4117',
                'profile_id' => 16,
            ],
            [
                'lot' => '3738',
                'block' => 'Q',
                'street' => 'Illustration Street',
                'subdivision' => 'Illustration Subdivision',
                'barangay' => 'Illustration Barangay',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zipCode' => '4118',
                'profile_id' => 17,
            ],
        ];

        foreach ($addresses as $address) {
            DB::table('addresses')->insert([
                'lot' => $address['lot'],
                'block' => $address['block'],
                'street' => $address['street'],
                'subdivision' => $address['subdivision'],
                'barangay' => $address['barangay'],
                'city' => $address['city'],
                'province' => $address['province'],
                'zipCode' => $address['zipCode'],
                'profile_id' => $address['profile_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
    }
}
