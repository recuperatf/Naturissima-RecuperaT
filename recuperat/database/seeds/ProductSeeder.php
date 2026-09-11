<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table("products")->insert([
          "name"=>"Terapia",
          "description"=>"Modelo comun para terapia",
          "product_category_id"=>1
      ]);
       DB::table("products")->insert([
        "name"=>"Terapia Física",
        "description"=>"Modelo comun para terapia",
        "img"=>"c_terapia_fisica.jpg",
        "product_category_id"=>1,
        "proxy_for"=>1
    ]);
       DB::table("products")->insert([
          "name"=>"Mecanoterapia",
          "description"=>"Es una de las técnicas que se usan en fisioterapia para realizar ejercicios terapéuticos medido por algún instrumento mecánico el cual nos ayuda a regular la fuerza, dirección y amplitud del movimiento.",
          "img"=>"mecanoterapia.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Electroterapia",
          "description"=>"Es una de las técnicas que se usan en fisioterapia, se usa la corriente eléctrica de manera terapéutica (con frecuencias, intensidad y tiempo preestablecido científicamente) para lograr un efecto fisiológico y neurofisiológico en el paciente.",
          "img"=>"electroterapia.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Termoterapia",
          "description"=>"Es una técnica de la fisioterapia en el cual se emplea el uso del calor superficial o profundo para lograr efectos fisiológicos y neurofisiológicos en el paciente.",
          "img"=>"termoterapia.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Crioterapia",
          "description"=>"Es una técnica de la fisioterapia en el cual se emplea el uso del frio para lograr efectos terapéuticos en el paciente lesionado.",
          "img"=>"crioterapia.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Kinesiotape",
          "description"=>"Aplicación de vendaje neuromuscular para lograr efectos terapéuticos, de drenaje, estabilización y corrección en un paciente.",
          "img"=>"kinesiotape.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Masoterapia",
          "description"=>"Es una técnica manual no invasiva usada en fisioterapia para lograr efectos terapéuticos (activación, relajación etc.) en el paciente.",
          "img"=>"masoterapia.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Consulta nutrición",
          "description"=>"Evaluación del estado nutricio y composición corporal, realiza plan de alimentación individualizado y asesoría para control de peso y tallas.<br/>
          Tratamiento nutrición para enfermedades crónicas degenerativas: obesidad, desnutrición, cáncer, diabetes, hipertensión, dislipidemias, gastritis, colitis, entre otras.<br/>
          Contamos con especialista en tratamiento de enfermedad renal crónica.",
          "img"=>"c_nutricion.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Consulta médica ortopedia y traumatología",
          "description"=>"Realiza diagnósticos en lesiones musculo esqueléticas basados en estudios clínicos, realiza tratamientos con cirugías o sin ella basado en evidencia.",
          "img"=>"c_trauma.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Consulta medicina física y rehabilitación",
          "description"=>"Consta de medicina preventiva y curativa
          En medicina preventiva se realiza valoración morfo funcional, valoración de las capacidades físicas, programas de activación física, detección de lesiones musculo esqueléticas.<br/>
          En medicina curativa se realiza diagnóstico de lesiones musculo esqueléticas, de aparatos y sistemas orgánicos.
          Tratamiento y rehabilitación de lesiones, manejo de patologías crónico degenerativas.",
          "img"=>"c_med_fisica.png",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Sesión de terapia física",
          "description"=>"Dar tratamiento por medio de calor profundo, calor superficial, ejercicios terapéuticos, electroterapia, agua, frio, masaje, con el fin de recuperar al paciente lo mejor posible.",
          "img"=>"s_terapia.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Terapia ocupacional",
          "description"=>"Realización de ejercicios terapéuticos y técnicas de movimiento para incorporar al paciente a su vida diaria de manera integral.",
          "img"=>"t_ocupacional.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Aplicación de ortesis",
          "description"=>"Una ortesis es un apoyo o complemento de nuestro cuerpo usado con el fin de corregir una postura, dar estabilización, dar apoyo a una articulación, prevenir deformidades etc., usadas en ortopedia y fisioterapia.",
          "img"=>"ortesis.png",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Estudios antropométricos",
          "description"=>"Una ortesis es un apoyo o complemento de nuestro cuerpo usado con el fin de corregir una postura, dar estabilización, dar apoyo a una articulación, prevenir deformidades etc., usadas en ortopedia y fisioterapia.",
          "img"=>"antropometricos.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Programas de salud laboral y ergonomía",
          "description"=>"Incorporación de la terapia física a tu empresa, te ayudamos mediante la impartición de cursos a brindarles a tus colaboradores la información correcta sobre el diseño y la evaluación de tareas, trabajos, productos, medio ambiente y sistemas para hacerlos compatibles con las necesidades, habilidades y limitaciones de las personas.",
          "img"=>"salud_ergonomica.png",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Programas reductivos",
          "description"=>"Dicho programa será acompañado de un nutriólogo y un fisioterapeuta, las sesiones incluyen la consulta nutricional, Masoterapia, electroterapia en diferentes protocolos y una rutina especifica de ejercicio.<br/>
          El objetivo es reducir medidas logrando una apariencia más estética.",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
       DB::table("products")->insert([
          "name"=>"Programas de activación física en adultos mayores",
          "description"=>"Las personas que realizan actividad física de manera continua, tienen menor riesgo de padecer enfermedades cardiovasculares, disminuye el riesgo de caídas, previene obesidad, por esta razón acude con nosotros a nuestro programa de activación física en el cual se adaptará un programa individualizado y así poder gozar los beneficios del ejercicio.",
          "img"=>"adultos_mayores.jpg",
          "product_category_id"=>1,
          "proxy_for"=>1
      ]);
   }
}
