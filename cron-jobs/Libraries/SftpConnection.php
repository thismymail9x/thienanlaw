<?php
class SftpConnection
{
	private $conn;
    private $sftp;

    public function openConnectionSFTP($remoteHost, $port=22, $data)
    {
        $this->conn = @ssh2_connect($remoteHost, $port);
        if (! $this->conn){
			$data["error_content"] = "Không thể kết nối với SFTP qua: $remoteHost trên cổng: $port.";
			return $data;
		}
		return $data;
    }

	public function openConnectionSSH($remoteHost, $port=22, $data)
    {
		echo "\nRetry to connect...";
        $this->conn = @ssh2_connect($remoteHost, $port, array('hostkey'=>'ssh-rsa'));
        if (! $this->conn){
			$data["error_content"] = "Không thể kết nối với SFTP qua: $remoteHost trên cổng: $port.";
			return $data;
		}
		echo "\nDone";
		return $data;
    }
	
	/*Authen by using public key*/
	public function authByPublicKey($sshUser, $sshPassword, 
								   $uploadfile_pub, $uploadfile_crt, 
								   $data){
		
		//auth public key
		if (! ssh2_auth_pubkey_file($this->conn, $sshUser,
                          $uploadfile_pub,
                          $uploadfile_crt, $sshPassword)) {
		  	$data["error_content"] = "Xác thực tải khoản và public key không phù hợp";
			return $data;
		}
		//auth user/password
		if(!ssh2_auth_password($this->conn, $sshUser, $sshPassword)){
			$data["error_content"] = "Xác thực tài khoản và mật khẩu không phù hợp";
			return $data;
		}
	}
	/*Ignore with SSH*/
    public function loginViaSFTP($username, $password, 
						  $data)
    {
        if (! @ssh2_auth_password($this->conn, $username, $password)){
			$data["error_content"] = "Không thể xác thực $username " .
                                "và mật khẩu $password qua SFTP";
			return $data;
		}
        $this->sftp = @ssh2_sftp($this->conn);
        if (! $this->sftp){
			$data["error_content"] = "Không thể khởi tạo kết nối với SFTP";
			return $data;
		}
		return $data;
    }
	
	//send from remotehost
    public function uploadFile($local_file, $remote_file, 
							   $data)
    {
        $sftp = $this->sftp;
        $stream = @fopen("ssh2.sftp://$sftp$remote_file", 'w');

        if (! $stream){
			$data["error_content"] = "Không thể mở tệp tin trên SFTP: $remote_file";
		}
		
        $data_to_send = @file_get_contents($local_file);
        if ($data_to_send === false){
			$data["error_content"] = "Không thể mở tệp tin trên Local: $local_file";
		}
		
        if (@fwrite($stream, $data_to_send) === false)if ($data_to_send === false){
			$data["error_content"] = "Không thể gửi dữ liệu lên SFTP tệp tin: $local_file";
		}
		
        @fclose($stream);
		return $data;
    }
	
	//receive from remotehost
	public function receiveFile($remote_file, $local_file, 
								$data)
    {
		
        $sftp = $this->sftp;
        $stream = @fopen("ssh2.sftp://$sftp$remote_file", 'r');
        if (! $stream){
			$data["error_content"] = "Không thể mở tệp tin trên SFTP: $remote_file";
		}
		
        $contents = fread($stream, filesize("ssh2.sftp://$sftp$remote_file"));
		
        file_put_contents ($local_file, $contents);
        @fclose($stream);
		
		return $data;
    }
	
	public function deleteFileOnRemote($remote_file){
      $sftp = $this->sftp;
      unlink("ssh2.sftp://$sftp$remote_file");
    }
	
	public function closeConnection(){
		$sftp = $this->sftp;
		ssh2_disconnect($sftp);
	}
	
	public function checkExistPath($path, $data){
		$sftp = $this->sftp;
		$fileExists = file_exists('ssh2.sftp://' . $sftp . $path);
		if($fileExists == false){
			$data["error_content"] = "Lỗi: kiểm tra thư mục $path";
			return $data;
		}
		return $data;
	}
	
	public function createFolderOnRemote($newFolder, $data){		
		$sftp = $this->sftp;
		if (! ssh2_sftp_mkdir($sftp, $newFolder)){
			$data["error_content"] = "Không thể tạo/ hoặc đã tồn tại thư mục $newFolder trên máy chủ SFTP";
			return $data;
		}
		return $data;
	}
}