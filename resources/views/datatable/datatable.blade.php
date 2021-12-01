<script>
    $( document ).ready(function() {
        $('#{{$tableName}}').DataTable({
            "scrollX": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('tlap.datatable', ['models' => $TLAPModel->getModelPluralName()]) }}",
                @if(!empty($model))
                "data": {
                    "ids": {{ $model->$relation()->pluck('id') }}
                }
                @endif
            },
            'columnDefs': [
                {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<button>Click!</button>"
                }
            ],
            "columns": [
                    @foreach($TLAPModel->getDatatableFields() as $fieldName)
                { "data": "{{ $fieldName }}", "title": "{{ $fieldName }}" },
                    @endforeach
                {"data": "",
                    render : function(data, type, row) {
                        console.log(row);
                        return '' +
                            '<a href="/admin/{{ $TLAPModel->getModelPluralName() }}/'+row.id+'/show" class="show"><i class="bi bi-eye"></i></a> ' +
                            '<a href="/admin/{{ $TLAPModel->getModelPluralName() }}/'+row.id+'/edit" class="show"><i class="bi bi-pencil-square"></i></a> ' +
                            '<a href="/admin/{{ $TLAPModel->getModelPluralName() }}/'+row.id+'/delete" class="show"><i class="bi bi-trash"></i></a>' +
                            ''

                    }    },
            ],
            'order': [[0, 'desc']]
        });
    });
</script>
