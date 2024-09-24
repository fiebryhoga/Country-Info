<?php
if (isset($_GET['query'])) {
    $query = strtolower($_GET['query']);

    // WSDL URL untuk API SOAP
    $wsdl = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL";

    // Membuat client SOAP
    $client = new SoapClient($wsdl);

    try {
        // Panggil fungsi untuk mendapatkan semua negara
        $countryList = $client->ListOfCountryNamesByName();

        // Ambil daftar negara
        $countries = $countryList->ListOfCountryNamesByNameResult->tCountryCodeAndName;

        $suggestions = [];

        // Iterasi daftar negara dan cari yang cocok dengan input
        foreach ($countries as $country) {
            if (strpos(strtolower($country->sName), $query) !== false) {
                $suggestions[] = $country->sName; // Menyimpan nama negara yang cocok
            }
        }

        // Kirim hasil suggestions sebagai JSON
        echo json_encode($suggestions);

    } catch (SoapFault $fault) {
        // Jika terjadi error, kirim pesan error
        echo json_encode(['error' => $fault->faultstring]);
    }
}
