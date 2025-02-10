document.addEventListener("DOMContentLoaded", function () {
    // Referencias a las secciones
    const inicioContent = document.getElementById("inicio-content");
    const commentsSection = document.getElementById("commentsSection");
    const rolesSection = document.getElementById("rolesSection");
    const inventorySection = document.getElementById("inventorySection");
  
    // Función para ocultar todas las secciones
    function hideAllSections() {
      if (inicioContent) inicioContent.style.display = "none";
      if (commentsSection) commentsSection.style.display = "none";
      if (rolesSection) rolesSection.style.display = "none";
      if (inventorySection) inventorySection.style.display = "none";
    }
  
    // Función para mostrar una sección específica
    function showSection(sectionElement) {
      hideAllSections();
      if (sectionElement) sectionElement.style.display = "block";
    }
  
    // Función para cargar los roles desde el servidor
    function cargarRoles() {
      fetch('../controllers/add_user.php?roles=1', { method: 'GET' })
        .then(response => {
          if (!response.ok) {
            throw new Error("Error en la respuesta al cargar roles");
          }
          return response.json();
        })
        .then(data => {
          const rolesContent = document.getElementById("rolesContent");
          let html = '';
          data.forEach(usuario => {
            let rol;
            switch (usuario.rol) {
              case 'admin':
                rol = 'Administrador';
                break;
              case 'tatoo':
                rol = 'Tatuador';
                break;
              default:
                rol = 'Usuario';
            }
            html += `
              <tr>
                <td>${usuario.nombre}</td>
                <td>${rol}</td>
              </tr>
            `;
          });
          if (rolesContent) rolesContent.innerHTML = html;
        })
        .catch(error => {
          console.error('Error al cargar roles:', error);
        });
    }
  
    // Función para cargar los productos (inventario) desde el servidor
    function cargarProductosCampos() {
      fetch('../controllers/AccionProductos.php?fields=1', { method: 'GET' })
        .then(response => {
          if (!response.ok) {
            throw new Error("Error en la respuesta al cargar productos");
          }
          return response.json();
        })
        .then(data => {
          const inventoryContent = document.getElementById("inventoryContent");
          let html = '';
          data.forEach(product => {
            html += `
              <tr>
                <td>${product.nombre}</td>
                <td>${product.cantidad}</td>
                <td>${product.precio}</td>
                <td>${product.categoria}</td>
              </tr>
            `;
          });
          if (inventoryContent) inventoryContent.innerHTML = html;
        })
        .catch(error => {
          console.error('Error al cargar los productos:', error);
        });
    }
  
    // Evento para la tarjeta de comentarios
    const commentsCard = document.getElementById("commentsCard");
    if (commentsCard) {
      commentsCard.addEventListener("click", function () {
        showSection(commentsSection);
        // Ejemplo de comentarios estáticos
        const commentsContent = document.getElementById("commentsContent");
        if (commentsContent) {
          commentsContent.innerHTML = `
            <div class="comment">
              <p><strong>Usuario 1:</strong> Excelente servicio y ambiente.</p>
            </div>
            <div class="comment">
              <p><strong>Usuario 2:</strong> Muy profesionales y amables.</p>
            </div>
            <div class="comment">
              <p><strong>Usuario 3:</strong> Recomiendo este lugar al 100%.</p>
            </div>
          `;
        }
      });
    }
  
    // Botón para volver de la sección de comentarios
    const backButtonComments = document.getElementById("backButtonComments");
    if (backButtonComments) {
      backButtonComments.addEventListener("click", function () {
        showSection(inicioContent);
      });
    }
  
    // Evento para la tarjeta de roles
    const rolesCard = document.getElementById("rolesCard");
    if (rolesCard) {
      rolesCard.addEventListener("click", function () {
        showSection(rolesSection);
        cargarRoles();
      });
    }
  
    // Botón para volver de la sección de roles
    const backButtonRoles = document.getElementById("backButtonRoles");
    if (backButtonRoles) {
      backButtonRoles.addEventListener("click", function () {
        showSection(inicioContent);
      });
    }
  
    // Evento para la tarjeta de inventario
    const inventoryCard = document.getElementById("inventoryCard");
    if (inventoryCard) {
      inventoryCard.addEventListener("click", function () {
        showSection(inventorySection);
        cargarProductosCampos();
      });
    }
  
    // Botón para volver de la sección de inventario
    const backButtonInventory = document.getElementById("backButtonInventory");
    if (backButtonInventory) {
      backButtonInventory.addEventListener("click", function () {
        showSection(inicioContent);
      });
    }
  
    // EVENTO: Al hacer clic en el botón de descargar reporte
    const downloadButton = document.querySelector(".download-button");
    if (downloadButton) {
      downloadButton.addEventListener("click", function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Descargar Reporte',
          text: '¿Deseas descargar el reporte en formato Excel?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Descargar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            generateExcel();
          }
        });
      });
    }
  
    // FUNCIÓN: Generar archivo Excel con ExcelJS
    function generateExcel() {
      // Crear un nuevo libro de Excel y agregar una hoja
      const workbook = new ExcelJS.Workbook();
      const worksheet = workbook.addWorksheet("Inventario");
  
      // Agregar la fila de cabecera y aplicarle estilos
      const header = ["Nombre", "Cantidad", "Precio", "Categoría"];
      const headerRow = worksheet.addRow(header);
      headerRow.eachCell((cell) => {
        cell.font = { bold: true, color: { argb: 'FFFFFFFF' } };
        cell.fill = {
          type: 'pattern',
          pattern: 'solid',
          fgColor: { argb: 'FF242A35' }
        };
        cell.alignment = { vertical: 'middle', horizontal: 'center' };
        cell.border = {
          top: { style: 'thin' },
          left: { style: 'thin' },
          bottom: { style: 'thin' },
          right: { style: 'thin' }
        };
      });
  
      // Obtener los datos de la tabla HTML
      const table = document.querySelector("#inventorySection table");
      if (!table) return;
      const tbodyRows = table.querySelectorAll("tbody tr");
      tbodyRows.forEach(row => {
        const rowData = [];
        row.querySelectorAll("td").forEach(cell => {
          rowData.push(cell.textContent.trim());
        });
        if (rowData.length > 0) {
          const dataRow = worksheet.addRow(rowData);
          dataRow.eachCell((cell) => {
            cell.alignment = { vertical: 'middle', horizontal: 'center' };
            cell.border = {
              top: { style: 'thin' },
              left: { style: 'thin' },
              bottom: { style: 'thin' },
              right: { style: 'thin' }
            };
          });
        }
      });
  
      // Ajustar el ancho de las columnas
      worksheet.columns.forEach(column => {
        let maxLength = 10;
        column.eachCell({ includeEmpty: true }, cell => {
          const columnLength = cell.value ? cell.value.toString().length : 0;
          if (columnLength > maxLength) {
            maxLength = columnLength;
          }
        });
        column.width = maxLength + 2;
      });
  
      // Generar el archivo Excel y disparar la descarga
      workbook.xlsx.writeBuffer().then((buffer) => {
        const blob = new Blob([buffer], {
          type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "Inventario.xlsx";
        link.click();
        URL.revokeObjectURL(link.href);
      }).catch((error) => {
        console.error("Error al generar el archivo Excel", error);
      });
    }
  
    // Mostrar el contenido inicial al cargar la página
    showSection(inicioContent);
  });
  