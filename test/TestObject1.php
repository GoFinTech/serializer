<?php


namespace GoFinTech\SerializerTest;


use Symfony\Component\Validator\Constraints as Assert;

class TestObject1
{
    /** @var string */
    /** @Assert\NotBlank() */
    public $a;
    /** @var int */
    /** @Assert\LessThan(100) */
    public $b;
    /** @var TestObject2[] */
    public $c;
}
