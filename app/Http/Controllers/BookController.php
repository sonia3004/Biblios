<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Affiche la liste des livres
    public function index()
    {
        $books = Book::all();
        return inertia('Books/Index', ['books' => $books, 'flash' => session()->all()]);
    }

    // Rechercher un livre
    public function search(Request $request)
    {
        $books = Book::query()
            ->when($request->title, fn($query, $title) => $query->where('title', 'like', "%$title%"))
            ->when($request->author, fn($query, $author) => $query->where('author', 'like', "%$author%"))
            ->get();

        return inertia('Books/Index', ['books' => $books, 'flash' => session()->all()]);
    }

    // Affiche le formulaire de réservation
    public function showReserveForm($id)
    {
        $book = Book::findOrFail($id);

        if (!$book->available) {
            return back()->with('error', 'Le livre est déjà réservé.');
        }

        return inertia('Books/ReserveForm', ['book' => $book]);
    }

    // Réserver un livre
    public function reserve(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $book = Book::findOrFail($id);

        if (!$book->available) {
            return back()->with('error', 'Le livre est déjà réservé.');
        }

        // Met à jour les informations de réservation
        $book->update([
            'available' => false,
            'reserved_by_first_name' => $request->first_name,
            'reserved_by_last_initial' => strtoupper($request->last_name[0]),
        ]);

        return redirect('/books')->with('success', 'Livre réservé avec succès.');
    }

    // Ajouter ou retirer un livre des favoris
    public function toggleFavorite($id)
    {
        $book = Book::findOrFail($id);

        if (auth()->user()->favorites()->where('book_id', $id)->exists()) {
            auth()->user()->favorites()->detach($book);
        } else {
            auth()->user()->favorites()->attach($book);
        }

        return back()->with('success', 'Favori mis à jour.');
    }
}
