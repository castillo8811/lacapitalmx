<?php
class SocialAnalytics{

  /**
   * @param $url
   * @return array
   */
  public function get_fb($url) {
    $json_string = file_get_contents('http://graph.facebook.com/?ids='.urlencode($url));
    $json = json_decode($json_string, true);
    return array(
      'shares'   => ($json[$url]['shares']) ? intval($json[$url]['shares']) : 0,
      'comments' => ($json[$url]['comments']) ? intval($json[$url]['comments']) : 0,
    );
  }

  /**
   * @param $url
   * @return int
   */
  public function get_tw($url) {
    $json_string = file_get_contents('http://urls.api.twitter.com/1/urls/count.json?url='.urlencode($url));
    $json = json_decode($json_string, true);
    return ($json['count']) ? intval($json['count']) : 0;
  }

  /**
   * @param $url
   * @return int
   */
  public function get_gp($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . urlencode($url) . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    $curl_results = curl_exec ($curl);
    curl_close ($curl);
    $json = json_decode($curl_results, true);
    return ($json[0]['result']['metadata']['globalCounts']['count']) ? intval($json[0]['result']['metadata']['globalCounts']['count']) : 0;
  }
}
