<?php

namespace App\Filament\Resources\GraduationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\SubjectGradesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SubjectGradesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubjectGradesRelationManager extends RelationManager
{
    protected static string $relationship = 'subject_grades';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kode_subject')
                    ->label('Subject')
                    ->relationship('subject', 'name') // Display subject name
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->label('Grade')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Subject Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Grade')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('download_excel')
                    ->label('Download Excel')
                    ->action(fn () => $this->downloadExcel()),
                Tables\Actions\Action::make('upload_excel')
                    ->label('Upload Excel')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->label('Excel File')
                            ->required()
                            ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']),
                    ])
                    ->action(fn (array $data) => $this->uploadExcel($data['file'])),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function downloadExcel()
    {
        $student = $this->ownerRecord->student; // Get the related student
        return Excel::download(new SubjectGradesExport($student), 'subject_grades.xlsx');
    }

    public function uploadExcel($filePath)
    {
        $studentId = $this->ownerRecord->student->id; // Get the related student ID

        // Convert the relative file path to the full storage path
        $fullPath = storage_path('app/public/' . ltrim($filePath, '/'));

        // Debugging: Log the file path to verify
        Log::info("Attempting to import file from path: $fullPath");

        // Ensure the file exists before importing
        if (!file_exists($fullPath)) {
            Log::error("File not found at path: $fullPath");
            throw new \Exception("File [$fullPath] does not exist and cannot be imported.");
        }

        // Import the Excel file
        Excel::import(new SubjectGradesImport($studentId), $fullPath);

        // Delete the temporary file after processing
        if (file_exists($fullPath)) {
            unlink($fullPath);
            Log::info("Temporary file deleted: $fullPath");
        } else {
            Log::warning("Temporary file not found for deletion: $fullPath");
        }

        // Debugging: Log success
        Log::info("File imported successfully from path: $fullPath");
    }
}
