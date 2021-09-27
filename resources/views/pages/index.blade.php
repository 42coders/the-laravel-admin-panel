@extends('tlap::layouts.admin')

@section('content-header')
    <div class="row">
        <div class="col-md-3">
            <h1>{{ $TLAPModel::getModelName() }}</h1>
        </div>
        <div class="col-md-9 d-flex justify-content-end ">
            <a class="" href="/{{ config('tlap.path') }}/{{ $TLAPModel::getModelPluralName() }}/create"
               title="create"><i class="bi bi-plus"></i></a>
        </div>
    </div>
@endsection

@section('content')
    <div class="container" style="margin:15px auto">
        <div class="d-none" id="showselected">
            <p><b>Selected rows data</b></p>
            <pre id="view-rows"></pre>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-3">
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Actions</button>
            <div id="myDropdown" class="dropdown-content">
                <a href="javascript:void(0)" id="consolelogids">Display all selected ids</a>
            </div>
        </div>
    </div>
    <table id="datatest" class="table display responsive nowrap" width="100%">
    </table>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@endsection
@section('scripts')
    <script>
        let mytable;
        let rows_selected = [];
        $(document).ready(function () {
            mytable = $('#datatest').DataTable({
                stateSave: true,
                "scrollX": true,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('tlap.datatable', ['models' => $TLAPModel::getModelPluralName()]) }}",
                'select': {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                "columns": [   //try columnDefs
                    {
                        "defaultContent": "",
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0,
                    },

                        @foreach($TLAPModel::getDatatableFields() as $fieldName)
                    {
                        "data": "{{ $fieldName }}", "title": "{{ $fieldName }}"
                    },
                        @endforeach
                    {
                        "data": "",
                        render: function (data, type, row) {
                            return '' +
                                '<a href="/admin/{{ $TLAPModel::getModelPluralName() }}/' + row.id + '/show" class="show"><i class="bi bi-eye"></i></a> ' +
                                '<a href="/admin/{{ $TLAPModel::getModelPluralName() }}/' + row.id + '/edit" class="show"><i class="bi bi-pencil-square"></i></a> ' +
                                '<a href="/admin/{{ $TLAPModel::getModelPluralName() }}/' + row.id + '/delete" class="show"><i class="bi bi-trash"></i></a>' +
                                ''

                        }
                    },
                ],
                'order': [[1, 'asc']]

            });
            mytable.on('select', function (e, dt, type, indexes) {
                if (type === 'row') {
                    var data = mytable.rows(indexes).data().pluck('id');
                    for (let i = 0; i < data.length; i++) {
                        if(!rows_selected.includes(data[i]))
                        {
                            rows_selected.push(data[i]);
                        }
                    }
                }
            });

            mytable.on('draw', function (e, dt, type, indexes) {
                var data = mytable.rows(indexes).data().pluck('id');
                for (let i = 0; i < data.length; i++) {
                    if (rows_selected.includes(data[i])) {
                        $('#datatest tbody').find('tr').eq(i).addClass("selected");
                    }
                }
            });

            mytable.on('deselect', function (e, dt, type, indexes) {
                if (type === 'row') {
                    var data = mytable.rows(indexes).data().pluck('id');
                    var index = rows_selected.indexOf(data[0]);
                    rows_selected.splice(index,1);

                }
            });

            $("#consolelogids").on('click', function (e) {
                if (rows_selected.length) {
                    $("#showselected").removeClass("d-none");
                    $("#view-rows").text(rows_selected.map(function (elem) {
                        return elem;
                    }).join(","));
                }
                e.preventDefault();
            })
        });

        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
@endsection
