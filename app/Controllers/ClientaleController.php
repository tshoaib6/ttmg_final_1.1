<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\Auth as Auth_Model;
use App\Models\Clientele;
use App\Libraries\Csvimport;
use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;



class ClientaleController extends BaseController
{
    protected $clientele_model;
    protected $activity_model;

    public function __construct()
    {
        $this->clientele_model = new Clientele;
    }

    public function index()
    {
        $session = session();
        $data = [];
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Clientele']),
            'page_title' => view('partials/page-title', ['title' => 'Clientele', 'pagetitle' => 'Home'])
        ];


        return view('Cliental/index', $data);
    }



    public function ajaxClientDatatable()
    {
        $db = db_connect();
        $builder = $db->table('clientele')
            ->select('name,phone_number,address,state,email');

        return DataTable::of($builder)

        
            ->filter(function ($builder, $request) {
                if($request->state){
                    // $builder->where('state',$request->state);
                }
              
            })
            ->toJson();
    }

    public function upload_clients_data()
{
    $session = session();
    $validation =  \Config\Services::validation();

    if (!$this->request->getFile('csvfile')->isValid()) {
        $session->setFlashdata('error', 'File upload failed.');
        return redirect()->back();
    }

    // File upload is valid, proceed with uploading
    $file = $this->request->getFile('csvfile');
    $fileExtension = pathinfo($file->getName(), PATHINFO_EXTENSION);

    $date = new DateTime();
    $c_date_time = $date->format('Y-m-d-H-i-s');
    $newName = $file->getRandomName();
    $file->move('uploads/clients', "client_data_" . $c_date_time . "_" . $newName);

    if ($fileExtension === 'csv') {
        $session->set('uploaded_file_client', [
            'file_name' => './uploads/clients/' . "client_data_" . $c_date_time . "_" . $newName,
        ]);
    } else if ($fileExtension === 'xlsx') {
        // Convert XLSX to CSV
        $xlsxFile = 'uploads/clients/' . "client_data_" . $c_date_time . "_" . $newName;
        $csvFile = 'uploads/clients/' . "client_data_" . $c_date_time . "_" . pathinfo($newName, PATHINFO_FILENAME) . '.csv';

        $excelReader = IOFactory::createReader('Xlsx');
        $excel = $excelReader->load($xlsxFile);
       
        $writer = IOFactory::createWriter($excel, 'Csv');
        $writer->setDelimiter(',');
        $writer->setEnclosure('"');
        $writer->setLineEnding("\r\n");
        $writer->save($csvFile);

        $session->set('uploaded_file_client', [
            'file_name' => $csvFile,
        ]);

        // Delete the original XLSX file
        unlink($xlsxFile);
    }

    return redirect()->to('map-headers-clients');
}

    public function map_headers_clients()
    {

        $session = session();
        $csvimport = new Csvimport();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Column Mapping']),
            'page_title' => view('partials/page-title', ['title' => 'Column Mapping', 'pagetitle' => 'TTMG']),
        ];

        $uploadedFile = $session->get('uploaded_file_client');

        if (!$uploadedFile) {
            return redirect()->to('all-clients')->with('error', 'No file uploaded');
        }

        $import_data = $csvimport->get_array($uploadedFile['file_name']);
        $session->set('csv_array_clients', $import_data);
        $data['headers'] = $import_data;
        $mapping_headers = ["name", "phone_number", "state", "address", "email"];
        foreach ($import_data[0] as $key => $value) {
            $header[] = $value;
        }
        $data['header'] = $header;
        $data['header_fields'] = $mapping_headers;
        return view('Cliental/map_client_headers', $data);
    }

    public function import_clients()
    {
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'All Orders']),
            'page_title' => view('partials/page-title', ['title' => 'All Orders', 'pagetitle' => 'TTMG']),
        ];

        $session = session();

        $head_arr = $this->request->getPost('map_head');
        $mapping_headers = ["name", "phone_number", "state", "address", "email"];

        $csv_array = $session->get('csv_array_clients');
        $data['user_mapper'] = $head_arr;
        $data['headers_avail'] = $mapping_headers;

        $leads = array();
        foreach ($csv_array[1] as $row) {
            $temp = array();
            foreach ($head_arr as $key => $h) {

                if($h=="-"){
                    $temp[$mapping_headers[$key]] ="";
                }
                else{
                    if (isset($row[$h])) {
                        $temp[$mapping_headers[$key]] = $row[$h];
                    } else {
                        // Handle missing key
                        $temp[$mapping_headers[$key]] = null; // or some default value
                    }                }
            }
            array_push($leads, $temp);
        }
        $post_data = array();

        foreach ($leads as $l) {
            $temp_post_data = [
                "name" => $l['name'],
                "phone_number" => $l['phone_number'],
                "state" => $l['state'],
                "address" => $l['address'],
                "email" => $l['email'],

            ];
            array_push($post_data, $temp_post_data);
        }

        $data['post_data'] = $post_data;
        $this->clientele_model->insertBatch($post_data);





        log_activity("New Clients Added " . count($post_data), get_user_fullname());


        $session = session();
        $session->setFlashdata('success', 'Clients Added.');
        return redirect()->to('all-clients');
    }
}
