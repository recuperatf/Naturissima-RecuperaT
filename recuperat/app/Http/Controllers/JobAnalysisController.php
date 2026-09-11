<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobAnalysisController extends CRUDController
{
    public function __construct(array $attributes = array()){
        parent::__construct();

        $this->route_show = 'job_analysis.show';
        $this->index_search_fields = array(
            'name'
        );
        $this->route_path = 'job_analysis';
        $this->class_name = '\App\JobAnalysisController';
        $this->model_name = '\App\JobAnalysis';
        $this->short_model_name = 'JobAnalysis';
        // $this->file_output = 'images/plans_images/diagnosis/';
        $this->A_validator = [
            // 'name' => 'required',
        ];
        $this->A_validator_messages = [
            // 'name.required'=>'El campo de nombre es obligatorio',
        ];
        $this->relationships = [
        ];
        $this->file_relationships = [

        ];
        $this->keys = [
            'index' => [
                'patient_id'=>'PacienteId',
                // 'user_id.filter'=>'Usuario',
            ],
            'user_id' => true,
            'create' => [
                // ['key'=>'name', 'label'=>'Nombre', 'type'=>'text'],
                // ['key'=>'code', 'label'=>'Clave', 'type'=>'text'],
            ]
        ];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workspaceId = request()->input('workspaceId');
        $workspace = \App\Workspace::with('laboral_company')->find($workspaceId);
        $workspace->laboral_company = $workspace->laboral_company;
        $patients = \App\Patient::where('is_laboral', true)->get()->map(function ($patient) {
            return [
                "id" => $patient->id,
                "full_name" => $patient->full_name,
                "name" => $patient->name,
                "surname" => $patient->surname,
                "second_surname" => $patient->second_surname,
                "birth_date" => $patient->birth_date,
                "sex" => $patient->sex,
            ];
        });
        return view('valorations.create_job_analysis')
            ->with('workspace', $workspace)
            ->with('valorations', [])
            ->with('patients', $patients)
            ->with('useVue', true);
    }

    public function store(Request $request)
    {
        $workspaceId = request()->input('workspace_id');
        $patientToCreate = request()->input('patient');
        $workspace = \App\Workspace::with('laboral_company')->find($workspaceId);
        $sex = $request->input('sex');
        $patientToCreate['is_laboral'] = true;
        $patientToCreate['birth_date'] = request()->input('birth_date', '1900-01-01');
        $patient = \App\Patient::create($patientToCreate);
        $jobAnalysis = \App\JobAnalysis::create([
            'patient_id' => $patient->id,
            'workspace_id' => $workspace->id,
            'department' => $request->input('department'),
            'work' => $request->input('work'),
            'asignation' => $request->input('asignation'),
            'equipment' => $request->input('equipment'),
            'work_description' => $request->input('work_description'),
        ]);
        return response()->json('Éxito', 200);
    }
}
