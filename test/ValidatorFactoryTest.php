<?php


namespace GoFinTech\SerializerTest;


use Doctrine\Common\Annotations\AnnotationRegistry;
use GoFinTech\Serializer\ValidatorFactory;
use PHPUnit\Framework\Constraint\LessThan;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\NotBlank;

class ValidatorFactoryTest extends TestCase
{
    private $validator;

    public function setUp(): void
    {
        AnnotationRegistry::registerFile(__DIR__ . "/../vendor/symfony/validator/Constraints/NotBlank.php");
        AnnotationRegistry::registerFile(__DIR__ . "/../vendor/symfony/validator/Constraints/LessThan.php");
        $this->validator = ValidatorFactory::create();
    }

    public function testSimpleValid()
    {
        $a = new TestObject1();
        $a->a = "two";
        $a->b = 33;
        $err = $this->validator->validate($a);
        $this->assertEquals(0, count($err));
    }

    public function testSimpleInvalid()
    {
        $a = new TestObject1();
        $a->a = "";
        $a->b = 101;
        $err = $this->validator->validate($a);
        $this->assertEquals(2, count($err));
    }
}
