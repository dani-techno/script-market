<?php
header('Content-Type: application/json');
$config = require 'config.php';

// Validasi request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

// Ambil payload dari frontend
$input = json_decode(file_get_contents('php://input'), true);
$action = $_GET['action'] ?? '';

// Setup Headers Flowix [cite: 4, 6]
$headers = [
    "Content-Type: application/json",
    "api_key: " . $config['api']['api_key'],
    "merchant_id: " . $config['api']['merchant_id']
];

$response = [];

switch ($action) {
    case 'create_payment':
        // Endpoint: POST /deposit/create [cite: 10]
        $url = $config['api']['base_url'] . '/api/v1/deposit/create';
        
        // Generate Reff ID unik
        $reffId = 'ORDER-' . time() . '-' . rand(100, 999);
        
        $body = [
            'amount' => (int) $config['product']['price'],
            'method_code' => 'QRISFAST', // [cite: 9]
            'fee_by_customer' => false, // Fee ditanggung merchant [cite: 11]
            'reff_id' => $reffId // Parameter sesuai dokumentasi, meski di doc tertulis ref_id, pastikan konsisten
        ];
        
        $response = curlRequest($url, $headers, $body);
        break;

    case 'check_status':
        // Endpoint: POST /deposit/status [cite: 14]
        $url = $config['api']['base_url'] . '/api/v1/deposit/status'; // Menggunakan /deposit/status sesuai doc
        
        if (empty($input['ref_id'])) {
            echo json_encode(['success' => false, 'message' => 'Reference ID Required']);
            exit;
        }

        $body = [
            'ref_id' => $input['ref_id'] // [cite: 14]
        ];
        
        $response = curlRequest($url, $headers, $body);
        break;

    case 'cancel_payment':
        // Endpoint: POST /deposit/cancel [cite: 16]
        $url = $config['api']['base_url'] . '/api/v1/deposit/cancel';
        
        if (empty($input['ref_id'])) {
            echo json_encode(['success' => false, 'message' => 'Reference ID Required']);
            exit;
        }

        $body = [
            'ref_id' => $input['ref_id'] // [cite: 17]
        ];
        
        $response = curlRequest($url, $headers, $body);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid Action']);
        exit;
}

echo $response;

/**
 * Fungsi Helper cURL
 */
function curlRequest($url, $headers, $body) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Non-aktifkan SSL verify untuk development local jika perlu (opsional)
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $result = curl_exec($ch);
    
    if (curl_errno($ch)) {
        return json_encode(['success' => false, 'message' => 'Curl Error: ' . curl_error($ch)]);
    }
    
    curl_close($ch);
    return $result;
}