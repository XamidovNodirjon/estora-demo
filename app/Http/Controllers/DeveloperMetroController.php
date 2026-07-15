<?php

namespace App\Http\Controllers;

use App\DTOs\MetroDto;
use App\Http\Requests\MetroRequest;
use App\Models\Metro;
use App\Services\MetroService;

class DeveloperMetroController extends Controller
{
    public function __construct(
        protected MetroService $service
    ) {}

    public function index()
    {
        $metros = $this->service->getMetros();
        return view('developer.metros.index', compact('metros'));
    }

    public function create()
    {
        return view('developer.metros.create');
    }

    public function store(MetroRequest $request)
    {
        $dto = MetroDto::fromArray($request->validated());
        $this->service->createMetro($dto);

        return redirect()->route('developer.infrastructure')->with('success', 'Metro muvaffaqiyatli yaratildi!');
    }

    public function edit(Metro $metro)
    {
        return view('developer.metros.edit', compact('metro'));
    }

    public function update(MetroRequest $request, Metro $metro)
    {
        $dto = MetroDto::fromArray($request->validated());
        $this->service->updateMetro($metro, $dto);

        return redirect()->route('developer.infrastructure')->with('success', 'Metro muvaffaqiyatli yangilandi!');
    }

    public function destroy(Metro $metro)
    {
        $this->service->deleteMetro($metro);
        return redirect()->route('developer.infrastructure')->with('success', 'Metro o\'chirildi!');
    }
}
