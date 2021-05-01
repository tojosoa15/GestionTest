<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\PrincipaleController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Datatables;

use Illuminate\Support\Facades\Hash;

class RegisterController extends PrincipaleController
{

    //Creation utilisateur
    public function showRegistrationForm()
    {
        $roles = $this->roleRepository->getAll();
        return $this->returnView('admin.auth.register')->with(compact('roles'));
    }
    //creation d'un enregistrement
    public function createRegistration(Request $request){
       $data=$request->all();
        $test= $this->userRepository->create($request->all());
       if($test==false){
           return redirect()->route('admin.auth.register')
               ->with('status','primary')
               ->with('icon_notif','checkbox-marked-circle')
               ->with('message',trans('user.register_success_notification'));
       }
       else
           return redirect()->route('admin.auth.register')
               ->with('status','danger')
               ->with('icon_notif','checkbox-marked-circle')
               ->with('message',trans('user.register_failed_notification'));

    }
    /***********************************************************/

    //creation d'un enregistrement
    public function saveEditProfilAjax(Request $request){
      $data = $request->all();
      $findUser = $this->userRepository->findByID($data['id_user']);
      $passUser = $findUser->password;
      if($data['password_profil'] == ''){
        $this->userRepository->updateProfil($data);
        return redirect()->route('admin.auth.change_profil',$data['id_user'])
               ->with('status','primary')
               ->with('icon_notif','checkbox-marked-circle')
               ->with('message',__('Modification réussi'));
      }elseif(Hash::check($data['password_profil'],$passUser)){
        $this->userRepository->updateProfil($data);
        return redirect()->route('admin.auth.change_profil',$data['id_user'])
               ->with('status','primary')
               ->with('icon_notif','checkbox-marked-circle')
               ->with('message',__('Modification réussi'));
      }else{
        return redirect()->route('admin.auth.change_profil',$data['id_user'])
               ->with('status','danger')
               ->with('icon_notif','checkbox-marked-circle')
               ->with('message',__("Votre ancien mot de pass est incorrecte"));
      }

    }
}
