<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_id' => fake()->numberBetween(1, 100),
            'payment_method' => fake()->randomElement(['Cash', 'Credit Card', 'Bank Transfer', 'EWallet']),
            'status' => fake()->randomElement(['Paid', 'Pending', 'Refunded', 'Failed']),
            'amount' => fake()->randomFloat(2, 80, 350),
            'paid_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
