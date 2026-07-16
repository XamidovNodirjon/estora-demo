<?php

namespace App\Http\Controllers;

use App\DTOs\MetroDto;
use App\Http\Requests\MetroRequest;
use App\Models\Metro;
use App\Services\MetroService;

class AdminMetroController extends Controller
{
    public function __construct(
        protected MetroService $service
    ) {}

    public function store(MetroRequest $request)
    {
        $dto = MetroDto::fromArray($request->validated());
        $this->service->createMetro($dto);

        return redirect()->route('admin.infrastructure')->with('success', 'Metro muvaffaqiyatli yaratildi!');
    }

    public function update(MetroRequest $request, Metro $metro)
    {
        $dto = MetroDto::fromArray($request->validated());
        $this->service->updateMetro($metro, $dto);

        return redirect()->route('admin.infrastructure')->with('success', 'Metro muvaffaqiyatli yangilandi!');
    }

    public function destroy(Metro $metro)
    {
        $this->service->deleteMetro($metro);
        return redirect()->route('admin.infrastructure')->with('success', 'Metro o\'chirildi!');
    }
}
