<?php

namespace App\Filament\Admin\Resources\SchoolApplications\Pages;

use App\Filament\Admin\Resources\SchoolApplications\SchoolApplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditSchoolApplication extends EditRecord
{
    protected static string $resource = SchoolApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

     protected function getFormActions(): array
    {
        return []; // Removes the default Save and Cancel actions
    }
}
