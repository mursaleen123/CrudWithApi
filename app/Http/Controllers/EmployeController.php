<?php

namespace App\Http\Controllers;

use App\Jobs\MatchSendEmail;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class EmployeController extends Controller
{
    //
    public function index()
    {
        $employe = Employe::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('crud.index')->with('employes', $employe);
    }
    public function create(Request $request)
    {
        if ($request->id == 0) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->Back()
                    ->withErrors($validator)
                    ->withInput($request->all());
            }
        }


        dispatch(new MatchSendEmail);

        $collection = $request->except(['_token', '_mehtod']);
        Employe::updateOrCreate(['id' => $request->id], $collection);

        return redirect()->back();
    }
    public function destroy($id)
    {

        try {
            $id == -1 ?   Employe::truncate() :  Employe::find($id)->delete();

            return redirect()->back();
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }
}
