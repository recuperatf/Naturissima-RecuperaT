<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('cie10form/{id}', 'CatCIE10Controller@cie10_form');
Route::prefix('exercise')->group(
    function () {
        Route::post('', 'ExerciseController@apiCreate');
        Route::post('exercise', 'ExerciseController@addExercise');
    }
);

Route::prefix('keywords')->group(
    function () {
        Route::post('create', 'KeywordController@apiStore');
    }
);

Route::prefix('glosary_ap')->group(
    function () {
        Route::post('create', 'AnatoPhysiologyGlosaryItemsController@apiStore');
    }
);

Route::prefix('terapeutic_plans')->group(
    function () {
        Route::post('', 'TerapeuticPlanController@apiStore');
        Route::put('/{id}', 'TerapeuticPlanController@apiUpdate');
    }
);

Route::prefix('terapeutic_plan_phases')->group(
    function () {
        Route::post('create', 'TerapeuticPlanController@apiStorePhase');
        Route::post('{id}/images', 'TerapeuticPlanController@apiStorePhaseImage');
        Route::put('{id}', 'TerapeuticPlanController@apiUpdatePhase');
        Route::delete('{id}', 'TerapeuticPlanController@deletePhase');
    }
);

Route::prefix('terapeutic_plan_phases_images')->group(
    function () {
        Route::delete('{id}', 'TerapeuticPlanController@apiDeletePhaseImage');
    }
);

Route::prefix('home_physiotherapy_program')->group(
    function () {
        Route::get('search/{string}', 'HomePhysiotherapyProgramController@apiSearch');
        Route::get('', 'HomePhysiotherapyProgramController@apiIndex');
        Route::get('{hpfId}', 'HomePhysiotherapyProgramController@apiShow');
        Route::put('{hpfId}', 'HomePhysiotherapyProgramController@update');
        Route::put('{hpfId}', 'HomePhysiotherapyProgramController@apiUpdate');
        Route::post('', 'HomePhysiotherapyProgramController@apiCreate');
        Route::get('{hpfId}/exercise', 'HomePhysiotherapyProgramController@apiGetExercise');
        Route::post('{hpfId}/exercise', 'HomePhysiotherapyProgramController@apiCreateExercise');
        Route::put('{hpfId}/exercise', 'HomePhysiotherapyProgramController@apiUpdateExercise');
        Route::delete('{hpfId}/exercise/{exercise}', 'HomePhysiotherapyProgramController@apiDeleteExercise');
        Route::delete('{hpfId}/exercise/{exercise}/image_resource/{imageResource}', 'HomePhysiotherapyProgramController@apiDeleteExerciseResourceImage');
        Route::post('{hpfId}/massage', 'HomePhysiotherapyProgramController@apiCreateMassage');
        Route::delete('{hpfId}/massage/{massage}', 'HomePhysiotherapyProgramController@apiDeleteMassage');
        Route::put('{hpfId}/massage', 'HomePhysiotherapyProgramController@apiUpdateMassage');
        Route::delete('{hpfId}/massage/{massage}/image_resource/{imageResource}', 'HomePhysiotherapyProgramController@apiDeleteMassageResourceImage');
        Route::post('{hpfId}/physical_agent', 'HomePhysiotherapyProgramController@apiCreatePhysicalAgent');
        Route::delete('{hpfId}/physical_agent/{physicalAgent}', 'HomePhysiotherapyProgramController@apiDeletePhysicalAgent');
        Route::put('{hpfId}/physical_agent', 'HomePhysiotherapyProgramController@apiUpdatePhysicalAgent');
        Route::delete('{hpfId}/physical_agent/{physicalAgent}/image_resource/{imageResource}', 'HomePhysiotherapyProgramController@apiDeletePhysicalAgentResourceImage');
        Route::post('{hpfId}/prescription', 'HomePhysiotherapyProgramController@apiCreatePrescription');
        Route::delete('{hpfId}/prescription/{prescription}', 'HomePhysiotherapyProgramController@apiDeletePrescription');
        Route::put('{hpfId}/prescription', 'HomePhysiotherapyProgramController@apiUpdatePrescription');
        Route::delete('{hpfId}/prescription/{prescription}/image_resource/{imageResource}', 'HomePhysiotherapyProgramController@apiDeletePrescriptionResourceImage');
        Route::post('{hpfId}/contraindication', 'HomePhysiotherapyProgramController@apiCreateContraindication');
        Route::delete('{hpfId}/contraindication/{contraindication}', 'HomePhysiotherapyProgramController@apiDeleteContraindication');
        Route::put('{hpfId}/contraindication', 'HomePhysiotherapyProgramController@apiUpdateContraindication');
        Route::post('{hpfId}/exercise_category', 'HomePhysiotherapyProgramController@apiAddExerciseCategory');
        Route::get('{hpfId}/exercise_category', 'HomePhysiotherapyProgramController@apiGetExerciseCategories');
        Route::post('{hpfId}/keywords', 'HomePhysiotherapyProgramController@apiAddKeywords');
        Route::post('{hpfId}/glosary_ap', 'HomePhysiotherapyProgramController@apiAddGlosaryAP');
    }
);

Route::resource('job_analysis', 'JobAnalysisController');

Route::prefix('decision')->group(
    function () {
        Route::get('home_physiotherapy_program/{string}', 'DecisionController@apiHomePhysiotherapyProgramShow');
    }
);
