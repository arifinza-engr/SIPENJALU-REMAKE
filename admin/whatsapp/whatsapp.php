<?php
$sql_cek = "SELECT * FROM tb_whatsapp";
$query_cek = mysqli_query($koneksi, $sql_cek);
$data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
?>

<div class="container mt-4 mb-4">
  <div class="card">
    <div class="card-header">
      <i class="fas fa-book"></i>
      <b>Data Aduan</b>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>No Telp</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM tb_whatsapp";
            $result = mysqli_query($koneksi, $query);
            $no = 1;
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>{$no}</td>";
              echo "<td>{$row['nama']}</td>";
              echo "<td>{$row['nomor']}</td>";
              echo "<td><a href='#' title='Ubah' class='btn btn-primary btn-sm editLink' data-id='{$row['id']}' data-nama='{$row['nama']}' data-nomor='{$row['nomor']}'><i class='fas fa-pen'></i> EDIT</a></td>";
              echo "</tr>";
              $no++;
            }
            ?>
          </tbody>
        </table>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
          <i class="fas fa-plus"></i> Tambah
        </button>
      </div>
    </div>
  </div>

  <!-- Tambah Modal -->
  <div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center">Tambah Data</h4>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <div class="form-group">
              <label>Nama:</label>
              <input type="text" class="form-control" name="add_nama">
            </div>
            <div class="form-group">
              <label>No Telp:</label>
              <input type="text" class="form-control" name="add_nomor">
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="Tambah">Tambah</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center">Ubah Data</h4>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <input type="hidden" name="id" id="edit_id">
            <div class="form-group">
              <label>Nama :</label>
              <input type="text" class="form-control" name="nama" id="edit_nama">
            </div>
            <div class="form-group">
              <label>No Whatsapp :</label>
              <input type="text" class="form-control" name="nomor" id="edit_nomor">
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="Ubah">Ubah</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_POST['Ubah'])) {
  $sql_ubah = "UPDATE tb_whatsapp SET nama='" . $_POST['nama'] . "', nomor='" . $_POST['nomor'] . "' WHERE id='" . $_POST['id'] . "'";
  $query_ubah = mysqli_query($koneksi, $sql_ubah);

  if ($query_ubah) {
    echo "<script>
              Swal.fire({title: 'Ubah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.value) {
                      window.location = 'index.php?page=whatsapp';
                  }
              })</script>";
  } else {
    echo "<script>
              Swal.fire({title: 'Ubah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.value) {
                      window.location = 'index.php?page=whatsapp';
                  }
              })</script>";
  }
}

if (isset($_POST['Tambah'])) {
  $sql_tambah = "INSERT INTO tb_whatsapp (nama, nomor) VALUES ('" . $_POST['add_nama'] . "', '" . $_POST['add_nomor'] . "')";
  $query_tambah = mysqli_query($koneksi, $sql_tambah);

  if ($query_tambah) {
    echo "<script>
              Swal.fire({title: 'Tambah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.value) {
                      window.location = 'index.php?page=whatsapp';
                  }
              })</script>";
  } else {
    echo "<script>
              Swal.fire({title: 'Tambah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.value) {
                      window.location = 'index.php?page=whatsapp';
                  }
              })</script>";
  }
}
?>


<script>
  $(document).ready(function() {
    $('.editLink').click(function() {
      let id = $(this).data('id');
      let nama = $(this).data('nama');
      let nomor = $(this).data('nomor');

      $('#edit_id').val(id);
      $('#edit_nama').val(nama);
      $('#edit_nomor').val(nomor);

      $('#editModal').modal('show');
    });
  });
</script>