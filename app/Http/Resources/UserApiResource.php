<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserApiResource extends JsonResource
{   
    public $status;
    public $massage;
    public $data;

    public function __construct($status,$massage, $data)
    {
        parent::__construct($data);
        $this->status = $status;
        $this->massage = $massage;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success' => $this->status,
            'massage' => $this->massage,
            'data' => $this->data
        ];
    }
}
