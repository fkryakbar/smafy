<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = 'participants';

    protected $guarded = [];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'slug', 'lesson_slug');
    }

    protected $casts = [
        'details' => 'json',
    ];

    public function sublesson_result($sublesson_slug)
    {
        $answers = Answer::where('participants_id', $this->id)->where('sublesson_slug', $sublesson_slug)->get();
        $questions = Slide::where('sublesson_slug', $sublesson_slug)->where(function ($query) {
            $query->where('type', '=', 'file_attachment')
                ->orWhere('type', '=', 'multiple_choice')
                ->orWhere('type', '=', 'short_answer')
                ->orWhere('type', '=', 'long_answer');
        })->get();

        $trueAnswer =  $answers->filter(function ($answer) {
            return $answer->result == 1;
        });

        $score_total = 100;
        if (count($questions) > 0) {
            $score_total = round((count($trueAnswer) / count($questions)) * 100, 2);
        }
        return new Builder($score_total, $trueAnswer, $questions);
    }

    public function score_total()
    {
        $sublessons = $this->details['finished_sublessons'];
        $score_total = 0;
        foreach ($sublessons as $key => $sublesson) {
            $score_total += $this->sublesson_result($key)->score_total;
        }

        return $score_total;
    }

    public function progress()
    {
        $finished_sublessons_total = count($this->details['finished_sublessons']);
        $sublessons_total = count(Lesson::where('slug', $this->lesson_slug)->with('sublessons')->first()->sublessons);
        if ($sublessons_total > 0) {
            return round(($finished_sublessons_total / $sublessons_total) * 100);
        }
        return 0;
    }

    public function finished_sublessons_total()
    {
        return count($this->details['finished_sublessons']);
    }
    public function sublessons_total()
    {
        return count(Lesson::where('slug', $this->lesson_slug)->with('sublessons')->first()->sublessons);
    }

    public function average_score()
    {
        $sublessons_total  = count(Lesson::where('slug', $this->lesson_slug)->with('sublessons')->first()->sublessons);
        if ($sublessons_total > 0) {
            return round(($this->score_total() / $sublessons_total), 2);
        }

        return 0;
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'participants_id', 'id');
    }
}

class Builder
{
    public $trueAnswer;
    public $score_total;
    public $questions;

    public function __construct($score_total, $trueAnswer, $questions)
    {
        $this->score_total = $score_total;
        $this->trueAnswer = $trueAnswer;
        $this->questions = $questions;
    }
}
