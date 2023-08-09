<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MembreResource\Pages;
use App\Filament\Resources\MembreResource\RelationManagers;
use App\Models\Membre;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Forms\Components;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;

class MembreResource extends Resource
{
    protected static ?string $model = Membre::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom')->autofocus()->required(),
                Forms\Components\TextInput::make('matricule')->autofocus()->required()->numeric(),
                Forms\Components\TextInput::make('prenom')->autofocus()->required(),
                Forms\Components\TextInput::make('telephone')->autofocus()->numeric()->maxLength(10),
                    Forms\Components\Select::make('sang')
                    ->placeholder('Groupe Sanguin')
                    ->options([
                        'A+' => 'A+',
                        'A-' => 'A-',
                        'B+' => 'B+',
                        'B-' => 'B-',
                        'O+' => 'O+',
                        'O-' => 'O-',
                        'AB+'=> 'AB+',
                        'AB-'=> 'AB-',
                    ]),




            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('matricule')->searchable(),
                Tables\Columns\TextColumn::make('nom')->searchable(),
                Tables\Columns\TextColumn::make('prenom')->searchable(),
                Tables\Columns\TextColumn::make('telephone'),
                Tables\Columns\TextColumn::make('sang'),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListMembres::route('/'),
            'create' => Pages\CreateMembre::route('/create'),
            'edit' => Pages\EditMembre::route('/{record}/edit'),
        ];
    }
}
