<?php 

class ControladorCursos
{

    /*=============================================
    MOSTRAR TODOS LOS CURSOS
    =============================================*/

    public function index($page)
    {

        /*=============================================
        VALIDAR EL TOKEN DEL CLIENTE
        =============================================*/

        $clientes = ModeloClientes::index("clientes");

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
        {

            foreach ($clientes as $key => $valueCliente)
            {
                
                if( "Basic ".base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW']) == 
                    "Basic ".base64_encode($valueCliente["id_cliente"].":".$valueCliente["llave_secreta"]) )
                {               

                    if($page != null)
                    {

                        /*=============================================
                        MOSTRAR LOS CURSOS CON PAGINACION
                        =============================================*/

                        $cantidad = 5;
                        $desde = ($page-1)*$cantidad;

                        $cursos = ModeloCursos::index("cursos", "clientes", $cantidad, $desde);

                    }else
                    {

                        /*=============================================
                        MOSTRAR LOS CURSOS
                        =============================================*/

                        $cursos = ModeloCursos::index("cursos", "clientes", null, null);

                    }

                    if(!empty($cursos))
                    {

                        $json = array(

                            "status"=>200,
                            "total_registros"=>count($cursos),
                            "detalle"=>$cursos

                        );

                        echo json_encode($json, true);

                        return;

                    }else
                    {

                        $json = array(

                            "status"=>200,
                            "total_registros"=>0,
                            "detalles"=>"No hay ningún curso registrado"
                            
                        );

                        echo json_encode($json, true);  

                        return;

                    }


                }else
                {

                    $json = array(

                        "status"=>404,
                        "detalles"=>"El token es inválido"
                        
                    );

                }

            }

        }else
        {

            $json = array(

                "status"=>404,
                "detalles"=>"No esta autorizado para recibir los registros"
                
            );

        }

        echo json_encode($json, true);  

        return;     

        

    }

    /*=============================================
    REGISTRAR UN NUEVO CURSO
    =============================================*/

    public function create($datos)
    {

        /*=============================================
        Validar credenciales del cliente
        =============================================*/

        $clientes = ModeloClientes::index("clientes");

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
        {

            foreach ($clientes as $key => $valueCliente)
            {
                
                if( "Basic ".base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW']) == 
                    "Basic ".base64_encode($valueCliente["id_cliente"].":".$valueCliente["llave_secreta"]) )
                {

                    /*=============================================
                    Validar datos
                    =============================================*/

                    foreach ($datos as $key => $valueDatos)
                    {

                        if(isset($valueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $valueDatos))
                        {

                            $json = array(

                                "status"=>404,
                                "detalle"=>"Error en el campo ".$key

                            );

                            echo json_encode($json, true);

                            return;
                        }

                    }

                    /*=============================================
                    Validar que el titulo o la descripcion no estén repetidos
                    =============================================*/

                    $cursos = ModeloCursos::index("cursos", "clientes", null, null);
                    
                    foreach ($cursos as $key => $value)
                    {
                        
                        if($value->titulo == $datos["titulo"])
                        {

                            $json = array(

                                "status"=>404,
                                "detalle"=>"El título ya existe en la base de datos"

                            );

                            echo json_encode($json, true);  

                            return;

                        }

                        if($value->descripcion == $datos["descripcion"])
                        {

                            $json = array(

                                "status"=>404,
                                "detalle"=>"La descripción ya existe en la base de datos"

                            );

                            echo json_encode($json, true);  

                            return;

                            
                        }

                    }

                
                    /*=============================================
                    Llevar datos al modelo
                    =============================================*/
    
                    $datos = array( "titulo"=>$datos["titulo"],
                                    "descripcion"=>$datos["descripcion"],
                                    "instructor"=>$datos["instructor"],
                                    "imagen"=>$datos["imagen"],
                                    "precio"=>$datos["precio"],
                                    "id_creador"=>$valueCliente["id"],
                                    "created_at"=>date('Y-m-d h:i:s'),
                                    "updated_at"=>date('Y-m-d h:i:s'));

                    $create = ModeloCursos::create("cursos", $datos);

                    /*=============================================
                    Respuesta del modelo
                    =============================================*/

                    if($create == "ok")
                    {

                        $json = array(
                            "status"=>200,
                            "detalle"=>"Registro exitoso, su curso ha sido guardado"

                        ); 
                        
                        echo json_encode($json, true); 

                        return;     

                    }
                
                }else
                {

                    $json = array(

                        "status"=>404,
                        "detalles"=>"El token es inválido"
                        
                    );

                }

            }

        }else
        {

            $json = array(

                "status"=>404,
                "detalles"=>"No está autorizado para recibir los registros"
                
            );

        }

        echo json_encode($json, true);  

        return;     

    }

    /*=============================================
    MOSTRAR UN SOLO CURSO PARA EDITARLO
    =============================================*/

    public function show($id)
    {

        /*=============================================
        Validar credenciales del cliente
        =============================================*/

        $clientes = ModeloClientes::index("clientes");

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
        {

            foreach ($clientes as $key => $valueCliente)
            {
                
                if( "Basic ".base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW']) == 
                    "Basic ".base64_encode($valueCliente["id_cliente"].":".$valueCliente["llave_secreta"]) )
                {

                    /*=============================================
                    Mostrar todos los cursos
                    =============================================*/

                    $curso = ModeloCursos::show("cursos","clientes", $id);

                    if(!empty($curso))
                    {

                        $json = array(

                            "status"=>200,
                            "detalle"=>$curso

                        );

                        echo json_encode($json, true);

                        return;

                    }else
                    {

                        $json = array(

                            "status"=>200,
                            "total_registros"=>0,
                            "detalles"=>"No hay ningún curso registrado"
                            
                        );

                        echo json_encode($json, true);  

                        return;

                    }


                }else
                {

                    $json = array(

                        "status"=>404,
                        "detalles"=>"El token es inválido"
                        
                    );

                }

            }

        }else
        {

            $json = array(

                "status"=>404,
                "detalles"=>"No está autorizado para recibir los registros"
                
            );

        }

        echo json_encode($json, true);  

        return;     

    }

    /*=============================================
    EDITAR EL CURSO
    =============================================*/

    public function update($id, $datos)
    {

        /*=============================================
        Validar credenciales del cliente
        =============================================*/

        $clientes = ModeloClientes::index("clientes");

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
        {

            foreach ($clientes as $key => $valueCliente)
            {
                
                if( "Basic ".base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW']) == 
                    "Basic ".base64_encode($valueCliente["id_cliente"].":".$valueCliente["llave_secreta"]) )
                {

                    /*=============================================
                    Validar datos
                    =============================================*/

                    foreach ($datos as $key => $valueDatos)
                    {

                        if(isset($valueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $valueDatos))
                        {

                            $json = array(

                                "status"=>404,
                                "detalle"=>"Error en el campo ".$key

                            );

                            echo json_encode($json, true);

                            return;
                        }

                    }

                    /*=============================================
                    Validar id creador
                    =============================================*/

                    $curso = ModeloCursos::show("cursos", "clientes", $id);

                    foreach ($curso as $key => $valueCurso)
                    {
                        
                        if($valueCurso->id_creador == $valueCliente["id"])
                        {

                            /*=============================================
                            Llevar datos al modelo
                            =============================================*/
            
                            $datos = array( "id"=>$id,
                                            "titulo"=>$datos["titulo"],
                                            "descripcion"=>$datos["descripcion"],
                                            "instructor"=>$datos["instructor"],
                                            "imagen"=>$datos["imagen"],
                                            "precio"=>$datos["precio"],
                                            "updated_at"=>date('Y-m-d h:i:s'));

                            $update = ModeloCursos::update("cursos", $datos);

                            /*=============================================
                            Respuesta del modelo
                            =============================================*/

                            if($update == "ok")
                            {

                                $json = array(
                                    "status"=>200,
                                    "detalle"=>"Registro exitoso, su curso ha sido actualizado"

                                ); 
                                
                                echo json_encode($json, true); 

                                return;     

                            }

                        }else
                        {

                            $json = array(

                                    "status"=>404,
                                    "detalle"=>"No está autorizado para modificar este curso"
                                
                                );

                            echo json_encode($json, true);

                            return;

                        }

                    }
        
                }else
                {

                    $json = array(

                        "status"=>404,
                        "detalles"=>"El token es inválido"
                        
                    );

                }

            }

        }else
        {

            $json = array(

                "status"=>404,
                "detalles"=>"No está autorizado para recibir los registros"
                
            );

        }

        echo json_encode($json, true);  

        return;     

    }

    /*=============================================
    Borrar curso
    =============================================*/

    public function delete($id)
    {

        /*=============================================
        Validar credenciales del cliente
        =============================================*/

        $clientes = ModeloClientes::index("clientes");

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
        {

            foreach ($clientes as $key => $valueCliente) {
                
                if( "Basic ".base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW']) == 
                    "Basic ".base64_encode($valueCliente["id_cliente"].":".$valueCliente["llave_secreta"]) )
                {

                    /*=============================================
                    Validar id creador
                    =============================================*/

                    $curso = ModeloCursos::show("cursos","clientes", $id);

                    foreach ($curso as $key => $valueCurso)
                    {
                        
                        if($valueCurso->id_creador == $valueCliente["id"])
                        {

                            /*=============================================
                            Llevar datos al modelo
                            =============================================*/
                        
                            $delete = ModeloCursos::delete("cursos", $id);

                            /*=============================================
                            Respuesta del modelo
                            =============================================*/

                            if($delete == "ok")
                            {

                                $json = array(
                                    "status"=>200,
                                    "detalle"=>"Se ha borrado su curso con éxito"

                                ); 
                                
                                echo json_encode($json, true); 

                                return;     

                            }

                        }else
                        {

                            $json = array(

                                    "status"=>404,
                                    "detalle"=>"No está autorizado para borrar este curso"
                                
                                );

                            echo json_encode($json, true);

                            return;

                        }

                    }
        
                }else
                {

                    $json = array(

                        "status"=>404,
                        "detalles"=>"El token es inválido"
                        
                    );

                }

            }

        }else
        {

            $json = array(

                "status"=>404,
                "detalles"=>"No está autorizado para recibir los registros"
                
            );

        }

        echo json_encode($json, true);  

        return;     


    }


}