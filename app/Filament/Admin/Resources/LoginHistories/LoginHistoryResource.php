<?php

namespace App\Filament\Admin\Resources\LoginHistories;

use App\Filament\Admin\Resources\LoginHistories\Pages\ManageLoginHistories;
use App\Models\LoginHistory;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class LoginHistoryResource extends Resource
{
    protected static ?string $model = LoginHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
     protected static string | UnitEnum | null $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
               
            TextColumn::make('user.first_name')
                ->label('User')
                ->searchable(),

            TextColumn::make('user.last_name')
                ->label('Last Name')
                ->searchable(),

            TextColumn::make('login_at')
                ->dateTime()
                ->sortable(),

            TextColumn::make('logout_at')
                ->dateTime()
                ->sortable(),

            IconColumn::make('successful')
                ->boolean(),

            TextColumn::make('ip_address')
                ->label('IP Address'),

            TextColumn::make('device_type')
                ->badge(),

            TextColumn::make('platform')
                ->badge(),

            TextColumn::make('browser')
                ->badge(),

            TextColumn::make('application')
                ->badge(),

            TextColumn::make('guard')
                ->badge(),
        
            ])
            ->defaultSort('login_at', 'desc')
            ->filters([
        SelectFilter::make('successful')
        ->options([
            1 => 'Successful',
            0 => 'Failed',
        ]),

    SelectFilter::make('device_type')
        ->options([
            'desktop' => 'Desktop',
            'mobile' => 'Mobile',
            'tablet' => 'Tablet',
        ]),

    SelectFilter::make('platform')
        ->options([
            'Windows' => 'Windows',
            'Android' => 'Android',
            'iOS' => 'iOS',
            'macOS' => 'macOS',
            'Linux' => 'Linux',
        ]),

    Filter::make('login_at')
        ->form([
            DatePicker::make('from'),
            DatePicker::make('until'),
        ])
        ->query(function (Builder $query, array $data) {

            return $query
                ->when(
                    $data['from'] ?? null,
                    fn ($query, $date) =>
                        $query->whereDate('login_at', '>=', $date)
                )
                ->when(
                    $data['until'] ?? null,
                    fn ($query, $date) =>
                        $query->whereDate('login_at', '<=', $date)
                );
        }),
            ])
            ->recordActions([
               // EditAction::make(),
               // DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                  //  DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageLoginHistories::route('/'),
        ];
    }
}
