<?php declare(strict_types=1);


namespace App;


class EventsController
{

    /**
     * метод апи контроллера принимающий данные после валидации
     * Реквест заменим на дату для сокращения кода
     *
     * @param array $data
     */
    public function store(array $data): void
    {
        //по хорошему мы должны провалидировать заранее данные
        //и контроллер не должен заниматься этой логикой, а отдельный сервис

        $filename = 'queue.txt';
        $path = __DIR__ . '/../data/' . $filename;
        //т.к. у нас нет полного приложения с сервисом очередей, используем файл.
        foreach ($data as $userId => $eventsSequence) {
            foreach ($eventsSequence as $step => $event) {
                file_put_contents(
                    $path,
                    $userId . "|" . $step . '=>' . $event . PHP_EOL,
                    FILE_APPEND | LOCK_EX);
            }
        }
        // "обрабатываем" данные
        sleep(1);
    }
}