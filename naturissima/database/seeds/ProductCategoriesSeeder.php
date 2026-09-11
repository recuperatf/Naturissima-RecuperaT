<?php

use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("product_categories")->insert([
        	"name"=>"Medicamentos",
        	"description"=>"Naturissima farmacias ofrece los mejores productos alópatas tanto de patente como genéricos para la salud de las familias. Procuramos seleccionar cuidadosamente los productos que ofrecemos con la política de calidad y economía en beneficio de las familias. ",
            "img"=>"/product_categories/img_medicamentos.jpg",
        ]);
        DB::table("product_categories")->insert([
        	"name"=>"Aromaterapia",
        	"description"=>"Medicina alternativa para la salud de las personas a través de diversos aceites esenciales que se obtienen de plantas medicinales. Estos aceites esenciales contribuyen a la salud emocional de las personas, ya que equilibran emociones y potencian la facultad sensorial a través del sentido del olfato. 
                <br/>
                La aromaterapia se basa en la obtención de aceites de plantas que se consideran potencialmente elevadas para lograr la salud por la energía que trasmiten.
                <br/>
                Entre los aceites esenciales básico encontramos la bergamota, el romero, el jazmín, la lavanda, entre otros, cada uno con diferentes propiedades que además combinados funcionan como activadores de energía y emociones positivas diversas.",
                "img"=>"/product_categories/img_aromaterapia.jpg",
        ]);
        DB::table("product_categories")->insert([
            "name"=>"Productos Naturales",
            "description"=>"Productos elaborados a base de plantas. Siguiendo normas oficiales mexicanas en la extracción de los beneficios de las diferentes plantas.
<br/>
Los laboratorios de productos naturales que manejamos seleccionan las plantas y mantienen los procesos de elaboración siguiendo los lineamientos de las autoridades sanitarias marcan.
<br/>
La selección por lo tanto de laboratorios y producto es altamente cuidada a fin de entregar los mejores productos a las familias.
<br/>
La dosificación también es importante por lo que esta se encuentra marcada en el producto y además es enseñada a través del catálogo de los productos
",
                "img"=>"/product_categories/img_productos_naturales.jpg",
        ]);
        DB::table("product_categories")->insert([
            "name"=>"Suplementos Alimenticios",
            "description"=>"Hoy en día mantenerse en forma y además estar adecuadamente nutrido tanto a nivel micro celular como macro celular es esencial. Naturissima Farmacias por lo tanto ofrece los mejores suplementos alimenticios tanto para las personas que realizan algún tipo de ejercicio como aquellas que por edad o actividad requieren tener una nutrición adecuada. Consulta aquí nuestro catálogo para que observes estos productos con mayor cuidado.
",
                "img"=>"/product_categories/img_suplementos_alimenticios.jpg",

        ]);
        DB::table("product_categories")->insert([
            "name"=>"Tes/tisanas",
            "description"=>"Bebida a partir de plantas aromáticas que se colocan sobre agua caliente para que la panta libere sus propiedades medicinales o terapéuticas. El té únicamente se prepara con la planta Camelia Sinesis, aunque se utiliza usualmente el término para muchas plantas que se preparan en forma individual. Las tisanas regularmente son combinaciones de plantas y frutos. 
",
                "img"=>"/product_categories/img_tes_y_tisanas.jpg",

        ]);
        DB::table("product_categories")->insert([
            "name"=>"Documentos Sobre Herbolaria",
            "description"=>"La tradición milenaria de la herbolaria mexicana se encuentra ahora presente en muchos de los remedios que han sido trasmitidos en forma generacional. Esta sección busca recuperar de fuentes confiables aquellos documentos que pueden concentrar esta tradición milenaria de cultivar y utilizar las plantas mexicanas presentes en nuestra geografía con lo que también se promueve su cuidado ya que muchas de estas plantas se encuentran hoy en día en peligro de extinción.
"
        ]);
        DB::table("product_categories")->insert([
            "name"=>"Recetas y remedios herbolarios",
            "description"=>"Naturissima farmacias selecciona para nuestros clientes farmacias y remedios herbolarios que coloca a disposición de las familias, etas incluyen formas de preparar los tés y tisanas, aplicación de plantas y forma de preparar diferentes plantas sean estas hojas, flores, cortezas o frutos.
",
                "img"=>"/product_categories/img_recetas_y_remedios_hermolarios.jpg",
        ]);
        DB::table("product_categories")->insert([
            "name"=>"Eventos",
            "description"=>"Naturissima farmacias comprometida con la salud y la armonía vital de las comunidades, realiza frecuentemente eventos con el fin de apoyar el desarrollo de las comunidades. Ejemplo de esto son los diversos talleres para elaboración de productos naturales, así como otros para manejo adecuado de enfermedades 
",
                "img"=>"/product_categories/img_eventos.jpg",

        ]);
        DB::table("product_categories")->insert([
            "name"=>"Servicios de Salud y Terapéuticos",
            "description"=>"Naturissima farmacia comprometida con la salud de la comunidades ofrece los siguientes servicios de salud.
<br/>
<br/>
<ul>
    <li>Consultas médicas. Previa cita que se agenda en los números de la farmacia en días específicos.</li>
    <li>Consultas homeopáticas. Previa cita que se agenda en los números de la farmacia en días específicos.</li>
</ul>
<br/>
<br/>
En ambos casos se puede pedir consulta a domicilio para los fraccionamientos que se encuentran en la zona del código postal 45134 que es donde opera la farmacia. Esta consulta tiene un costo mayor que la que se brinda en la farmacia.
<ul>
    <li>Flores de Bach. Previa cita que se agenda en los números de la farmacia.</li>
    <li>Orientación naturista. Tardes de los días lunes y viernes directamente acudiendo a la farmacia.</li>
</ul>
",

                "img"=>"/product_categories/img_servicios_de_salud.jpg",
        ]);
    }
}
