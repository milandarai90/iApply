<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark" style="position: sticky"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="/" class="brand-link "> <!--begin::Brand Image--> <img src="..." alt="..." class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-bold">iApply</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    
    @if(auth()->user()->role == 1)
    <div class="sidebar-wrapper">
        <nav class="mt-2">
       
            <ul class="nav sidebar-menu flex-column " data-lte-toggle="treeview" data-accordion="false">
                <li class="nav-item">       
                        <a href="#" class="nav-link" id="dashboard">
                            <i class="nav-icon bi bi-speedometer text-warning"></i>
                            <p class="fw-bold">Dashboard</p>
                        </a>
                    </a>
                </li>
                <li class="nav-item" id="country"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-globe2 text-warning"></i>
                    <p class="fw-bold">
                   Users
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="addCountry">
                    <li class="nav-item"> <a href="{{route('superadmin.users')}}" class="nav-link"> <i class="nav-icon bi bi-plus-square"></i>
                            <p>View Users</p>
                        </a> </li>
                </ul>
                <ul class="nav nav-treeview" id="viewCountry">
                    <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-eye-fill"></i>
                            <p>###</p>
                        </a> </li>
                </ul>
                </li>
    
            </ul>
        </nav>
    </div>
    @endif


    @if(auth()->user()->role == 2)
    <div class="sidebar-wrapper">
        <nav class="mt-2">
       
            <ul class="nav sidebar-menu flex-column " data-lte-toggle="treeview" data-accordion="false">
                <li class="nav-item">       
                        <a href="#" class="nav-link" id="dashboard">
                            <i class="nav-icon bi bi-speedometer text-warning"></i>
                            <p class="fw-bold">Dashboard</p>
                        </a>
                    </a>
                </li>
                <li class="nav-item" id="country"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-globe2 text-warning"></i>
                    <p class="fw-bold">
                   Country
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="addCountry">
                    <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-plus-square"></i>
                            <p>Add Country</p>
                        </a> </li>
                </ul>
                <ul class="nav nav-treeview" id="viewCountry">
                    <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-eye-fill"></i>
                            <p>View Country</p>
                        </a> </li>
                </ul>
                </li>
    
            </ul>
        </nav>
    </div>
    @endif

    @if(auth()->user()->role == 3)
    <div class="sidebar-wrapper">
        <nav class="mt-2">
       
            <ul class="nav sidebar-menu flex-column " data-lte-toggle="treeview" data-accordion="false">
                <li class="nav-item">       
                        <a href="#" class="nav-link" id="dashboard">
                            <i class="nav-icon bi bi-speedometer text-warning"></i>
                            <p class="fw-bold">Dashboard</p>
                        </a>
                    </a>
                </li>
                <li class="nav-item" id="country"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-globe2 text-warning"></i>
                    <p class="fw-bold">
                  ##
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="addCountry">
                    <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-plus-square"></i>
                            <p>##</p>
                        </a> </li>
                </ul>
                <ul class="nav nav-treeview" id="viewCountry">
                    <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-eye-fill"></i>
                            <p>##</p>
                </ul>
                </li>
    
            </ul>
        </nav>
    </div>
    @endif

    </aside>     