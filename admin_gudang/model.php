<?php

    Class model{
        private $server = "localhost";
        private $username = "root";
        private $password = "";
        private $db = "barang-kino";
        private $conn;

        public function __construct()
        {
            try {
                $this->conn = new mysqli($this->server,$this->username,$this->password,$this->db);
            }   catch (\Throwable $th) {
                //throw $th;
                echo"Connection error" . $th->getMessage();
            }
            
        }


        public function fetch(){
            $data = [];

            $query = "SELECT * FROM tbl_data";
            if($sql = $this->conn->query($query)){
                while ($row = mysqli_fetch_assoc($sql)){
                    $data [] = $row;
                }
            }

            return $data;
        }

        public function date_range($start_date, $end_date)
    {
        $data = [];

        if (isset($start_date) && isset($end_date)) {
            $query = "SELECT * FROM `tbl_data` WHERE `TANGGAL` > '$start_date' AND `TANGGAL` < '$end_date'";
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        }

        return $data;
        }
    }