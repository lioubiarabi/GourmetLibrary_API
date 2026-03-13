<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BookController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware('admin', except: ['index','getByCategory','show'])];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                    ->orWhere('author', 'like', $searchTerm);
            });
        }

        if ($request->has('sort')) {
            if ($request->sort === 'popular') {
                $query->withCount('borrowings')->orderByDesc('borrowings_count');
            }
        }

        return response()->json([
            'books' => $query->get()
        ], 200);
    }

    public function getByCategory($id)
    {
        $books = Book::with('category')->where('category_id', $id)->get();

        return response()->json([
            "books" => $books
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'damaged_quantity' => 'nullable|integer|min:0',
        ]);

        $book = Book::create($validated);

        return response()->json([
            'message' => 'The book is added successfully',
            'book' => $book->load('category')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'category_id' => 'sometimes|required|exists:categories,id',
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer|min:0',
            'damaged_quantity' => 'sometimes|required|integer|min:0',
        ]);

        $book->update($validated);

        return response()->json([
            'message' => 'The book is updated successfully',
            'book' => $book->load('category')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'message' => "Book: '{$book->title}' is deleted!"
        ], 200);
    }
}
