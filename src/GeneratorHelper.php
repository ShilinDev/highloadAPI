<?php declare(strict_types=1);

namespace App;

class GeneratorHelper
{

    /**
     * Examples of events
     *
     * @var array
     */
    private $events = ['click', 'view', 'tap', 'media', 'banner', 'download'];
    /**
     * @var int
     */
    private $blockSize;
    /**
     * @var int
     */
    private $counter = 0;

    /**
     * @return int
     */
    public function getCounter(): int
    {
        return $this->counter;
    }

    /**
     * GeneratorHelper constructor.
     *
     * @param int $blockSize
     */
    public function __construct(int $blockSize)
    {
        $this->blockSize = $blockSize;
    }

    /**
     * Генерируем набор случаных событий
     *
     * @return array
     * @throws \Exception
     */
    public function generate(): array
    {
        $this->counter = 0;
        $result = [];
        for ($i = 0; $i < $this->blockSize; $i++) {
            //генерируем последовательность 1-5 событий
            $randEventsCount = random_int(1, 5);
            $events = [];
            for ($j = 0; $j < $randEventsCount; $j++) {
                $events[] = $this->events[random_int(0, 5)];
                $this->counter++;
            }
            //$i выступает в роли ID юзера
            // храним массив событий для конкретного юзера
            $result[$i] = $events;
        }

        return $result;
    }
}