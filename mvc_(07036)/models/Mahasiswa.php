<?php
require_once 'config.php';

class Mahasiswa {
    public function getAll() {
        global $conn;
        $result = $conn->query("SELECT * FROM mahasiswa");
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function insert($data) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, alamat, no_hp) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['nim'], $data['nama'], $data['alamat'], $data['no_hp']);
        $stmt->execute();
    }

    public function getById($id) {
        global $conn;
        $result = $conn->query("SELECT * FROM mahasiswa WHERE id = $id");
        return $result->fetch_assoc();
    }

    public function update($id, $data) {
        global $conn;
        $stmt = $conn->prepare("UPDATE mahasiswa SET nim=?, nama=?, alamat=?, no_hp=? WHERE id=?");
        $stmt->bind_param("ssssi", $data['nim'], $data['nama'], $data['alamat'], $data['no_hp'], $id);
        $stmt->execute();
    }

    public function delete($id) {
        global $conn;
        $conn->query("DELETE FROM mahasiswa WHERE id = $id");
    }
}
