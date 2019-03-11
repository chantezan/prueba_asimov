<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
        'name' => 'required',
        'last_name' => 'required',
        'date' => 'required',
        'email' => 'required|email|max:255',
    ]);
      $book = new Book($request->all());

      if(!$book->save()){

        return Response('',400);
      }
      return response()->json($book, 200);
  }

  /**
   * Display the specified resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
      return response()->json(Book::whereBetween('date',[$request->from,$request->to])->get(), 200);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request)
  {
    $validatedData = $request->validate([
        'id' => 'required',
    ]);
    $book = Book::find($request->id);
    $book->fill($request->all());
    if(!$book->save()){
      return Response('',400);
    }
    return response()->json($book, 200);
  }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
      $book = Book::find($request->id);
      $book->delete();
    }
}
