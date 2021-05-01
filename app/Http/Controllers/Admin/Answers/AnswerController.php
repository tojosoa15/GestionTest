<?php

namespace App\Http\Controllers\Admin\Answers;

use App\Http\Controllers\Admin\PrincipaleController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class AnswerController extends PrincipaleController
{
    public function listeAnswer(Request $request){
        if($request->ajax())
        {
            $answer = $this->answerRepository->getAll();

            return Datatables::of($answer)

                ->addColumn('name_answer', function ($valeur)  {
                    return $valeur->name_answer;
                })
                ->addColumn('question_id', function ($valeur)  {
                    return $valeur->question->questionnaire;
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
