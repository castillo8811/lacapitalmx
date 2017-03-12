<?php
interface ImxAdsServerActions{

	//Funciones definidas para la administracion de los Ads

	function getAdsBySite($param_seccion="all",$format,$param_estado="all");
        function getAdStatus($ad_name);
	function getAllAds();
	function activateAd();
	function disableAd();
	function createAd();
	function deleteAd();
}