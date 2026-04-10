<h1 class="h3 fw-bold mb-4" style="color: var(--dark-purple);">Pengembalian Buku</h1>

<div class="table-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-arrow-left-right me-2 text-success"></i>
            Data Pengembalian
        </h5>
        <button class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Pengembalian
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID Pinjam</th>
                    <th>Judul Buku</th>
                    <th>Peminjam</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>#P-00125</td>
                    <td class="fw-bold">Bumi Manusia</td>
                    <td>Andi</td>
                    <td>20 Mar 2026</td>
                    <td>27 Mar 2026</td>
                    <td>27 Mar 2026</td>
                    <td><span class="badge bg-success rounded-pill">Tepat Waktu</span></td>
                    <td>
                        <button class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>#P-00126</td>
                    <td class="fw-bold">Negeri 5 Menara</td>
                    <td>Budi</td>
                    <td>15 Mar 2026</td>
                    <td>22 Mar 2026</td>
                    <td>25 Mar 2026</td>
                    <td><span class="badge bg-danger rounded-pill">Terlambat</span></td>
                    <td>
                        <button class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>#P-00127</td>
                    <td class="fw-bold">Atomic Habits</td>
                    <td>Citra</td>
                    <td>29 Mar 2026</td>
                    <td>05 Apr 2026</td>
                    <td>-</td>
                    <td><span class="badge bg-warning text-dark rounded-pill">Belum Kembali</span></td>
                    <td>
                        <button class="btn btn-sm btn-success">
                            <i class="bi bi-check-circle"></i> Proses
                        </button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>