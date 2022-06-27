<?php 

require_once "conexion.php";

class ModeloCursos
{

    /*=============================================
    METODO PARA MOSTRAR TODOS LOS CURSOS
    =============================================*/

    static public function index($tabla1, $tabla2, $cantidad, $desde)
    {

        // Se usa una paginacion para seleccionar los cursos en la cantidad especificada 
        // Se usa INNER JOIN para selecccionar los cursos y los clientes relacionados con esos cursos

        if($cantidad != null){

            $stmt = Conexion::conectar()->prepare("SELECT $tabla1.id, $tabla1.titulo, $tabla1.descripcion, $tabla1.instructor, $tabla1.imagen, $tabla1.precio, $tabla1.id_creador, $tabla2.nombre, $tabla2.apellido FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_creador = $tabla2.id LIMIT $desde, $cantidad");

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT $tabla1.id, $tabla1.titulo, $tabla1.descripcion, $tabla1.instructor, $tabla1.imagen, $tabla1.precio, $tabla1.id_creador, $tabla2.nombre, $tabla2.apellido FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_creador = $tabla2.id");

        }

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_CLASS);

        $stmt -> close();

        $stmt = null;

    }

    /*=============================================
    METODO PARA CREAR UN SOLO CURSO
    =============================================*/

    static public function create($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(titulo, descripcion, instructor, imagen, precio, id_creador, created_at, updated_at) VALUES (:titulo, :descripcion, :instructor, :imagen, :precio, :id_creador, :created_at, :updated_at)");

        $stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":instructor", $datos["instructor"], PDO::PARAM_STR);
        $stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
        $stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_creador", $datos["id_creador"], PDO::PARAM_STR);
        $stmt -> bindParam(":created_at", $datos["created_at"], PDO::PARAM_STR);
        $stmt -> bindParam(":updated_at", $datos["updated_at"], PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt-> close();

        $stmt = null;

    }

    /*=============================================
    METODO PARA MOSTRAR UN SOLO CURSO
    =============================================*/

    static public function show($tabla1, $tabla2, $id)
    {

        // Se usa INNER JOIN para selecccionar el curso y el cliente relacionado con ese curso

        $stmt = Conexion::conectar()->prepare("SELECT $tabla1.id, $tabla1.titulo, $tabla1.descripcion, $tabla1.instructor, $tabla1.imagen, $tabla1.precio, $tabla1.id_creador, $tabla2.nombre, $tabla2.apellido FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_creador = $tabla2.id WHERE $tabla1.id=:id");

        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_CLASS);

        $stmt -> close();

        $stmt = null;

    }

    /*=============================================
    METODO PARA ACTUALIZAR UN SOLO CURSO
    =============================================*/

    static public function update($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET titulo=:titulo, descripcion=:descripcion, instructor=:instructor, imagen=:imagen ,precio=:precio, updated_at=:updated_at WHERE id = :id");

        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":instructor", $datos["instructor"], PDO::PARAM_STR);
        $stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
        $stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt -> bindParam(":updated_at", $datos["updated_at"], PDO::PARAM_STR);

        if($stmt -> execute())
        {

            return "ok";

        }else
        {

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt-> close();

        $stmt = null;

    }

    /*=============================================
    METODO PARA BORRAR UN SOLO CURSO
    =============================================*/

    static public function delete($tabla, $id)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt -> execute())
        {

            return "ok";

        }else
        {

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt-> close();

        $stmt = null;

    }

}