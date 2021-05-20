<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\ExcelExporter;

/**
 * Class EmailExporter
 * @package App\Admin\Extensions
 */
class EmailExcelExporter extends ExcelExporter

{
    protected $fileName = 'Emails List.xls';

    protected $headings = ['ID', 'Email', 'Action', 'Created At', 'Updated At'];
}