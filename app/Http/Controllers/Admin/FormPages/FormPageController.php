<?php

namespace App\Http\Controllers\Admin\FormPages;

use App\Http\Controllers\Admin\PrincipaleController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class FormPageController extends PrincipaleController
{
    public function listeForm_page(Request $request){
        if($request->ajax())
        {
            $form_page = $this->formPageRepository->getAll();

            return Datatables::of($form_page)

                ->addColumn('name_form_page', function ($valeur)  {
                    return $valeur->name_form_page;
                })
                ->addColumn('form_id', function ($valeur)  {
                    return $valeur->form->nom_form;
                })
                ->addColumn('action', function ($action)  {

                    return '<center>
                            <a href="#" class="action-edit"  data-toggle="modal"> <i class="mdi mdi-24px  md-24 mdi-border-color "></i></a>

                            <a href="#" class="action-delete"> <i class="mdi mdi-24px mdi-delete fas fa-2x"></i></a>
                       </center>';

                })
                 ->rawColumns(['action'])
                ->make(true);
        }
    }
}
