<?php 

require 'vendor/autoload.php';
use GuzzleHttp\Client;
$config = parse_ini_file('config.ini');

$path = $config['path'];

$to      = $argv['1'];
$subject = $argv['2'];
$body    = $argv['3'];


$obj = new ZabbixHue($config);

if ($body === 'alert' OR $body === 'NG') {
    $obj->alert($path);
} else {
    $obj->recovery($path);
}

class ZabbixHue {
    
    public $base_url;
    public $client;
    
    public function __construct(array $config = [])
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => $config['url'],
        ]);
    }
    
    public function recovery($path)
    {
        return $this->client->request('PUT', $path, ['json' => [
            'on'     => true,
            'sat'    => 254,
            'bri'    => 32,
            'alert'  => 'none',
            'effect' => 'colorloop',
        ]]);
    }
    
    public function alert($path)
    {
        return $this->client->request('PUT', $path, ['json' => [
            'on'     => true,
            'sat'    => 254,
            'bri'    => 32,
            'xy'     => [
                0.55,
                0.311,
            ],
            'alert'  => 'lselect',
            'effect' => 'none',
        ]]);
    }
}
