$(document).ready(function() {
    $('#tableColaboradores').DataTable({
      dom: 'lBfrtip',
      buttons: [{
          extend: 'excel',
          footer: true,
          title: 'Lista Colaboradores',
          filename: 'Lista Colaboradores',
          text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
        },
        {
          extend: 'pdf',
          footer: true,
          title: ' Lista Colaboradores',
          filename: 'Lista Colaboradores',
          text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
        }
      ],
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
  });

  $(document).ready(function() {
    $('#tableInventario').DataTable({
      dom: 'lBfrtip',
      buttons: [{
          extend: 'excel',
          footer: true,
          title: 'Invetario',
          filename: 'Inventario',
          text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
        },
        {
          extend: 'pdf',
          footer: true,
          title: 'Inventario',
          filename: 'Inventario',
          text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
        }
      ],
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
  });


  $(document).ready(function() {
    $('#tableStock').DataTable({
      dom: 'lBfrtip',
      buttons: [{
          extend: 'excel',
          footer: true,
          title: 'Stock',
          filename: 'Stock',
          text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
        },
        {
          extend: 'pdf',
          footer: true,
          title: ' Stock',
          filename: 'Stock',
          text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
        }
      ],
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
  });

  $(document).ready(function() {
    $('#tableMarcas').DataTable({
      dom: 'lBfrtip',
      buttons: [{
          extend: 'excel',
          footer: true,
          title: 'Marcas',
          filename: 'Marcas',
          text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
        },
        {
          extend: 'pdf',
          footer: true,
          title: ' Marcas',
          filename: 'Marcas',
          text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
        }
      ],
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
  });

  $(document).ready(function() {
    $('#tableModelos').DataTable({
      dom: 'lBfrtip',
      buttons: [{
          extend: 'excel',
          footer: true,
          title: 'Modelos',
          filename: 'Modelos',
          text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
        },
        {
          extend: 'pdf',
          footer: true,
          title: ' Modelos',
          filename: 'Modelos',
          text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
        }
      ],
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
  });
  $(document).ready(function() {
    $('#tableSedes').DataTable({
      dom: 'lBfrtip',
      buttons: [{
          extend: 'excel',
          footer: true,
          title: 'Sede',
          filename: 'Sede',
          text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
        },
        {
          extend: 'pdf',
          footer: true,
          title: ' Sede',
          filename: 'Sede',
          text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
        }
      ],
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
  });
  $(document).ready(function() {
    $('#tableEquipos').DataTable({
      dom: 'lBfrtip',
      buttons: [{
          extend: 'excel',
          footer: true,
          title: 'Equipo',
          filename: 'Equipo',
          text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
        },
        {
          extend: 'pdf',
          footer: true,
          title: ' Equipo',
          filename: 'Equipo',
          text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
        }
      ],
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
  });