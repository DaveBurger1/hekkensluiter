<?php

namespace App\Util;

use Generator;

class Entities
{
    private static array $entities = [
        'case' => 'Zaak',
        'case_prisoner' => 'Link Gedetineerde',
        'cell_occupation' => 'Bezetting',
        'evidence' => 'Bewijs',
        'group' => 'Groep',
        'location' => 'Locatie',
        'prisoner' => 'Gedetineerde',
        'user' => 'Gebruiker',
    ];

    private static array $actions = [
        'make' => ['Maak', 'Maakte'],
        'edit' => ['Bewerk', 'Bewerkte'],
        'delete' => ['Verwijder', 'Verwijderde'],
    ];


    public static function gen_entity_actions(): Generator
    {
        foreach (Entities::$entities as $entityKey => $entityName) {
            foreach (Entities::$actions as $actionKey => $actionNames) {
                list($nameFuture, $namePast) = $actionNames;
                yield [$entityKey . '_' . $actionKey, "$nameFuture $entityName", "$namePast $entityName"];
            }
        }
    }
}