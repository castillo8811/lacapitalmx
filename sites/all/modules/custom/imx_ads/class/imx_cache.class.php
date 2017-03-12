<?php

/*
 * Clase que genera archivos de cache en base a un Id, este id es el identificador
 * del archivo que se generará, se reciben arrays y estos son codificados a JSON, y en
 * su recuperación son decodificados
 */

/**
 *
 * @author Sergio Castillo
 */
class ImxAdsCache {

    private $data;
    private $cache_interval;
    private $cache_base_path;
    private $cache_id_path;

	/*
	 *Contructor de la clase
	 *
	 * @arguments $cache_interval tiempo en minutos que durara el archivo de cache antes de ser limpiado
	 * @arguments $cache_base_path ruta donde se guardaran los archivos de cache
	 */

    public function __construct($cache_interval = 5,$cache_base_path="/srv/data/files/cache/imx_cache/") {
        $this->cache_interval =$cache_interval;
        $this->cache_base_path=$cache_base_path;
		$this->cache_id_path="";
    }


	/*
	 *Guarda los datos en cache
	 *
	 * @arguments $id nombre que tendra e archivo estos deben ser unicos
	 * @arguments $data Array de datos a guardar
	 */

    public function cache_set($id,$data) {
    	if(is_array($data)){
    		$data=json_encode($data);
    	}
		$this->cache_id_path=$this->cache_base_path.$id.".cache";
        $file_time = filemtime($this->cache_id_path);
        $time_after = $file_time + $this->cache_interval * 60;
        $f = fopen($this->cache_id_path, "w");
        fwrite($f, $data);
        fclose($f);
    }


    /*
     * Valida si existen datos en un tiempo cache valido, si no existen se limpia el archivo
	 * @arguments $id id del cache a consultar
	 *
    */

    public function cache_get($id) {
    	$this->cache_id_path=$this->cache_base_path.$id.".cache";
        if ($this->validateFiletime()) {
            $f = file_get_contents($this->cache_id_path);
            $data=json_decode($f,true);
            return $data;
        } else {

        }
    }


	/*Validamos el tiempo de vida del archivo*/

    public function validateFiletime(){
        $file_time = filemtime($this->cache_id_path);
        $time_after = $file_time + $this->cache_interval * 60;
        if ($time_after < time()) {
            #echo "Ya es tiempo " . date("Y-M--D H:i:s", time())."----";
            #echo "debe ser a las" . date("Y-M--D H:i:s", $time_after);
            return false;
        } else {
            #echo "Aun no es tiempo " . date("Y-M--D H:i:s", $file_time) . "----";
            #echo "debe ser ha " . date("Y-M--D H:i:s", $time_after);
            return true;
        }
    }

}