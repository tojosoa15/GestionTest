<?php

namespace App\Http\Controllers\Admin\Questions;

use App\Http\Controllers\Admin\PrincipaleController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class QuestionController extends PrincipaleController
{
    public function formCreate()
    {
        return view('admin.questions.form_create');
    }
    public function listeQuestion(Request $request){
        if($request->ajax())
        {
            $question = $this->questionRepository->getAll();

            return Datatables::of($question)

                ->addColumn('question', function ($valeur)  {
                    return $valeur->questionnaire;
                })
                ->addColumn('type_question_id', function ($valeur)  {
                    return $valeur->type_question->nom_type_question;
                })
                ->addColumn('form_page_id', function ($valeur)  {
                    return $valeur->form_page->name_form_page;
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
