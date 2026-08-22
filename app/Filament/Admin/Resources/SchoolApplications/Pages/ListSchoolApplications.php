<?php

namespace App\Filament\Admin\Resources\SchoolApplications\Pages;

use App\Filament\Admin\Resources\SchoolApplications\SchoolApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchoolApplications extends ListRecords
{
    protected static string $resource = SchoolApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
