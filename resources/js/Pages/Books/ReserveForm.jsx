import React from 'react';
import { useForm } from '@inertiajs/react';

export default function ReserveForm({ book }) {
    const { data, setData, post, errors } = useForm({
        first_name: '',
        last_name: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(`/books/reserve/${book.id}`);
    };

    return (
        <div className="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 className="text-2xl font-bold text-center mt-8 text-gray-800">
                Réserver : {book.title}
            </h1>

            <form onSubmit={handleSubmit} className="mt-8 bg-gray-100 p-6 rounded-lg shadow-md">
                <div>
                    <label htmlFor="first_name" className="block text-sm font-medium text-gray-700">
                        Prénom :
                    </label>
                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        value={data.first_name}
                        onChange={(e) => setData('first_name', e.target.value)}
                        className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                    {errors.first_name && (
                        <div className="text-red-500 text-sm mt-1">{errors.first_name}</div>
                    )}
                </div>
                <div className="mt-4">
                    <label htmlFor="last_name" className="block text-sm font-medium text-gray-700">
                        Nom :
                    </label>
                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        value={data.last_name}
                        onChange={(e) => setData('last_name', e.target.value)}
                        className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                    {errors.last_name && (
                        <div className="text-red-500 text-sm mt-1">{errors.last_name}</div>
                    )}
                </div>
                <button
                    type="submit"
                    className="mt-6 w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Réserver
                </button>
            </form>
        </div>
    );
}
