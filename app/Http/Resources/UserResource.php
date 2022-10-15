<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'img' => $this->profile_picture,
            'jobTitle' => $this->job,
            'teams' => $this->teams->map(fn($team) => $team->name),
            'results' => json_decode($this->results
                ->filter(fn($result) => $result->test_identifier == $request->test_identifier)
                ->first()->result, true),
            'uuid' => $this->uuid,
        ];
    }
}
