<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\ExternalResource;

class GlobalSearchController extends CRUDController
{
    private $_includedModels = [
        'ProtocoloFisioterapia',
        'DiagnosisPlan',
        'TerapeuticPlan',
        'HomePhysiotherapyProgram',
        // 'ProtocoloFisioterapiaLMG'
    ];
    private function findResourceByType($resource, $keyword, $title, $author, $subject)
    {
        $returnQuery = $resource->where('is_sealed', true);
        if ($keyword) {
            $returnQuery->where("name", 'like', "%$keyword%")
                ->orWhereHas('keywords', function ($query) use ($keyword) {
                    $query->where('keywords.name', 'like', "%$keyword%");
                })
                ->orWhere('creator', 'like', $keyword);
        }
        if ($title) {
            $returnQuery = $returnQuery->where('name', 'like', $title);
        }
        if ($author) {
            $returnQuery = $returnQuery->where('creator', 'like', $author);
        }
        if ($subject) {
            $returnQuery = $returnQuery->where('description', 'like', $subject);
        }
        return $returnQuery->get();
    }
    public function index(Request $request)
    {
        $keyword = $request->input('keywords');
        $title = $request->input('search_title');
        $author = $request->input('search_author');
        $subject = $request->input('search_subject');
        $results = [];
        $documentsProtocoloFisioterapia = \App\ProtocoloFisioterapia::findResourceByType($keyword, $title, $author, $subject);
        $this->__addResultToArray($results, $documentsProtocoloFisioterapia, 'ProtocoloFisioterapia');
        $documentsHomePhysiotherapyProgram = \App\HomePhysiotherapyProgram::findResourceByType($keyword, $title, $author, $subject);
        $this->__addResultToArray($results, $documentsHomePhysiotherapyProgram, 'HomePhysiotherapyProgram');
        $documentsTerapeuticPlan = \App\TerapeuticPlan::findResourceByType($keyword, $title, $author, $subject);
        $this->__addResultToArray($results, $documentsTerapeuticPlan, 'TherapeuticPlan');
        $documentsDiagnosisPlan = \App\DiagnosisPlan::findResourceByType($keyword, $title, $author, $subject);
        $this->__addResultToArray($results, $documentsDiagnosisPlan, 'DiagnosticPlan');
        $externalResources = \App\ExternalResource::findResourceByType($keyword, $title, $author, $subject);
        $this->__addResultToArray($results, $externalResources, 'ExternalResource');


        return view('global_search.index')->with('resultsArray', $results);
    }

    const TYPE_PROTOCOL = 'ProtocoloFisioterapia';
    const TYPE_PROGRAM_HOME = 'HomePhysiotherapyProgram';
    const TYPE_PLAN_THERAPY = 'TherapeuticPlan';
    const TYPE_PLAN_DIAGNOSIS = 'DiagnosticPlan';
    const TYPES_PARSING = [
        'ProtocoloFisioterapia' => 'Protocolo de Fisioterapia',
        'HomePhysiotherapyProgram' => 'Programa Fisioterapéutico en Casa',
        'TherapeuticPlan' => 'Planes de tratamiento',
        'DiagnosticPlan' => 'Pruebas y medidas funcionales',
        'ExternalResource' => 'Recurso externo',
    ];

    private function __addResultToArray(&$resultsCollection, $collection, $type)
    {
        foreach ($collection as $element) {
            $element->type = $type;
            $element->parsedType = self::TYPES_PARSING[$type];
            $resultsCollection[] = $element;
        }
    }


    public function show($id)
    {
        $request = request();
        $type = $request->input('type', null);
        $document = [];
        $baseUrl = '';
        $document = \App\ExternalResource::find($id);
        $baseUrl = "";
        $fullUrl = "";
        if ($type == self::TYPE_PROTOCOL) {
            $document = \App\ProtocoloFisioterapia::find($id);
            $baseUrl = '/protocolos_fisioterapia';
            $fullUrl = "/protocolos_fisioterapia/$id";
        }

        if ($type == self::TYPE_PROGRAM_HOME) {
            $document = \App\HomePhysiotherapyProgram::find($id);
            $baseUrl = '/home_physiotherapy_program';
            $fullUrl = "/decision/$id";
        }

        if ($type == self::TYPE_PLAN_THERAPY) {
            $document = \App\TerapeuticPlan::find($id);
            $baseUrl = '/terapeutic_plan';
            $fullUrl = "/terapeutic_plan/$id";
        }

        if ($type == self::TYPE_PLAN_DIAGNOSIS) {
            $document = \App\DiagnosisPlan::find($id);
            $baseUrl = '/diagnosis_plan';
            $fullUrl = "/diagnosis_plan/$id";
        }

        if (!$document) {
            return view('global_search.index')
                ->with('success', 'No se encontró el recurso')
                ->with('resultsArray', []);
        }


        return view('global_search.show')->with('document', $document)->with('type', $type)->with('baseUrl', $baseUrl)->with('fullUrl', $fullUrl);
    }

    public function destroy($id)
    {
        ExternalResource::destroy($id);
        return redirect()->route('globalSearch')
            ->with('success', 'Recurso eliminado');
    }
}
