<table class="table-bordered">
    <tbody>
    <?php foreach ($rows as $row): ?>
        <tr>
            <?php foreach ($columns as $column): ?>
                <td><?php echo $column($row); ?></td>
            <?php endforeach; ?>
            <td><a href="/admin/delete-article/?id=<?php echo $row->id; ?>" class="btn btn-danger">Удалить</a></td>
            <td><a href="/admin/update-article/?id=<?php echo $row->id; ?>" class="btn btn-primary">Редактировать</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
