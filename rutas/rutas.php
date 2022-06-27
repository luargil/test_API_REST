<?php 

$arrayRutas = explode("/", $_SERVER['REQUEST_URI']);

if(isset($_GET["page"]) && is_numeric($_GET["page"]))
{  

    $cursos = new ControladorCursos();
    $cursos -> index($_GET["page"]);    

}else
{

    if(count(array_filter($arrayRutas)) == 0)
    {
        
        /*=============================================
        RESPUESTA CUANDO NO SE HACE PETICION A LA API
        =============================================*/
                
        $json = array(

        "detalle"=>"no encontrado"

        );

        echo json_encode($json, true);

        return;

    }else
    {

        /*=============================================
        CUANDO PASAMOS SOLO UN INDICE AL $arrayRutas
        =============================================*/

        if(count(array_filter($arrayRutas)) == 1)
        {  

            /*=============================================
            CUANDO SE HACEN PETICIONES AL REGISTRO
            =============================================*/

            if(array_filter($arrayRutas)[1] == "registro")
            {

                /*=============================================
                SI LAS PETICIOONES SON POST
                =============================================*/

                if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST")
                {

                    /*=============================================
                    SE CAPTURAN LOS DATOS PARA EL REGISTRO DEL CLIENTE
                    =============================================*/

                    $datos = array( "nombre"=>$_POST["nombre"],
                                    "apellido"=>$_POST["apellido"],
                                    "email"=>$_POST["email"]);


                    $registro = new ControladorClientes();
                    $registro -> create($datos);    

                }else
                {

                    $json = array(

                        "detalle"=>"no encontrado"

                    );

                    echo json_encode($json, true);

                    return;

                }

            }

            /*=============================================
            CUANDO SE HACEN PETICIONES A LOS CURSOS
            =============================================*/

            else if(array_filter($arrayRutas)[1] == "cursos")
            {

                /*=============================================
                SI LAS PETICIONES SON GET
                =============================================*/

                if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET")
                {

                    $cursos = new ControladorCursos();
                    $cursos -> index(null); 

                }

                /*===========================.==================
                SI LAS PETICIONES SON POST
                =============================================*/

                else if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST")
                {

                    /*=============================================
                    SE CAPTURAN LOS DATOS PARA EL REGISTRO DEL CURSO
                    =============================================*/

                    $datos = array( "titulo"=>$_POST["titulo"],
                                    "descripcion"=>$_POST["descripcion"],
                                    "instructor"=>$_POST["instructor"],
                                    "imagen"=>$_POST["imagen"],
                                    "precio"=>$_POST["precio"]);

                    $crearCurso = new ControladorCursos();
                    $crearCurso -> create($datos);  

                }else
                {

                    $json = array(

                        "detalle"=>"no encontrado"

                    );

                    echo json_encode($json, true);

                    return;

                }

            }else
            {

                $json = array(

                    "detalle"=>"no encontrado"

                );

                echo json_encode($json, true);

                return;

            }

        }else
        {

            /*=============================================
            CUANDO SE HACEN PETICIONES A UN SOLO CURSO
            =============================================*/

            if(array_filter($arrayRutas)[1] == "cursos" && is_numeric(array_filter($arrayRutas)[2]))
            {

                /*=============================================
                SI LAS PETICIONES SON GET
                =============================================*/

                if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET")
                {

                    $curso = new ControladorCursos();
                    $curso -> show(array_filter($arrayRutas)[2]);   

                }

                /*=============================================
                SI LAS PETICIONES SON PUT
                =============================================*/

                else if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "PUT")
                {

                    /*=============================================
                    SE CAPTURAN LOS DATOS PARA LA ACTUALIZACION
                    =============================================*/

                    $datos = array();

                    parse_str(file_get_contents('php://input'), $datos);    

                    $editarCurso = new ControladorCursos();
                    $editarCurso -> update(array_filter($arrayRutas)[2], $datos);   

                }

                /*=============================================
                SI LAS PETICIONES SON DELETE
                =============================================*/

                else if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "DELETE")
                {

                    $borrarCurso = new ControladorCursos();
                    $borrarCurso -> delete(array_filter($arrayRutas)[2]);   

                }else
                {

                    $json = array(

                        "detalle"=>"no encontrado"

                    );

                    echo json_encode($json, true);

                    return;
                
                }


            }else
            {

                $json = array(

                    "detalle"=>"no encontrado"

                );

                echo json_encode($json, true);

                return;
            }

        }

    }

}

