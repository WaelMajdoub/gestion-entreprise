<?php

namespace GestionEntreprise\Component\Serializer;

class CustomNormalizer extends \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer {

    public function normalize($object, $format = null)
    {
        // if the object is a User, unset location for normalization, without touching the original object
        if($object instanceof \GestionEntreprise\ParametrageBundle\Entity\TypePrestation) {
            $object = clone $object;
            $object->setCategoriesPrestation(new \Doctrine\Common\Collections\ArrayCollection());
        }

        return parent::normalize($object, $format);
    }

} 