<?php

namespace App\Widgets;

use App\View;

/**
 * Class AdminDataTable
 *
 * Используется в App\Controllers\Admin
 * в методе actionIndex
 *
 * @package App\Widgets
 */
class AdminDataTable
{
    public $rows;
    public $columns;

    public function __construct(array $rows, array $columns)
    {
        $this->rows = $rows;
        $this->columns = $columns;
    }

    public function render()
    {
        $view = new View();
        $view->rows = $this->rows;
        $view->columns = $this->columns;
        return $view->render(__DIR__ . '/admin_data_table/templates/table.php');
    }
}
