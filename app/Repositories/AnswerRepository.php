<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use App\Models\Answer;
use App\User;

class AnswerRepository extends BaseRepository
{
    //
    protected $answer;
    public function __construct()
    {
        $this->answer = new Answer();

    }
    public function getAll()
    {
        return Answer::all();
    }
}
