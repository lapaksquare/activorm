<?php 

class Address_model extends CI_Model{
	
	function getAddressProvince(){
		$sql = "
		SELECT 
		ap.province_id,
		ap.province_name,
		ap.province_country_id
		FROM
		address__province ap
		WHERE 1
		AND ap.province_country_id = 'id'
		ORDER BY ap.province_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
	function getAddressKabupaten(){
		$sql = "
		SELECT
		ak.city_id,
		ak.city_province_id,
		ak.city_name
		FROM
		address__kabupaten ak
		WHERE 1
		ORDER BY ak.city_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
	function getAddressKecamatan(){
		$sql = "
		SELECT
		ak.kecamatan_id,
		ak.kecamatan_name,
		ak.kecamatan_kabupaten_id
		FROM
		address__kecamatan ak
		WHERE 1
		ORDER BY ak.kecamatan_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
	function getAddressKelurahan(){
		$sql = "
		SELECT
		ak.kelurahan_id,
		ak.kelurahan_name,
		ak.kelurahan_kecamatan_id
		FROM
		address__kelurahan ak
		WHERE 1
		ORDER BY ak.kelurahan_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
	function getKabupatenByProvinceId($province_id){
		if ($province_id == 0) return array();
		$sql = "
		SELECT 
		ak.city_id,
		ak.city_province_id,
		ak.city_name
		FROM
		address__kabupaten ak
		WHERE 1
		AND ak.city_province_id = ?
		ORDER BY ak.city_name ASC
		";
		return $this->db->query($sql, array($province_id))->result();
	}
	
	function getKecamatanByKabupatenId($kabupaten_id){
		if ($kabupaten_id == 0) return array();
		$sql = "
		SELECT 
		ak.kecamatan_id,
		ak.kecamatan_name,
		ak.kecamatan_kabupaten_id
		FROM
		address__kecamatan ak
		WHERE 1
		AND ak.kecamatan_kabupaten_id = ?
		ORDER BY ak.kecamatan_name ASC
		";
		return $this->db->query($sql, array($kabupaten_id))->result();
	}
	
	function getKelurahanByKecamatanId($kecamatan_id){
		if ($kecamatan_id == 0) return array();
		$sql = "
		SELECT 
		ak.kelurahan_id,
		ak.kelurahan_name,
		ak.kelurahan_kecamatan_id
		FROM
		address__kelurahan ak
		WHERE 1
		AND ak.kelurahan_kecamatan_id = ?
		ORDER BY ak.kelurahan_name ASC
		";
		return $this->db->query($sql, array($kecamatan_id))->result();
	}
	
}

?>