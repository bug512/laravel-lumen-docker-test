<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Participant extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'event' => new Event($this->event),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
