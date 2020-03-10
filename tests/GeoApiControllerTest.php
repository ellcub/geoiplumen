<?php

class GeoApiControllerTest extends TestCase
{
    /**
     * Test that a UK IP address returns United Kingdom
     * @return void
     */
    public function testUKIPAddress()
    {
        $this->get('/locationByIP?IP=2.20.183.200')
            ->seeJsonEquals(
                [
                    'country_name' => 'United Kingdom',
                ]
            );
    }
}
