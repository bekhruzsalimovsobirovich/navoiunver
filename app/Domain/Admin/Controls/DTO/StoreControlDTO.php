<?php

namespace App\Domain\Admin\Controls\DTO;

use Illuminate\Http\UploadedFile;

class StoreControlDTO
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var UploadedFile|null
     */
    private ?UploadedFile $file = null;

    /**
     * @param array $data
     * @return StoreControlDTO
     */
    public static function fromArray(array $data)
    {
        $dto = new self();
        $dto->setName($data['name']);
        $dto->setFile($data['file'] ?? null);

        return $dto;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return UploadedFile|null
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * @param UploadedFile|null $file
     */
    public function setFile(?UploadedFile $file): void
    {
        $this->file = $file;
    }
}
