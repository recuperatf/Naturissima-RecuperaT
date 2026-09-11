<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DocumentalSearchController extends Controller
{
    public function index(Request $request) {
        $searchTerms = $request->input('search');
        $hours = 12;
        $seconds = $hours * 60 * 60;
        $results = Cache::store('redis')->remember('dspace_items', $seconds, function () {
            $json = file_get_contents("https://biblioteca.fisioaleph.com/rest/items");
            return json_decode($json);
        });
        if ($searchTerms) {
            $results = array_filter($results, function ($item) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    if (property_exists($item, $term['where']) && $term['term']){
                        $keyToSearch = $term['where'];
                        $keyword = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($term['term'], ENT_QUOTES, 'UTF-8'))), ' '));
                        $value = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($item->$keyToSearch, ENT_QUOTES, 'UTF-8'))), ' '));
                        if (strpos($value, $keyword) !== false) return true;
                    }
                }
                return false;
            });
        } else {
            $results = [];
        }
        return view('layouts.fisioaleph.documents_search')->with('resultsArray', $results);
    }
}
