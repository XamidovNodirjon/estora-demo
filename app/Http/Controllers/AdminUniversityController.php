<?php

namespace App\Http\Controllers;

use App\DTOs\UniversityDto;
use App\Http\Requests\UniversityRequest;
use App\Models\University;
use App\Services\UniversityService;

class AdminUniversityController extends Controller
{
    public function __construct(
        protected UniversityService $service
    ) {}

    public function store(UniversityRequest $request)
    {
        $dto = UniversityDto::fromArray($request->validated());
        $this->service->createUniversity($dto);

        return redirect()->route('admin.infrastructure')->with('success', 'Universitet muvaffaqiyatli yaratildi!');
    }

    public function update(UniversityRequest $request, University $university)
    {
        $dto = UniversityDto::fromArray($request->validated());
        $this->service->updateUniversity($university, $dto);

        return redirect()->route('admin.infrastructure')->with('success', 'Universitet muvaffaqiyatli yangilandi!');
    }

    public function destroy(University $university)
    {
        $this->service->deleteUniversity($university);
        return redirect()->route('admin.infrastructure')->with('success', 'Universitet o\'chirildi!');
    }
}
