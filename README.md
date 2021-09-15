# Symfony Serializer Ready To Use

Symfony has a full-featured object [serializer component](https://symfony.com/doc/current/components/serializer.html).
However, unless you get it pre-configured, you will probably have a hard time making it work the way you need it.

This small package wraps up Symfony components needed for the "usual case" of object serialization/deserialization.
It makes sure you get all the common dependencies and configures type discovery through reflection and phpDoc.

This serializer is deliberately made to "just work". In particular, it lacks any configuration.
If you need something else, just use the original components and set them up the way you need.
