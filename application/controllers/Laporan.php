<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct(){
		parent::__construct();		

		if($this->session->userdata('status') == ''){
			redirect(base_url('auth'));
		}
	}

	public function index()
	{	
		// print_r($this->input->get());exit;
		if($this->input->get('tanggal_mulai') != '') {
			$data['tanggal_mulai'] = $this->input->get('tanggal_mulai');
			$data['tanggal_selesai'] = $this->input->get('tanggal_selesai');
			$mulai = new DateTime($this->input->get('tanggal_mulai'));
			$selesai = new DateTime($this->input->get('tanggal_selesai'));
			$diff = date_diff($mulai, $selesai);
			$beda = $diff->format("%a");
			if($beda > 8) {
				?>
				<script>
					alert('Maaf, Maksimal jangka waktu 1 minggu');
					location.href = "<?= site_url('laporan') ?>";
				</script>
				<?php
			}


			$data['jenis'] = $this->input->get('jenis');
			if($this->input->get('jenis') == 1) {
				$data['frame'] = $this->input->get('frame');
			} elseif($this->input->get('jenis') == 1) {
				$data['lensa'] = $this->input->get('lensa');
			} elseif($this->input->get('jenis') == 1) {
				$data['cairan'] = $this->input->get('cairan');
			} else {
				$data['lain'] = $this->input->get('lain');
			}

		}

		if($this->input->get("submit") == 'download') {
			$this->download_pdf();
		}

		$this->template->load("laporan/home");
	}

	function download_excel()
	{
		$this->load->view("laporan/excel");
	}

}