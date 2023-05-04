<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Http\Requests\LoanUpdateRequest;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanRequest $request)
    {
        $copy = Copy::find($request->copy_id);
        if ($copy->status == "borrowed") {
            return response()->json(["msg" => "Cópia não disponível"], 422);
        }

        $loan = Loan::create($request->all());

        $copy->update([
            "status" => "borrowed"
        ]);

        $loanData = $loan;

        return LoanResource::collection($loanData);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(LoanUpdateRequest $request, Loan $id)
    {
        $loan = Loan::find($id);
        if ($loan) {
            $loan->update($request->status);
            return new LoanResource($loan);
        }
        return response()->json(['error' => '404 Not Found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = Loan::find($id);
        if ($loan) {
            $loan->delete();
            return response()->json(null, 204);
        }
        return response()->json(['error' => '404 Not Found'], 404);
    }
}
