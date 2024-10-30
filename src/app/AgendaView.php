<?php

declare(strict_types=1);

namespace ConferenceApp;

class AgendaView
{
    /**
     * @var Agenda
     */
    private $agenda;

    /**
     * @param Agenda $agenda
     */
    public function __construct(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }

    /**
     * @return int
     */
    public function getNumberOfSlots(): int
    {
        /**
         * @todo: Implement it
         */
        return $this->agenda->count();
    }

    /**
     * return int
     */
    public function getDurationInMinutes(): int
    {
        $totalDuration = 0;
        $prevEndAt = null;

        foreach ($this->agenda as $slot) {
            if ($prevEndAt) {
                $totalDuration += max(0, $slot->getStartAt()->getTimestamp() - $prevEndAt->getTimestamp());
            }
            $totalDuration += $slot->getEndAt()->getTimestamp() - $slot->getStartAt()->getTimestamp();
            $prevEndAt = $slot->getEndAt();
        }
        return $totalDuration / 60;
    }
}
