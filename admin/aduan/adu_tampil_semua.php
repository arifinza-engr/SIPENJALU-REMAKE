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
            $query = "SELECT a.id_pengaduan, a.judul, a.no_telpon, a.foto, a.lat, a.lng, a.status, j.jenis, p.nama_pengadu, p.no_hp 
                    FROM tb_pengaduan a 
                    JOIN tb_jenis j ON a.jenis=j.id_jenis 
                    JOIN tb_pengadu p ON a.author=p.id_pengadu";
            $result = $koneksi->query($query);

            while ($row = $result->fetch_assoc()) {
              echo "<tr class='text-center align-middle'>";
              echo "<td>{$no}</td>";
              echo "<td>{$row['judul']}</td>";
              echo "<td>{$row['no_telpon']}</td>";
              echo "<td>{$row['jenis']}</td>";
              $googleMapsLink = "https://www.google.com/maps/?q={$row['lat']},{$row['lng']}";
              echo "<td><a href='{$googleMapsLink}' target='_blank' class='btn btn-primary btn-sm'><i class='fas fa-map-marker-alt' style='margin-right: 4px;'></i>Lihat</a></td>";
              $imgSrc = "foto/{$row['foto']}";
              echo "<td><img src='{$imgSrc}' width='100px' data-bs-toggle='modal' data-bs-target='#imageModal' onclick='showImage(this.src)' role='button' tabIndex='0' /></td>";

              $status = $row['status'];
              $labelClass = $status === 'Proses' ? 'warning' : ($status === 'Tanggapi' ? 'success' : 'primary');

              $labelText = $status; // default value
              if ($status === 'Proses') {
                $labelText = 'Menunggu';
              } elseif ($status === 'Tanggapi') {
                $labelText = 'Dalam Proses';
              } else {
                $labelText = 'Selesai';
              }

              echo "<td><span class='label label-{$labelClass}'>{$labelText}</span></td>";


              $manageLink = "?page=aduan_kelola&kode={$row['id_pengaduan']}";
              echo "<td><a href='{$manageLink}' title='Tanggapi' class='btn btn-primary btn-sm'><i class='fas fa-pen'></i></a></td>";
              echo "</tr>";
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- modal -->
<div id="imageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Foto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="" id="imagePreview" width="100%" alt="Preview">
      </div>
    </div>
  </div>
</div>


<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
  function showImage(src) {
    document.getElementById('imagePreview').src = src;
  }
</script>