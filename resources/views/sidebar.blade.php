<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark" style="position: sticky"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="/" class="brand-link "> <!--begin::Brand Image--> <img src="..." alt="..." class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-bold">iApply</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    
    @if(auth()->user()->role == 1)
    <div class="sidebar-wrapper">
        <nav class="mt-2">
       
            <ul class="nav sidebar-menu flex-column " data-lte-toggle="treeview" data-accordion="false">
                <li class="nav-item">       
                        <a href="{{route('superadmin.dashboard')}}" class="nav-link" id="dashboard">
                            <i class="nav-icon bi bi-speedometer text-warning"></i>
                            <p class="fw-bold">Dashboard</p>
                        </a>
                    </a>
                </li>
                <li class="nav-item" id="users"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-people text-warning"></i>
                    <p class="fw-bold">
                   View Users
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="viewUsers">
                    <li class="nav-item"> <a href="{{route('superadmin.users')}}" class="nav-link"> <i class="nav-icon bi bi-person-lines-fill"></i>
                            <p>All</p>
                        </a> </li>
                </ul>
                <ul class="nav nav-treeview" id="viewConsultancies">
                    <li class="nav-item"> <a href="{{route('superadmin.viewConsultancies')}}" class="nav-link"> <i class="nav-icon bi bi-building"></i>
                            <p>Consultancies</p>
                        </a> </li>
                </ul>
                <ul class="nav nav-treeview" id="viewBranch">
                    <li class="nav-item"> <a href="{{route('superadmin.viewBranch')}}" class="nav-link"> <i class="nav-icon bi bi-house"></i>
                            <p>Branch</p>
                        </a> </li>
                </ul>
                </li>
                <li class="nav-item" id="add"> <a href="#" class="nav-link"> <i class="nav-icon bi-plus-square text-warning">
                </i>
                    <p class="fw-bold">
                   Add Users
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="addConsultancy">
                    <li class="nav-item"> <a href="{{route('superadmin.addConsultancy')}}" class="nav-link"> <i class="nav-icon bi bi-building-add"></i>
                            <p>Consultancy</p>
                        </a> </li>
                </ul>
                <ul class="nav nav-treeview" id="addBranch">
                    <li class="nav-item"> <a href="{{route('superadmin.addBranch')}}" class="nav-link"> <i class="nav-icon bi bi-house-add"></i>
                            <p>Branch</p>
                        </a> </li>
                </ul>
                </li>
                <li class="nav-item" id=""> <a href="#" class="nav-link"> <i class="nav-icon bi-plus-square text-warning"></i>
                    <p class="fw-bold">
                   ###
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="###">
                    <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-building-add"></i>
                            <p>###</p>
                        </a> </li>
                </ul>
                <ul class="nav nav-treeview" id="###">
                    <li class="nav-item" > <a href="#" class="nav-link" > <i class="nav-icon bi bi-house-add"></i>
                            <p>###<p>
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
                        <a href="{{route('consultancy.dashboard')}}" class="nav-link" id="dashboard">
                            <i class="nav-icon bi bi-speedometer text-warning"></i>
                            <p class="fw-bold">Dashboard</p>
                        </a>
                    </a>
                </li>
                <li class="nav-item" id="consultancyBranch"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-building text-warning"></i>
                    <p class="fw-bold">
                   Branch
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="consultancyAddBranch">
                    <li class="nav-item"> <a href="{{route('consultancy.addBranch')}}" class="nav-link"> <i class="nav-icon bi bi-house-add"></i>
                            <p>Add</p>
                        </a> </li>
                </ul>
                <ul class="nav nav-treeview" id="consultancyViewBranch">
                    <li class="nav-item"> <a href="{{route('consultancy.viewBranch')}}" class="nav-link"> <i class="nav-icon bi bi-house"></i>
                            <p>View</p>
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
                        <a href="{{route('branch.dashboard')}}" class="nav-link" id="dashboard">
                            <i class="nav-icon bi bi-speedometer text-warning"></i>
                            <p class="fw-bold">Dashboard</p>
                        </a>
                    </a>
                </li>
                <li class="nav-item" id="class"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-grid-3x3-gap text-warning"></i>
                    <p class="fw-bold">
                  Classes
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="addClass">
                    <li class="nav-item"> <a href="{{route('branch.addClass')}}" class="nav-link"> <i class="nav-icon bi bi-plus-lg"></i>
                            <p>Add Class</p>
                        </a> </li>
                </ul>
                <ul class="nav nav-treeview" id="viewClasses">
                    <li class="nav-item"> <a href="{{route('branch.viewClass')}}" class="nav-link"> <i class="nav-icon bi bi-eye-fill"></i>
                            <p>All class</p>
                        </a> </li>
                </ul>
                </li>
                <li class="nav-item" id="course"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-journals text-warning"></i>
                    <p class="fw-bold">
                  Courses
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="addCourse">
                    <li class="nav-item"> <a href="{{route('branch.addCourse')}}" class="nav-link"> <i class="nav-icon bi bi-journal-plus"></i>
                            <p>Add Courses</p>
                        </a> </li>
                </ul>
                <ul class="nav nav-treeview" id="viewCourse">
                    <li class="nav-item"> <a href="{{route('branch.viewCourse')}}" class="nav-link"> <i class="nav-icon bi bi-journal-check"></i>
                            <p>View Courses</p>
                        </a> </li>
                </ul>
                </li>

                <li class="nav-item" id="students"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-journals text-warning"></i>
                    <p class="fw-bold">
                  Students
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="addstudents">
                    <li class="nav-item"> <a href="{{route('branch.addStudents')}}" class="nav-link"> <i class="nav-icon bi bi-journal-plus"></i>
                            <p>Add Students</p>
                        </a> </li>
                </ul>
                <ul class="nav nav-treeview" id="viewstudents">
                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon bi bi-journal-check"></i>
                            <p>View Students</p>
                        </a> </li>
                </ul>
                </li>
    
            </ul>
        </nav>
    </div>
    @endif

    </aside>     