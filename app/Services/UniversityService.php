<?php

namespace App\Services;

use App\DTOs\UniversityDto;
use App\Models\University;
use App\Repositories\UniversityRepository;

class UniversityService
{
    public function __construct(
        protected UniversityRepository $repository
    ) {}

    public function getUniversities($limit = 10)
    {
        return $this->repository->getPaginated($limit);
    }

    public function getAllUniversities()
    {
        return $this->repository->getAll();
    }

    public function getUniversityById($id)
    {
        return $this->repository->findById($id);
    }

    public function createUniversity(UniversityDto $dto): University
    {
        return $this->repository->create($dto->toArray());
    }

    public function updateUniversity(University $university, UniversityDto $dto): University
    {
        return $this->repository->update($university, $dto->toArray());
    }

    public function deleteUniversity(University $university): bool
    {
        return $this->repository->delete($university);
    }
}
