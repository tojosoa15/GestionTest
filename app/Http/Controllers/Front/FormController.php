<?php

namespace App\Http\Controllers\Front;


use Illuminate\Http\Request;

class FormController extends PrincipaleController
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request,$id_form)
    {
        $details_form=$this->formRepository->findById($id_form);
       // dd($request->session());
        return $this->returnView('front.form.index')->with(compact('details_form'));
    }
}
