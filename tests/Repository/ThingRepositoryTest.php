<?php

namespace App\Tests\Repository;

use App\Entity\Thing;
use App\Tests\KernelTestCase;

class ThingRepositoryTest extends KernelTestCase
{
    /** @test */
    public function id_is_set_by_doctrine()
    {
        $thing = new Thing();

        $this->entityManager->persist($thing);
        $this->entityManager->flush();

        self::assertEquals(1, $thing->getId());
    }
}
