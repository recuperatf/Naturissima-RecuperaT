<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\DecisionMail;
use Illuminate\Http\Request;
use App\Decision;
use App\DecisionHpp;
use App\HomePhysiotherapyProgram;
use \Illuminate\Support\Facades\Route;

class DecisionController extends Controller
{
    function apiHomePhysiotherapyProgramShow(Request $request, $password)
    {
        $hpfId = DecisionHpp::where('password', $password)->first()->home_physiotherapy_program;
        $homePhysiotherapyProgram = $hpfId->with('exercise.image_resources')
            ->with('massage.image_resources')
            ->with('physical_agent.image_resources')
            ->with('prescription.image_resources')
            ->with('contraindication')
            ->with('contraindication')
            ->find($hpfId->id);
        return response($homePhysiotherapyProgram, 200);
    }

    public function show(Request $request, $password)
    {
        $decisionId = $request->input('decisionId', false);
        $decision = json_encode('');
        if ($decisionId) {
            $decision = Decision::find($decisionId);
            $decision->patient = $decision->patient;
            $decision->clinic = $decision->clinic;
        }
        if (is_numeric($password)) {
            $hpf = HomePhysiotherapyProgram::find($password);
        } else {
            $hpf = DecisionHpp::where('password', $password)->first()->home_physiotherapy_program;
        }
        return view('decision.show')
            ->with('useVue', true)
            ->with('hppId', $hpf->id)
            ->with('decision', $decision);
    }

    public function sendDecision(Request $request, $decisionId)
    {
        $decision = Decision::find($decisionId);
        $name = $request->get('name');
        $to = $request->get('to');
        $subject = "Tu Receta RecupraT";
        $decisionHpps = collect();
        $decision->home_physiotherapy_programs->map(function ($hpp) use (&$decisionHpps) {
            $thisDecisionsHpps = $hpp->decisionHpps;
            $decisionHpps = $decisionHpps->merge($thisDecisionsHpps);
        });
        Mail::to($to)->send(new DecisionMail($decision, $decisionHpps, $subject));

        return 'Tu receta fue enviada con éxito';

    }
    public function printDecision(Request $request, $decisionId)
    {
        $decision = Decision::find($decisionId);
        return view('decision.print_decision')
            ->with('decision', $decision)
            ->with('patient', $decision->patient)
            ->with('user', $decision->author);
    }
}
