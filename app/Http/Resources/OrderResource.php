<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "total" => $this->total,
            "status" => $this->status,
            "payment_status"=>$this->payments()->latest()->first()->status ?? null,
            "delivered_at"=>$this->delivered_at?$this->delivered_at:null,
            "created_at"=>$this->created_at,
            "address" => [
                "name" => $this->address->name,
                "address" => $this->address->address,
                "region" => $this->address->region,
                "city" => $this->address->city,
                "cp" => $this->address->cp,

            ],
            "products"=>$this->products->map(function($product){
                return [
                    "name"=>$product->name,
                    "quantity"=>$product->pivot->quantity,
                    "price"=>$product->pivot->price,
                    "image_url"=>url('/storage/'.$product->image_url)

                ];
            })

        ];
    }
}
