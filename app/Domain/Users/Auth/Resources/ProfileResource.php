<?php

namespace App\Domain\Users\Auth\Resources;

use App\Domain\Admin\Controls\Models\Control;
use App\Domain\Admin\QuestionsAnswers\Models\Answer;
use App\Domain\Users\Results\Resources\ResultResource;
use App\Models\Trait\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProfileResource extends JsonResource
{
    use Result;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'region' => $this->region,
            'city' => $this->city,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'role' => $this->getRoleNames(),
            'results' => $this->result($this->results)
        ];
    }
}
