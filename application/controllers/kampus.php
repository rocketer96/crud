<?php
class kampus extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('m_data');
        $this->load->helper('url');
    }

    function index (){
        $data['mahasiswa'] = $this->m_data->tampil_data()->result();
        $this->load->view('tampil_data', $data);
    }

    function tambah(){
        $this->load->view('input_data');
    }

    function tambah_aksi(){
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $pekerjaan = $this->input->post('pekerjaan');

        $data = array(
            'nim' => $nim,
            'nama' => $nama,
            'alamat' => $alamat,
            'pekerjaan' => $pekerjaan
        );

        $this->m_data->input_data($data, 'mahasiswa');
        redirect('kampus/index');
    }

    function edit($id){
        $where = array('id' => $id);
        $data['mahasiswa'] = $this->m_data->edit_data($where, 'mahasiswa')->result();
        $this->load->view('edit_data', $data);
    }

    function update(){
        $id = $this->input->post('id');
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $pekerjaan = $this->input->post('pekerjaan');

        $data = array(
            'nim' => $nim,
            'nama' => $nama,
            'alamat' => $alamat,
            'pekerjaan' => $pekerjaan
        );

        $where = array(
            'id' => $id
        );

        $this->m_data->update_data($where, $data, 'mahasiswa');
        redirect('kampus');
    }
	
	
	function hapus($id){
		$where = array('id' => $id);
		$this->m_data->hapus_data($where,'mahasiswa');
		redirect('kampus');
	}

    function __construct() {
        parent::__construct();
        $this->load->model('m_data');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    function tambah_aksi(){
        $this->form_validation->set_rules('nim','NIM','required|min_length[8] |max_length[8]');
        $this->form_validation->set_rules('nama','Nama','required|alpha|min_lenght[5]|max_length[15]');
        $this->form_validation->set_rules('alamat','Alamat','required|alpha');
        $this->form_validation->set_rules('pekerjaan','Pekerjaan','required|alpha');

        if($this->form_validation->run() == TRUE)
        {
            $nim = $this->input->post('nim');
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $pekerjaan = $this->input->post('pekerjaan');

            $config['max-size']=2048;
            $config['allowed_types']="png|jpg|gif";
            $config['remove_spaces']=TRUE;
            $config['overwrite']=TRUE;
            $config['upload_path']=FCPATH. 'images';

            $this->load->library('upload');
            $this->upload->initialize
        }
    }
}