<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Patient;
use \App\Antecedent;
use \App\AntecedentType;
use \App\ClinicalHistoryDiagnosis;
use \App\Valoration;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Auth;

class ClinicalHistory extends Model
{
    protected $guarded = ['id'];
    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }
    public function weight_lift_evaluations()
    {
        return $this->hasMany('App\WeightLiftEvaluation', 'clinical_history_id', 'id');
    }
    public function clinical_physiotherapy_notes()
    {
        return $this->hasMany('App\ClinicalPhysiotherapyNote', 'clinical_history_id', 'id');
    }
    public function clinical_rehabilitation_notes()
    {
        return $this->hasMany('App\ClinicalRehabilitationNote', 'clinical_history_id', 'id');
    }
    public function antecedents()
    {
        return $this->hasMany('App\Antecedent', 'clinical_history_id', 'id');
    }
    public function valorations()
    {
        return $this->hasMany('App\Valoration', 'clinical_history_id', 'id');
    }
    public function moreRecentValoration($name, $section)
    {
        $valoration = $this->valorations->where('section', $section)->where('name', $name)->sortByDesc('created_at')->first();
        return $valoration;
    }
    public function diagnosis()
    {
        return $this->hasMany('App\ClinicalHistoryDiagnosis', 'clinical_history_id', 'id');
    }
    public function treatments()
    {
        return $this->hasMany('App\ClinicalHistoryTreatment', 'clinical_history_id', 'id');
    }
    public function cie10Diagnosis()
    {
        $cie10_diagnosis = new Collection;
        foreach ($this->diagnosis as $diagnosis) {
            $cie10_diagnosis->add($diagnosis->diagnosis);
        }
        return $cie10_diagnosis;
    }
    public function cie9Treatments()
    {
        $C_cie9_mc = new Collection;
        foreach ($this->treatments as $treatments) {
            $C_cie9_mc->add($treatments->treatment);
        }
        return $this->treatments;
    }
    public function saveHistory($array_to_save)
    {
        if (Patient::find($array_to_save['patient_id'])->clinicalHistory) {
            $this->id = Patient::find($array_to_save['patient_id'])->clinicalHistory->id;
        }
        $type = !empty($array_to_save['clinicalHistoryType']) ? $array_to_save['clinicalHistoryType'] : false;
        if ($type == 'physiotherapy') {
            $diagnosis = $this->_save_relationship($array_to_save, "treatments", 'ClinicalHistoryTreatment', 'cie9_mc_id');
            $diagnosis = $this->_save_relationship($array_to_save, "diagnosis", 'ClinicalHistoryDiagnosis', 'cat_cie10_id');
            // $treatments = $this->_save_param($array_to_save, "treatments", 'cie9_mc_id');
        }
        $clinicalHistory = $this->_save_all($array_to_save);
    }
    private function _save_relationship(&$array_to_save, $relationship, $relationalModel, $id_field)
    {
        $relationship_array = [];
        $this->$relationship()->delete();
        $model = '\App' . '\\' . $relationalModel;
        if (!empty($array_to_save[$relationship])) {
            $relationship_array = $array_to_save[$relationship];
            unset($array_to_save[$relationship]);
            foreach ($relationship_array as $key => $m_relationship) {
                $relationalModelInstance = new $model();
                $relationalModelInstance->$id_field = $m_relationship;
                $this->$relationship()->save($relationalModelInstance);
            }
        }
        return $this->$relationship;

    }
    public function saveWithAntecedents($array_to_save)
    {
        unset($array_to_save['_token']);
        $array_to_evaluate = [
            ['key' => 'antecedents_no_patological', 'function' => 'antecedents'],
            ['key' => 'antecedents_familial', 'function' => 'antecedents'],
            ['key' => 'valoration_neurology', 'function' => 'valorations'],
            ['key' => 'valoration_muscular_contracture', 'function' => 'valorations'],
            ['key' => 'valoration_cicatriz_quirurgica', 'function' => 'valorations'],
            ['key' => 'valoration_gait', 'function' => 'valorations'],
            ['key' => 'valoration_traslation_initial', 'function' => 'valorations'],
            ['key' => 'valoration_traslation_final', 'function' => 'valorations'],
            ['key' => 'valoration_pain', 'function' => 'valorations'],
            ['key' => 'valoration_muscular_strength', 'function' => 'valorations'],
            ['key' => 'valoration_goniometry', 'function' => 'valorations'],
            ['key' => 'valoration_spasticity', 'function' => 'valorations'],
            ['key' => 'valoration_hipotony', 'function' => 'valorations'],
            ['key' => 'valoration_cranial_nerves_sensorial', 'function' => 'valorations'],
            ['key' => 'valoration_cranial_nerves_motor', 'function' => 'valorations'],
            ['key' => 'valorations_appoinment_reason_nutriology', 'function' => 'valorations'],
            ['key' => 'antecedents_familial_nutriology', 'function' => 'valorations'],
            ['key' => 'valoration_physical_examination_nutriology', 'function' => 'valorations'],
            ['key' => 'valoration_food_frequency_examination_nutriology', 'function' => 'valorations'],
            ['key' => 'valoration_dietetic_antecedents_nutriology', 'function' => 'valorations'],
            ['key' => 'valoration_24_hour_abstract_nutriology', 'function' => 'abstract_24_hours'],
            ['key' => 'valorations_appoinment_reason_traumatology', 'function' => 'valorations'],
            ['key' => 'valorations_diagnosis_traumatology', 'function' => 'valorations'],
            ['key' => 'valorations_tratamiento_traumatology', 'function' => 'valorations'],
            ['key' => 'valorations_muscular_valoration_hip', 'function' => 'valorations'],
            ['key' => 'valorations_muscular_valoration_hip', 'function' => 'valorations'],
        ];
        $alimentos = ['Cerdo', 'Res', 'Pollo', 'Pescado', 'Mariscos', ' Huevo', 'Leche', 'Queso', 'Yogurt', 'Bolillo', 'Pasta', 'Tortilla', 'Pan de Caja', 'Cereal', 'Arroz', 'Frutas', 'Verduras', 'Manteca', 'Aceite', 'Oleaginosas', 'Aguacate', 'Crema', 'Mayonesa', 'Pan dulce', 'Tostadas', 'Galletas', 'Jugo Industrializado', 'Refresco', 'Azúcar', 'Leguminosas'];
        foreach ($alimentos as $key => $alimento) {
            $array_to_evaluate[] = ['key' => 'valoration_food_frequency_examination_nutriology_' . strtolower($alimento), 'function' => 'valorations'];
        }
        $this->_save_all_antecedentes(
            $array_to_evaluate,
            $array_to_save
        );
    }

    private function _is_json($string, $return_data = false)
    {
        $data = json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
    }
    private function _save_all($array_to_save)
    {
        // dd(AntecedentType::all());
        $clinical_history = false;
        $patient = Patient::find($array_to_save['patient_id']);
        $existed = false;
        $clinicalHistory = null;
        if (!($clinicalHistory = $patient->clinicalHistory)) {
            $this->user_id = Auth::user()->id;
            $clinical_history = $patient->clinicalHistory()->save($this);
            $clinicalHistory = $clinical_history;
        } else {
            $existed = true;
        }
        //eliminating non Valoration things
        unset(
            $array_to_save['_token'],
            $array_to_save['clinicalHistoryType'],
            $array_to_save['patient_id'],
            $array_to_save[1],
            $array_to_save['printObjectives']
        );
        $array_to_save = array_filter($array_to_save, function ($element) {
            return $element != null;
        });
        foreach ($array_to_save as $keyBigArray => $A_valoration) {
            //cada sección puede tener multiples valoracionse
            if (!is_array($A_valoration))
                continue;
            foreach ($A_valoration as $keyValorationKey => $valoration) {
                unset($valoration['antecedent_type_id']);
                if (!array_key_exists('json_values', $valoration)) {
                    continue;
                }
                if ($clinicalHistory) {
                    if (empty($valoration['name'])) {
                        $valoration['name'] = $keyValorationKey;
                        $valoration['section'] = $keyBigArray;
                        $previous_valoration = $clinicalHistory->valorations->where('name', '=', ($valoration['name']))->where('section', '=', $valoration['section']);
                        // if($keyValorationKey != 1){
                        //     dd($previous_valoration);
                        // }
                        foreach ($previous_valoration as $O_valoration) {
                            $O_valoration->delete();
                        }
                    }
                    $previous_valoration = $clinicalHistory->valorations->where('name', '=', ($valoration['name']))->where('section', '=', $valoration['section']);
                    if (empty($valoration['json_values'])) {
                        // Saving empty strings
                        $valoration['json_values'] = "";
                    }
                    if ($previous_valoration->count() == 0) {
                        if (!empty($valoration['json_values']) && is_array($valoration['json_values'])) {
                            $valoration['json_values'] = json_encode($valoration['json_values']);
                        }
                        $valoration = new Valoration($valoration);
                    } else {
                        $valorationJsonValues = $valoration['json_values'];
                        if (is_array($valorationJsonValues)) {
                            $valoration['json_values'] = json_encode($valorationJsonValues);
                        } else {
                            if (Str::startsWith($valoration['json_values'], '{') || Str::startsWith($valoration['json_values'], '[')) {
                                $valorationJsonValues = json_encode($valoration['json_values']);
                            }
                            if (!empty($valoration['json_values']) && !is_array($valoration['json_values'])) {
                                $valoration['json_values'] = $valorationJsonValues;
                            }
                        }
                        $oValoration = new Valoration();
                        $valoration = $oValoration->fill($valoration);
                        // if($keyBigArray == "valoration_tendons_and_muscle_nordic_change_in_job_codo_o_antebrazo") {
                        //     dd($valoration , $array_to_save);
                        // }
                    }
                }
                $valoration->user_id = auth()->id();
                $res = $clinicalHistory->valorations()->save($valoration);
            }
        }
        return $patient->clinicalHistory;
    }


    private function _save_all_antecedentes($array_keys, $array_to_save)
    {
        $clinical_history = false;
        $patient = Patient::find($array_to_save['patient_id']);
        $existed = false;
        if (!($clinicalHistory = $patient->clinicalHistory)) {
            $this->user_id = Auth::user()->id;
            $clinical_history = $patient->clinicalHistory()->save($this);
        } else {
            $existed = true;
            $clinical_history = $patient->clinicalHistory;
        }
        $abstract_24_hours = $clinicalHistory->valorations->where('name', 'abstract_24_hours_nutriology');
        foreach ($abstract_24_hours as $key => $valoration) {
            $valoration->delete();
        }
        foreach ($array_keys as $key => $key_array) {
            $function_relationship = $key_array['function'];

            if (isset($array_to_save[$key_array['key']])) {
                $working_arrays = $array_to_save[$key_array['key']];
                foreach ($working_arrays as $key_working_array => $working_array) {
                    if (isset($working_array['json_values'])) {
                        $working_array['json_values'] = ($working_array['json_values'] == null) ? '' : $working_array['json_values'];
                    } else {
                        $working_array['json_values'] = '';

                    }
                    $working_array['present'] = ($working_array['json_values']) ? true : false;
                    $model;
                    switch ($key_array['function']) {
                        case 'abstract_24_hours':
                            $working_array['section'] = $working_array['json_values']['time'];
                            $working_array['json_values'] = json_encode($working_array['json_values']);
                            $working_array['name'] = 'abstract_24_hours_nutriology';
                            $function_relationship = 'valorations';
                            $model = new Valoration($working_array);
                            break;
                        case 'antecedents':
                            $model = new Antecedent($working_array);
                            break;
                        case 'valorations':
                            $model = new Valoration($working_array);
                            break;
                        default:
                    }
                    if ($existed) {
                        $hasMany_model = $clinical_history->$function_relationship();
                        if ($hasMany_model->where('name', $working_array['name'])->where('section', (isset($working_array['section']) ? $working_array['section'] : null))->first()) {
                            $model = $hasMany_model->where('name', $working_array['name'])->where('section', (isset($working_array['section']) ? $working_array['section'] : null))->first();
                            $model->json_values = $working_array['json_values'];
                            $model->cie10_id = $working_array['cie10_id'];
                            $model->save();
                        } else {
                            $hasMany_model->save($model);
                        }
                    } else {
                        $clinical_history->$function_relationship()->save($model);
                    }
                }
            }
        }
    }
}
