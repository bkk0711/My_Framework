<?php
	/**
 	*  Class Kết nối CSDL
 	*/
	class Database
	{
		private $hostname = 'localhost';
		private $username = 'root';
		private $password = 'mysql';
		private $dataname = 'mvc';

		private $conn = NULL;
		private $result = NULL;

	
		// Kết nối CSDL dùng Mysqli
		public function connect()
		{
			$this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dataname);
			if ($this->conn)
			{
				mysqli_set_charset($this->conn, 'utf8mb4');
				//echo 'Success';
			}else{
				echo 'Kết nối thất bại !! ';
				exit();
			}
			return $this->conn;
		} 

		// Hàm ngắt kết nối mysqli
		public function Disconnect()
		{
			if($this->conn)
			{
				$this->conn->close();
				echo 'Ngắt kết nối !!';
			}
		}

		// Thực hiện câu truy vấn
		public function execute($sql){
			$this->result = $this->conn->query($sql);
			return $this->result;
		}
		// Phương thức lấy dữ liệu
		public function getData()
		{
			if($this->result)
			{
				$data = mysqli_fetch_array($this->result);
			}else{
				$data = 0;
			}
			return $data;
		}
		// Lấy toàn bộ dữ liệu
		public function GetAllData()
		{
			if($this->result)
			{
				while ($datas = $this->getData()) {
					$data[] = $datas;

				}
			}else{
				$data = 0;
			}
			return $data;
		}
		// Phương thức nhập dữ liệu vào CSDL
		/*
		/// VD INSERT
		$db->InsertData('user', array(
    		'name' => 'Nguyen Van A',
    		'phone' => '0123.456.789'
		));
		*/
		public function InsertData($table, $tbldata)
		{
			// Lưu trữ danh sách field
    		$field_list = '';
    		// Lưu trữ danh sách giá trị tương ứng với field
   			$value_list = '';

			// Lặp qua data
		    foreach ($tbldata as $key => $value){
		        $field_list .= ",$key";
		        $value_list .= ",'".$this->conn->real_escape_string($value)."'";
		    }
			// Vì sau vòng lặp các biến $field_list và $value_list sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
   			$sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
   			return $this->execute($sql); 
		}
		//Phương thức cập nhật CSDL
		/*
		$db->UpdateData('user', array(
    		'name' => 'Nguyen Van B'
		), 'id = 1');
		*/
		public function UpdateData($table, $tbldata, $where)
		{
			$sql = '';
			foreach ($tbldata as $key => $value)
			{
            	$sql .= "$key = '".$this->conn->real_escape_string($value)."',";
        	}
        	// Vì sau vòng lặp biến $sql sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        	$sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
        	return $this->execute($sql); 
		}
		//phương thức xóa CSDL
		/*
		$db->RemoveData('user', 'id = 1');
		*/
		public function RemoveData($table, $where)
		{
			$sql = "DELETE FROM $table WHERE $where";
			return $this->execute($sql);
		}
		
}
?>
