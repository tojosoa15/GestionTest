<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\FormRepository;
use App\Repositories\FormPageRepository;
use App\Repositories\AnswerRepository;

class PrincipaleController extends Controller
{

	public $userRepository;
    public $roleRepository;
    public $questionRepository;
    public $formRepository;
    public $formPageRepository;
    public $answerRepository;

public function __construct()
    {

        $this->middleware('admin');
        $this->userRepository=new UserRepository();
        $this->roleRepository=new RoleRepository();
        $this->questionRepository=new QuestionRepository();
        $this->formRepository=new FormRepository();
        $this->formPageRepository=new FormPageRepository();
        $this->answerRepository=new AnswerRepository();
    }
    public function returnView($view)
    {


        return view($view);
    }
}
