<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use App\Models\Question;
use App\User;

class QuestionRepository extends BaseRepository
{
    //
    protected $question;
    public function __construct()
    {
        $this->question = new Question();

    }
    public function getAll()
    {
        return Question::all();
    }
}
