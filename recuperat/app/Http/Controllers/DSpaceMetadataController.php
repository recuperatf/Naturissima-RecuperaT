<?php

namespace App\Http\Controllers;

use App\CollectionType;
use App\ExternalResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DSpaceMetadataController extends Controller
{

  const ZOTERO_OUR_LIBRARY_MAPPING = [
    'Title' => ['name'],
    'Author' => ['creator'],
    'Date' => ['date_issued'],
    'Version' => ['latest_version', 'version_history'],
    'DOI' => ['doi'],
    'Legal Status' => ['document_status'],
    'Key' => ['collection_id'],
    'Url' => ['url'],
  ];
  public function index () {

  }

  public function create (Request $request) {
    return view('dspace_metadata.create');
  }
  public function libraryCreate(Request $request) {
    return view('our_library.create');
  }

  public function libraryStore (Request $request) {
    $all = $request->all();
    $externalResource = ExternalResource::create($all);
    $externalResource->save();
    return redirect()->route('globalSearch');
  }

  public function store (Request $request) {
    $collectionId = $request->input('collection_id');
    if (($csvFile = $request->file('csv_file')) && $collectionId) {
      $destinationPath = resource_path('dspace/Zotero-to-DSpace');
      $filename = "tmp_zotero_file.csv";
      $csvFile->move($destinationPath, $filename);
      $a = exec("cd $destinationPath && python3 convert.py -i $filename  -o dspace_items.csv -hdl $collectionId");
      $this->__removeDuplicatesFromCSV("$destinationPath/dspace_items.csv", "$destinationPath/dspace_items.csv");
      $this->__removeEmptyTitlesFromCSV("$destinationPath/dspace_items.csv", "$destinationPath/dspace_items.csv");
      return response()->download(resource_path("dspace/Zotero-to-DSpace/dspace_items.csv"));
    }
  }

  private function __removeEmptyTitlesFromCSV($csvFilePath, $filename) {
    $csv = array_map('str_getcsv', file($csvFilePath));
    $titles = [];
    $csv = array_filter($csv, function($row) {
        if (empty($row[6]))
            return false;
        return true;
    });
    $csvString = $this->__arrayToCSV($csv, $filename);
    return $csv;
  }

  private function __removeDuplicatesFromCSV($csvFilePath, $filename) {
    $csv = array_map('str_getcsv', file($csvFilePath));
    $titles = [];
    $csv = array_filter($csv, function($row) use (&$titles) {
        if (!empty($row[4]) && in_array($row[4], $titles)) return false;
        if (!empty($row[5]) && in_array($row[5], $titles)) return false;
        if (!empty($row[6]) && in_array($row[6], $titles)) return false;
        if (!empty($row[7]) && in_array($row[7], $titles)) return false;
        if (!empty($row[8]) && in_array($row[8], $titles)) return false;
        if (!empty($row[9]) && in_array($row[9], $titles)) return false;
        if (!empty($row[10]) && in_array($row[10], $titles)) return false;
        if (!empty($row[11]) && in_array($row[11], $titles)) return false;

        if (!empty($row[4])) $titles[] = $row[4];
        if (!empty($row[5])) $titles[] = $row[5];
        if (!empty($row[6])) $titles[] = $row[6];
        if (!empty($row[7])) $titles[] = $row[7];
        if (!empty($row[8])) $titles[] = $row[8];
        if (!empty($row[9])) $titles[] = $row[9];
        if (!empty($row[10])) $titles[] = $row[10];
        if (!empty($row[11])) $titles[] = $row[11];
        return true;
    });
    $csvString = $this->__arrayToCSV($csv, $filename);
    return $csv;
  }

  private function __arrayToCSV($array, $filename) {
    $csv = '';
    foreach ($array as $row) {
        $row = array_map(function($value) {
            $value = str_replace('"', "'", $value);
            return "\"$value\"";
        }, $row);
        $csv .=  implode(',', $row) . "\n";
        // if (strpos($row[6], "Allostasis") !== false)
        //     dd(implode(',', $row) . "\n");
    }
    return $this->__csvStringToFile($csv, $filename);
    return $filename;
  }

  private function __csvStringToFile($csvString, $filename) {
    $file = fopen($filename, 'w');
    fwrite($file, $csvString);
    fclose($file);
    return true;
  }

  public function massiveStoringCreate() {
    return view('our_library.massive_storing_create');
  }

  public function storeMassiveCsv(Request $request) {
    $JOURNAL_COLLECTION_TYPE_ID = 22;
    if ($csvFile = $request->file('csv_file')) {
      $destinationPath = resource_path('dspace/tmp_csvs');
      $randomUUID = Str::uuid();
      $filename = "tmp_zotero_file_$randomUUID.csv";
      $csvFile->move($destinationPath, $filename);

      $readCsvAsArray = array_map('str_getcsv', file("$destinationPath/$filename"));
      // first row is the header
      $header = array_shift($readCsvAsArray);
      $header = array_map(function($value) {
        return str_replace('"', '', $value);
      }, $header);
      $readCsvAsArray = array_map(function($row) use ($header) {
        return array_combine($header, $row);
      }, $readCsvAsArray);
      $mappedObjectsToOurLibrary = array_map(function($row) {
        $mapped = [];
        // dd($row);
        foreach ($row as $key => $value) {
          $cleanKey = preg_replace('/[[:^print:]]/', '', $key);
          if (!empty(self::ZOTERO_OUR_LIBRARY_MAPPING[$cleanKey])) {
            foreach (self::ZOTERO_OUR_LIBRARY_MAPPING[$cleanKey] as $ourLibraryKey) {
              $mapped[$ourLibraryKey] = $value;
            }
          }
        }
        return $mapped;
      }, $readCsvAsArray);
    }
    $mappedObjectsToOurLibrary = array_map(function($row) use ($JOURNAL_COLLECTION_TYPE_ID){
      $row['collection_type_id'] = $JOURNAL_COLLECTION_TYPE_ID;
      return $row;
    }, $mappedObjectsToOurLibrary);
    $repeatedResources = ExternalResource::whereIn('collection_id', array_column($mappedObjectsToOurLibrary, 'collection_id'))->get();
    $repeatedResourcesCount = count($repeatedResources);
    $mappedObjectsToOurLibrary = array_filter($mappedObjectsToOurLibrary, function($row) use ($repeatedResources) {
      foreach ($repeatedResources as $repeatedResource) {
        if ($repeatedResource->collection_id == $row['collection_id']) {
          return false;
        }
      }
      return true;
    });
    ExternalResource::insert($mappedObjectsToOurLibrary);
    $numberOfInsertedResources = count($mappedObjectsToOurLibrary);
    return view('global_search.index')
      ->with('success', "$numberOfInsertedResources recursos agregados. $repeatedResourcesCount recursos repetidos.")
      ->with('resultsArray', []);
  }

}

