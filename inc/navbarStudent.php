<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="index.php?vista=home" class="logo d-flex align-items-center">
      <img src="./assets/img/logo.png" alt="">

      <span class="d-none d-lg-block">QuickCheck</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="./assets/img/foto.webp" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h3><?php echo $_SESSION['nombre']; ?></h3>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item d-flex align-items-center" href="index.php?vista=user_update&user_id_up=<?php echo $_SESSION['id']; ?>"><i class="bi bi-person"></i> <span>Mi Perfil</span></a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item d-flex align-items-center" href="index.php?vista=xdss"><i class="bi bi-gear"></i> <span>Configuración</span></a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item d-flex align-items-center" href="index.php?vista=xd"><i class="bi bi-question-circle"></i> <span>¿Necesitas Ayuda?</span></a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item d-flex align-items-center" href="index.php?vista=logout"><i class="bi bi-box-arrow-right"></i> <span>Cerar sesión</span></a></li>
        </ul>
      </li>
    </ul>
  </nav>
</header>

<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php?vista=home">
        <i class="bi bi-grid"></i> <span>Dashboard</span>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-people-fill"></i><span>Usuario -> Clase</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li><a href="index.php?vista=user_class_list"><i class="bi bi-circle"></i><span>Lista de Usuarios</span></a></li>
        <li><a href="index.php?vista=user_class_category"><i class="bi bi-circle"></i><span>Listado por Categoria</span></a></li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-earmark-text"></i><span>Clases</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="charts-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li><a href="index.php?vista=class_list"><i class="bi bi-circle"></i><span>Lista de Clases</span></a></li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-calendar"></i><span>Asistencia</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="icons-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li><a href="index.php?vista=attendance_list"><i class="bi bi-circle"></i><span>Lista de Asistencias</span></a></li>
        <li><a href="index.php?vista=attendance_class_category"><i class="bi bi-circle"></i><span>Listado por Categoria</span></a></li>
      </ul>
    </li>
  </ul>

  <div class="card">

    <div class="card-body pb-0">
      <h5 class="card-title">Mr Quick <span>| Todo Un Loquillo</span></h5>

      <div id="budgetChart" style="min-height: auto;" class="echart"></div>
      <img src="./assets/img/pato.gif" alt="" style="width: 200px;">

    </div>
  </div>


</aside>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const logoutLink = document.getElementById('logout-link');

    if (logoutLink) {
      logoutLink.addEventListener('click', function(event) {
        event.preventDefault();

        Swal.fire({
          title: '¿Estás seguro que deseas salir?',
          text: '¡Hasta luego!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, Salir',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = logoutLink.getAttribute('href');
          }
        });
      });
    }
  });
</script>