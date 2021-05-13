<?php
use PHPUnit\Framework\TestCase;
use Kompli\Konnect\Exception\Error404;

class Error404Test extends TestCase
{
    public function testConstruct()
    {
        $strError = 'Things';
        $exception = new Error404($strError);

        $this->assertTrue($exception instanceof Error404);
        $this->assertEquals(
            'Not Found (Things)',
            $exception->getMessage()
        );
    }
}
