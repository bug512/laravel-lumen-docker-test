<?php

use Illuminate\Testing\Assert as PHPUnit;

class ParticipantsTest extends TestCase
{
    use \Laravel\Lumen\Testing\DatabaseTransactions;

    /**
     * Тестирование endpoint список участников
     *
     * @return void
     */
    public function testListParticipants()
    {
        $this->get('api/participants/', [
            'x-api-key' => env('X_API_KEY', 'X_API_KEY')
        ])->seeJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'event',
                    'created_at',
                    'updated_at',
                ]
            ]
        ]);

        $this->seeStatusCode(200);
    }

    /**
     * Тестирование endpoint список участников c фильтрацией
     *
     * @return void
     */
    public function testListFilterEvent()
    {
        $this->get('api/participants/event/2', [
            'x-api-key' => env('X_API_KEY', 'X_API_KEY')
        ])->seeJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'event',
                    'created_at',
                    'updated_at',
                ]
            ]
        ]);

        foreach ($this->response->original as $item) {
            if ($item->event->id !== 2) {
                PHPUnit::fail(
                    "Неверная фильтрация"
                );
            }
        }

        $this->seeStatusCode(200);
    }

    /**
     * Тестирование endpoint список участников c фильтрацией
     *
     * @return void
     */
    public function testCreateParticipant()
    {
        $data = [
            'action' => 'create',
            'data' => [
                'name' => 'test',
                'email' => 'test2@test.test',
                'event_id' => 1,
            ],
        ];

        $headers = [
            'x-api-key' => env('X_API_KEY', 'X_API_KEY'),
            'Content-Type' => 'application/vnd.api+json',
        ];

        $this->json('POST', 'api/participants/', $data, $headers);

        $this->seeJson(['message' => 'Успешно создано']);

        $this->seeStatusCode(200);
    }
}
