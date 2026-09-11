<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\ExcerciseDivision;

class HomePhysiotherapyProgram extends FourPModel
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function exercise()
    {
        return $this->belongsToMany('App\Exercise', 'exercise_hpp')->withPivot('series', 'repetitions');
    }

    public function decisionHpps()
    {
        return $this->hasMany('App\DecisionHpp');
    }

    public function massage()
    {
        return $this->belongsToMany('App\Massage', 'hpp_massage');
    }

    public function physical_agent()
    {
        return $this->belongsToMany('App\PhysicalAgent', 'hpp_physical_agent', 'home_physiotherapy_program_id', 'physical_agent_id')
            ->withPivot('indication', 'precautions');
    }

    public function prescription()
    {
        return $this->belongsToMany('App\Prescription', 'hpp_prescription', 'home_physiotherapy_program_id', 'prescription_id')
            ->withPivot('indication', 'precautions');
    }

    public function contraindication()
    {
        return $this->belongsToMany('App\Contraindication', 'contraindication_hpp', 'home_physiotherapy_program_id', 'contraindication_id');
    }

    public function getExerciseDivisionsAttribute()
    {
        return ExcerciseDivision::all();
    }

    public function keywords()
    {
        return $this->belongsToMany('App\Keyword', 'keyword_hfp');
    }

    public function anato_physiology_glosary_item()
    {
        return $this->belongsTo('App\AnatoPhysiologyGlosaryItem', 'anato_physiology_glosary_item_id');
    }
}
