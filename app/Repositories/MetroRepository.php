<?php

namespace App\Repositories;

use App\Models\Metro;

class MetroRepository
{
    public function getPaginated($limit = 10)
    {
        return Metro::latest()->paginate($limit);
    }

    public function getAll()
    {
        return Metro::all();
    }

    public function findById($id)
    {
        return Metro::findOrFail($id);
    }

    public function create(array $data): Metro
    {
        return Metro::create($data);
    }

    public function update(Metro $metro, array $data): Metro
    {
        $metro->update($data);
        return $metro;
    }

    public function delete(Metro $metro): bool
    {
        return $metro->delete();
    }
}
