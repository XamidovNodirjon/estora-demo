<?php

namespace App\Repositories;

use App\Models\University;

class UniversityRepository
{
    public function getPaginated($limit = 10)
    {
        return University::latest()->paginate($limit);
    }

    public function getAll()
    {
        return University::all();
    }

    public function findById($id)
    {
        return University::findOrFail($id);
    }

    public function create(array $data): University
    {
        return University::create($data);
    }

    public function update(University $university, array $data): University
    {
        $university->update($data);
        return $university;
    }

    public function delete(University $university): bool
    {
        return $university->delete();
    }
}
