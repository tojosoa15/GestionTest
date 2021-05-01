<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\PrincipaleController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Datatables;


class GroupeController extends PrincipaleController
{

    //Affichage de la vue d'enregistrement
    public function showRegistrationForm()
    {

        //

        return $this->returnView('backend.auth.groupes.groupe');
    }
    public function detailsGroupeForm(Request $request){
        if($request->ajax()){
            $groupe=$request->groupe;
            $data = view('backend.auth.groupes.details_groupe', compact('groupe'))->render();
            return response()->json(['div'=>$data]);
        }
    }
    //creation d'un enregistrement
    public function createRegistration(Request $request){

        $test= $this->roleRepository->create($request->all());;
        if($test==false){
            return redirect()->route('backend.groupes.register');
        }
        else
            return redirect()->route('backend.groupes.register')
                ->with('status','info')
                ->with('message','ce groupe existe déjà');

    }
    public function listeGroupe(Request $request){

        if($request->ajax())
        {
            $groupes = $this->roleRepository->getAll();

            return Datatables::of($groupes)

                ->addColumn('nombre_utilisateur', function ($valeur)  {
                    return $valeur->users->count();
                })
                ->addColumn('modif', function ($action)  {

                    return '<center>                                        

                            <a href="" class="action-edit" onclick="edit_groupe('.$action->id_role.')" data-toggle="modal" data-target="#edit_role"> <i class="fa fa-pencil-square-o fa-lg btn btn-success"></i></a> 



                       </center>';

                })
                ->make(true);
        }
    }
    public function editForm(Request $request)//Formulaire de modification
    {
        if($request->ajax()) {
            $groupe = $this->roleRepository->findIdRole($request->id_role);
            $data = view('backend.auth.groupes.edit_groupe', compact('groupe'))->render();
            return response()->json(['edit_role'=>$data]);
        }
    }

    //Enregistrement de la modification

    public function saveModification(Request $request)
    {
        if($request->ajax()) {
            $this->roleRepository->updateValeur($request->id_role,$request->nom_role);
            $data = "true";
            return response()->json(['edit_role'=>$data]);
        }
    }

}
