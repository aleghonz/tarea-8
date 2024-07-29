<?php

function obtenerPaquetes() {
    $paquetes = [
        [
            'id' => 1,
            'nombre' => 'Aventura en el Desierto de Atacama',
            'precio' => 150000,
            'precio_oferta' => 120000, 
            'region' => 'Arica y Parinacota',
            'tipo' => 'Aventura',
            'descripcion' => 'Explora el desierto más árido del mundo, con sus paisajes surrealistas, géiseres, lagunas altiplánicas y cielos estrellados. Disfruta de actividades como sandboarding, trekking y observación astronómica.',
            'imagen' => 'atacama.png',
            'incluye' => ['Transporte', 'Alojamiento en hotel', 'Excursiones guiadas', 'Desayuno y cena'],
            'duracion' => '5 días / 4 noches'
        ],
        [
            'id' => 2,
            'nombre' => 'Cultura Ancestral en San Pedro de Atacama',
            'precio' => 180000,
            'region' => 'Arica y Parinacota',
            'tipo' => 'Cultural',
            'descripcion' => 'Sumérgete en la rica historia y tradiciones de los pueblos atacameños. Visita sitios arqueológicos como el Pukará de Quitor y el Valle de la Luna, y disfruta de la gastronomía local en restaurantes típicos.',
            'imagen' => 'san_pedro.png',
            'incluye' => ['Transporte', 'Alojamiento en hotel boutique', 'Guía local', 'Todas las comidas', 'Entradas a sitios arqueológicos'],
            'duracion' => '4 días / 3 noches'
        ],
        [
            'id' => 3,
            'nombre' => 'Geoglifos Gigantes de Tarapacá',
            'precio' => 120000,
            'region' => 'Tarapacá',
            'tipo' => 'Cultural',
            'descripcion' => 'Descubre los misteriosos geoglifos del Cerro Unita, enormes figuras dibujadas en las laderas que datan de hace más de mil años. Aprende sobre la cultura prehispánica de la zona y disfruta de los paisajes desérticos.',
            'imagen' => 'geoglifos.png',
            'incluye' => ['Transporte', 'Guía arqueólogo', 'Almuerzo tipo picnic', 'Entradas a los sitios arqueológicos'],
            'duracion' => 'Día completo'
        ],
        [
            'id' => 4,
            'nombre' => 'Historia Salitrera en Humberstone y Santa Laura',
            'precio' => 100000,
            'precio_oferta' => 80000,
            'region' => 'Tarapacá',
            'tipo' => 'Cultural',
            'descripcion' => 'Viaja al pasado y conoce la historia de la industria del salitre en las antiguas oficinas salitreras de Humberstone y Santa Laura, declaradas Patrimonio de la Humanidad por la UNESCO.',
            'imagen' => 'salitreras.png',
            'incluye' => ['Transporte', 'Guía especializado', 'Entradas a los museos'],
            'duracion' => 'Día completo'
        ],

        [
            'id' => 15,
            'nombre' => 'Crucero por los Fiordos Patagónicos',
            'precio' => 450000,
            'region' => 'Los Lagos',
            'tipo' => 'Aventura',
            'descripcion' => 'Embárcate en un crucero inolvidable por los fiordos patagónicos, admirando paisajes de ensueño, glaciares imponentes y una rica fauna marina.',
            'imagen' => 'fiordos.png',
            'incluye' => ['Crucero de 4 días', 'Todas las comidas y bebidas a bordo', 'Excursiones en zodiac', 'Charlas educativas'],
            'duracion' => '4 días / 3 noches'
        ],
        [
            'id' => 16,
            'nombre' => 'Relajo en las Termas de Puyehue',
            'precio' => 220000,
            'region' => 'Los Lagos',
            'tipo' => 'Relax',
            'descripcion' => 'Disfruta de las aguas termales y tratamientos de spa en el entorno natural de Puyehue. Ideal para descansar y desconectar.',
            'imagen' => 'termas.png',
            'incluye' => ['Transporte', 'Alojamiento en hotel con termas', 'Acceso a piscinas termales', 'Masajes y tratamientos (opcional)'],
            'duracion' => '3 días / 2 noches'
        ],
        [
            'id' => 27,
            'nombre' => 'Pingüinos y Glaciares en Punta Arenas',
            'precio' => 280000,
            'region' => 'Magallanes y de la Antártica Chilena',
            'tipo' => 'Aventura',
            'descripcion' => 'Navega por el Estrecho de Magallanes, observa colonias de pingüinos en la Isla Magdalena, visita el imponente Glaciar Grey y disfruta de la fauna marina.',
            'imagen' => 'pinguino.png',
            'incluye' => ['Transporte', 'Alojamiento', 'Excursiones guiadas', 'Todas las comidas'],
            'duracion' => '4 días / 3 noches'
        ],
        [
            'id' => 28,
            'nombre' => 'Expedición a la Antártica (¡20% de descuento!)',
            'precio' => 500000,
            'precio_oferta' => 400000,
            'region' => 'Magallanes y de la Antártica Chilena',
            'tipo' => 'Aventura',
            'descripcion' => 'Una aventura única en la vida para explorar el continente blanco, su fauna (pingüinos, ballenas, focas) y sus paisajes helados. Navega entre icebergs y desembarca en sitios históricos y científicos.',
            'imagen' => 'antartica.png',
            'incluye' => ['Vuelos desde Punta Arenas', 'Crucero', 'Alojamiento a bordo', 'Todas las comidas', 'Equipo especial para el frío', 'Charlas educativas'],
            'duracion' => '10 días / 9 noches'
        ]
    ];

    return $paquetes;
}


