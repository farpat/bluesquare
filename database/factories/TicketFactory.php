<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type'        => array_rand(Ticket::getTypes()),
            'title'       => $this->faker->sentence,
            'priority'    => array_rand(Ticket::getPriorities()),
            'status'    => array_rand(Ticket::getStatuses()),
            'description' => $this->faker->paragraph,
            'context'     => $this->faker->paragraph,
        ];
    }
}
