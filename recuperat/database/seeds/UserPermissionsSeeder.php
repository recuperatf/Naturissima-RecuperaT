<?php

use Illuminate\Database\Seeder;

class UserPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administracion
        DB::table('permissions')->insert([
            'name' => 'administation_menu.see',
            'description' => 'Administración Menú',
        ]);
        DB::table('permissions')->insert([
            'name' => 'dspace_metadata.see',
            'description' => 'Administración/Ver Carga de metadataos (DSpace)',
        ]);
        DB::table('permissions')->insert([
            'name' => 'dspace_metadata.create',
            'description' => 'Administración/Crear Carga de metadataos (DSpace)',
        ]);
        DB::table('permissions')->insert([
            'name' => 'our_library_files.see',
            'description' => 'Administración/Ver Carga de archivos (Fisioaleph)',
        ]);
        DB::table('permissions')->insert([
            'name' => 'our_library_files.create',
            'description' => 'Administración/Crear Carga de archivos (Fisioaleph)',
        ]);
        DB::table('permissions')->insert([
            'name' => 'our_library_metadata.see',
            'description' => 'Administración/Ver Carga de metadatos (Fisioaleph)',
        ]);
        DB::table('permissions')->insert([
            'name' => 'our_library_metadata.create',
            'description' => 'Administración/Crear Carga de metadatos (Fisioaleph)',
        ]);
        // // Usuarios
        // DB::table('permissions')->insert([
        //     'name' => 'users.see',
        //     'description' => 'Ver usuarios',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'users.edit',
        //     'description' => 'Editar usuarios',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'users.create',
        //     'description' => 'Crear usuarios',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'users.delete',
        //     'description' => 'Borrar usuarios',
        // ]);
        // // Usuarios
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office.see',
        //     'description' => 'Ver consulta',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office.delete',
        //     'description' => 'Borrar pacientes en consulta',
        // ]);
        // // Recetas
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_prescriptions.see',
        //     'description' => 'Ver recetas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_prescriptions.edit',
        //     'description' => 'Editar recetas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_prescriptions.create',
        //     'description' => 'Crear recetas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_prescriptions.delete',
        //     'description' => 'Borrar recetas',
        // ]);
        // // Laboratorios
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_labs.see',
        //     'description' => 'Ver laboratorios',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_labs.edit',
        //     'description' => 'Editar laboratorios',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_labs.create',
        //     'description' => 'Crear laboratorios',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_labs.delete',
        //     'description' => 'Borrar laboratorios',
        // ]);
        // // Recetas
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_prescription.see',
        //     'description' => 'Ver notas de evolución',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_prescription.edit',
        //     'description' => 'Editar notas de evolución',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_prescription.create',
        //     'description' => 'Crear notas de evolución',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_prescription.delete',
        //     'description' => 'Borrar notas de evolución',
        // ]);
        // // Sesiones de tratamiento
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_treatments.see',
        //     'description' => 'Ver sesiones de tratamiento',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_treatments.edit',
        //     'description' => 'Editar sesiones de tratamiento',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_treatments.create',
        //     'description' => 'Crear sesiones de tratamiento',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_treatments.delete',
        //     'description' => 'Borrar sesiones de tratamiento',
        // ]);
        // // Sesiones de tratamiento
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_clinical_history.see',
        //     'description' => 'Ver historias clínicas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_clinical_history.edit',
        //     'description' => 'Editar historias clínicas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_clinical_history.create',
        //     'description' => 'Crear historias clínicas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_clinical_history.delete',
        //     'description' => 'Borrar historias clínicas',
        // ]);
        // // Valoraciones de fisiotarpia
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_physiotherapy_valorations.see',
        //     'description' => 'Ver valoraciones de fisioterapia',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_physiotherapy_valorations.edit',
        //     'description' => 'Editar valoraciones de fisioterapia',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_physiotherapy_valorations.create',
        //     'description' => 'Crear valoraciones de fisioterapia',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'medical_office_session_physiotherapy_valorations.delete',
        //     'description' => 'Borrar valoraciones de fisioterapia',
        // ]);
        // // protocolos
        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapy_protocols.see',
        //     'description' => 'Ver protocolos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapy_protocols.edit',
        //     'description' => 'Editar protocolos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapy_protocols.create',
        //     'description' => 'Crear protocolos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapy_protocols.delete',
        //     'description' => 'Borrar protocolos',
        // ]);
        // // planes diagnosticos
        // DB::table('permissions')->insert([
        //     'name' => 'diagnosis_plans.see',
        //     'description' => 'Ver pruebas y medidas fucionales',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'diagnosis_plans.edit',
        //     'description' => 'Editar pruebas y medidas fucionales',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'diagnosis_plans.create',
        //     'description' => 'Crear pruebas y medidas fucionales',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'diagnosis_plans.delete',
        //     'description' => 'Borrar pruebas y medidas fucionales',
        // ]);
        // // Planes terapéuticos
        // DB::table('permissions')->insert([
        //     'name' => 'terapeutic_plans.see',
        //     'description' => 'Ver planes terapeuticos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'terapeutic_plans.edit',
        //     'description' => 'Editar planes terapeuticos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'terapeutic_plans.create',
        //     'description' => 'Crear planes terapeuticos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'terapeutic_plans.delete',
        //     'description' => 'Borrar planes terapeuticos',
        // ]);
        // // Programas terpáuticos en casa
        // DB::table('permissions')->insert([
        //     'name' => 'home_fisiotherapy_program.see',
        //     'description' => 'Ver programas terpáuticos en casa',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'home_fisiotherapy_program.edit',
        //     'description' => 'Editar programas terpáuticos en casa',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'home_fisiotherapy_program.create',
        //     'description' => 'Crear programas terpáuticos en casa',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'home_fisiotherapy_program.delete',
        //     'description' => 'Borrar programas terpáuticos en casa',
        // ]);
        // // Fisioterapia laboral (análisis de puesto)
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_job_analysis.see',
        //     'description' => 'Ver análisis de puesto',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_job_analysis.edit',
        //     'description' => 'Editar análisis de puesto',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_job_analysis.create',
        //     'description' => 'Crear análisis de puesto',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_job_analysis.delete',
        //     'description' => 'Borrar análisis de puesto',
        // ]);
        // // Fisioterapia laboral (nórdico)
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_norse.see',
        //     'description' => 'Ver nórdico',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_norse.edit',
        //     'description' => 'Editar nórdico',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_norse.create',
        //     'description' => 'Crear nórdico',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_norse.delete',
        //     'description' => 'Borrar nórdico',
        // ]);
        // // Fisioterapia laboral (nórdico)
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_load_manual.see',
        //     'description' => 'Ver manual de cargas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_load_manual.edit',
        //     'description' => 'Editar manual de cargas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_load_manual.create',
        //     'description' => 'Crear manual de cargas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_load_manual.delete',
        //     'description' => 'Borrar manual de cargas',
        // ]);
        // // Fisioterapia laboral (nórdico)
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_evaluations.see',
        //     'description' => 'Ver evaluaciones laborales',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_evaluations.edit',
        //     'description' => 'Editar evaluaciones laborales',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_evaluations.create',
        //     'description' => 'Crear evaluaciones laborales',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_evaluations.delete',
        //     'description' => 'Borrar evaluaciones laborales',
        // ]);
        // // Fisioterapia laboral (nórdico)
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_lmg_protocols.see',
        //     'description' => 'Ver LMG protocolos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_lmg_protocols.edit',
        //     'description' => 'Editar LMG protocolos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_lmg_protocols.create',
        //     'description' => 'Crear LMG protocolos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_lmg_protocols.delete',
        //     'description' => 'Borrar LMG protocolos',
        // ]);
        // // Fisioterapia laboral (nórdico)
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_laboral_companies.see',
        //     'description' => 'Ver empresas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_laboral_companies.edit',
        //     'description' => 'Editar empresas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_laboral_companies.create',
        //     'description' => 'Crear empresas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_laboral_companies.delete',
        //     'description' => 'Borrar empresas',
        // ]);
        // // Fisioterapia laboral (nórdico)
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_laboral_workspaces.see',
        //     'description' => 'Ver puestos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_laboral_workspaces.edit',
        //     'description' => 'Editar puestos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_laboral_workspaces.create',
        //     'description' => 'Crear puestos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboral_physiotherapy_laboral_workspaces.delete',
        //     'description' => 'Borrar puestos',
        // ]);



        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyOffice.edit_diagnosis_plan',
        //     'description' => '(F Consulta) Editar pruebas y medidas',
        // ]);

        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyOffice.edit_treatment_sessions',
        //     'description' => '(F Consulta) Editar sesiones de tratamiento',
        // ]);

        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyHomePhysitherapyProgram.edit',
        //     'description' => '(F) Editar programa fisioterapéutico en casa',
        // ]);

        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyOffice.edit_valorations',
        //     'description' => '(F Consulta) Editar valoraciones de fisioterapia',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyOffice.see_notas',
        //     'description' => '(F Consulta) Ver notas',
        // ]);

        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyOffice.edit_notas',
        //     'description' => '(F Consulta) Editar notas',
        // ]);

        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyOffice.see_clinical_history',
        //     'description' => '(F Consulta) Editar Historia Clínica',
        // ]);


        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyOffice.see_recetas',
        //     'description' => '(F Consulta) Editar recetas',
        // ]);

        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyOffice.see_laboratorios',
        //     'description' => '(F Consulta) Editar estudios de laboratorio',
        // ]);


        // DB::statement("SET foreign_key_checks=0");
        // DB::table('permissions')->truncate();
        // DB::table('permission_user')->truncate();
        // DB::statement("SET foreign_key_checks=1");

        // DB::table('permissions')->insert([
        //     'name' => 'laboralPhysiotherapyJobAnalysis.see',
        //     'description' => '(FL) Ver análisis de puesto',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboralPhysiotherapyNorse.see',
        //     'description' => '(FL) Ver nórdico',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboralPhysiotherapyLoads.see',
        //     'description' => '(FL) Ver Cargas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboralPhysiotherapyEvaluations.see',
        //     'description' => '(FL) Ver Evaluaciones',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboralPhysiotherapyTests.see',
        //     'description' => '(FL) Ver Pruebas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'laboralPhysiotherapyLMGProtocols.see',
        //     'description' => '(FL) Ver Protocolos LMG',
        // ]);


        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyOffice.see',
        //     'description' => '(F) Ver consulta fisioterapia',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyProtocols.see',
        //     'description' => '(F) Ver protocolos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyTests.see',
        //     'description' => '(F) Ver Pruebas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyHomePhysitherapyProgram.see',
        //     'description' => '(F) Ver programa fisioterapéutico en casa',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyTherapeuticPlan.see',
        //     'description' => '(F) Ver Plan Terapéutico',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyCie10.see',
        //     'description' => '(F) Ver cie 10',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'physiotherapyCie9MC.see',
        //     'description' => '(F) Ver Cie9-CM',
        // ]);


        // DB::table('permissions')->insert([
        //     'name' => 'administrativeUsers.see',
        //     'description' => '(F) Ver Usuarios',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'administrativeQuestions.see',
        //     'description' => '(F) Ver Preguntas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'administrativeOrders.see',
        //     'description' => '(F) Ver Órdenes',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'administrativeNonClasifiedProducts.see',
        //     'description' => '(F) Ver Productos sin clasificar',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'administrativeAppoinmtents.see',
        //     'description' => '(F) Ver Citas',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'administrativeCenters.see',
        //     'description' => '(F) Ver Centros',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'administrativeProductCategories.see',
        //     'description' => '(F) Ver Categorías de Productos',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'agenda.see',
        //     'description' => 'Ver agenda',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'agenda.delete',
        //     'description' => 'Borrar eventos de la agenda',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'general_database.see',
        //     'description' => 'Bases de datos en general',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'general_database.edit',
        //     'description' => 'Editar bases de datos en general',
        // ]);
        // DB::table('permissions')->insert([
        //     'name' => 'general_database.delete',
        //     'description' => 'Borrar cualquier registro',
        // ]);
    }
}
