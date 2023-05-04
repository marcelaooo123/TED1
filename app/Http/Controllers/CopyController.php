<?php

namespace App\Http\Controllers;

use App\Http\Requests\CopyEmprestimoRequest;
use App\Http\Requests\CopyRequest;
use App\Http\Requests\CopyUpdateRequest;
use App\Http\Resources\CopyResource;
use App\Models\Copy;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CopyController extends Controller
{
    private $copy;
    public function __construct(Copy $copy)
    {
        $this->copy = $copy;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        $copies = Copy::all();
        return CopyResource::collection($copies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CopyRequest $request)
    {
        $copy = Copy::create($request->all());
        return new CopyResource($copy);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Copy  $copy
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $copy = Copy::find($id);
        if ($copy) {
            return new CopyResource($copy);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Copy  $copy
     * @return \Illuminate\Http\Response
     */
    public function update(CopyUpdateRequest $request, $id)
    {
        $copy = $this->copy->find($id);
        if ($copy) {
            $copy->update($request->all());
            return new CopyResource($copy);
        }
        return response()->json(['error' => '404 Not Found'], 404);
    }

    public function emprestimo(CopyEmprestimoRequest $request, $id)
    {
        $copy = $this->copy->find($id);
        if ($copy) {
            $copy->update($request->status);
            return new CopyResource($copy);
        }
        return response()->json(['error' => '404 Not Found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Copy  $copy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $copy = $this->copy->find($id);
        if ($copy) {
            $copy->delete();
            return response()->json(null, 204);
        }
        return response()->json(['error' => '404 Not Found'], 404);
    }
}
