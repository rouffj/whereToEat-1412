<?php

namespace App\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserManagerTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();
        //$kernel->getContainer()->get();
        $this->assertSame('test', $kernel->getEnvironment());
        //$routerService = static::getContainer()->get('router');
        //$myCustomService = static::getContainer()->get(CustomService::class);
    }
}
