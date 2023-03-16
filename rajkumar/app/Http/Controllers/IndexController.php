<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Executiontime;
use App\Models\Sendingmail;
use App\Models\User;
use Illuminate\Support\Facades\DB; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;


use Location;
use Cookie;
use Mail;



class IndexController extends Controller
{
    public function index()
    { 
        return view('index');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'FirstName'          =>  'required',
            'LastName'         =>  'required'
        ]);
        $begin = microtime(true);

        $exe_time = DB::Table('script_executions')
        ->insert(['FirstName' => $request->FirstName, 'LastName'=>$request->LastName]);

        $last_inserted_id = (Int) DB::getPdo()->lastInsertId();

        $end = microtime(true) - $begin;

        if($last_inserted_id){

            $affectedRows = DB::table('script_executions')
                    ->where('id', $last_inserted_id)
                    ->update(['ExecutionTime' => $end]);

            //print_r($end);
            //die('hello');
        }

        return redirect()->to('/')->with('success', 'Data captured successfully.');

    }

    public function ip_address(Request $request)
    {

        $userIp = $request->ip();
        $userIp = '27.60.63.117';
        $ip_based_location = \Location::get($userIp);
        
        //dd($ip_based_location->countryName);

        // Storing data in cookie
        Cookie::queue('ip', $ip_based_location->ip, 120);
        Cookie::queue('countryName', $ip_based_location->countryName, 120);
        Cookie::queue('countryCode', $ip_based_location->countryCode, 120);
        Cookie::queue('regionCode', $ip_based_location->regionCode, 120);
        Cookie::queue('regionName', $ip_based_location->regionName, 120);
        Cookie::queue('cityName', $ip_based_location->cityName, 120);
        Cookie::queue('zipCode', $ip_based_location->zipCode, 120);
        Cookie::queue('isoCode', $ip_based_location->isoCode, 120);
        Cookie::queue('postalCode', $ip_based_location->postalCode, 120);
        Cookie::queue('latitude', $ip_based_location->latitude, 120);
        Cookie::queue('longitude', $ip_based_location->longitude, 120);
        Cookie::queue('metroCode', $ip_based_location->metroCode, 120);
        Cookie::queue('areaCode', $ip_based_location->areaCode, 120);
        Cookie::queue('timezone', $ip_based_location->timezone, 120);
        Cookie::queue('driver', $ip_based_location->driver, 120);

  
        return view('get-and-display-ip-address', ['data'=>json_decode( json_encode($ip_based_location), true)]);
        // Get and diaply public ip: {"ip":"27.60.63.117","countryName":"India","countryCode":"IN","regionCode":"UP","regionName":"Uttar Pradesh","cityName":"Lucknow","zipCode":"226016","isoCode":null,"postalCode":null,"latitude":"26.8756","longitude":"80.9115","metroCode":null,"areaCode":"UP","timezone":"Asia\/Kolkata","driver":"Stevebauman\\Location\\Drivers\\IpApi"}
    }

    public function ip_address_cookies_based(Request $request)
    {   
        $cookie_arr = array("ip"=>Cookie::get('ip'), "countryName"=>Cookie::get('country'),"countryCode"=>Cookie::get('countryCode'),"regionCode"=>Cookie::get('regionCode'),"cityName"=>Cookie::get('cityName'),"zipCode"=>Cookie::get('zipCode'),"isoCode"=>Cookie::get('isoCode'), "postalCode"=>Cookie::get('postalCode'), "latitude"=>Cookie::get('latitude'), "longitude"=>Cookie::get('longitude'), "metroCode"=>Cookie::get('metroCode'), "areaCode"=>Cookie::get('areaCode'),"timezone"=>Cookie::get('timezone'),"driver"=>Cookie::get('driver'));

        // $value = Cookie::get('ip');
        // $value2 = Cookie::get('country');
        //dd( json_encode(($cookie_arr) ));

        //return response->json($value2);

  
     return view('display-cookies-data', ['data'=>json_decode( json_encode($cookie_arr), true)]);

    }

    public function ExportExcel($id_data){
       ini_set('max_execution_time', 0);
       ini_set('memory_limit', '4000M');
       try {
           $spreadSheet = new Spreadsheet();
           $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
           $spreadSheet->getActiveSheet()->fromArray($id_data);
           $Excel_writer = new Xls($spreadSheet);
           header('Content-Type: application/vnd.ms-excel');
           header('Content-Disposition: attachment;filename="Id_Exported_Sheet.xls"');
           header('Cache-Control: max-age=0');
           ob_end_clean();
           $Excel_writer->save('php://output');
           exit();
       } catch (Exception $e) {
           return;
       }
   }
   /**
    *This function loads the customer data from the database then converts it
    * into an Array that will be exported to Excel
    */

    public function open_text_map(Request $request)
    {   
        return view('open-text-map-data');
    }

    public function exporting_id(Request $request){
        $response = file_get_contents("https://opencontext.org/query/Asia/Turkey/Kenan+Tepe.json");
        $location = json_decode($response, true);

        //echo "<pre>";
        // print_r($location);

        $result = [];
        array_walk_recursive($location, function($value, $key) use(&$result) {
            if ($key === 'id') {
                $result[] = $value;
            }
        });

        $result_2 = array_unique($result);
        //print_r($result_2);
        //die("hello raj");

               $data = $result_2;
               $data_array [] = array("ID");
               //echo "<pre>";
               //print_r($data);
               foreach($data as $data_item)
               {
                   $data_array[] = array(
                       'id' =>$data_item
                   );
               }
               $this->ExportExcel($data_array);

        //dd($location);
    }

    public function to_send_email(Request $request)
    {   
        return view('to-send-email');
    }

    public function email_sent(Request $request)
    {   
        $request->validate([
            'email'          =>  'required',
            'messages'         =>  'required'
        ]);

        $exe_time = DB::Table('sending_emails')
                    ->insert(['email' => $request->email, 'messages'=>$request->messages]);
                $last_inserted_id = (Int) DB::getPdo()->lastInsertId();

                //  Send mail to visitor
                \Mail::send('mail_template', array(
                    'email' => $request->email,
                    'messages' => $request->messages,
                ), function($message) use ($request){
                    $message->from($request->email);
                    $message->to($request->email, 'Visitor')->subject($request->get('subject'));
                });

                return redirect()->back()->with(['success' => 'Your message transmitted Successfully']);

                
    }


}
