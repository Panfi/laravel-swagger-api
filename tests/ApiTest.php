<?php

namespace Finnegan\Api\Tests;


use Finnegan\Api\ApiServer;
use Finnegan\Api\Endpoints\AggregateEndpoint;
use Finnegan\Api\Endpoints\BaseEndpoint;
use Finnegan\Api\Endpoints\EndpointInterface;
use Finnegan\Api\Endpoints\ModelsEndpoint;


class ApiTest extends TestCase
{
	
	
	public function testBaseEndpointRegistration ()
	{
		$endpoint = $this->api->endpoint ( 'uri', function () {
		} );
		
		$this->assertInstanceOf ( BaseEndpoint::class, $endpoint );
		
		$endpoints = $this->api->getEndpoints ();
		$this->assertInternalType ( 'array', $endpoints );
		$this->assertEquals ( 1, count ( $endpoints ) );
		
		$this->assertInstanceOf ( BaseEndpoint::class, array_first ( $endpoints ) );
		$this->assertInstanceOf ( EndpointInterface::class, array_first ( $endpoints ) );
	}
	
	
	public function testAggregateEndpointRegistration ()
	{
		$endpoint = $this->api->aggregate ( 'aggregate-uri', [ 'App\\Page', 'App\\User' ] );
		
		$this->assertInstanceOf ( AggregateEndpoint::class, $endpoint );
		
		$this->assertInternalType ( 'array', $endpoint->models );
		$this->assertEquals ( 2, count ( $endpoint->models ) );
	}
	
	
	public function testModelRegistration ()
	{
		$model = 'App\\Page';
		
		$this->assertInstanceOf ( ApiServer::class, $this->api->models ( $model ) );
		
		$this->assertTrue ( $this->app->resolved ( ModelsEndpoint::class ) );
	}
}