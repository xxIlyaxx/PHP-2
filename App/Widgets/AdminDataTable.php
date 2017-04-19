<?php

namespace App\Widgets;

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
        ob_start();
        include __DIR__ . '/admin_data_table/templates/table.php';
        return ob_get_clean();
    }
}
