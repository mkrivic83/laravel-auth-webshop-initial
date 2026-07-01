<?php

return [

    'required' => 'Polje :attribute je obavezno.',
    'min' => [
        'string' => 'Polje :attribute mora imati najmanje :min znakova.',
        'numeric' => 'Polje :attribute mora biti najmanje :min.',
    ],
    'max' => [
        'numeric' => 'Polje :attribute ne smije biti veće od :max.',
        'string' => 'Polje :attribute ne smije imati više od :max znakova.',
    ],
    'numeric' => 'Polje :attribute mora biti broj.',
    'integer' => 'Polje :attribute mora biti cijeli broj.',
    'gt' => [
        'numeric' => 'Polje :attribute mora biti veće od :value.',
    ],

    // 'custom' => [
    //     'naziv' => [
    //         'regex' => 'Naziv knjige mora početi velikim slovom.',
    //     ],

    //     'autor' => [
    //         'regex' => 'Autor mora sadržavati ime i prezime, a svaka riječ mora početi velikim slovom.',
    //     ],

    //     'godina' => [
    //         'min' => 'Godina ne smije biti manja od 1800.',
    //         'max' => 'Godina ne smije biti veća od trenutne godine.',
    //     ],

    //     'cijena' => [
    //         'gt' => 'Cijena mora biti veća od 0.',
    //         'max' => 'Cijena ne smije biti veća od 400.',
    //     ],
    // ],

    'attributes' => [
        'naziv' => 'naziv',
        'opis' => 'autor',
    ],

];