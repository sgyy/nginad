<?php
/**
 * CDNPAL NGINAD Project
 *
 * @link http://www.nginad.com
 * @copyright Copyright (c) 2013-2015 CDNPAL Ltd. All Rights Reserved
 * @license GPLv3
 */

namespace buyrtb\workflows\tasklets\common\adcampaign;

class GetGeoCodeCountry {
	
	public static function execute(&$Logger, &$Workflow, \model\openrtb\RtbBidRequest &$RtbBidRequest) {
		
		/*
		 * use maxmind incrementally. The geo-Country pay DB we have is only 1 meg
		 * if we need city/state ok, but only load it if absolutely necessary
		 */
		
		$RtbBidRequestGeo = new \model\openrtb\RtbBidRequestGeo();
		$RtbBidRequest->RtbBidRequestDevice->RtbBidRequestGeo = $RtbBidRequestGeo;
		if ($RtbBidRequest->RtbBidRequestDevice->ip !== null && $RtbBidRequest->RtbBidRequestDevice->RtbBidRequestGeo === null):
			$Workflow->maxmind = new \geoip\maxmind();
			$RtbBidRequest->RtbBidRequestDevice->RtbBidRequestGeo->country = $Workflow->maxmind->get_geo_code_country($RtbBidRequest->RtbBidRequestDevice->ip);
		endif;
	}
	
}
