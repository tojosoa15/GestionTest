<?php

namespace App\Repositories;

use App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

use App\Models\Client;
use Illuminate\Support\Facades\App;

class FormRepository extends BaseRepository
{
    protected $form;
    public function __construct()
    {
        $this->form = new Form();
    }
    public function getAll()
    {

        return $this->form->newQuery()
        ->select(['forms.*'])->get();
    }
    //Creation type transport
    public function create($data)
    {
            $this->form=new Form(
                [
                    'nom_form'=>$data['nom_form']
                ]);
            $this->form->save();
    }

      //Recherche par identifiant
    public function findById($id_form){
        return Form::find($id_form);
    }

}
