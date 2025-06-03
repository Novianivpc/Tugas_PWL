<?php
require_once 'models/Mahasiswa.php';

class MahasiswaController {
    public function index() {
        $model = new Mahasiswa();
        $data = $model->getAll();
        require 'views/mahasiswa_list.php';
    }

    public function create() {
        require 'views/mahasiswa_add.php';
    }

    public function store() {
        $model = new Mahasiswa();
        $model->insert($_POST);
        header("Location: index.php");
    }

    public function edit($id) {
        $model = new Mahasiswa();
        $mhs = $model->getById($id);
        require 'views/mahasiswa_edit.php';
    }

    public function update($id) {
        $model = new Mahasiswa();
        $model->update($id, $_POST);
        header("Location: index.php");
    }

    public function delete($id) {
        $model = new Mahasiswa();
        $model->delete($id);
        header("Location: index.php");
    }
}
