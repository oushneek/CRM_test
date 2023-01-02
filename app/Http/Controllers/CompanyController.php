<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
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
        $companies=Company::paginate(10);
        return view('company.index', compact(['companies']));

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

            return redirect()->route('company.index')->with('success', 'Company Created Successfully');

        }catch(\Exception $e){
            return redirect()->route('company.index')->with('error', 'Could Not Create Company.');
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
    public function edit($id)
    {
        $company=Company::find($id);
        return view('company.edit', compact(['company']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, $id)
    {

        try{
            $data = $request->only(['id','name', 'email','website']);
            // Logo Upload
            if($request['logo']) {
                $now=Carbon::now()->format('YmdHs');
                $logo =$now.preg_replace('/\s+/', '_', $request['name'])  . '_logo.' . $request['logo']->getClientOriginalExtension();
                $request['logo']->move(public_path('images/'), $logo);
                $data['logo'] = $logo;
            }
            $company=Company::find($id);
            $company->update($data);
            if($company->isDirty())
                return redirect()->route('company.index')->with('success', 'Company Updated Successfully');
            else
                return redirect()->route('company.index')->with('info', 'Company Saved without any change.');


        }catch(\Exception $e){
            return redirect()->route('company.index')->with('error', 'Could Not Update Company.');
        }
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
