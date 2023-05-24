{{-- json --}}
@php
    $column['value'] = $column['value'] ?? $entry->{$column['name']};
    $column['escaped'] = $column['escaped'] ?? true;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';
    $column['wrapper']['element'] = $column['wrapper']['element'] ?? 'pre';
    $column['text'] = $column['default'] ?? '-';

    if(is_string($column['value'])) {
        $column['value'] = json_decode($column['value'], true);
    }

    if($column['value'] instanceof \Closure) {
        $column['value'] = $column['value']($entry);
    }

    if(!empty($column['value'])) {
        $column['text'] = $column['prefix'].json_encode($column['value'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES).$column['suffix'];
    }
    $data = json_decode($column['text']);
@endphp

@includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start')
@foreach ($data as $key => $value)
    <span><b style="text-transform: capitalize">{{str_replace('_'," ", $key)}}:</b>{{$value}}</span>
@endforeach
@includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end')
