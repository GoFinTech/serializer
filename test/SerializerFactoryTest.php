<?php

namespace GoFinTech\SerializerTest;

use GoFinTech\Serializer\SerializerFactory;
use PHPUnit\Framework\TestCase;

class SerializerFactoryTest extends TestCase
{
    private $serializer;

    public function setUp(): void
    {
        $this->serializer = SerializerFactory::create();
    }

    public function testSimpleArray()
    {
        $array = ['this' => 'that', 'foo' => 1, 'sub' => [0, 2, 7]];
        $serialized = '{"this":"that","foo":1,"sub":[0,2,7]}';

        $actual = $this->serializer->serialize($array, 'json');
        $this->assertEquals($serialized, $actual);
    }

    public function testObject()
    {
        $a = new TestObject1();
        $a->a = 'one';
        $a->b = 42;
        $a->c = [];
        $b = new TestObject2();
        $b->x = 1.3;
        $a->c[] = $b;
        $b = new TestObject2();
        $b->x = 3.14;
        $a->c[] = $b;
        $json = '{"a":"one","b":42,"c":[{"x":1.3},{"x":3.14}]}';

        $this->assertEquals($json, $this->serializer->serialize($a, 'json'));
        $this->assertEquals($a, $this->serializer->deserialize($json, TestObject1::class, 'json'));
    }
}
