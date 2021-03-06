<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use App\GraphiqueStudent;
use App\Mail\NewUserWelcomMail;
use App\MatiereCustomers;
use App\Mail\WelcomeMail;
use App\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class CustomerController extends Controller
{
    /*public function index(Request $request){

       $customers = Customer::where('active',$request->query('active', 1))->get();

       return view('customer.index',compact('customers'));
    }
    */

    public function __construct()
    {
       $this->middleware('auth');
    }




    public function create(Customer $customer){


        Customer::where('id',$customer)->first();


        return view('customer.create',compact('customer'));
    }



    public function store(){


        $data = request()->validate([

            'nom'=>'required',
            'prenom'=>'required',
            'classe'=>'required',
            'telephone'=>'required',
            'ecole'=>'required',
            //'user_id'=>'required',


        ]);

        Mail::to($customer->email)->send(new NewUserWelcomMail());

        //dd($data);
        $customers = auth()->user()->customer()->create($data);





        return redirect('/customers/'.$customers->id);


    }



    public function show(Customer $customer){


        //Customer::where('id',$customer)->first();

       return view ('customer.show', compact('customer'));
    }



/*
    public function edit(Customer $customer){

        $customer = Customer::all();

        return view ('customers.edit', compact('customer'));

    }



    public function update(Customer $customer){

        $customer->update($this->validatedData());

        return redirect('/customers');
    }




    public function destroy(Customer $customer){

        $customer->delete();

        return redirect('/customers');
    }




    protected function validatedData(){

         return request()->validate([

        'name'=>'required',
        'email'=>'required|email'
         ]);

    }

*/

}
