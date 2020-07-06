<?php

namespace App\Http\Controllers;

use App\Jobs\CreateParticipant;
use App\Jobs\UpdateParticipant;
use App\Models\Event;
use App\Http\Resources\Participant as ParticipantResource;
use App\Http\Resources\Success;
use App\Http\Resources\Error;
use App\Models\Participant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Illuminate\Validation\Rule;

/**
 * @group Managing participants
 *
 * Управление участниками
 *
 * API для управления участниками мероприятий
 *
 * Для работы API необходимо в заголовке передавать ключ X_API_KEY указанный в файле .env
 * Например: X_API_KEY=5ebe2294ecd0e0f08eab7690d2a6ee69
 *
 * Разметка документации здесь
 * https://beyondco.de/docs/laravel-apidoc-generator/getting-started/documenting-your-api
 *
 * @package App\Http\Controllers
 */
class ParticipantsController extends Controller
{

    /**
     * @group Participants list
     * Список участников
     * Список участников с возможностью фильтрации
     *
     * @urlParam  id id параметр фильтрации выборки.
     * @apiResourceCollection App\Http\Resources\Participant
     * @apiResourceModel App\Models\Participant
     */
    public function actionList($id = null)
    {
        if ($id) {
            return ParticipantResource::collection(Participant::where('event_id', $id)->get());
        }
        return ParticipantResource::collection(Participant::all());
    }

    /**
     * @group Participant view
     * Данные участника
     *
     * @urlParam  id id участника обязательный параметр .
     * @apiResource App\Http\Resources\Participant
     * @apiResourceModel App\Models\Participant
     */
    public function actionView($id)
    {
        $participant = Participant::find($id);
        if (!$participant) {
            $error = new Error([
                'id' => 3,
                'status' => 504,
                'title' => 'Участник не найден',
            ]);

            return new JsonResponse($error->resource);
        }

        return new ParticipantResource($participant);
    }

    /**
     * @group Delete participant
     * Удаление участника
     *
     * @urlParam  id id участника обязательный параметр .
     *
     * @response {
     *  "message": "Успешно удалено"
     * }
     *
     * @response 504{
     *  "id":  2,
     *  "status": 504,
     *  "title": "Ошибка удаления"
     * }
     * @response 504{
     *  "id":  3,
     *  "status": 504,
     *  "title": "Участник не найден"
     * }
     */
    public function actionDelete($id)
    {
        $participant = Participant::find($id);
        if (!$participant) {
            $error = new Error([
                'id' => 3,
                'status' => 504,
                'title' => 'Участник не найден',
            ]);

            return new JsonResponse($error->resource);
        }

        $deleted = Participant::destroy($id);

        if (!$deleted) {
            $error = new Error([
                'id' => 2,
                'status' => 504,
                'title' => 'Ошибка удаления',
            ]);

            return new JsonResponse($error->resource);
        }

        $success = new Success([
            'message' => 'Успешно удалено',
        ]);

        return new JsonResponse($success->resource);
    }

    /**
     * @group Create participant
     * Добавление участника
     *
     * @bodyParam  action string required Обязательный параметр `create`
     * @bodyParam  data.name string Имя участника
     * @bodyParam  data.email string Email участника
     * @bodyParam  data.even_id int id мероприятия
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function actionCreate(Request $request)
    {
        if ($request->action !== 'create') {
            $error = new Error([
                'id' => 3,
                'status' => 504,
                'title' => 'Неверный тип данных',
            ]);
            return new JsonResponse($error->resource);
        }

        $this->validate($request, [
            'data.name' => 'required',
            'data.email' => 'required|email|unique:participants,email',
            'data.event_id' => 'nullable|exists:events,id'
        ]);

        $participant = Participant::create($request->data);

        if (!$participant) {
            $error = new Error([
                'id' => 2,
                'status' => 504,
                'title' => 'Ошибка создания',
            ]);

            return new JsonResponse($error->resource);
        }

        if (array_key_exists('event_id', $request->data)) {
            $event = Event::find($request->data['event_id']);
            $participant->event()->associate($event);
            $participant->save();
        }

        Queue::push(new CreateParticipant($participant));

        $success = new Success([
            'message' => 'Успешно создано',
        ]);

        return new JsonResponse($success->resource);
    }

    /**
     * @group Update participant
     * Обновление данных участника
     *
     * @bodyParam  action string required Обязательный параметр `update`
     * @bodyParam  data.name string Имя участника
     * @bodyParam  data.email string Email участника
     * @bodyParam  data.even_id int id мероприятия
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function actionUpdate(Request $request, $id)
    {
        if ($request->action !== 'update') {
            $error = new Error([
                'id' => 3,
                'status' => 504,
                'title' => 'Неверный тип данных',
            ]);
            return new JsonResponse($error->resource);
        }

        $participant = Participant::find($id);
        if (!$participant) {
            $error = new Error([
                'id' => 3,
                'status' => 504,
                'title' => 'Участник не найден',
            ]);

            return new JsonResponse($error->resource);
        }

        $this->validate($request, [
            'data.name' => Rule::requiredIf(function () use ($request) {
                $emptyEmail = !array_key_exists('email', $request->data) || $request->data['email'] === '';
                $emptyEvent = !array_key_exists('event_id', $request->data) || $request->data['event_id'] === '';
                return $emptyEmail && $emptyEvent;
            }),
            'data.email' => Rule::requiredIf(function () use ($request) {
                $emptyName = !array_key_exists('name', $request->data) || $request->data['name'] === '';
                $emptyEvent = !array_key_exists('event_id', $request->data) || $request->data['event_id'] === '';
                return $emptyName && $emptyEvent;
            }),
            'data.event_id' => Rule::requiredIf(function () use ($request) {
                $notExistFields = !array_key_exists('name', $request->data) &&
                    !array_key_exists('email', $request->data);
                $emptyFields = empty($request->data['name']) &&
                    empty($request->data['email']);

                return $notExistFields || $emptyFields;
            }),
        ]);

        $this->validate($request, [
            'data.email' => 'email|unique:participants,email',
            'data.event_id' => 'nullable|exists:events,id'
        ]);

        $participant->fill($request->data);

        if (array_key_exists('event_id', $request->data)) {
            $event = Event::find($request->data['event_id']);
            $participant->event()->associate($event);
        }

        $saved = $participant->save();

        if (!$saved) {
            $error = new Error([
                'id' => 4,
                'status' => 504,
                'title' => 'Ошибка сохранения',
            ]);

            return new JsonResponse($error->resource);
        }

        Queue::push(new UpdateParticipant($participant));

        $success = new Success([
            'message' => 'Успешно обновлено',
        ]);

        return new JsonResponse($success->resource);
    }
}
