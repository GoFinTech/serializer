<?php

namespace GoFinTech\Serializer;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;

class ValidatorFactory
{
    /** @var ValidatorBuilder */
    private static $builder;

    public static function create(): ValidatorInterface
    {
        if (static::$builder)
            return static::$builder->getValidator();
        else
            return static::build()->getValidator();
    }

    private static function build(): ValidatorBuilder
    {
        $builder = Validation::createValidatorBuilder();
        $builder->enableAnnotationMapping();
        static::$builder = $builder;

        return $builder;
    }
}
