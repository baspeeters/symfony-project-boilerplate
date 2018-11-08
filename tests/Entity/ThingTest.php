<?php

namespace App\Tests\Entity;

use App\Entity\Thing;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class ThingTest extends TestCase
{
    /** @test */
    public function set_and_get_name()
    {
        $thing = new Thing();
        $thing->setName('This is my name');

        self::assertEquals('This is my name', $thing->getName());
    }
}
