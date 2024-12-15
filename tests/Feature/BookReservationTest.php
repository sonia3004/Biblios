<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase; // Réinitialise la base de données après chaque test

    /** @test */
    public function it_displays_the_homepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_reserve_a_book()
    {
        // Crée un utilisateur et un livre disponible
        $user = User::factory()->create();
        $book = Book::factory()->create(['available' => true]);

        // Simule une réservation par l'utilisateur
        $this->actingAs($user)
             ->post("/books/reserve/{$book->id}", [
                 'first_name' => 'Sonia',
                 'last_name' => 'B'
             ])
             ->assertRedirect('/books'); // Vérifie la redirection après la réservation

        // Vérifie que la réservation a bien été enregistrée dans la base de données
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'available' => false,
            'reserved_by_first_name' => 'Sonia',
            'reserved_by_last_initial' => 'B',
        ]);
    }

    /** @test */
    public function a_user_cannot_reserve_an_already_reserved_book()
    {
        // Crée un utilisateur et un livre déjà réservé
        $user = User::factory()->create();
        $book = Book::factory()->create(['available' => false]);

        // Simule une tentative de réservation
        $this->actingAs($user)
             ->post("/books/reserve/{$book->id}", [
                 'first_name' => 'Sonia',
                 'last_name' => 'B'
             ])
             ->assertSessionHas('error', 'Le livre est déjà réservé.');

        // Vérifie que le statut du livre n'a pas changé
        $this->assertTrue($book->fresh()->available === false);
    }
}
