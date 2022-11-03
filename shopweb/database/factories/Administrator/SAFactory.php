<?php

namespace Database\Factories\Administrator;

use App\Models\Administrator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SAFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Administrator::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'SA',
            'username' => 'sa',
            'email' => null,
            'email_verified_at' => null,
            'password' => Hash::make("sa"),
            'profile_photo_path' => null,
        ];
    }
}
