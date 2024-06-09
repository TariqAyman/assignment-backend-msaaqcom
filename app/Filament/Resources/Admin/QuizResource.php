<?php

namespace App\Filament\Resources\Admin;

use App\Enums\QuestionType;
use App\Enums\QuizType;
use App\Filament\Resources\Admin\QuizResource\Pages;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $tenantRelationshipName = 'quizzes';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\TextInput::make('description')->nullable(),
                Forms\Components\Select::make('type')
                    ->required()
                    ->live()
                    ->options(QuizType::toSelectOptions()),
                Forms\Components\DateTimePicker::make('start_date')
                    ->visible(fn(Get $get): bool => $get('type') == QuizType::IN_TIME)
                    ->seconds(false)
                    ->after('now')
                    ->requiredIf('type', QuizType::IN_TIME),
                Forms\Components\DateTimePicker::make('end_date')
                    ->visible(fn(Get $get): bool => $get('type') == QuizType::IN_TIME)
                    ->seconds(false)
                    ->after('start_date')
                    ->requiredIf('type', QuizType::IN_TIME),

                Forms\Components\Section::make('Questions')
                    ->schema([
                        Builder::make('questions')
                            ->blocks([
                                Builder\Block::make(QuestionType::TEXT)
                                    ->label('Text question')
                                    ->schema([
                                        TextInput::make('question')
                                            ->label('Question')
                                            ->required(),
                                        TextInput::make('description')
                                            ->label('Description')
                                            ->required(),
                                    ])
                                    ->columns(2),
                                Builder\Block::make(QuestionType::CHOICES)
                                    ->schema([
                                        TextInput::make('question')
                                            ->label('Question')
                                            ->required(),
                                        TextInput::make('description')
                                            ->label('Description')
                                            ->required(),
                                        Forms\Components\Section::make('Questions')
                                            ->schema([
                                                Builder::make('choices')
                                                    ->label('choice')
                                                    ->blocks([
                                                        Builder\Block::make('choice')
                                                            ->label('choice')
                                                            ->schema([
                                                                TextInput::make('title')
                                                                    ->label('Title')
                                                                    ->required(),
                                                                TextInput::make('description')
                                                                    ->label('Description')
                                                                    ->required(),
                                                                TextInput::make('explanation')
                                                                    ->label('Explanation')
                                                                    ->required(),
                                                                TextInput::make('order')
                                                                    ->numeric()
                                                                    ->label('Order')
                                                                    ->required(),
                                                                ToggleButtons::make('is_correct')
                                                                    ->boolean()
                                                                    ->inline()
                                                                    ->required(),
                                                            ])
                                                            ->columns(2),
                                                    ]),
                                            ])
                                    ])
                                    ->columns(2),
                                Builder\Block::make(QuestionType::TRUE_FALSE)
                                    ->label('True/False question')
                                    ->schema([
                                        TextInput::make('question')
                                            ->label('Question')
                                            ->required(),
                                        TextInput::make('description')
                                            ->label('Description')
                                            ->required(),
                                        ToggleButtons::make('is_correct')
                                            ->label('Is True')
                                            ->boolean()
                                            ->inline()
                                            ->required(),
                                    ])
                                    ->columns(2),
                            ])
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('start_date'),
                Tables\Columns\TextColumn::make('end_date'),
            ])
            ->filters([

            ])
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
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
}
