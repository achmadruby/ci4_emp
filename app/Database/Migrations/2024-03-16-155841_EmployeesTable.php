<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmployeesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_dept' => [
                'type' => 'INT',
            ],
            'id_status' => [
                'type' => 'INT',
            ],
            'id_pendidikan' => [
                'type' => 'INT',
            ],
            'id_card' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'no_absen' => [
                'type' => 'INT',
            ],
            'nik' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tempat_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM',
                'constraint' => ['PRIA', 'WANITA'],
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'no_kk' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'agama' => [
                'type' => 'ENUM',
                'constraint' => ['ISLAM', 'KATOLIK', 'PROTESTAN', 'HINDU', 'BUDDHA', 'KONGHUCU'],
            ],
            'join_date' => [
                'type' => 'DATE',
            ],
            'active' => [
                'type' => 'ENUM',
                'constraint' => ['YES', 'NO'],
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('employees');
        $this->forge->addForeignKey('id_dept', 'departement', 'id');
        $this->forge->addForeignKey('id_status', 'status', 'id');
        $this->forge->addForeignKey('id_pendidikan', 'pendidikan', 'id');
    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}
