<?php
use App\Product;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
header('Access-Control-Allow-Origin: *');
Auth::routes();
//mail
Route::get('helper/create/user', function (Request $request) {
	$email = $request->email;
	$name = $request->name;
	$lastName = $request->last_name;
	$password = $request->password;
	$sshCommand = "ssh dspace";
	$commandToRun = "/dspace/bin/dspace user --add --email '$email' -g '$name' -s '$lastName' --password '$password'";
	$fullCommand = "$sshCommand \"$commandToRun\"";
	exec($fullCommand, $output, $returnCode);
	if ($returnCode == 0) {
		return response()->json(['message' => 'User created successfully'], 200);
	} else {
		return response()->json(['message' => 'Error creating user'], 500);
	}
})->middleware('is_admin');
Route::get('cif21', function () {
	return response()->download(public_path('files/cif21.pdf'));
});
Route::get('atlas', function () {
	return response()->download(public_path('files/atlas.pdf'));
});
Route::get('users/ajaxAll', 'UsersController@ajaxAll');
Route::resource('users', 'UsersController')->middleware('logged_in');
Route::get('/historia', 'HomeController@index');
Route::post('/users/ajaxUpdate/{id?}', 'UsersController@ajaxUpdate')->name('users.ajaxUpdate');
Route::post('/users/ajaxDelete', 'UsersController@ajaxDelete')->name('users.ajaxDelete');
Route::get('/users/ajaxGet/{text}', 'UsersController@ajaxGet')->name('users.ajaxGet');

Route::resource('information', 'InformationRequestController');
Route::get('answer/{request_id}', 'InformationRequestController@answer')->name('answer.create');
Route::post('answer', 'InformationRequestController@send_answer')->name('answer.store');

Route::get('/', "HomeController@index");
Route::get('/index2', "HomeController@index2");
Route::resource('/store', 'ProductController')->middleware('logged_in');
Route::get('/checkout', 'ProductController@checkout')->name('checkout');

Route::resource('/bibliography', 'BibliographyController')->middleware('is_admin')->middleware('logged_in');
Route::post('/bibliography/ajaxUpdate/{id?}', 'BibliographyController@ajaxUpdate')->name('bibliography.ajaxUpdate');
Route::post('/bibliography/ajaxDelete', 'BibliographyController@ajaxDelete')->name('bibliography.ajaxDelete');
Route::get('/bibliography/ajaxGet/{text}', 'BibliographyController@ajaxGet')->name('bibliography.ajaxGet');
Route::get('/bibliography/download/{bibliography}', 'BibliographyController@downloadBibliography')->name('bibliography.download');

Route::get('/legal/terminos_y_condiciones', "LegalController@terms_and_conditions")->name('terms_and_conditions');
Route::get('/legal/aviso_privacidad', "LegalController@privacy_disclaimer")->name('privacy_disclaimer');
Route::get('/legal/terminos_y_condiciones', "LegalController@terms_and_conditions")->name('privacy_disclaimer');

Route::resource('/clinics', 'ClinicController')->middleware('logged_in');
Route::post('/clinics/ajaxUpdate/{id?}', 'ClinicController@ajaxUpdate')->name('clinics.ajaxUpdate');
Route::post('/clinics/ajaxDelete', 'ClinicController@ajaxDelete')->name('clinics.ajaxDelete');
Route::get('/clinics/ajaxGet/{text}', 'ClinicController@ajaxGet')->name('clinics.ajaxGet');

Route::resource('/servicios_en_salud', 'ServicesController');

Route::resource('/laboral_company', 'LaboralCompaniesController')->middleware('can_see_apoinments')->middleware('logged_in');
Route::post('/laboral_company/ajaxUpdate/{id?}', 'LaboralCompaniesController@ajaxUpdate')->name('laboral_company.ajaxUpdate');
Route::post('/laboral_company/ajaxDelete', 'LaboralCompaniesController@ajaxDelete')->name('laboral_company.ajaxDelete');
Route::get('/laboral_company/ajaxGet/{string?}', 'LaboralCompaniesController@ajaxGet')->name('laboral_company.ajaxGet');

Route::resource('/workspaces', 'WorkspacesController')->middleware('can_see_apoinments')->middleware('logged_in');
Route::post('/workspaces/ajaxUpdate/{id?}', 'WorkspacesController@ajaxUpdate')->name('workspaces.ajaxUpdate');
Route::post('/workspaces/ajaxDelete', 'WorkspacesController@ajaxDelete')->name('workspaces.ajaxDelete');
Route::get('/workspaces/ajaxGet/{string?}', 'WorkspacesController@ajaxGet')->name('workspaces.ajaxGet');


Route::resource('/protocolos_fisioterapia', 'ProtocoloFisioterapiaController')->middleware('can_see_apoinments')->middleware('logged_in');
Route::post('/protocolos_fisioterapia/ajaxUpdate/{id?}', 'ProtocoloFisioterapiaController@ajaxUpdate')->name('protocolos_fisioterapia.ajaxUpdate');
Route::post('/protocolos_fisioterapia/ajaxDelete', 'ProtocoloFisioterapiaController@ajaxDelete')->name('protocolos_fisioterapia.ajaxDelete');
Route::get('/protocolos_fisioterapia/ajaxGet/{string?}', 'ProtocoloFisioterapiaController@ajaxGet')->name('protocolos_fisioterapia.ajaxGet');
Route::get('/protocolos_fisioterapia/getAllWithRelationShips/{id}', 'ProtocoloFisioterapiaController@getAllWithRelationShips')->name('protocolos_fisioterapia.getAllWithRelationShips');

Route::get('/home_physiotherapy_program/newVersion/{id}', 'HomePhysiotherapyProgramController@newVersion')->name('home_physiotherapy_program.new_version');
Route::get('/protocolos_fisioterapia/newVersion/{id}', 'ProtocoloFisioterapiaController@newVersion')->name('protocolos_fisioterapia.new_version');

Route::resource('/product_categories', 'ProductCategoriesController')->middleware('can_see_apoinments')->middleware('logged_in');
Route::post('/product_categories/ajaxUpdate/{id?}', 'ProductCategoriesController@ajaxUpdate')->name('product_categories.ajaxUpdate');
Route::post('/product_categories/ajaxDelete', 'ProductCategoriesController@ajaxDelete')->name('product_categories.ajaxDelete');
Route::get('/product_categories/ajaxGet/{string?}', 'ProductCategoriesController@ajaxGet')->name('product_categories.ajaxGet');

Route::resource('/protocolos_fisioterapia_lmg', 'ProtocoloFisioterapiaLMGController')->middleware('can_see_apoinments')->middleware('logged_in');
Route::post('/protocolos_fisioterapia_lmg/ajaxUpdate/{id?}', 'ProtocoloFisioterapiaLMGController@ajaxUpdate')->name('protocolos_fisioterapia_lmg.ajaxUpdate');
Route::post('/protocolos_fisioterapia_lmg/ajaxDelete', 'ProtocoloFisioterapiaLMGController@ajaxDelete')->name('protocolos_fisioterapia_lmg.ajaxDelete');
Route::get('/protocolos_fisioterapia_lmg/ajaxGet/{string?}', 'ProtocoloFisioterapiaLMGController@ajaxGet')->name('protocolos_fisioterapia_lmg.ajaxGet');

Route::resource('/diagnosis_plan', 'DiagnosisPlanController')->middleware('can_see_apoinments')->middleware('logged_in');
Route::post('/diagnosis_plan/ajaxUpdate/{id?}', 'DiagnosisPlanController@ajaxUpdate')->name('diagnosis_plan.ajaxUpdate');
Route::post('/diagnosis_plan/ajaxDelete', 'DiagnosisPlanController@ajaxDelete')->name('diagnosis_plan.ajaxDelete');
Route::get('/diagnosis_plan/ajaxGet/{text}', 'DiagnosisPlanController@ajaxGet')->name('diagnosis_plan.ajaxGet');
Route::get('/diagnosis_plan/new_version/{id?}', 'DiagnosisPlanController@newVersion')->name('diagnosis_plan.new_version');

Route::resource('/terapeutic_plan', 'TerapeuticPlanController')->middleware('can_see_apoinments')->middleware('logged_in');
Route::post('/terapeutic_plan/ajaxUpdate/{id?}', 'TerapeuticPlanController@ajaxUpdate')->name('terapeutic_plan.ajaxUpdate');
Route::post('/terapeutic_plan/ajaxDelete', 'TerapeuticPlanController@ajaxDelete')->name('terapeutic_plan.ajaxDelete');
Route::get('/terapeutic_plan/ajaxGet/{text}', 'TerapeuticPlanController@ajaxGet')->name('terapeutic_plan.ajaxGet');
Route::get('/terapeutic_plan/newVersion/{id}', 'TerapeuticPlanController@newVersion')->name('terapeutic_plan.new_version');

Route::resource('/laboratory_order', 'LaboratoryOrderController')->middleware('logged_in');
Route::post('/laboratory_order/ajaxUpdate/{id?}', 'LaboratoryOrderController@ajaxUpdate')->name('laboratory_order.ajaxUpdate');
Route::post('/laboratory_order/ajaxDelete', 'LaboratoryOrderController@ajaxDelete')->name('laboratory_order.ajaxDelete');

Route::resource('/exercise', 'ExerciseController')->middleware('logged_in');
Route::get('getExerciseAjax/{id?}', 'ExerciseController@ajaxGet')->name('exercise.ajaxGet');
Route::post('/exercise/ajaxUpdate/{id?}', 'ExerciseController@ajaxUpdate')->name('exercise.ajaxUpdate');
Route::post('/exercise/ajaxDelete', 'ExerciseController@ajaxDelete')->name('exercise.ajaxDelete');

Route::resource('/cie9_mc', 'Cie9McController')->middleware('logged_in');
Route::get('/ajax_get_cie9_mc/{cie9_mc?}', 'Cie9McController@ajax_get_cie9_mc');
Route::post('/cie9_mc/ajaxUpdate/{id?}', 'Cie9McController@ajaxUpdate')->name('cie9_mc.ajaxUpdate');
Route::post('/cie9_mc/ajaxDelete', 'Cie9McController@ajaxDelete')->name('cie9_mc.ajaxDelete');
Route::resource('/cie10', 'CatCIE10Controller')->middleware('logged_in');
Route::get('/cie10/{id}/edit/{stop_extend}', 'CatCIE10Controller@edit')->name('cie10.edit_stop_extend');

Route::post('/cie10/ajaxUpdate/{id?}', 'CatCIE10Controller@ajaxUpdate')->name('cie10.ajaxUpdate');
Route::post('/cie10/ajaxDelete', 'CatCIE10Controller@ajaxDelete')->name('cie10.ajaxDelete');
Route::get('/ajax_get_cie10/{cie10?}', 'CatCIE10Controller@ajax_get_cie10')->name('cie10.ajaxGet');

Route::get('get_home_physiotherapy_program/{id?}', 'HomePhysiotherapyProgramController@ajax_get_home_physiotherapy_program')->name('home_physiotherapy_program.ajaxGet');
Route::resource('home_physiotherapy_program', 'HomePhysiotherapyProgramController')->middleware('logged_in')->middleware('logged_in');
Route::post('/home_physiotherapy_program/ajaxUpdate/{id?}', 'HomePhysiotherapyProgramController@ajaxUpdate')->name('home_physiotherapy_program.ajaxUpdate');
Route::post('/home_physiotherapy_program/ajaxDelete', 'HomePhysiotherapyProgramController@ajaxDelete')->name('home_physiotherapy_program.ajaxDelete');
Route::get('/home_physiotherapy_program/ajaxGet/{string?}', 'HomePhysiotherapyProgramController@ajaxGet')->name('home_physiotherapy_program.ajaxGet');

Route::resource('job_analysis', 'JobAnalysisController')->middleware('logged_in');
Route::post('/job_analysis/ajaxUpdate/{id?}', 'JobAnalysisController@ajaxUpdate')->name('job_analysis.ajaxUpdate');
Route::post('/job_analysis/ajaxDelete', 'JobAnalysisController@ajaxDelete')->name('job_analysis.ajaxDelete');


Route::resource('/cursos', 'CoursesController');
Route::resource('/tienda', 'ProductController');
Route::resource('/contacto', 'ContactController');
//pacientes, middleware
Route::resource('/pacientes', 'PatientController')->middleware('can_see_apoinments')->middleware('logged_in');
Route::get('/historia/createDecision/{patient_id?}', 'ClinicalHistoryController@createDecision')->name('history.decision.create')->middleware('can_see_apoinments');
Route::post('/historia/storeDecision', 'ClinicalHistoryController@storeDecision')->name('history.decision.store')->middleware('can_see_apoinments');
Route::resource('/historia', 'ClinicalHistoryController')->middleware('can_see_apoinments')->middleware('logged_in');
Route::get('/historia/create/{stop_extend?}', 'ClinicalHistoryController@create')->middleware('can_see_apoinments')->name('historia.create.choose');
Route::post('/historia/print', 'ClinicalHistoryController@printValoration')->name('historia.print')->middleware('can_see_apoinments')->middleware('logged_in');
Route::delete('/historia/valoration_delete/{id}', 'ClinicalHistoryController@valorationDelete')->name('historia.valoration_delete')->middleware('can_see_apoinments')->middleware('logged_in');
Route::post('/historia/add_file', 'ClinicalHistoryController@addFile');
Route::get('/historia/{patientId}/all_files', 'ClinicalHistoryController@allFiles');
Route::get('/historia/download_file/{fileId}/{fileName?}', 'ClinicalHistoryController@downloadFile');
Route::delete('/historia/remove_file/{path}', 'ClinicalHistoryController@removeFile');
Route::post('/sessions', 'ClinicalHistoryController@addSession');
Route::put('/sessions/{id}', 'ClinicalHistoryController@updateSession');
Route::get('/sessions', 'ClinicalHistoryController@allSession');
Route::delete('/sessions/{id}', 'ClinicalHistoryController@deleteSession');
Route::post('/session_objectives', 'ClinicalHistoryController@addSessionObjective');
Route::get('/session_objectives', 'ClinicalHistoryController@allSessionObjective');
Route::delete('/session_objectives/{id}', 'ClinicalHistoryController@deleteSessionObjective');
Route::put('/session_objectives/{id}', 'ClinicalHistoryController@updateSessionObjective');


Route::get('/admin/non_categorized_products', 'ProductController@nonCategorizedProducts');

Route::resource('/appoinments', 'AppoinmentController');
Route::get('/ajax_get_appoinments_from_date/{date?}', 'AppoinmentController@ajax_get_appoinments_from_date');
Route::get('/ajax_json_get_appoinments_from_date/{date?}', 'AppoinmentController@ajax_json_get_appoinments_from_date');


Route::resource('/decision', 'DecisionController');
Route::get('/send_decision/{decision}', 'DecisionController@sendDecision')->name('decision.send_decision')->middleware('logged_in');
Route::get('/print-decision/{decision}', 'DecisionController@printDecision')->name('decision.send_decision');

Route::resource('/orders', 'OrderController')->middleware('logged_in');
Route::post('/tienda/manage_cart', 'ProductController@AJAX_manageCart');

Route::get('/category/{viewcategory}', 'ProductCategoriesController@viewCategory');
Route::get('/helper/ajax_get_municipalities_id_by_name/{municipality_id}', 'CheckoutController@ajax_get_municipality_id_by_name');
Route::get('/helper/ajax_get_municipalities_from_state_id/{municipality_id}', 'CheckoutController@ajax_get_municipalities_by_state_id');
Route::get('/helper/ajax_get_estate_id_by_name/{state_name}', 'CheckoutController@ajax_get_estate_id_by_name');
// Route::get('/store/{viewcategory?}','ProductCategoriesController@index')->name("store.index");

Route::post('/charge', 'OpenPayController@store')->name('charge');
Route::post('/email/resend/{order}', 'OpenPayController@send_email')->name("resend_email");
Route::get('/detalles_de_compra/{id}/{mail_status?}', 'OpenPayController@detalles_de_compra')->name('openpay.detalles_de_compra');
Route::post('/revision', 'OpenPayController@revision');

Route::get('/ajax_json_get_all_therapies', 'AppoinmentController@ajax_json_get_all_therapies');

Route::get('/create_appointment_for_product/{product_id}', 'AppoinmentController@create_appointment_for_product')->name('appoinment_for_product.create');
Route::get('/ajax_get_remaining_times_from_date/{date?}/{clinic_id?}', 'AppoinmentController@ajax_get_remaining_times_from_date');
Route::get('/ajax_get_services', function () {
	$services = Product::where('product_category_id', 1)->where('active', true)->get();
	return response()->json($services, 200);
});

Route::get('employees', 'PatientController@index')->name('employees.index');
Route::get('employees/create', 'PatientController@create')->name('employees.create');

Route::get('ofertas/clientes', 'OfferController@indexForClients');
Route::get('empresas', 'CompaniesController@index')->name('companies');
//middleware admin
Route::resource('ofertas', 'OfferController')->middleware('web', 'is_admin')->middleware('logged_in');
Route::get('/test', 'TestController@index')->name('test');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/edit', 'HomeController@edit')->name('home.edit');
Route::get('/globalSearch/{id}', 'GlobalSearchController@show')->name('globalSearch.show');
Route::get('/globalSearch', 'GlobalSearchController@index')->name('globalSearch');
Route::delete('/globalSearch/{id}', 'GlobalSearchController@destroy')->name('global_search.destroy');
// Route::get('/ip', function(){
// 	return request()->ip();
// });
Route::put('/home', 'HomeController@update')->name('home.update');

Route::get('/keywords/ajaxGet/{text?}', 'KeywordController@ajaxGet')->name('keywords.ajaxGet');
Route::resource('/keywords', 'KeywordController')->middleware('logged_in');
Route::post('/keywords/ajaxUpdate/{id?}', 'KeywordController@ajaxUpdate')->name('keywords.ajaxUpdate');
Route::post('/keywords/ajaxDelete', 'KeywordController@ajaxDelete')->name('keywords.ajaxDelete');

Route::get('/anato_physiology_glosary_item/ajaxGet/{text?}', 'AnatoPhysiologyGlosaryItemsController@ajaxGet')->name('anato_physiology_glosary_item.ajaxGet');
Route::resource('/anato_physiology_glosary_item', 'AnatoPhysiologyGlosaryItemsController')->middleware('logged_in');
Route::post('/anato_physiology_glosary_item/ajaxUpdate/{id?}', 'AnatoPhysiologyGlosaryItemsController@ajaxUpdate')->name('anato_physiology_glosary_item.ajaxUpdate');
Route::post('/anato_physiology_glosary_item/ajaxDelete', 'AnatoPhysiologyGlosaryItemsController@ajaxDelete')->name('anato_physiology_glosary_item.ajaxDelete');

Route::resource('/dspace_metadata', 'DSpaceMetadataController');
Route::post('/our_library/massive_storage', 'DSpaceMetadataController@storeMassiveCsv')->name('our_library.massive_storing.store');
Route::get('/library', 'DSpaceMetadataController@libraryCreate')->name('our_library.create');
Route::post('/library', 'DSpaceMetadataController@libraryStore')->name('our_library.store');
Route::get('/library/metadata_creation', 'DSpaceMetadataController@massiveStoringCreate')->name('our_library.massive.create');
Route::get('/loginAsUser/{id}', 'UsersController@loginAsUser');

Route::resource('phisioaleph/documental_search', 'DocumentalSearchController');

Route::get('nordic', 'ClinicalHistoryController@_sumNordic');
Route::get('hand', 'ClinicalHistoryController@_sumSpecificHand');
Route::get('elbow', 'ClinicalHistoryController@_sumSpecificElbow');
Route::get('shoulder', 'ClinicalHistoryController@_sumSpecificShoulder');
Route::get('cervical_column', 'ClinicalHistoryController@_sumSpecificCervicalColumn');

Route::resource('/laboral_terapeutic_plan', 'LaboralTherapeuticPlanController')->middleware('logged_in');
Route::post('/laboral_terapeutic_plan/ajaxUpdate/{id?}', 'LaboralTherapeuticPlanController@ajaxUpdate')->name('laboral_terapeutic_plan.ajaxUpdate');
Route::post('/laboral_terapeutic_plan/ajaxDelete', 'LaboralTherapeuticPlanController@ajaxDelete')->name('laboral_terapeutic_plan.ajaxDelete');

Route::post('/weight_lifting_valoration/create', 'WeightLiftEvaluationController@create');
Route::post('/weight_lifting_valoration', 'WeightLiftEvaluationController@store');
Route::get('/weight_lifting_valoration/clinical_history/{clinicalHistoryId}', 'WeightLiftEvaluationController@show');

Route::resource('/clinical_physiotherapy_notes', 'ClinicalPhysiotherapyNotesController')->middleware('logged_in');
Route::resource('/clinical_rehabilitation_notes', 'ClinicalRehabilitationNotesController')->middleware('logged_in');

Route::get('/excercise_divisions/ajaxGet/{text?}', 'ExcerciseDivisionsController@ajaxGet')->name('excercise_divisions.ajaxGet');
Route::resource('/excercise_divisions', 'ExcerciseDivisionsController')->middleware('logged_in');
Route::post('/excercise_divisions/ajaxUpdate/{id?}', 'ExcerciseDivisionsController@ajaxUpdate')->name('excercise_divisions.ajaxUpdate');
Route::post('/excercise_divisions/ajaxDelete', 'ExcerciseDivisionsController@ajaxDelete')->name('excercise_divisions.ajaxDelete');
