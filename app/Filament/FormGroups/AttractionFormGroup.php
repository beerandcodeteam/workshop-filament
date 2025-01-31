<?php

namespace App\Filament\FormGroups;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class AttractionFormGroup
{
    public static function make(Form $form, $has_schedule = false): array
    {
        $fields = [
            Select::make('attraction_type_id')
                ->relationship('attractionType', 'name')
                ->required(),
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('description')
                ->required()
                ->maxLength(255),
            FileUpload::make('cover')
                ->image()
                ->required(),
        ];

        if ($has_schedule) {
            $fields[] = DateTimePicker::make('schedule');
        }

        return $fields;
    }
}
