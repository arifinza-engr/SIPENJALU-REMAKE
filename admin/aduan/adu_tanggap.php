<!-- refactored -->
<div class="container mt-4">
  <div class="card">
    <div class="card-header bg-infooo">
      <i class="fas fa-book"></i> <!-- FontAwesome 5 update -->
      Data Aduan
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered" id="dataTables-example">
          <thead>
            <tr>
              <th>No</th>
              <th>Pengadu</th>
              <th>No Telp</th>
              <th>Nama</th>
              <th>Jenis</th>
              <th>Alamat</th>
              <th>Foto</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $stmt = $koneksi->prepare("SELECT a.id_pengaduan, a.judul, a.no_telpon, a.foto, a.lat, a.lng, a.status, j.jenis, p.nama_pengadu, p.no_hp
                        FROM tb_pengaduan a
                        JOIN tb_jenis j ON a.jenis=j.id_jenis
                        JOIN tb_pengadu p ON a.author=p.id_pengadu
                        WHERE status=?");
            $status = 'Tanggapi';
            $stmt->bind_param('s', $status);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($data = $result->fetch_assoc()) {
              displayRow($data, $no++);
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Detail Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="" id="imagePreview" width="100%" alt="Preview">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
function displayRow($data, $no)
{
  $status_label = getStatusLabel($data['status']);

  // Prepare Google Maps link based on latitude and longitude
  $mapLink = "https://www.google.com/maps/?q={$data['lat']},{$data['lng']}";

  echo "<tr class='text-center align-middle'>
        <td>$no</td>
        <td>{$data['judul']}</td>
        <td>{$data['no_telpon']}</td>
        <td>{$data['judul']}</td>
        <td>{$data['jenis']}</td>
        <td><a href='{$mapLink}' target='_blank' class='btn btn-primary btn-sm'><i class='fas fa-map-marker-alt'></i> Lihat</a></td>;
        <td><img src='foto/{$data['foto']}' width='100px' onclick='showImageInModal(this.src)' role='button' tabindex='0'></td>
        <td><span class='label $status_label[0]'>$status_label[1]</span></td>
        <td><a href='?page=aduan_kelola&kode={$data['id_pengaduan']}' title='Tanggapi' class='btn btn-primary btn-sm'><i class='fas fa-pen'></i></a></td>
    </tr>";
}

function getStatusLabel($status)
{
  switch ($status) {
    case 'Proses':
      return ['label-warning', 'menunggu'];
    case 'Tanggapi':
      return ['label-success', 'Ditanggapi'];
    default:
      return ['label-primary', 'Selesai'];
  }
}
?>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
  function showImageInModal(src) {
    document.getElementById('imagePreview').src = src;
    $('#imageModal').modal('show');
  }
</script>