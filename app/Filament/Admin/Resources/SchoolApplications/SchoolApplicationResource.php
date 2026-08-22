<?php

namespace App\Filament\Admin\Resources\SchoolApplications;

use App\Filament\Admin\Resources\SchoolApplications\Pages\CreateSchoolApplication;
use App\Filament\Admin\Resources\SchoolApplications\Pages\EditSchoolApplication;
use App\Filament\Admin\Resources\SchoolApplications\Pages\ListSchoolApplications;
use App\Filament\Admin\Resources\SchoolApplications\Schemas\SchoolApplicationForm;
use App\Filament\Admin\Resources\SchoolApplications\Tables\SchoolApplicationsTable;
use App\Models\SchoolApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolApplicationResource extends Resource
{
    protected static ?string $model = SchoolApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'school_name';

    public static function form(Schema $schema): Schema
    {
        return SchoolApplicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchoolApplicationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSchoolApplications::route('/'),
            'create' => CreateSchoolApplication::route('/create'),
            'edit' => EditSchoolApplication::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
