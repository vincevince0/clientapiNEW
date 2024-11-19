<?php
 
namespace App\Html;
 
use App\RestApiClient\Client;
 
class Request{
 
    static function handle()
    {
        switch($_SERVER["REQUEST_METHOD"]){
            case "POST":
                self::postRequest();
                break;
            case "GET":
                self::getCounties();
                break;
            case "DELETE":
                self::deleteCounty();
                break;
            default:
                self::getCounties();
                break;
        }
    }
 
    private static function postRequest()
    {
        $request = $_REQUEST;
        switch (true) {
            case isset($request['btn-home']):
                echo 'Ez itt a kezdőlap.';
                break;
            case isset($request['btn-counties']):
                PageCounties::table(self::getCounties());
                break;
            case isset($request['btn-del-county']):
                self::deleteCounty();
                PageCounties::table(self::getCounties());
                break;
            case isset($request['btn-save-county']):
                // Editing an existing county
                $id = $_POST['id'];  // Get the county ID
                $name = $_POST['name'];  // Get the updated county name
                self::updateCounty($id, ['name' => $name]);  // Call update function
                PageCounties::table(self::getCounties());  // Reload counties
                break;
            case isset($request['btn-save-new-county']):
                // Creating a new county
                $name = $_POST['name'];  // Get the new county name
                self::createCounty(['name' => $name]);  // Call create function
                PageCounties::table(self::getCounties());  // Reload counties
                break;
            case isset($request['btn-update-county']):
                PageCounties::editor();
                break;
        }
    }
    
    
 
    private static function getCounties(): array
    {
        $client = new Client();
        $response = $client->get('counties');
 
        return $response['data'];
    }

    private static function createCounty($data)
{
    $name = $data['name'];  // Get the name of the new county
    $client = new Client();
    $response = $client->post('counties', ['name' => $name]);

    if ($response && isset($response['data'])) {
        // Successfully created county
        return $response['data'];
    } else {
        // Handle error
        echo "Error creating county.";
    }
}



private static function updateCounty($id, $data)
{
    $client = new Client();
    $response = $client->put('counties/' . $id, $data);

    if ($response && isset($response['data'])) {
        // Successfully updated
        return $response['data'];
    } else {
        // Handle error
        echo "Error updating county.";
    }
}



    private static function deleteCounty()
    {
        $requestData = $_POST["btn-del-county"];
        $client = new Client();
        $response = $client->delete('counties', $requestData);

        //header("refresh:0");
    }
 
}
 
?>