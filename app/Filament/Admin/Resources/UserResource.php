<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Filament\BlockGroups\Address;
use App\Models\Role;
use App\Models\User;
use App\Services\AddressServices;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Password;
use Filament\Forms\Components\Actions\Action;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Usuários';
    protected static ?string $pluralLabel = 'Usuários';
    protected static ?string $label = 'Usuário';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\Fieldset::make('Papel')
                        ->schema([
                            Forms\Components\ToggleButtons::make('role_id')
                                ->label('')
                                ->required()
                                ->markAsRequired(false)
                                ->options(Role::all()->sortBy('name')->pluck('name', 'id'))
                                ->grouped()
                                ->reactive()
                                ->default(2)
                                ->afterStateUpdated(function ($record, $state, $livewire)
                                {
                                    if ($record)
                                    {
                                        $record->role_id = (int) $state;
                                        $livewire->dispatch('type-updated');
                                    }
                                }),
                        ]),
                    Forms\Components\Fieldset::make('Dados de acesso')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Nome')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('email')
                                ->label('Email')
                                ->required()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),
                            Forms\Components\TextInput::make('password')
                                ->label('Senha')
                                ->required()
                                ->maxLength(255)
                                ->confirmed()
                                ->rules([Password::min(8)->mixedCase()->numbers()->uncompromised()])
                                ->password()
                                ->revealable(),
                            Forms\Components\TextInput::make('password_confirmation')
                                ->label('Confirme a Senha')
                                ->required()
                                ->maxLength(255)
                                ->password()
                                ->revealable(),
                        ]),
                    Forms\Components\Fieldset::make('Dados de Endereço')
                        ->schema([
                            Forms\Components\Repeater::make('addresses')
                                ->hiddenLabel()
                                ->relationship()
                                ->schema(Address::make($form))
                                ->columns(2)
                                ->addActionLabel('Adicionar Endereço')
                                ->addActionAlignment('start')
                        ])->columns(1)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('addresses.city.state.country.name')
                    ->label('País')
                    ->searchable(),
                TextColumn::make('events_count')
                    ->label('Eventos que participou')
                    ->badge()
                    ->color(function (string $state) {
                       if ($state < 5) {
                           return 'gray';
                       }
                       return 'success';
                    })
                    ->counts([
                        'events' => fn (Builder $query): Builder => $query->whereNotNull('event_user.checkin_at')
                    ]),
                TextColumn::make('created_at')
                    ->date("d F Y"),
                Tables\Columns\ViewColumn::make('teste')->view('filament.tables.columns.custom-column')
            ])
            ->filters([
                SelectFilter::make('role_id')
                    ->label("Tipo")
                    ->relationship('role', 'name'),
                Tables\Filters\QueryBuilder::make()
                    ->constraints([
                        Tables\Filters\QueryBuilder\Constraints\DateConstraint::make('created_at')
                            ->label('Data de criação'),
                        Tables\Filters\QueryBuilder\Constraints\RelationshipConstraint::make('events')
                            ->relationship('events', 'name')->multiple()
                    ])
            ])
            ->filtersFormWidth(MaxWidth::FourExtraLarge)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
