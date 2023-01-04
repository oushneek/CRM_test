<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($company_id)
    {
        try{
            $employees=Employee::where('company_id','=',$company_id)->paginate(10);
            $company=Company::find($company_id);
            return view('employee.index', compact(['employees','company']));
        }catch (\Exception $e){
            return redirect()->back()->with('error','Could Not Access.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id)
    {
        try{
            $company=Company::find($company_id);
            return view('employee.create',compact(['company']));
        }catch (\Exception $e){
            return redirect()->back()->with('error','Could Not Load View');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeCreateRequest $request)
    {
        try{
            $data = $request->only(['company_id','first_name','last_name', 'email','phone']);
            $employee=Employee::create($data);

            return redirect()->route('employee.index',$request['company_id'])->with('success', 'Employee Successfully');

        }catch(\Exception $e){
            return redirect()->route('employee.index',$request['company_id'])->with('error', 'Could Not Add Employee.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
