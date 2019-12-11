<?php

return [
    'accepted'                       => ':attribute moet aanvaard worden.',
    'active_url'                     => ':attribute is geen geldige URL.',
    'after'                          => ':attribute moet een datum zijn na :date',
    'after_or_equal'                 => 'The :attribute must be a date after or equal to :date.',
    'alpha'                          => ':attribute mag enkel letters bevatten.',
    'alpha_dash'                     => ':attribute mag enkel letters, cijfers en koppeltekens bevatten.',
    'alpha_num'                      => ':attribute mag enkel letters en cijfers bevatten.',
    'latin'                          => 'The :attribute may only contain ISO basic Latin alphabet letters.',
    'array'                          => ':attribute moet een array zijn.',
    'before'                         => ':attribute moet een datum voor :date zijn.',
    'before_or_equal'                => 'The :attribute must be a date before or equal to :date.',
    'between'                        => [
        'numeric' => ':attribute moet tussen :min en :max zijn.',
        'file'    => ':attribute moet tussen :min en :max kilobytes zijn.',
        'string'  => ':attribute moet tussen :min en :max tekens lang zijn.',
        'array'   => ':attribute moet tussen :min en :max voorwerpen bevatten',
    ],
    'boolean'                        => ':attribute moet true of false zijn.',
    'confirmed'                      => ':attribute bevestiging stemt niet overeen.',
    'date'                           => ':attribute is geen geldige datum',
    'date_format'                    => ':attribute is geen :format formaat',
    'different'                      => ':attribute en :other moeten verschillend zijn.',
    'digits'                         => ':attribute moet :digits cijfers bevatten',
    'digits_between'                 => ':attribute moet tussen :min en  :max cijfers lang zijn.',
    'dimensions'                     => ':attribute heeft ongeldige afmetingen.',
    'distinct'                       => ':attribute heeft een duplicaat waarde.',
    'email'                          => ':attribute moet een geldig e-mailadres zijn.',
    'exists'                         => 'De gekozen :attribute is ongeldig.',
    'file'                           => ':attribute moet een bestand zijn.',
    'filled'                         => ':attribute veld is vereist.',
    'gt'                             => [
        'numeric' => ':attribute moet groter zijn dan :value.',
        'file'    => ':attribute moet groter zijn dan :value kilobytes.',
        'string'  => ':attibute moet groter zijn dan :value tekens.',
        'array'   => ':attribute moet meer dan :value items hebben.',
    ],
    'gte'                            => [
        'numeric' => ':attibute moet groter zijn of gelijk aan :value.',
        'file'    => ':attribute moet groter zijn of gelijk aan :value kilobytes.',
        'string'  => ':attribute moet groter zijn of gelijk aan :value tekens.',
        'array'   => ':attribute moet op zen minst :value items hebben of meer.',
    ],
    'image'                          => ':attribute moet een afbeelding zijn.',
    'in'                             => 'De gekozen :attribute is ongeldig.',
    'in_array'                       => 'Het veld :attribute bestaat niet in :other.',
    'integer'                        => ':attribute moet een integer zijn.',
    'ip'                             => ':attribute moet een geldig IP adres zijn.',
    'ipv4'                           => ':attribute moet een geldig ipv4 adres zijn.',
    'ipv6'                           => ':attribute moet een geldig ipv6 adres zijn.',
    'json'                           => ':attribute moet een geldige JSON string zijn.',
    'lt'                             => [
        'numeric' => ':attirbute moet minder zijn dan :value.',
        'file'    => ':attirbute moet minder zijn dan :value kilobytes.',
        'string'  => ':attirbute moet minder dan :value tekens hebben.',
        'array'   => ':attirbute moet mindern dan :value items hebben.',
    ],
    'lte'                            => [
        'numeric' => ':attirbute moet minder of gelijk zijn dan :value.',
        'file'    => ':attirbute moet minder of gelijk zijn dan :value kilobytes.',
        'string'  => ':attirbute moet minder of gelijk zijn dan :karakter value.',
        'array'   => ':attirbute mag niet meer dan :value items hebben.',
    ],
    'max'                            => [
        'numeric' => ':attribute mag niet groter zijn dan :max.',
        'file'    => ':attribute mag niet groter zijn dan :max kilobytes.',
        'string'  => ':attribute mag niet meer dan :max tekens tellen.',
        'array'   => ':attribute mag niet meer dan :max items tellen.',
    ],
    'mimes'                          => ':attribute moet een bestand zijn van het type: :values.',
    'mimetypes'                      => ':attribute moet een bestand zijn van het type: :values.',
    'min'                            => [
        'numeric' => ':attribute moet minstens :min zijn.',
        'file'    => ':attribute moet minstens :min kilobytes zijn.',
        'string'  => ':attribute moet minstens :min tekens bevatten.',
        'array'   => ':attribute moet minstens :min items bevatten.',
    ],
    'not_in'                         => 'Gekozen :attribute is ongeldig.',
    'not_regex'                      => ':attribute formaat is onjuist.',
    'numeric'                        => ':attribute moet een cijfer zijn.',
    'password'                       => 'Het wachtwoord is niet correct.',
    'present'                        => 'Het :attribute veld moet aanwezig zijn.',
    'regex'                          => 'Formaat van :attribute is ongeldig.',
    'required'                       => ':attribute is vereist.',
    'required_if'                    => ':attribute is vereist wanneer :other gelijk is aan :value.',
    'required_unless'                => ':attribute is vereist tenzij :other behoort to :values.',
    'required_with'                  => ':attribute is vereist wanneer :values aanwezig zijn.',
    'required_with_all'              => ':attribute is vereist wanneer :values aanwezig zijn.',
    'required_without'               => ':attribute is vereist wanneer :values niet aanwezig zijn.',
    'required_without_all'           => ':attribute is vereist wnneer geen enkel of :values aanwezig zijn.',
    'same'                           => ':attribute en :other moeten overeenstemmen.',
    'size'                           => [
        'numeric' => ':attribute moet :size groot zijn.',
        'file'    => ':attribute moet :size kilobytes zwaar zijn',
        'string'  => ':attribute moet :size tekens lang zijn.',
        'array'   => ':attribute moet :size items bevatten.',
    ],
    'string'                         => ':attribute moet een sting zijn.',
    'timezone'                       => ':attribute moet een geldige zone zijn.',
    'unique'                         => ':attribute werd reeds genomen.',
    'uploaded'                       => ':attribute is niet geupload.',
    'url'                            => 'Het formaat van :attribute is ongeldig.',
    'custom'                         => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'reserved_word'                  => ':attribute bevat een gereserveerd woord',
    'dont_allow_first_letter_number' => 'The \":input\" field can\'t have first letter as a number',
    'exceeds_maximum_number'         => ':attribute is langer dan verwacht.',
    'attributes'                     => [],
];
