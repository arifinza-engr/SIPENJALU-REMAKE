<?php
ob_start(); // Start output buffering
require('fpdf/fpdf.php');

$koneksi = mysqli_connect("localhost", "root", "", "sipangkat"); // Update with your DB details

if (isset($_POST['Cetak'])) {
	$jenis = $_POST['jenis'];
	$tgl_1 = $_POST['tgl_1'];
	$tgl_2 = $_POST['tgl_2'];

	$sql = "SELECT * FROM tb_pengaduan WHERE jenis='$jenis' AND (waktu_aduan BETWEEN '$tgl_1' AND '$tgl_2')";
	$result = mysqli_query($koneksi, $sql);

	if (!$result) {
		die("Query failed: " . mysqli_error($koneksi));
	}

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 16);
	$pdf->Cell(0, 10, 'Laporan Aduan', 0, 1, 'C');

	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(10, 10, 'No', 1);
	$pdf->Cell(50, 10, 'Pengadu', 1);
	$pdf->Cell(30, 10, 'No Telp', 1);
	$pdf->Cell(30, 10, 'Jenis', 1);
	$pdf->Cell(50, 10, 'Alamat', 1);
	$pdf->Cell(30, 10, 'Status', 1);
	$pdf->Ln();

	$no = 1;
	while ($row = mysqli_fetch_assoc($result)) {
		$pdf->Cell(10, 10, $no++, 1);
		$pdf->Cell(50, 10, $row['nama_pengadu'], 1);
		$pdf->Cell(30, 10, $row['no_telpon'], 1);
		$pdf->Cell(30, 10, $row['jenis'], 1);
		$pdf->Cell(50, 10, $row['alamat'], 1);
		$pdf->Cell(30, 10, $row['status'], 1);
		$pdf->Ln();
	}

	ob_end_clean(); // Discard the buffer contents
	$pdf->Output();
	exit(); // Exit the script to not execute HTML rendering
}
?>

<!-- Your HTML Form -->
<!DOCTYPE html>
<html>

<head>
	<title>Laporan Aduan</title>
</head>

<body>

	<div class="panel panel-info">
		<div class="panel-heading">
			<i class="glyphicon glyphicon-print"></i>
			<b>Kelola Laporan</b>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
					<form method="POST" action="">
						<!-- Rest of your form fields -->

						<div>
							<input type="submit" name="Cetak" value="Cetak" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>

</html>

<?php
ob_end_flush(); // Send the output and turn off output buffering
?>