<?php

namespace App\Http\Controllers\Front;


use Illuminate\Http\Request;

class PageController extends PrincipaleController
{


    public function getNombrePage(Request $request)
    {
        if($request->ajax()){
            $details_form=$this->formRepository->findById($request->id_form);
            $nombre_page=$details_form->form_pages->count();
            return  response()->json(['nombre_page'=>$nombre_page,'id_page'=>$details_form->form_pages->first()->id_form_page]);
        }


    }
    public function loadPage(Request $request)
    {
        if($request->ajax()){
            $detail_page=$this->formPageRepository->findById($request->id_page);
            $detail_form=$this->formRepository->findById($request->id_form);
            $data=$this->returnView('front.page.my_page')->with( compact('detail_page','detail_form'))->render();
            return  response()->json(['load_page'=>$data]);
        }


    }
    public function saveSessionLoadPage(Request $request)
    {
        if($request->ajax()){
            // Via a request instance...
            $request->session()->put('data_responds', $request->data_responds);
            $detail_page=$this->formPageRepository->findById($request->id_page);
            $detail_form=$this->formRepository->findById($request->id_form);
            $data=$this->returnView('front.page.my_page')->with( compact('detail_page','detail_form'))->render();
            return  response()->json(['load_page'=>$data]);
        }


    }

}
