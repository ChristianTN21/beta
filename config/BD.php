<?php
class bd{
	public function __construct(){
		$this->db=Conectado::conexion();
	}
	
	public function existeRegistro($sql){
		$resultado = $this->db->query($sql); //Ejecuto la consulta
		if($resultado->num_rows > 0){
			$valor = 1;
		}else{
			$valor = 0;
		}
		return $valor;
	}
	function numRegistros($sql, $cnn){
			require($cnn);
			$consulta = mysqli_query($link,$sql);
			$numero_filas = mysqli_num_rows($consulta);
			
			if($numero_filas>0){
				$cantidad_filas = $numero_filas;
			}else{
				$cantidad_filas = 0;
			}
			return $cantidad_filas;
		}
		

	public function mostrarCampo($sql, $campo){
		$resultado = $this->db->query($sql); //Ejecuto la consulta
		if($resultado->num_rows > 0){
			while($row=$resultado->fetch_assoc()){
				$valor = $row[$campo];
			}
		}else{
			$valor = "Vacio";
		}
		return $valor;
	}	
	
	public function devuelveCampo($sql, $campo){
			$resultado = $this->db->query($sql);
			while($row = $resultado->fetch_assoc()){
				
				$valor = $row[$campo];
			}
			return $valor;
		}
	
	public function combo($sql, $id, $des, $No){
			$resultado = $this->db->query($sql);
			while($row=$resultado->fetch_assoc()){
				if($row[$id]<>$No){//SI LA VARIABLE ES DIREFENTE, SE MUESTRA(PARA NO REPETIR)
				echo '<option value="'.$row[$id].'">'.$row[$des].'</option>';
				}
			}
		}
		
		public function abc($sql){
			if($this->db->query($sql)==TRUE){
				echo "Se ha realizado el cambio solicitado";
			}else{
				echo "Error: ".$sql." ".$this->db->error;
			}	
			$this->db->close();
		}
}
?>