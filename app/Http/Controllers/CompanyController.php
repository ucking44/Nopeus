<?php

namespace App\Http\Controllers;

use Validator;
use App\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::paginate(5);
        return view('company.index', compact('company'));
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
        //dd($request->all());
        $company = $request->all();

        $filenameWithExtension = $request->file('logo')->getClientOriginalName();

        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

        $extension = $request->file('logo')->getClientOriginalName();

        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        $request->file('logo')->move('logos', $filenameToStore);
        //dd($request->all());

        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        // $company->logo = $logoName;
        $company->logo = $filenameToStore;
        $company->website = $request->input('website');
        $company->save();

        return redirect()->back()->with('status', 'Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        // if($company->user_id != Auth::id())
        // {
        //     //Toastr::error('You Are Not Authorized To Access This Page', 'Error');
        //     return redirect()->back()->with('status', 'You Are Not Authorized To Access This Page');;
        // }

        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->update();

        return redirect('company')->with('status', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->back()->with('status', 'Data Deleted Successfully');
    }
}
