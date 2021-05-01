<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\PrincipaleController;
use App\Models\Mediatheque;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class UserController extends PrincipaleController
{

    public function listeUser(Request $request){
        if($request->ajax())
        {
            $users = $this->userRepository->getAll();

            return Datatables::of($users)

                ->addColumn('name', function ($valeur)  {
                    return $valeur->name;
                })
                ->addColumn('email', function ($valeur)  {
                    return $valeur->email;
                })
                ->addColumn('action', function ($action)  {

                    return '<center>
                            <a href="#" class="action-edit" onclick="edit_user('.$action->id.');" data-toggle="modal"> <i class="mdi mdi-24px  md-24 mdi-border-color "></i></a>

                            <a href="#" class="action-delete" onclick="delete_user('.$action->id.');"> <i class="mdi mdi-24px mdi-delete fas fa-2x"></i></a>
                       </center>';

                })

                ->make(true);
        }
    }
    public function editForm(Request $request)//Formulaire de modification introduction  forme
    {
        if($request->ajax()) {
            $utilisateur = $this->userRepository->findByID($request->id);
            $roles = $this->roleRepository->getAll();
            $data = view('admin.auth.edit_user', compact('utilisateur','roles'))->render();
            return response()->json(['edit_user'=>$data]);
        }
    }
    public function editMyProfilForm(Request $request)//Formulaire de modification introduction  forme
    {
        if($request->ajax()) {
            $utilisateur = $this->userRepository->findByID($request->id);
            $data = view('admin.auth.edit_my_profil', compact('utilisateur'))->render();
            return response()->json(['edit_my_profil'=>$data]);
        }
    }

    public function saveModification(Request $request)//Enregistrement de la modification de l'introduction forme
    {
        if($request->ajax()) {

            $this->userRepository->updateValeur($request->user);
            $data = "true";
            return response()->json(['edit_introduction_forme'=>$data]);
        }
    }
    public function editProfilForm($id_user){

        if(Auth::guard('admin')->user()->id==$id_user){
            $profil=$this->userRepository->findByID($id_user);
            $filename=$profil->photo!=null?asset(Config::get('app.upload_file').'/'.$profil->photo->mediatheque->nom_dossier.'/'.$profil->photo->mediatheque->nom_media):"";

            return $this->returnView('admin.auth.edit_my_profil')->with(compact('profil','filename'));
        }
    }
    public function savePhotoProfil(Request $request,$id_user){
        if(Auth::guard('admin')->user()->id==$id_user){
            $profil=$this->userRepository->findByID($id_user);
            if($profil!=null){
                $data=array();
                $file = $request->file('change_photo');
                $extension=$file->getClientOriginalExtension();
                $filename = sha1('mediatheque' . rand() . time() . time()) . ".{$extension}";
                //Enregistrement dans la base de données
                $data['nom_origine'] =$file->getClientOriginalName();
                $data['nom_media'] =$filename;
                $data['extension'] = $extension;
                $dossier=Config::get('app.upload_file').'/'.Config::get('app.upload_name_file_photo_profil');
                $data['nom_dossier'] = Config::get('app.upload_name_file_photo_profil');
                $sizefile = $file->getClientSize();
                if($sizefile == false){
                    return redirect()->route('admin.auth.change_profil',[$id_user])
                                    ->with('status','danger')
                                    ->with('icon_notif','checkbox-marked-circle')
                                    ->with('message',__("La taille de l'image ne doit pas depasser 1MB"));
                }
                else{
                    //Upload fichier
                    $file->move($dossier, $filename);
                    //Supprimer le media dans le mediatheque autre
                    if($profil->photo!=null && $profil->photo->mediatheque!=null){
                        $media=$profil->photo->mediatheque;
                        $this->mediathequeAutreRepository->deleteMedia($profil->photo->id_autre);
                        if($media->mediatheque_autres->count()==0){
                            @unlink($dossier.'/'.$profil->photo->mediatheque->nom_media);
                            $this->mediathequeRepository->deleteMedia($profil->photo->mediatheque->id_mediatheque);
                        }
                    }
                    //Attacher un media à une collection
                    $this->mediathequeRepository->createMediaDossierUser($data,$profil);
                    return redirect()->route('admin.auth.change_profil',[$id_user]);
                }
            }
        }

    }

    // Modification utilisateur
    public function showModalEditUser(Request $request)
    {
      $idUser = $request->input('idUser');
      $getUserById = $this->userRepository->findByID($idUser);
      return response()->json(['getUserById'=>$getUserById]);
    }

    public function editUserAjax(Request $request)
    {
      $datas = $request->all();
      $this->userRepository->updateUser($datas);
      $message = 'Modification réussi';
      return response()->json(['message'=>$message]);
    }

    public function deleteUser(Request $request)
    {
      $idUser = $request->input('idUser');
      $deleteUser = $this->userRepository->deleteUser($idUser);
      $message = 'Suppression réussi';
      return response()->json(['message'=>$message]);
    }
}
