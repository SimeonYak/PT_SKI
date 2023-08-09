<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
</head>
<body>
    <h1>Customer List</h1>
    <table id="customer-list" border="1">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Pekerjaan</th>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- Daftar pelanggan akan ditampilkan di sini -->
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?php echo $customer->nama; ?></td>
                <td><?php echo $customer->jenis_kelamin; ?></td>
                <td><?php echo $customer->tanggal_lahir; ?></td>
                <td><?php echo $customer->pekerjaan; ?></td>
                <td><?php echo $customer->provinsi; ?></td>
                <td><?php echo $customer->kabupaten; ?></td>
                <td><?php echo $customer->kecamatan; ?></td>
                <td><?php echo $customer->desa; ?></td>
                <td><button class="edit-btn" data-toggle="modal" data-target="#edit-modal" data-id="<?php echo $customer->id; ?>">Edit</button></td>
                <td><button class="delete-btn" data-id="<?php echo $customer->id; ?>">Delete</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Form untuk menambahkan pelanggan -->
    <form id="add-form">
        <h2>Tambah Customer</h2>
        <label>Nama: <input type="text" name="nama" required></label><br>
        <label>Jenis Kelamin:</label>
            <select name="jenis_kelamin" id="jk" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select><br>
        <label>Tanggal Lahir: <input type="date" name="tanggal_lahir" required></label><br>
        <label>Pekerjaan: <input type="text" name="pekerjaan" required></label><br>
        <label>Provinsi:</label>
                <select class="form-control" id="provinsi" name="provinsi">
                <option>Pilih</option>
                </select> <br>
        <label>Kota:</label>
                <select class="form-control" id="kota" name="kota">
                <option>Pilih</option>
                </select> <br>
        <label>Kecamatan:</label>
                <select class="form-control" id="kecamatan" name="kecamatan">
                <option>Pilih</option>
                </select> <br>
        <label>Desa:</label>
                <select class="form-control" id="desa" name="desa">
                </select>
                <br>
        <input type="submit" value="Add">
    </form>

    <!-- Modal untuk mengedit pelanggan -->
    <div id="edit-modal" style="display: none;">
        <form id="edit-form">
            <h2>Edit Customer</h2>
            <input type="hidden" id="edit-customer-id" name="customer_id">
            <label>Nama: <input type="text" id="edit-nama" name="nama" required></label><br>
            <label>Jenis Kelamin:</label>
            <select name="jenis_kelamin" id="edit-jenis_kelamin" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select><br>
            <label>tanggal_lahir: <input type="date" id="edit-tanggal_lahir" name="tanggal_lahir" required></label><br>
            <label>pekerjaan: <input type="text" id="edit-pekerjaan" name="pekerjaan" required></label><br>
            <label>Provinsi:</label>
                <select class="form-control" id="edit-provinsi" name="provinsi" >
                <option>Pilih</option>
                </select> <br>
                <label>Kota:</label>
                <select class="form-control" id="edit-kota" name="kota" >
                <option>Pilih</option>
                </select> <br>
                <label>Kecamatan:</label>
                <select class="form-control" id="edit-kecamatan" name="kecamatan" >
                <option>Pilih</option>
                </select> <br>
                <label>Desa:</label>
                <select class="form-control" id="edit-desa" name="desa" >
                <option>Pilih</option>
                </select>
                <br>
            <input type="submit" value="Update">
        </form>
    </div>

    <div>
        <h3><a href="report.php">Kasus 2</a> </h3>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            // Mengambil daftar pelanggan saat halaman dimuat
            $.ajax({
                url: "<?php echo site_url('customer/index'); ?>",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    // Menampilkan daftar pelanggan
                    var html = '';
                    for (var i = 0; i < data.customers.length; i++) {
                        html += '<tr>';
                        html += '<td>' + data.customers[i].nama + '</td>';
                        html += '<td>' + data.customers[i].jenis_kelamin + '</td>';
                        html += '<td>' + data.customers[i].tanggal_lahir + '</td>';
                        html += '<td>' + data.customers[i].pekerjaan + '</td>';
                        html += '<td>' + data.customers[i].provinsi + '</td>';
                        html += '<td>' + data.customers[i].kota + '</td>';
                        html += '<td>' + data.customers[i].kecamatan + '</td>';
                        html += '<td>' + data.customers[i].desa + '</td>';
                        html += '<td><button class="edit-btn" data-id="' + data.customers[i].id + '">Edit</button></td>';
                        html += '<td><button class="delete-btn" data-id="' + data.customers[i].id + '">Delete</button></td>';
                        html += '</tr>';
                    }
                    $('#customer-list tbody').html(html);
                }
            });

            // Menambahkan pelanggan baru
            $('#add-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo site_url('customer/add_customer'); ?>",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (data) {
                        if (data.status === "success") {
                            alert("berhasil menambahkan data!");
                            location.reload();
                        }
                    }
                });
            });

            // Mengambil data pelanggan saat tombol edit ditekan
            $(document).on('click', '.edit-btn', function () {
                var customer_id = $(this).data('id');
                $.ajax({
                    url: "<?php echo site_url('customer/get_customer'); ?>",
                    method: "POST",
                    data: {customer_id: customer_id},
                    dataType: "json",
                    success: function (data) {
                        $('#edit-nama').val(data.nama);
                        $('#edit-jenis_kelamin').val(data.jenis_kelamin);
                        $('#edit-tanggal_lahir').val(data.tanggal_lahir);
                        $('#edit-pekerjaan').val(data.pekerjaan);
                        $('#edit-provinsi').val(data.provinsi);
                        $('#edit-kota').val(data.kota);
                        $('#edit-kecamatan').val(data.kecamatan);
                        $('#edit-desa').val(data.desa);
                        $('#edit-customer-id').val(customer_id);
                        $('#edit-modal').modal('show');
                    }
                });
            });

            // Mengupdate data pelanggan
            $('#edit-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo site_url('customer/update_customer'); ?>",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (data) {
                        if (data.status === "success") {
                            alert("Berhasil mengupdate data!");
                            location.reload();
                        }
                    }
                });
            });

            // Menghapus pelanggan
            $(document).on('click', '.delete-btn', function () {
                var customer_id = $(this).data('id');
                if (confirm("Are you sure you want to delete this customer?")) {
                    $.ajax({
                        url: "<?php echo site_url('customer/delete_customer'); ?>",
                        method: "POST",
                        data: {customer_id: customer_id},
                        dataType: "json",
                        success: function (data) {
                            if (data.status === "success") {
                                alert("berhasil menghapus data!");
                                location.reload();
                            }
                        }
                    });
                }
            });
        });
        
    </script>
    <script>
    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`)
        .then(response => response.json())
        .then(provinces => {
            var data = provinces;
            var tampung = '<option>Pilih</option>';
            data.forEach(element => {
                tampung += `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`;
            });
            document.getElementById('provinsi').innerHTML = tampung;
    });
    </script>
       <script>
        const selectProvinsi = document.getElementById('provinsi');

        selectProvinsi.addEventListener('change', (e) => {
            var provinsi = e.target.options[e.target.selectedIndex].dataset.reg;
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
                .then(response => response.json())
                .then(regencies => {
                    var data = regencies;
                    var tampung = '<option>Pilih</option>';
                    data.forEach(element => {
                        tampung += `<option data-dist="${element.id}" value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById('kota').innerHTML = tampung;
            });
        });
    </script>
    <script>
        const selectKota = document.getElementById('kota');

        selectKota.addEventListener('change', (e) => {
            var kota = e.target.options[e.target.selectedIndex].dataset.dist;
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kota}.json`)
                .then(response => response.json())
                .then(districts => {
                    var data = districts;
                    var tampung = '<option>Pilih</option>';
                    data.forEach(element => {
                        tampung += `<option data-vill="${element.id}" value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById('kecamatan').innerHTML = tampung;
            });
        });
    </script>
     <script>
        const selectKecamatan = document.getElementById('kecamatan');

        selectKecamatan.addEventListener('change', (e) => {
            var kecamatan = e.target.options[e.target.selectedIndex].dataset.vill;
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
                .then(response => response.json())
                .then(villages => {
                    var data = villages;
                    var tampung = '<option>Pilih</option>';
                    data.forEach(element => {
                        tampung += `<option value="${element.id}" value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById('desa').innerHTML = tampung;
            });
        });
    </script>
</html>
