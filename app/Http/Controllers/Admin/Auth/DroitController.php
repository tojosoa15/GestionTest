<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\PrincipaleController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Input;

class DroitController extends PrincipaleController
{
    public function showBackend(){
        $roles = $this->roleRepository->getAll();
        return $this->returnView('backend.auth.droit_backend')->with(compact('roles'));
    }
    public function selectAjax(Request $request)
    {
        if($request->ajax()){
            $this->id_role=$request->id_role;
            $droits=$this->droitRepository->findByIdRole($this->id_role);

            $data = view('backend.auth.ajax.droit_table',compact('droits'))->render();
            return response()->json(['tables'=>$data]);
        }
    }

    public function registerBackend(Request $request)
    {
        $droits=$this->droitRepository->findByIdRole($request->roles);
        $data=array();
        $i=0;
        foreach ($droits as $droit) {
            if($droit->menu->is_actif==true){
                $data['id_droit'] = $droit->id_droit;
                $data['access'] = Input::has($i) ? true : false;
                $data['creer'] = Input::has($i+1) ? true : false;
                $data['modifier'] = Input::has($i+2) ? true : false;
                $data['supprimer'] = Input::has($i+3) ? true : false;
                $this->droitRepository->updateByIdRoleIdMenu($data);
                $i+=4;
            }

        }

        return redirect()->route('backend.auth.droits.backend');

    }
    public function droitAccess(Request $request){
        $test_access=$this->droitRepository->getDroitAccess($request->id_menu,Auth::user()->role->id_role);
        if($test_access!=null)
            $data="true";
        else
            $data="false";
        return response()->json(['reponse'=>$data]);
    }
}
