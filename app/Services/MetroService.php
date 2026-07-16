<?php

namespace App\Services;

use App\DTOs\MetroDto;
use App\Models\Metro;
use App\Repositories\MetroRepository;

class MetroService
{
    public function __construct(
        protected MetroRepository $repository
    ) {}

    public function getMetros($limit = 10)
    {
        return $this->repository->getPaginated($limit);
    }

    public function getAllMetros()
    {
        return $this->repository->getAll();
    }

    public function getMetroById($id)
    {
        return $this->repository->findById($id);
    }

    public function createMetro(MetroDto $dto): Metro
    {
        return $this->repository->create($dto->toArray());
    }

    public function updateMetro(Metro $metro, MetroDto $dto): Metro
    {
        return $this->repository->update($metro, $dto->toArray());
    }

    public function deleteMetro(Metro $metro): bool
    {
        return $this->repository->delete($metro);
    }
}
