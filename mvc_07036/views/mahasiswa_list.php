<a href="index.php?page=create">Tambah Data</a>
<table border="1">
    <tr>
        <th>ID</th><th>NIM</th><th>Nama</th><th>Alamat</th><th>No HP</th><th>Aksi</th>
    </tr>
    <?php foreach($data as $mhs): ?>
    <tr>
        <td><?= $mhs['id']; ?></td>
        <td><?= $mhs['nim']; ?></td>
        <td><?= $mhs['nama']; ?></td>
        <td><?= $mhs['alamat']; ?></td>
        <td><?= $mhs['no_hp']; ?></td>
        <td>
            <a href="index.php?page=edit&id=<?= $mhs['id']; ?>">Edit</a> |
            <a href="index.php?page=delete&id=<?= $mhs['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
