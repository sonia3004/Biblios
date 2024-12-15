import React from 'react';
import { useForm } from '@inertiajs/react';

export default function Index({ books, flash }) {
    const { data, setData, get } = useForm({
        title: '',
        author: '',
    });

    const handleSearch = (e) => {
        e.preventDefault();
        get('/books/search'); // Envoie la requête GET au backend
    };

    return (
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {/* Notifications */}
            {flash?.success && (
                <div className="bg-green-100 text-green-800 p-4 rounded-md mb-6">
                    {flash.success}
                </div>
            )}
            {flash?.error && (
                <div className="bg-red-100 text-red-800 p-4 rounded-md mb-6">
                    {flash.error}
                </div>
            )}

            {/* Titre principal */}
            <h1 className="text-3xl font-bold text-center mt-8 text-gray-800">Catalogue de Livres</h1>

            {/* Formulaire de recherche */}
            <form onSubmit={handleSearch} className="mt-8 bg-gray-100 p-6 rounded-lg shadow-md">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label htmlFor="title" className="block text-sm font-medium text-gray-700">
                            Titre :
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            placeholder="Rechercher par titre"
                            value={data.title}
                            onChange={(e) => setData('title', e.target.value)}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>
                    <div>
                        <label htmlFor="author" className="block text-sm font-medium text-gray-700">
                            Auteur :
                        </label>
                        <input
                            type="text"
                            id="author"
                            name="author"
                            placeholder="Rechercher par auteur"
                            value={data.author}
                            onChange={(e) => setData('author', e.target.value)}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>
                </div>
                <button
                    type="submit"
                    className="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Rechercher
                </button>
            </form>

            {/* Liste des livres */}
            <ul className="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {books.map((book) => (
                    <li key={book.id} className="bg-white shadow rounded-lg p-6">
                        <h2 className="text-lg font-semibold text-gray-800">{book.title}</h2>
                        <p className="text-gray-700 mt-2">Auteur : {book.author}</p>
                        <p className="text-gray-500 text-sm mt-1">Genre : {book.genre}</p>
                        <p className="mt-4">
                            <span
                                className={`inline-block px-3 py-1 text-sm font-medium rounded-full ${
                                    book.available
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-red-100 text-red-800'
                                }`}
                            >
                                {book.available
                                    ? 'Disponible'
                                    : book.reserved_by_first_name && book.reserved_by_last_initial
                                    ? `Réservé par ${book.reserved_by_first_name} ${book.reserved_by_last_initial}`
                                    : 'Réservé'}
                            </span>
                        </p>
                        {book.available && (
                            <a
                                href={`/books/reserve/${book.id}`}
                                className="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            >
                                Réserver
                            </a>
                        )}
                    </li>
                ))}
            </ul>
        </div>
    );
}
