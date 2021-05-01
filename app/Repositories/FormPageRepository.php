<?php

namespace App\Repositories;

use App\Models\Form;

use App\Models\Form_page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

use App\Models\Client;
use Illuminate\Support\Facades\App;

class FormPageRepository extends BaseRepository
{
    protected $form_page;
    public function __construct()
    {
        $this->form_page = new Form_page();
    }
    public function getAll()
    {

        return $this->form_page->newQuery()
        ->select(['form_pages.*'])->get();
    }


      //Recherche par identifiant
    public function findById($id_form_page){
        return Form_page::find($id_form_page);
    }

}
