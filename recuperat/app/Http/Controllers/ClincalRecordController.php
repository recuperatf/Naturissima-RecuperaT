<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Patient;
class ClincalRecordController extends Controller
{
    /**
     * Get patient list for the clinical record controller
     * @return mixed|\Illuminate\View\View
     */
    public function patient_list()
    {
        $patients = Patient::all();
        return view("clinical_record.patient_list")->with(compact("patients"));
    }
}
