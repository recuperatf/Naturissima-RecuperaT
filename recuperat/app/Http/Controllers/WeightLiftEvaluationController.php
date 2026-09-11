<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\WeightLiftEvaluation;
use \App\ClinicalHistory;

class WeightLiftEvaluationController extends Controller
{
    public function index(){}

    public function show(Request $request, $clinicalHistoryId){
        return ClinicalHistory::find($clinicalHistoryId)->weight_lift_evaluations->first();
    }

    public function store(Request $request)
    {
        $clinicalHistoryId = $request->input('ch_id');
        $evaluation = $request->input('evaluation');
        $answers = $request->input('answers');
        $clinicalHistory = ClinicalHistory::find($clinicalHistoryId);
        $weightLiftEvaluation = WeightLiftEvaluation::find($evaluation['id']);
        $answersJson = json_encode($answers);

        $weightLiftEvaluation->metadata = $answersJson;
        $weightLiftEvaluation->save();

        return response()->json([
            'message' => 'Evaluación guardada correctamente',
            'evaluation' => $weightLiftEvaluation
        ]);
    }
}
