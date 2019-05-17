<?php


namespace GoFinTech\Serializer;


use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Custom normalizer to natively support gofintech/date.
 * @package GoFinTech\Serializer
 */
class DateNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function supportsNormalization($data, $format = null)
    {
        return is_subclass_of($data, 'GoFinTech\Date\Date');
    }

    public function normalize($object, $format = null, array $context = [])
    {
        return (string)$object;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type == 'GoFinTech\Date\Date' && is_string($data);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        /** @noinspection PhpUndefinedClassInspection */
        /** @noinspection PhpUndefinedNamespaceInspection */
        return \GoFinTech\Date\Date::create($data);
    }
}
