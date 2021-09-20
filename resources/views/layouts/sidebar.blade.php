<div class="col-auto col-md-2 col-xl-2  px-0 bg-white shadow">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-black min-vh-100">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            @foreach(config('tlap.models') as $key => $modelEntry)
            <li class="nav-item">
                <a href="/{{ config('tlap.path') }}/{{ $key }}"
                   class="@if(request()->route()->named($key)) active @endif nav-link align-middle px-0">
                    <i class="fs-4 bi-gear"></i> <span class="ms-1 d-none d-sm-inline">{{ $modelEntry::getModelName() }}</span>
                </a>
            </li>
            @endforeach
            {{--
            <li>
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                    </li>
                </ul>
            </li>
            --}}
        </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                <span class="d-none d-sm-inline mx-1">loser</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>
{{--
<div class="sidebar bg-white shadow">
    <ul class="nav">
        @foreach(config('tlap.models') as $key => $modelEntry)
            <li>
                <a class="@if(request()->route()->named($key)) active @endif" href="/{{ config('tlap.path') }}/{{ $key }}">
                    <span>{{ $key }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
--}}
