<?php

namespace Tests\Feature\Livewire;

use App\Livewire\LoginPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LoginPage::class)
            ->assertStatus(200);
    }
}
