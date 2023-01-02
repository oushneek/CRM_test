<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyCreateRequest $request)
    {
        try{
            $data = $request->only(['name', 'email','website']);
            // Logo Upload
            if($request['logo']) {
                $now=Carbon::now()->format('YmdHs');
                $logo =$now.preg_replace('/\s+/', '_', $request['name'])  . '_logo.' . $request['logo']->getClientOriginalExtension();
                $request['logo']->move(public_path('images/'), $logo);
                $data['logo'] = $logo;
            }

            $company=Company::create($data);

            return redirect()->route('dashboard')->with('success', 'Company Created Successfully');

        }catch(\Exception $e){
            return redirect()->route('dashboard')->with('error', 'Could Not Create Company.');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
