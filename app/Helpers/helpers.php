<?php

if (!function_exists('hola_mundo')) {
    /**
     * Calcula la combinacion de equipos.
     * @param $equipos Número de equipos.
     * @return array
     */
    function calcular_rondas($equipos, $boolVuelta = false)
    {
        $rounds = array(); // Rondas.
        $roundsVuelta = array(); // Rondas vuelta.
        $ghost = false; // Equipo fantasma.
        // Array equipos
        $arrayEquipos = nums(intval($equipos));
        // Número de equipos.
        $teams = $equipos;
        // Si el equipo es impar se le agrega un equipo fantasma.

        if ($teams % 2 == 1) {
            $teams++;
            $ghost = true;
        }
        // Calcular las fechas a partir del número de equipos.
        $totalRounds = $teams - 1; // Total de rondas.
        $matchesPerRound = $teams / 2; // Partidos por ronda.

        for ($i = 0; $i < $totalRounds; $i++) {
            $rounds[$i] = array();
        }

        for ($round = 0; $round < $totalRounds; $round++) {
            for ($match = 0; $match < $matchesPerRound; $match++) {
                $home = ($round + $match) % ($teams - 1);
                $away = ($teams - 1 - $match + $round) % ($teams - 1);
                // El último equipo se queda en el mismo lugar mientras los otros giran a su alrededor.
                if ($match == 0) {
                    $away = $teams - 1;
                }
                if (!($ghost && ($home == count($arrayEquipos) || $away == count($arrayEquipos)))) {
                    $rounds[$round][] = [
                        team_name($home + 1, $arrayEquipos),
                        team_name($away + 1, $arrayEquipos)
                    ];
                }
            }
        }

        if ($boolVuelta) {
            for ($i = 0; $i < $totalRounds; $i++) {
                $interleaved[$i] = array();
            }

            $evn = 0;
            $odd = ($teams / 2);
            for ($i = 0; $i < sizeof($rounds); $i++) {
                if ($i % 2 == 0) {
                    $interleaved[$i] = $rounds[$evn++];
                } else {
                    $interleaved[$i] = $rounds[$odd++];
                }
            }


            foreach ($interleaved as $rs => $round) {
                foreach ($round as $r => $fecha) {
                    $roundsVuelta[$rs][] = flip($fecha);
                }
            }
        }

        return ['ida' => $rounds, 'vuelta' => $roundsVuelta];
    }
}

if (!function_exists('nums')) {
    /**
     * Obtener consecución de un número.
     * @param $n Número de equipos.
     * @return array
     */
    function nums($n)
    {
        $ns = array();
        for ($i = 1; $i <= $n; $i++) {
            $ns[] = $i;
        }
        return $ns;
    }
}

if (!function_exists('team_name')) {
    /**
     *
     * @param $num Indice del equipo
     * @param $names Array equipos
     * @return string
     */
    function team_name($num, $names)
    {
        $i = $num - 1;
        if (sizeof($names) > $i && strlen(trim($names[$i])) > 0) {
            return trim($names[$i]);
        } else {
            return $num;
        }
    }
}


if (!function_exists('flip')) {
    /**
     *
     * @param $num Indice del equipo
     * @param $names Array equipos
     * @return string
     */
    function flip($match)
    {
        return [$match[1], $match[0]];
    }
}
