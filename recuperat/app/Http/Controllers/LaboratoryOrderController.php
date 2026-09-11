<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaboratoryOrder;
use Illuminate\Support\Facades\Auth;
;

class LaboratoryOrderController extends CRUDController
{
    public function __construct(array $attributes = array())
    {
        parent::__construct();
        $this->route_path = 'laboratory_order';
        $this->file_output = 'images/laboratory_order/';
        $this->class_name = '\App\LaboratoryOrderController';
        $this->model_name = '\App\LaboratoryOrder';
        $this->short_model_name = 'User';

        $this->A_validator = [
        ];
        $this->A_validator_update = [
        ];
        $this->A_validator_messages = [
        ];
        $this->A_validator_messages_update = [
        ];
        $this->relationships = [
            'Patient' => 'patient',
            'User' => 'user',
        ];
        $this->file_relationships = [
        ];
        $this->labSections = [
            "Hematología" => [
                "Biometría Hemática Completa",
                "Tipo sanguíneo y factor RH",
                "Reticulocitos",
                "Coombs directo",
                "Coombs indirecto"
            ],
            "Coagulación" => [
                "Tiempo de sangrado y coagulación",
                "Tiempo de protrombina (TP)",
                "Tiempo Parcial de Tromboplastina (TPT)",
                "Tiempo de protrombina",
                "Fibrinógeno",
            ],
            'Urianálisis' => [
                'Examen general de orina',
                'Antidoping',
                'Depuración de creatinina',
                'Proteínas en orina'
            ],
            'Parasitología' => [
                'Coproparasitoscópico (1)',
                'Coproparasitoscópico (2)',
                'Coproparasitoscópico (3)',
                'Coprológico',
                'Sangre oculta en heces',
                'Amiba en fresco',
            ],
            'Marcadores tumorales' => [
                'Antígeno prostáticos específico',
                'CA 125',
                'CA 15-3',
                'CEA',
                'CA 19-9',
            ],
            'Química sanguínea' => [
                'Glucosa',
                'Curva de tolerancia a la glucosa',
                'Urea',
                'Creatinina',
                'Ac. úrico',
                'Colesterol',
                'Trigliceridos',
                'Colesterol HDL',
                'Colesterol LDL',
                'Colesterol Total',
                'Bilirrubina total',
                'Bilirrubina directa',
                'Bilirrubina indirecta',
                'Proteínas totales',
                'Alúbima',
                'Transaminasas (TGO, TGP, GGT)',
                'Fosfatasa alcalina',
                'Fosfatasa ácida y prostática',
                'Deshidrogenasa Láctica (LDH)',
                'Hierro',
                'Hemoglobina Glucosilada',
                'Electrolitos (Na, Cl, K, Ca, P, Mg)',
            ],
            'Microbiología' => [
                'Cultivo Faríngeo',
                'Espermocultivo',
                'Cultivo de orina',
                'Coprocultivo',
                'BAAR en expectoración',
                'Cultivo Vaginal'
            ],
            'Hormonas' => [
                'Prolactina',
                'Progesterona',
                'Estradiol',
                'Estrógenos',
                'LH',
                'FSH Testosterona',
                'T3 Total',
                'T4 Total',
                'TSH',
                'T3 libre',
                'T4 libre',
                'Insulina',
                'H. Adrenocorticotrófica (ACTH)',
                'H. Dehidroepiandrosterona (DHEA)',
                'Dehidroepiandrosterona sulfato'
            ],
            'Serología' => [
                'AC. Anti VIH',
                'VDRL',
                'Reacciones febriles',
                'Antiestreptolisinas',
                'Proteína C Reactiva',
                'Factor Reumatoide',
                'Prueba de Embarazo',
                'Rosa de bengala'
            ],
            'Estudios Especiales' => [
                'Vitamina B12',
                'Hepatitis A IGM',
                'Hepatitis B AG de superficie',
                'Hepatitis C'
            ],
            'Tomografía' => [
                'TC Abdominopélvico simple y contrastada',
                'TC de cadera simple y contrastada',
                'TC de columna cervical',
                'TC de columna lumbosacra',
                'TC de cráneo simple y contrastada',
                'TC de pelvis simple y contrastada',
                'TC de senos paranasales simple',
                'TC de tórax simple',
                'TC de urotac simple y contrastada',
            ],
            'Ultrasonido' => [
                'US. tiroideo/cuello',
                'US. mamario',
                'US. hídago y vías biliares',
                'US. hídago renal y de vías urinarias',
                'US. abdominal general hombre',
                'US. abdominal general mujer',
                'US. abdominal inferior mujer',
                'US. abdominal obstetrico trim I',
                'US. abdominal obstetrico trim II y III',
                'Otro ultrasonido' => [
                    'type' => 'textarea',
                    'key' => 'ultrasound_text',
                ]
            ],
            'Gabinete' => [
                'Papanicolau',
                'Densitometría',
                'Mastografía',
                'Electrocardiograma',
                'Otra radiografía' => [
                    'type' => 'textarea',
                    'key' => 'radiografia_text',
                ]
            ],
        ];
        $this->title = "Orden de Laboratorio/Imagen";
        $this->keys = [
            'index' => [
            ],
            'create' => [
            ],
            'edit' => [
            ]
        ];
    }
    public function create()
    {
        foreach ($this->labSections as $key => $sectionArray) {
            $section = array_map(function ($element) {
                if (is_array($element)) {
                    return null;
                }
                return ['name' => strtolower(str_replace(' ', '_', $element)), 'description' => $element];
            }, $sectionArray);
            $section = array_filter($section, function ($element) {
                return !empty ($element);
            });
            $this->keys['create'][$key] = ['key' => strtolower(str_replace(' ', '_', $key)), 'label' => $key, "type" => 'multiple_checkbox', 'options' => $section, 'name' => strtolower(str_replace(' ', '_', $key)), 'default' => [], 'grid' => 'col-md-3'];

            foreach ($sectionArray as $key => $value) {
                if (is_array($value)) {
                    $this->keys['create'][$key] = ['no_print_if_empty' => true, 'key' => $value['key'], 'rows' => 5, 'label' => $key, "type" => 'textarea', 'name' => $value['key'], 'grid' => 'col-md-3'];
                }
            }
            // type
            $this->keys['create'][] = ['type' => 'hr'];
        }
        // $this->keys['create']['Radiografía'] = ['key'=>'Radiografía', 'label' => 'Radiografía', "type" => 'text', 'name' => 'radiografia'];
        $this->keys['create']['Otros'] = ['key' => 'Otros', 'label' => 'Otros', "type" => 'text', 'name' => 'others'];
        $this->patient_id = request()->patient_id;
        $previous = LaboratoryOrder::where('patient_id', $this->patient_id)->orderBy('id', 'desc')->first();

        return view('laboratory.add')->
            with('previous', $previous)->
            with('title', !empty($this->title) ? $this->title : null)->
            with('form_method', 'post')->
            with('form_url', route($this->route_path . '.store'))->
            with('patient', !empty($this->patient_id) ? \App\Patient::find($this->patient_id) : null)->
            with('patient_id', !empty($this->patient_id) ? $this->patient_id : null)->
            with('keys', $this->keys['create']);
    }
    public function edit($id, $stop_extend = false)
    {
        $labOrder = LaboratoryOrder::find($id);
        $sections = json_decode($labOrder->json_values, true);
        $arrayDefault = [];
        foreach ($sections as $key => $array) {
            foreach ($sections as $study) {
                if (is_array($study)) {
                    foreach ($study as $only) {
                        $arrayDefault[] = strtolower(str_replace(' ', '_', $only));
                    }
                }
            }
        }
        $laboratory = LaboratoryOrder::find($id);
        foreach ($this->labSections as $key => $sectionArray) {
            $section = array_map(function ($element) {
                if (is_array($element)) {
                    return null;
                }
                return ['name' => strtolower(str_replace(' ', '_', $element)), 'description' => $element];
            }, $sectionArray);
            $section = array_filter($section, function ($element) {
                return !empty ($element);
            });
            $this->keys['create'][$key] = ['key' => strtolower(str_replace(' ', '_', $key)), 'label' => $key, "type" => 'multiple_checkbox', 'options' => $section, 'name' => strtolower(str_replace(' ', '_', $key)), 'default' => $arrayDefault, 'grid' => 'col-md-3'];
            foreach ($sectionArray as $key => $value) {
                if (is_array($value)) {
                    $keyName = $value['key'];
                    $defaultValue = !empty($sections[$keyName]) ? $sections[$keyName] : '';
                    $laboratory->$keyName = $defaultValue;
                    $this->keys['create'][$key] = [
                        'no_print_if_empty' => true,
                        'key' => $value['key'],
                        'rows' => 5,
                        'label' => $key,
                        "type" => 'textarea',
                        'name' => $value['key'],
                        'grid' => 'col-md-3',
                    ];
                }
            }
            // type
            $this->keys['create'][] = ['type' => 'hr'];
        }
        // foreach($this->labSections as $key => $section){
        //     $section = array_map(function($element){
        //         return ['name' => strtolower(str_replace(' ', '_' , $element)), 'description' => $element];
        //     }, $section);
        //     $this->keys['create'][$key] = ['key'=>strtolower(str_replace(' ', '_' , $key)), 'label' => $key, "type" => 'multiple_checkbox', 'options'=>$section, 'name' => strtolower(str_replace(' ', '_' , $key)), 'default'=> $arrayDefault, 'grid' => 'col-md-3'];
        // }
        // $this->keys['create']['Radiografía'] = ['key'=>'Radiografía', 'label' => 'Radiografía', "type" => 'text', 'name' => 'radiografia', 'default' => !empty($sections['Radiografía']) ? $sections['Radiografía'] : ''];
        $this->keys['create']['Otros'] = ['key' => 'Otros', 'label' => 'Otros', "type" => 'text', 'name' => 'others', 'default' => !empty($sections['Otros']) ? $sections['Otros'] : ''];
        $this->patient_id = $laboratory->patient_id;
        $previous = LaboratoryOrder::where('id', '<', $id)->where('patient_id', $this->patient_id)->orderBy('id', 'desc')->first();
        $next = LaboratoryOrder::where('id', '>', $id)->where('patient_id', $this->patient_id)->first();
        return view('laboratory.add')->
            with('author', $laboratory->user)->
            with('laboratory', $laboratory)->
            with('previous', $previous)->
            with('patient', !empty($this->patient_id) ? \App\Patient::find($this->patient_id) : null)->
            with('next', $next)->
            with('title', !empty($this->title) ? $this->title : null)->
            with('form_method', 'post')->
            with('form_url', route($this->route_path . '.store'))->
            with('patient_id', !empty($this->patient_id) ? $this->patient_id : null)->
            with('keys', $this->keys['create']);
    }

    public function store(Request $request)
    {
        $A_request = $request->all();
        $labOrder = new LaboratoryOrder();
        unset($A_request['_token']);
        $labOrder->patient_id = $A_request['patient_id'];
        unset($A_request['patient_id']);
        $labOrder->json_values = json_encode($A_request);
        $labOrder->user_id = Auth::id();
        $labOrder->save();
        $labOrderId = $labOrder->id;
        $url = '/laboratory_order/' . $labOrderId . '/edit?patient_id=' . $labOrder->patient_id;
        return redirect($url)->with('success', 'Se ha guardado con exito');
    }

    public function ajaxDelete($request, $id = false)
    {
        return;
    }
    public function ajaxUpdate($request, $id = false)
    {
        $return;
    }
}
