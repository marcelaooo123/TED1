<?php

namespace App\Http\Controllers;

use App\Http\Resources\CopyResource;
use App\Http\Resources\LoanResource;
use App\Models\Copy;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::with(['user', 'copy'])->get();
        return LoanResource::collection($loans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            // 'book_id' => 'required|exist:books,id',
            'copy_id' => 'required|exists:copies,id',
            'user_date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $copy = Copy::find($request->copy_id);
        if ($copy->status == "borrowed") {
            return response()->json(["msg" => "Cópia não disponível"], 422);
        }

        $loan = Loan::create($request->all());

        $copy->update([
            "status" => "borrowed"
        ]);

        $loanData = $loan;

        return response()->json([
            "loan" => $loanData,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loans = Loan::where('id', $id)->with(['user', 'copy'])->get();
        return LoanResource::collection($loans);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
