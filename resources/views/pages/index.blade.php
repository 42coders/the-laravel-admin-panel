@extends('tlap::layouts.admin')

@section('content-header')
    <div class="row">
        <div class="col-md-3">
            <h1>{{ $TLAPModel::getModelName() }}</h1>
        </div>
        <div class="col-md-9 d-flex justify-content-end ">
            <a class="" href="/{{ config('tlap.path') }}/{{ $TLAPModel::getModelPluralName() }}/create" title="create"><i class="bi bi-plus"></i></a>
        </div>
    </div>
@endsection

@section('content')
    <table id="datatest" class="table display responsive nowrap" width="100%">
    </table>
@endsection

@section('scripts')
    <script>
        $( document ).ready(function() {
            $('#datatest').DataTable({
                "scrollX": true,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('tlap.datatable', ['models' => $TLAPModel::getModelPluralName()]) }}",
                'columnDefs': [
                    {{--{
                        'targets': 0,
                        'render': function(data, type, row, meta){
                            if(type === 'display'){
                                data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                            }

                            return data;
                        },
                        'checkboxes': {
                            'selectRow': true,
                            'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                        }
                    },--}}
                    {
                        "targets": -1,
                        "data": null,
                        "defaultContent": "<button>Click!</button>"
                    }
                ],
                "columns": [
                    @foreach($TLAPModel::getDatatableFields() as $fieldName)
                        { "data": "{{ $fieldName }}", "title": "{{ $fieldName }}" },
                    @endforeach
                    {"data": "",
                        render : function(data, type, row) {
                            console.log(row);
                            return '' +
                                '<a href="/admin/{{ $TLAPModel::getModelPluralName() }}/'+row.id+'/show" class="show"><i class="bi bi-eye"></i></a> ' +
                                '<a href="/admin/{{ $TLAPModel::getModelPluralName() }}/'+row.id+'/edit" class="show"><i class="bi bi-pencil-square"></i></a> ' +
                                '<a href="/admin/{{ $TLAPModel::getModelPluralName() }}/'+row.id+'/delete" class="show"><i class="bi bi-trash"></i></a>' +
                                ''

                        }    },
                ],
                'order': [[1, 'asc']]
            });
        });

    </script>
@endsection
