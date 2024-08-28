<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    //chaning the name from data to ticket
    public static $wrap = 'ticket';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //this were we design the payload(response). 
        //return parent::toArray($request);
        //the idea is we simply define what we want in our json payload here
       return [
        'type'=>'ticket',
        'id'=>$this->id,
        'attributes'=>[
            'title'=>$this->title,
            'description'=>$this->description,
            'status'=>$this->status,
            'createdAt'=>$this->created_at, 
            'updatedAt'=>$this->updated_at,
        ],
        'relationships'=>[
            'authur'=>
            [
                'data'=>
                [
                    'type'=>'user',
                    'id'=>$this->user_id,
                ],
                'links'=>[
                    ['self'=>'todo']
                ]
            ]
        ]
        ,
        'links'=>[
            ['self'=>route('tickets.show',['ticket'=>$this->id])]
        ]
       ];
    }
}
