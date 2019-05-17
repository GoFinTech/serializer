<?php

namespace GoFinTech\Serializer;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerFactory
{
    /** @var Serializer */
    private static $instance;

    public static function create(): Serializer
    {
        return static::$instance ?? static::build();
    }

    private static function build(): Serializer
    {
        $doc = new PhpDocExtractor();
        $ref = new ReflectionExtractor();
        $info = new PropertyInfoExtractor([$ref], [$doc, $ref], [$doc], [$ref], [$ref]);
        $norm = [new ObjectNormalizer(null, null, null, $info)];
        $norm[] = new ArrayDenormalizer();
        if (class_exists('GoFinTech\Date\Date'))
            $norm[] = new DateNormalizer();
        static::$instance = new Serializer($norm, [new JsonEncoder(), new YamlEncoder(), new XmlEncoder()]);
        return static::$instance;
    }
}
