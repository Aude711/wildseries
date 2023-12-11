<?php

namespace App\Services;

use App\Entity\Program;
use App\Entity\Season;

class ProgramDuration 
{
    public function calculate(Program $program): string
    {
        $programDuration = 0;

        $seasons = $program->getSeasons();

        foreach ($seasons as $season) {
            $seasonDuration = $this->calculateAll($season);
            $programDuration += $seasonDuration;
        }
        return $programDuration;
    }

    public function calculateAll(Season $season): int
    {
        $seasonDuration = 0;

        $episodes = $season->getEpisodes();

        foreach ($episodes as $episode) {
            $seasonDuration += $episode->getDuration();
        }
        return $seasonDuration;
    }
}
