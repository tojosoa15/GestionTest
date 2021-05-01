<?php

namespace App\Http\Controllers\Front;


use Illuminate\Http\Request;

class HomeController extends PrincipaleController
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list_forms=$this->formRepository->getAll();
        return $this->returnView('front.nosFormulaire')->with(compact('list_forms'));
    }
}
