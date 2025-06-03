<form method="POST" action="index.php?page=update&id=<?= $mhs['id']; ?>">
    <input name="nim" value="<?= $mhs['nim']; ?>"><br>
    <input name="nama" value="<?= $mhs['nama']; ?>"><br>
    <input name="alamat" value="<?= $mhs['alamat']; ?>"><br>
    <input name="no_hp" value="<?= $mhs['no_hp']; ?>"><br>
    <button type="submit">Update</button>
</form>
