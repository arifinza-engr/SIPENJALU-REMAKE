<div class="container mt-4 mb-4">
  <div class="card">
    <div class="card-header bg-infooo text-white">
      <i class="fa fa-book"></i> <!-- Harap tambahkan pustaka FontAwesome atau ikon Bootstrap lainnya -->
      <b>Data Aduan</b>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
            <tr>
              <th>No</th>
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
            function get_address_from_latlng($lat, $lng, $api_key)
            {
              $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&key=$api_key";
              $json_data = file_get_contents($url);
              $result = json_decode($json_data, TRUE);
              return $result['results'][0]['formatted_address'] ?? 'Alamat tidak ditemukan';
            }

            $api_key = "AIzaSyCkyPyVxHBaWGGsJgiQDe0ttKfhE1zzDZ0";

            $author = $data_id;
            $no = 1;
            $sql = $koneksi->query("SELECT a.id_pengaduan, a.judul, a.lat, a.lng, a.foto, a.status, j.jenis FROM tb_pengaduan a JOIN tb_jenis j ON a.jenis=j.id_jenis WHERE author='$author'");
            while ($data = $sql->fetch_assoc()) :
              $address = get_address_from_latlng($data['lat'], $data['lng'], $api_key);
            ?>
              <tr class='text-center align-middle'>
                <td><?= $no++; ?></td>
                <td><?= $data['judul']; ?></td>
                <td><?= $data['jenis']; ?></td>
                <td><a href="https://www.google.com/maps?q=<?= $data['lat']; ?>,<?= $data['lng']; ?>" target="_blank"><?= $address; ?></a></td>

                <td>
                  <!-- Image thumbnail that triggers the modal -->
                  <img src="foto/<?= $data['foto']; ?>" width="100px" data-bs-toggle="modal" data-bs-target="#imageModal<?= $no ?>" role="button" tabIndex="0" />
                  <!-- The Modal -->
                  <div class="modal fade" id="imageModal<?= $no ?>">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body text-center">
                          <img src="foto/<?= $data['foto']; ?>" style="width: 100%;" alt="Image Preview">
                        </div>
                      </div>
                    </div>
                  </div>

                <td>
                  <?php
                  if ($data['status'] == 'Proses') {
                    echo '<span class="label label-warning">Menunggu</span>';
                  } elseif ($data['status'] == 'Tanggapi') {
                    echo '<span class="label label-success">Dalam Proses</span>';
                  } else {
                    echo '<span class="label label-primary">Selesai</span>';
                  }
                  ?>
                </td>

                <td>
                  <?php
                  if ($data['status'] == 'Proses') :
                  ?>
                    <!-- Ubah ikon -->
                    <a href="?page=aduan_ubah&kode=<?= $data['id_pengaduan']; ?>" title="Ubah" class="btn btn-success btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <!-- Hapus ikon -->
                    <a href="?page=aduan_hapus&kode=<?= $data['id_pengaduan']; ?>" onclick="return confirm('Apakah anda yakin hapus pengadu ini ?')" title="Hapus" class="btn btn-danger btn-sm">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  <?php
                  else :
                    echo '-';
                  endif;
                  ?>
                </td>

              </tr>
            <?php
            endwhile;
            ?>
          </tbody>
        </table>
        <a href="?page=aduan_tambah" class="btn btn-primary mb-3">
          <i class="fas fa-plus"></i> Tambah
        </a>
      </div>
    </div>
  </div>
</div>