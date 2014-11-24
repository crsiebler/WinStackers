<?php

namespace ASU\AssetBundle\Traits;

trait SearchableTrait {

    abstract function getSearchableFields();

    abstract function normalize($field, $term);

    public function search($searchTerm) {
        $qb = $this->createQueryBuilder("e");

        foreach ($this->getSearchableFields() as $key => $field) {
            $terms = $this->normalize($field, $searchTerm);

            if ($terms !== false) {
                foreach ($terms as $jey => $t) {
                    $qb->orWhere("e.{$field} LIKE :searchTerm_{$key}_{$jey}")
                            ->setParameter("searchTerm_{$key}_{$jey}", "%$t%");
                }
            }
        }

        return $qb->getQuery()->getResult();
    }

}
