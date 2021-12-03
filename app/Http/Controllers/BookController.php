<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Traits\ApiResponder;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponder;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return list of book
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return $this->successResponse($books);
    }

    /**
     * Create a new book
     * 
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:200',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1'
        ];

        $this->validate($request, $rules);

        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    /**
     * Show an existing author
     * 
     * @return Illuminate\Http\Response
     */
    public function show($book)
    {
        $book = Book::findOrFail($book);

        return $this->successResponse($book);
    }

    /**
     * Update an existing book
     * 
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $book)
    {
        $rules = [
            'name' => 'max:200',
            'gender' => 'max:10|in:male,female',
            'country' => 'max:200'
        ];

        $this->validate($request, $rules);

        $book = Book::findOrFail($book);
        $book->fill($request->all());
        if($book->isClean()){
            return $this->errorResponse('Atleast one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $book->save();

        return $this->successResponse($book); 
    }

    /**
     * Delete an existing book
     * 
     * @return Illuminate\Http\Response
     */
    public function destroy($book)
    {
        $book = Book::findOrFail($book);
        $book->delete();
        return $this->successResponse($book);
    }
}
