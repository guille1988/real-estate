<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\PageEnum;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class PropertyController
{
    public function index()
    {
        return Inertia::render(PageEnum::ADMIN_PROPERTIES->value);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Property $property)
    {
        //
    }

    public function edit(Property $property)
    {
        //
    }

    public function update(Request $request, Property $property)
    {
        //
    }

    public function destroy(Property $property)
    {
        //
    }
}
