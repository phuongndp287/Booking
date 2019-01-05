<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers extends CI_Controller
{
    public $isCheck = false;

    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->helper('language');
        $this->lang->load('supplier', $this->session->userdata('language'));
    }

    function index()
    {
        if (!empty($_POST)) {

            if (isset($_POST['uploadclick'])) {
                if (isset($_FILES['file'])) {
                    $this->docFileExcel($_FILES['file']['tmp_name'], './folder/' . $_FILES['file']['name']);
                }
            } elseif (isset($_POST['userName'])) {
                $userName = $_POST['userName'];
                $FullName = $_POST['FullName'];
                $SupplierType = $_POST['SupplierType'];
                $active = $_POST['active'];
                $sup_profile_id = $_POST['sup_profile_id'];
                $this->addSupplier($userName, $FullName, $SupplierType, $active, $sup_profile_id);

            } elseif ($_POST['supplier_search'] != null) {
                $this->isCheck = true;
                $supplier_cd = $_POST['supplier_search'];
//                $this->list_suppliers($supplier_cd);
                $this->list_suppliers_by_id($supplier_cd);
            } else {
                $this->isCheck = false;
//                $supplier_cd = $_POST['supplier_search'];
                $this->list_suppliers();
            }
        } else {
            $this->isCheck = false;
            $this->list_suppliers();
        }
    }
    //lay thong tin theo ten
    function list_suppliers()
    {

        $this->load->library('pagination');
        $this->load->model('supplier');

        $config['base_url'] = base_url() . 'admin/suppliers/list_suppliers';
        $config['total_rows'] = $this->supplier->total_suppliers();
        $config['per_page'] = 2;
        $config["uri_segment"] = 4;
        //pagination styling
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href"#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['next_link'] = '&raquo;';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

//        if ($this->isCheck) {
//            $data['suppliers'] = $this->supplier->show_suppliers($config['per_page'], $page, $supplier_cd);
//        } else {
            $data['suppliers'] = $this->supplier->show_all_suppliers($config['per_page'], $page);
//        }

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/suppliers/suppliers';
        $data['title'] = 'suppliers';
        $this->load->view('includes/template', $data);
    }


    function list_suppliers_by_id($supplier_cd)
    {
        $this->load->library('pagination');
        $this->load->model('supplier');

        $data['suppliers'] = $this->supplier->show_suppliers($supplier_cd);

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/suppliers/suppliers';
        $data['title'] = 'suppliers';
        $this->load->view('includes/template', $data);
//        redirect('admin/suppliers', 'refresh');
    }

    //them thong tin
    function addSupplier($supplierName, $supplierFullName, $supplierType, $active, $supplierProfileId)
    {
        //TODO chua hien thi len view con da them dc
        $this->load->library('pagination');
        $this->load->model('supplier');

        $data['supplier'] = $this->supplier->insert_infomation(uniqid(), $supplierName, $supplierFullName, (int)$supplierType, $active, $supplierProfileId);
        redirect('admin/suppliers', 'refresh');
    }

    private function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {

        }
    }

    function delete_supplier($id)
    {
        $this->load->model('supplier');
        $this->session->set_flashdata('message', 'Ticket successfully deleted');
        $this->supplier->delete_supplier($id);
        redirect('admin/suppliers', 'refresh');
    }

    private function docFileExcel($file)
    {
        if ($file == null) {
            redirect('admin/suppliers', 'refresh');
            return;
        }
        $this->load->library('pagination');
        $this->load->model('supplier');

        include 'Classes/PHPExcel/IOFactory.php';
        try {
            $inputFileType = PHPExcel_IOFactory::identify($file);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($file);
        } catch (Exception $e) {
            die('Lỗi không thể đọc file "' . pathinfo($file, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $rowData = array();
        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            $check_id = $this->supplier->check_all_id($rowData[$row - 1][0][0]);
            if (!$check_id) {
                $data['supplier'] = $this->supplier->insert_infomation($rowData[$row - 1][0][0], $rowData[$row - 1][0][1], $rowData[$row - 1][0][2], (int)$rowData[$row - 1][0][3], $rowData[$row - 1][0][4], $rowData[$row - 1][0][5]);
            } else {
            }
        }

        redirect('admin/suppliers', 'refresh');
    }
}


