<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // $books = Book::all();
        $books = Book::paginate(5);
        return view('book.index', compact('books'));
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(BookStoreRequest $request)
    {
        // $request->validate();
        $image = $request->file('image')->store('public/product');
        Book::create(
            [
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'image' => $image,
            ]
        );
        return back()->with('message', 'New book added');
    }

    public function edit($id)
    {
        $books = Book::find($id);
        return view('book.edit', compact('books'));
    }

    public function update(UpdateStoreRequest $request, $id)
    {
        $books = Book::find($id);
        if ($request->hasFile('image')) {
            $books->name = $request->name;
            $books->description = $request->description;
            $books->category = $request->category;
            $books->image =  $request->file('image')->store('public/product');
            $books->save();
        } else {
            $books->name = $request->name;
            $books->description = $request->description;
            $books->category = $request->category;
            $books->save();
        }
        return redirect()->route('book.index')->with('message', 'Book updated');
    }

    public function delete($id)
    {
        $books = Book::find($id);
        $books->delete();

        return redirect()->route('book.index')->with('message', 'Book Deleted');
    }
}
