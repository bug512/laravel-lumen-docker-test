<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Success extends JsonResource
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'message' => $this->message,
        ];
    }
}
