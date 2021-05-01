<?php

namespace App\Http\Controllers\Admin\Forms;

use App\Http\Controllers\Admin\PrincipaleController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class FormController extends PrincipaleController
{
    public function listeForm(Request $request){
        if($request->ajax())
        {
            $form = $this->formRepository->getAll();

            return Datatables::of($form)

                ->addColumn('nom_form', function ($valeur)  {
                    return $valeur->nom_form;
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

    // Ajouter form
    public function addForm(Request $request)
    {
        $datas = $request->all();
        // $this->formRepository->addForm($datas);
        // $message='Enregistrement effectué avec succès';
        return response()->json(['message'=>$datas]);
    }
}
