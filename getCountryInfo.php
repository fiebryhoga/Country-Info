<?php
if (isset($_GET['country_name'])) {
    $countryName = $_GET['country_name'];

    $wsdl = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL";
    $client = new SoapClient($wsdl);

    try {
        // Ambil ISO Code negara
        $countryISO = $client->CountryISOCode(['sCountryName' => $countryName]);
        $countryID = $countryISO->CountryISOCodeResult;

        if ($countryID) {
            // Ambil data lengkap negara
            $countryInfo = $client->FullCountryInfo(['sCountryISOCode' => $countryID]);
            $countryData = $countryInfo->FullCountryInfoResult;

            // Gabungkan nama benua dan kode, nama mata uang dan kode, dan nama negara dan kode
            $countryData->sContinentName = "Asia"; // Contoh data statis
            $countryData->sCurrencyName = "Rupiah"; // Contoh data statis

            // Kirim data ke frontend
            echo json_encode($countryData);
        } else {
            echo json_encode(['error' => 'Negara tidak ditemukan']);
        }
    } catch (SoapFault $fault) {
        echo json_encode(['error' => $fault->faultstring]);
    }
}
