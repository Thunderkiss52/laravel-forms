<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Thunderkiss52\LaravelDocuments\DocumentFactory;
use Thunderkiss52\LaravelForms\Controllers\DraftController;

Route::middleware(['auth', 'web'])->prefix('forms')->name('forms.')->group(function () {

    Route::put('draft', [DraftController::class, 'reorder']);
    Route::resource('draft', DraftController::class);
    Route::get('/table', function (Request $request) {
        abort_if(!$request->query('form'), 400);
        $form = $request->query('form');
        $rows = $form::fields();
        // $result = [];
        $fieldHeaders = [];
        foreach ($rows as $row) {
            foreach ($row as $field) {
                $fieldHeaders[] = $field->label;
            }
        }
        return response()->download(DocumentFactory::table(
            [],
            $fieldHeaders,
            false,
            $form::toTableValidation(),
            method_exists($form, 'columnWidth') ? $form::columnWidth() : []
        ), __('File').".xlsx");
    });
    Route::post('/table/parse', function (Request $request) {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx']
        ]);
        $file = $request->file('file');

        // Загружаем файл с помощью PhpSpreadsheet
        $spreadsheet = IOFactory::load($file->getPathname());

        // Получаем первый лист
        $sheet = $spreadsheet->getActiveSheet();

        // Получаем диапазон ячеек с данными
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

        // Извлекаем заголовки (первая строка)
        $headers = [];
        for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            $cellCoordinate = Coordinate::stringFromColumnIndex($col) . '1'; // Формируем координату ячейки (A1, B1, ...)
            $headers[] = $sheet->getCell($cellCoordinate)->getFormattedValue();
        }

        // Извлекаем данные с учетом форматирования
        $data = [];
        for ($row = 2; $row <= $highestRow; ++$row) {
            $rowData = [];
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $cellCoordinate = forms . phpCoordinate::stringFromColumnIndex($col) . $row; // Формируем координату ячейки (A2, B2, ...)
                $cell = $sheet->getCell($cellCoordinate);
                $rowData[$headers[$col - 1]] = $cell->getFormattedValue();
            }
            $data[] = $rowData;
        }

        // Возвращаем данные в формате JSON
        return response()->json($data);
    })->name('table.parse');


});
