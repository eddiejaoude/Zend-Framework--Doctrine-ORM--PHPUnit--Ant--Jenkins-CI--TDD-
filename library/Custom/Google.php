<?php
/**
 * Google class
 *
 * @author          Eddie Jaoude
 */
class Custom_Google {

    /**
     * constructor  method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function  __construct() {
        
    }

    public function  getLatLng($address) {
        # address identifier
        $address_identifier = 'latlng_' . str_replace(array(' '), array('_'), $address);
        $address_identifier = preg_replace('/[^a-z0-9_]+/i', '', $address);

        # registry
        $registry = Zend_Registry::getInstance();

        # caching
        $frontendOptions = array(
            'lifetime' => 2592000, // cache lifetime of 30 days
            'automatic_serialization' => true
        );

        $backendOptions = array(
            'cache_dir' => $registry->config->application->logs->tmpDir . '/cache/' // Directory where to put the cache files
        );

        $cache = Zend_Cache::factory('Core',
                        'File',
                        $frontendOptions,
                        $backendOptions);

        # get data
        if (($data = $cache->load($address_identifier)) === false) {
            new Custom_Logging('Hit Google: Lat/Lng for ' . $address, Zend_Log::INFO);
            $client = new Zend_Http_Client('http://maps.google.com/maps/geo?q=' . urlencode($address), array('maxredirects' => 0, 'timeout' => 30));
            $request = $client->request();
            $response = Zend_Http_Response::fromString($request);
            $body = Zend_Json::decode($response->getBody());

            $data = array();
            $data['latitude'] = !empty($body['Placemark'][0]['Point']['coordinates'][1]) ? $body['Placemark'][0]['Point']['coordinates'][1] : null;
            $data['longitude'] = !empty($body['Placemark'][0]['Point']['coordinates'][0]) ? $body['Placemark'][0]['Point']['coordinates'][0] : null;
            $cache->save($data, $address_identifier);
        } else {
            new Custom_Logging('(local cache) Hit Google: Lat/Lng for ' . $address, Zend_Log::INFO);
        }

        return $data;
    }

}