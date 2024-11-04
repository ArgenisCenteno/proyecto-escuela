<aside class="app-sidebar bg-dark text-white shadow" data-bs-theme="dark" >
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand" style="border: none"> 
        <!--begin::Brand Link--> 
        <a href="{{ route('home') }}" class="brand-link">
            <!--begin::Brand Image-->  
            <!--end::Brand Image--> 
            <!--begin::Brand Text--> 
            <span class="brand-text fw-light">Escuela</span> 
            <!--end::Brand Text--> 
        </a> 
        <!--end::Brand Link--> 
    </div>
    <!--end::Sidebar Brand--> 
    
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column " role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('pacientes.index') }}" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-user-injured"></i></span>
                        <span class="nav-text text-white">Alumnos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tratamientos.index') }}" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-stethoscope"></i></span>
                        <span class="nav-text text-white">Tratamientos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('citas.index') }}" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-calendar-check"></i></span>
                        <span class="nav-text text-white">Citas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('especialistas.index') }}" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-user-md"></i></span>
                        <span class="nav-text text-white">Especialistas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('representantes.index') }}" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-users"></i></span>
                        <span class="nav-text text-white">Representantes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('notasmedicas.index') }}" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-file-medical"></i></span>
                        <span class="nav-text text-white">Notas Médicas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pacienteTratamientos.index') }}" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-notes-medical"></i></span>
                        <span class="nav-text text-white">Terapias</span>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div> 
    <!--end::Sidebar Wrapper-->
</aside> 
<!--end::Sidebar--> 
<!--begin::App Main-->
