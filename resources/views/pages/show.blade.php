@extends('tlap::layouts.admin')

@section('content-header')
    <div class="row">
        <div class="col-md-3">
            <h1>{{ $TLAPModel::getModelName() }}</h1>
        </div>
        <div class="col-md-9 d-flex justify-content-end ">
            <a class="" href="/{{ config('tlap.path') }}/{{ $TLAPModel::getModelPluralName() }}/{{ $model->id }}/edit/" title="edit"><i class="bi bi-pencil-square"></i></a>
        </div>
    </div>
@endsection

@section('content')
    <table class="table">
        @foreach($model::getTLAPTableStructure() as $fieldName => $fieldValue)
            <tr>
                <td>{{ $fieldName }}</td>
                <td>{{ $model->$fieldName }}</td>
            </tr>
        @endforeach
    </table>
    <div class="col-md-12">&nbsp;</div>

    <div class="col-md-12">
        @foreach($model::withRelations() as $relation)
            <h3>{{ $relation }}</h3>
            @if(empty($model->$relation) || $model->$relation->count() <= 0)
                <p>No relatated Models found</p>
            @else
                <table id="datatest-{{$relation}}" class="table display responsive nowrap" width="100%">
                </table>
                @php
                    $relatedModel = $model->$relation()->first();
                @endphp


                <script>
                    $( document ).ready(function() {
                        $('#datatest-{{$relation}}').DataTable({
                            "scrollX": true,
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": "{{ route('tlap.datatable', ['models' => $relatedModel::getModelPluralName()]) }}",
                                "data": {
                                    "ids": {{ $model->$relation()->pluck('id') }}
                                },
                            },
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
                                    @foreach($relatedModel::getDatatableFields() as $fieldName)
                                { "data": "{{ $fieldName }}", "title": "{{ $fieldName }}" },
                                    @endforeach
                                {"data": "",
                                    render : function(data, type, row) {
                                        console.log(row);
                                        return '' +
                                            '<a href="/admin/{{ $relatedModel::getModelPluralName() }}/'+row.id+'/show" class="show"><i class="bi bi-eye"></i></a> ' +
                                            '<a href="/admin/{{ $relatedModel::getModelPluralName() }}/'+row.id+'/edit" class="show"><i class="bi bi-pencil-square"></i></a> ' +
                                            '<a href="/admin/{{ $relatedModel::getModelPluralName() }}/'+row.id+'/delete" class="show"><i class="bi bi-trash"></i></a>' +
                                            ''

                                    }    },
                            ],
                            'order': [[1, 'asc']]
                        });
                    });

                </script>

            @endif
        @endforeach
    </div>

    <a class="btn btn-light" href="/{{ config('tlap.path') }}/{{ $model::getModelPluralName() }}/">Zurück</a>
@endsection
