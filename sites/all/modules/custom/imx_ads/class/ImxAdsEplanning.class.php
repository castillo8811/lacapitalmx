<?php
require_once "ImxAdsServerConfig.class.php";
require_once "ImxAdsServerActions.class.php";
require_once "imx_cache.class.php";

/*La clase funciona filtrando los espacios en base al site_id, en caso que este no esta correcto
 * trae todos los espacio en general
 * */

class ImxAdsEplanning extends ImxAdsServerConfig implements ImxAdsServerActions{

	//Funciones definidas para la administracion de los Ads
	private $config=array();
	protected $base_url="https://admin.us.e-planning.net/";
	protected $imx_cache;

	public function __construct($user,$password,$site_id){
		$this->config["user"]=$user;
		$this->config["password"]=$password;
		$this->config["base_url"]=$this->base_url;
		$this->config["site_id"]=$site_id;
		parent::__construct($this->config);
	}


	/*
	 * Devuelve los espacios de un sitio en base a parametros
	 *
	 * @arguments $param_seccion  Seccion a la que pertenece el espacio
	 * @arguments $param_format formato de salida de la peticion
	 * @arguments $param_estado Estado del espacio  act | arc | all
	 *
	 * */
	public function getAdsBySite($param_ouput_format="json",$param_seccion=null,$param_estado="all"){
		$seccion=($param_seccion)?"&seccion_id={$param_seccion}":"";
		$estado=($param_estado)?"&estado={$param_estado}": "";
			$ouput_format=$param_ouput_format;
			$url="/admin/adnet/pub/admin/espacios.html?op=l&sitio_id={$this->site_id}{$seccion}{$estado}&o=xml";
			//print $url;
			$complete_url=$this->base_url.$url;
			$data=$this->curl_request($complete_url);

			if($ouput_format=="json"){
				$data=$this->xmlToJson($data);
			}

               file_put_contents("/srv/data/files/cache/imx_ads/eplanning_spaces_cache_$this->site_id",json_encode($data));
	}


	public function getAdByName($ad_name=""){
                $data=  file_get_contents("/srv/data/files/cache/imx_ads/eplanning_spaces_cache_$this->site_id");
		$ads=  json_decode($data,true);
		$array_found=null;
		foreach($ads as $ad){
			if($ad["nombre"]==$ad_name){
				$array_found=$ad;
			}
		}
		return $array_found;
	}

	/*
	 * Eplaning define status
	 * */
	public function getAdStatus($ad_name){
		$data=$this->getAdByName($ad_name);
		$status=(isset($data["estado"]))? $data["estado"]:null;

		return $status;
	}

	public function getAllAds(){}
	public function activateAd(){}
	public function disableAd(){}
	public function createAd(){}
	public function deleteAd(){}

	public function xmlToJson($data){
		$xml_data=simplexml_load_string($data);
		$data_json=array();
		foreach($xml_data->espacio as $espacio){

			$data_json[(string)$espacio->espacio_id]["seccion"]=(string)$espacio->seccion;
			$data_json[(string)$espacio->espacio_id]["fecha_alta"]=(string)$espacio->fecha_alta;
			$data_json[(string)$espacio->espacio_id]["subseccion_id"]=(string)$espacio->subseccion_id;
			$data_json[(string)$espacio->espacio_id]["fecha_baja"]=(string)$espacio->fecha_baja;
			$data_json[(string)$espacio->espacio_id]["sitio_id"]=(string)$espacio->sitio_id;
			$data_json[(string)$espacio->espacio_id]["espacio_id"]=(string)$espacio->espacio_id;
			$data_json[(string)$espacio->espacio_id]["sitio"]=(string)$espacio->sitio;
			$data_json[(string)$espacio->espacio_id]["estado"]=(string)$espacio->estado;
			$data_json[(string)$espacio->espacio_id]["encoded_id"]=(string)$espacio->encoded_id;
			$data_json[(string)$espacio->espacio_id]["seccion_id"]=(string)$espacio->seccion_id;
			$data_json[(string)$espacio->espacio_id]["tamano"]=(string)$espacio->tamano;
			$data_json[(string)$espacio->espacio_id]["nombre"]=(string)$espacio->nombre;
			$data_json[(string)$espacio->espacio_id]["url"]=(string)$espacio->url;
			$data_json[(string)$espacio->espacio_id]["tamano"]=(string)$espacio->tamano;

		}
		return $data_json;
	}



}