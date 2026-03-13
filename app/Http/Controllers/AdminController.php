<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function getStatics()
    {
        return response()->json([
            'total_books' => Book::count(),
            'total_copies' => Book::sum('quantity'),
            'damaged_copies' => Book::sum('damaged_quantity'),
            'total_categories' => Category::count(),
            'top_five' => Book::withCount("borrowings")->orderByDesc('borrowings_count')->take(5)->get(),
        ], 200);
    }
}
