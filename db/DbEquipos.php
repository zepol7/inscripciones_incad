<?php

require_once("DbConexion.php");

class DbEquipo extends DbConexion {
    	
		
		
		
	public function getEquipo($idEquipo) {
        try {
            $sql = "SELECT *, DATE_FORMAT(fecha_compra,'%d/%m/%Y') AS format_fecha_compra, DATE_FORMAT(fecha_mantenimiento,'%d/%m/%Y') AS format_fecha_mantenimiento " .
                    "FROM equipos " .
                    "WHERE id_equipo=" . $idEquipo;
			
            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
	
	public function getEquipoUsuario($idTipoEquipo, $idPiloto) {
        try {
            $sql = "SELECT * FROM equipos e WHERE e.id_tipo_equipo = ".$idTipoEquipo." AND e.id_usuario_piloto = ". $idPiloto;
			
            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
	
	
	
	
	public function getListaEquiposBuscar($txt_buscar) {
        try {
            $txt_buscar = str_replace(" ", "%", $txt_buscar);
            $sql = "SELECT e.*, l.nombre_detalle AS nombre_tipo_equipo, STR_TO_DATE(e.fecha_compra, '%d/%m/%Y') AS format_fecha_compra, STR_TO_DATE(e.fecha_mantenimiento,'%d/%m/%Y') AS format_fecha_mantenimiento, u.*, " .
					"(SELECT SUM(r2.tiempo) FROM registro_planilla r2 INNER JOIN equipos e2 ON e2.id_usuario_piloto = r2.id_piloto WHERE e2.id_equipo = e.id_equipo AND r2.fecha_mod_tiempo > e.fecha_mantenimiento) AS tiempo_vuelo " .
                    "FROM equipos e " .
                    "INNER JOIN listas_detalle l ON l.id_detalle = e.id_tipo_equipo " .
                    "LEFT JOIN usuarios u ON u.id_usuario = e.id_usuario_piloto " .
                    "WHERE e.marca LIKE '%" . $txt_buscar . "%' " .
                    "OR e.modelo LIKE '%" . $txt_buscar . "%' " .
                    "OR e.color LIKE '%" . $txt_buscar . "%' " .                    
					"OR l.nombre_detalle LIKE '%" . $txt_buscar . "%' " .
					"OR CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) LIKE '%" . $txt_buscar . "%' " .                    
                    "ORDER BY e.fecha_compra, e.estado_equipo";
                    
					
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
	
	
	
	
	public function InsertEquipo($txt_fecha_compra, $cmb_tipo_equipo, $txt_serial, $txt_marca, $txt_modelo, $cmb_maillon, $txt_color, $txt_mosquetones, $id_usuario_crea, $txt_fecha_mantenimiento, $estado_equipo) {

        try {
            
            $sql = "CALL pa_crear_editar_equipos(STR_TO_DATE('".$txt_fecha_compra."', '%d/%m/%Y'), STR_TO_DATE('".$txt_fecha_mantenimiento."', '%d/%m/%Y'), $cmb_tipo_equipo, '".$txt_serial."', '".$txt_marca."', '".$txt_modelo."', '".$cmb_maillon."', '".$txt_color."', '".$txt_mosquetones."', 1, $estado_equipo, $id_usuario_crea, 0, @id)";

            //echo $sql;	   
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_equipo_creado = $arrResultado["@id"];
            
            return $id_equipo_creado;
        } catch (Exception $e) {
            return -2;
        }
    }
	
	
	
	public function EditarEquipo($txt_fecha_compra, $cmb_tipo_equipo, $txt_serial, $txt_marca, $txt_modelo, $cmb_maillon, $txt_color, $txt_mosquetones, $id_usuario_crea, $hdd_id_equipo, $txt_fecha_mantenimiento, $estado_equipo) {

        try {
            
            $sql = "CALL pa_crear_editar_equipos(STR_TO_DATE('".$txt_fecha_compra."', '%d/%m/%Y'), STR_TO_DATE('".$txt_fecha_mantenimiento."', '%d/%m/%Y'), $cmb_tipo_equipo, '".$txt_serial."', '".$txt_marca."', '".$txt_modelo."', '".$cmb_maillon."', '".$txt_color."', '".$txt_mosquetones."', 2, $estado_equipo, $id_usuario_crea, $hdd_id_equipo, @id)";

            //echo $sql;	   
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_equipo_editado = $arrResultado["@id"];
            
            return $id_equipo_editado;
        } catch (Exception $e) {
            return -2;
        }
    }
	
	
	
	/****************************************************************/
	
	
	
	
	
	
	
	
	public function getListaUsuarioPilotos($txt_buscar) {
        try {
            $txt_buscar = str_replace(" ", "%", $txt_buscar);
            $sql = "SELECT u.* FROM usuarios u  " .
                    "INNER JOIN usuarios_perfiles up ON up.id_usuario = u.id_usuario " .
                    "WHERE up.id_perfil = 2 " .
                    "AND ( u.nombre_usuario LIKE '%" . $txt_buscar . "%' " .
                    "OR u.apellido_usuario LIKE '%" . $txt_buscar . "%' " .                    
					"OR u.numero_documento LIKE '%" . $txt_buscar . "%' ) " .                    
                    "ORDER BY u.apellido_usuario";
				

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
	
	
	public function getListaPilotos() {
        try {
			
            $sql = "SELECT u.id_usuario, CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) AS nombre_completo, COUNT(e.id_equipo) AS cantidad_equipos
					FROM usuarios u  
					INNER JOIN usuarios_perfiles up ON up.id_usuario = u.id_usuario 
					INNER JOIN equipos e ON e.id_usuario_piloto = u.id_usuario 
					WHERE up.id_perfil = 2                     
					GROUP BY u.id_usuario, u.nombre_usuario, u.apellido_usuario
					HAVING cantidad_equipos >= 5 
					ORDER BY u.apellido_usuario ";
				

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
	
	
	
	
	public function getPiloto($id_piloto) {
        try {
            $sql = "SELECT u.* FROM usuarios u  
                    INNER JOIN usuarios_perfiles up ON up.id_usuario = u.id_usuario 
                    WHERE up.id_perfil = 2 
                    AND u.id_usuario =  $id_piloto  
                    ORDER BY u.apellido_usuario";
				

            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
	public function getListaEquipos($txt_buscar, $tipo_equipo) {
        try {
                    
           	$txt_buscar = str_replace(" ", "%", $txt_buscar);
            $sql = "SELECT e.*, l.nombre_detalle AS nombre_tipo_equipo, STR_TO_DATE(e.fecha_compra, '%d/%m/%Y') AS format_fecha_compra 
                   FROM equipos e 
                   INNER JOIN listas_detalle l ON l.id_detalle = e.id_tipo_equipo 
                   WHERE e.id_tipo_equipo = " . $tipo_equipo . " AND
                   e.id_usuario_piloto = 0 AND                    
                   (e.marca LIKE '%" . $txt_buscar . "%' 
                   OR e.modelo LIKE '%" . $txt_buscar . "%' 
                   OR e.color LIKE '%" . $txt_buscar . "%' ) 
				    AND e.estado_equipo = 23		
                   ORDER BY e.fecha_compra";         

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
	
	
	
	
	public function AsignarEquipoPiloto($id_piloto, $ids_equipos_pilotos, $id_usuario_crea) {
			try {
				
				$array_equipos_pilotos = explode(",", $ids_equipos_pilotos);
				foreach ($array_equipos_pilotos as $fila) {
					if ($fila > 0) {
						$sql = "INSERT INTO temp_equipo (id_equipo, id_usuario)
								VALUES	(".$fila.", ".$id_usuario_crea.")";
						
						$arrCampos[0] = "@id";
						$this->ejecutarSentencia($sql, $arrCampos);
					}
				}
				
				$sql = "CALL pa_asignar_equipos_piloto($id_piloto, $id_usuario_crea, @id)";
				
				$arrCampos[0] = "@id";
				$arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
				$id_perfil = $arrResultado["@id"];
				
				return $id_perfil;
			} catch (Exception $e) {
				return -2;
			}
		}
	
	
	
	
	/****************************************************************/
	
	
	
	
	
	
		
		

}

?>
