<?php

namespace App\Domain\Admin\Controls\Actions;

use App\Domain\Admin\Controls\DTO\StoreControlDTO;
use App\Domain\Admin\Controls\Models\Control;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreControlAction
{
    /**
     * @param StoreControlDTO $dto
     * @return Control
     * @throws Exception
     */
    public function execute(StoreControlDTO $dto): Control
    {
        DB::beginTransaction();
        try {
            $control = new Control();
            $control->name = $dto->getName();
            $control->save();

            if ($dto->getFile()) {
                $filename = Str::random(6) . '_' . time() . '.' . $dto->getFile()->getClientOriginalExtension();
                $dto->getFile()->storeAs('public/files/controls', $filename);
                $path = url('storage/files/controls/' . $filename);

                $control->files()->create([
                    'filename' => $filename,
                    'path' => $path,
                    'type' => 'control',
                ]);
            }

        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $control;
    }
}
