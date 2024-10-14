@if ($canEdit === true)
@if (!empty($actions['edit']))
{{ Html::link(@$actions['edit']['url'], @$actions['edit']['label'] ?? '', ['class' => 'btn btn-light-warning btn-sm fas fa-edit fs-4']) }}
@endif
@endif

@if ($canEnable === true)
@if (!empty($actions['enable']))
<a href="{{ $actions['enable']['url'] }}" type="button" class="btn btn-light-primary btn-sm">
    <span class="fs-4">
        <i class="fas fa-unlock"></i>
    </span>
</a>
@endif
@endif

@if ($canDisable === true)
@if (!empty($actions['disable']))
<a href="{{ $actions['disable']['url'] }}" type="button" class="btn btn-light-danger btn-sm">
    <span class="fs-4">
        <i class="fas fa-lock"></i>
    </span>
</a>

@endif
@endif

@if ($canDelete === true)
@if (!empty($actions['delete']))
<button class="btn btn-light-danger btn-sm fas fa-trash-alt fs-4" onclick="deleteData('{{ $actions['delete']['url'] }}')">
    {{ $actions['delete']['label'] ?? '' }}
</button>

@endif
@endif

@if ($canView === true)
@if (!empty($actions['view']))
{{ Html::link(@$actions['view']['url'], @$actions['view']['label'] ?? '', ['class' => 'btn btn-light-primary btn-sm fas fa-eye fs-4']) }}
@endif
@endif


@if ($canExcel === true)
@if (!empty($actions['excel']))
{{ Html::link(@$actions['excel']['url'], @$actions['excel']['label'], ['class' => 'btn btn-light-success btn-sm fas fa-file-excel fs-4']) }}
@endif
@endif


@if ($canPDF === true)
@if (!empty($actions['pdf']))
{{ Html::link(@$actions['pdf']['url'], @$actions['pdf']['label'], ['class' => 'btn btn-light-danger btn-sm fas fa-file-pdf fs-4']) }}
@endif
@endif

@if (!empty($actions['copy']))
    {{ Html::link(@$actions['copy']['url'], @$actions['copy']['label'], ['class' => 'btn btn-light-info btn-sm fas fa-copy fs-4']) }}
@endif