<?php


namespace Ideahq\Bundle\SwaggerUIBundle\Tests\Controller;

use Ideahq\Bundle\SwaggerUIBundle\Tests\WebTestCase;

class SwaggerUIControllerTest extends WebTestCase
{
    public function testSwaggerUIPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/documentation/');

        $response = $client->getResponse();
        //var_dump($response->getContent());
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertCount(1, $crawler->filter('#message-bar'));
        $this->assertCount(1, $crawler->filter('#swagger-ui-container'));

        $content = $response->getContent();
        $this->assertRegExp('#url:\s?"\\\/static-api-docs"#', $content);
        $this->assertRegExp('/dom_id:\s?"swagger-ui-container"/', $content);
        $this->assertRegExp('/docExpansion:\s?"full"/', $content);
        $this->assertRegExp('!validatorUrl:\s?"https:\\\/\\\/online.swagger.io\\\/validator"!', $content);
        $this->assertRegExp('/operations_sorter:\s?"alpha"/', $content);
    }

    public function testExternalUrl()
    {
        $client = static::createClient(array('environment' => 'external'));
        $client->request('GET', '/documentation/');

        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $this->assertRegExp('#url:\s?"http:\\\/\\\/petstore.swagger.wordnik.com\\\/api\\\/api-docs"#', $content);
    }
}
