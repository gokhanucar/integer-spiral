<?php

namespace Tests\Unit;

use App\Models\Layout;
use Tests\TestCase;

class LayoutTest extends TestCase
{
    /**
     * Layout create test.
     *
     * @return void
     */
    public function testCanCreateLayout()
    {
        $data = [
            'x' => random_int(1, 10),
            'y' => random_int(1, 10)
        ];

        $this->post(route('layouts.store'), $data)
            ->assertStatus(201);
    }

    /**
     * List all layouts test.
     *
     * @return void
     */
    public function testCanListLayouts()
    {
        $layout1 = Layout::factory()->create();
        $layout2 = Layout::factory()->create();

        $this->get(route('layouts.index'))
            ->assertStatus(200);
    }

    /**
     * Get layout value test.
     *
     * @return void
     */
    public function testCanGetLayoutValue()
    {
        $layout = Layout::factory()->create();
        $params = [
            'layoutId' => $layout->layoutId,
            'x' => random_int(0, $layout->x - 1),
            'y' => random_int(0, $layout->y - 1)
        ];

        $this->get(route('layouts.value', $params))
            ->assertStatus(200);
    }

    /**
     * Get layout single record test.
     *
     * @return void
     */
    public function testCanGetLayoutSingle()
    {
        $layout = Layout::factory()->create();

        $this->get(route('layouts.show', $layout->layoutId))
            ->assertStatus(200);
    }
}
