<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
  protected $user=null;
  

   public function sendaadharotp(){
 $post=$this->input->post();
    $kyc=$this->db->where('aadhar_no',$post['aadharno'])->get('kycs')->row();

if($kyc){
$res['code']=500;
$res['data']['message']='aadhar no is already used for kyc by another user';
echo json_encode($res);
die();
}


    $api=$this->db->where(['tag'=>'AADHAR'])->get('apis')->row();  
   
   
    // $user = $this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
    
    $url = 'https://api.sandbox.co.in/kyc/aadhaar/okyc/otp';
 

// $_SESSION['txn']=$data;

$postdata = '{
  "aadhaar_number": "'.$post['aadharno'].'"
}';

$headers[]='Authorization: '.$api->authtoken;
$headers[]='accept: application/json';
$headers[]='content-type: application/json';
$headers[]='x-api-key: '.$api->apikey;
$headers[]='x-api-version: 1.0';

$ch = curl_init($url); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
curl_close($ch);
echo $result;

    }

public function verifyaadharotp(){

    $api=$this->db->where(['tag'=>'AADHAR'])->get('apis')->row();  
   
    $post=$this->input->post();
    // $user = $this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
    
    $url = 'https://api.sandbox.co.in/kyc/aadhaar/okyc/otp/verify';
 

// $_SESSION['txn']=$data;

$postdata = '{
  "otp": "'.$post['aadharotp'].'",
  "ref_id": "'.$post['ref_id'].'"
}';

$headers[]='Authorization: '.$api->authtoken;
$headers[]='accept: application/json';
$headers[]='content-type: application/json';
$headers[]='x-api-key: '.$api->apikey;
$headers[]='x-api-version: 1.0';

$ch = curl_init($url); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
curl_close($ch);
header('content-type: application/json');
echo $result;
$res=json_decode($result);
if($res->code==200 && isset($res->data->status) && $res->data->status=='VALID'){
    $kyc['user_id']=$this->session->userdata('UserAuth');
    $kyc['aadhar_no']=$post['aadhar_no'];
    $kyc['kycdata']=json_encode($res->data);
    $kyc['created_at']=time();
    $kyc['status']=1;


    $this->db->insert('kycs',$kyc);
$this->session->set_flashdata('txnmsg','Your KYC is successfully completed !');

}
    }


    public function savelogin($id){
        setcookie('UserAuth', $id, time() + (86400 * 300000), "/");
    }
    
public function onlyforauth(){
        $this->autologin();
        if($this->session->userdata('UserAuth')){
            $this->user = $this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
        }else{
            redirect(base_url('user/login'));
        }
    }

     public function onlyfornonauth(){
        $this->autologin();

        if($this->session->userdata('UserAuth')){
         redirect(base_url('user/dashboard'));  
        }else{
            $this->user = null;
        }
    }
	
public function send_otp($number=0)
	{
        $post=$this->input->post();
        $isMobileAlreadyRegistred=$this->db->where('mobile_no',$post['mobile_no'])->get('users')->row();
        
        if(trim($post['full_name'],'!@#$%^&*()_+=-')=='' || str_replace(' ','',$post['full_name'])==''){
          $res['return']=false;
$res['message']='please enter a valid name';
echo json_encode($res);
        die();  
        }

       

$mobileregex = "/^[6-9][0-9]{9}$/" ;
         if(preg_match($mobileregex, $post['mobile_no']) != 1){
          $res['return']=false;
$res['message']='please enter a valid mobile no';
echo json_encode($res);
        die();  
        }

        if($isMobileAlreadyRegistred){
$res['return']=false;
$res['message']='mobile no already registered !';
echo json_encode($res);
        die();
        }

        if($post['refer_code']){
            $isReferCodeValid=$this->db->where('code',$post['refer_code'])->get('users')->row();
        if(!$isReferCodeValid){
$res['return']=false;
$res['message']='refer code is not valid !';
echo json_encode($res);
        die();
        }
        }

        ini_set("allow_url_fopen", 1);
		$mainurl='https://www.fast2sms.com/dev/bulkV2';
		$api=$this->db->where(['tag'=>'FAST2SMS'])->get('apis')->row()->apikey;
        $route='otp';
        $otp=rand(100000,999999);
        $flash=0;
        // $call=$mainurl.'?authorization='.$api.'&route='.$route.'&variables_values='.$otp.'&flash='.$flash.'&numbers='.$number;
        // $result = file_get_contents($call);
        // $gggg = "https://health.rajnikantmahato.me/api.php?apikey=baby&to=$number&msg=your%20otp%20is%20$otp";
        // $ff =  file_get_contents($gggg);
      
        $url = 'https://codedrops.in/api/whatsapp/send';

        // Headers
        $headers = [
            'Api-key: 225b5b6c-570c-4ce2-85b9-706efee5827c',
            'Content-Type: application/json'
        ];
        
        // Data to be sent in JSON format
        $data = [
            "contact" => [
                [
                    "number" => "91" . $number,
                    "message" => $otp
                ]
            ]
        ];
        
        // Initialize cURL session
        $ch = curl_init($url);
        
        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        // Execute the request
        $response = curl_exec($ch);
        
        
        curl_close($ch);



        $this->session->set_userdata('login_otp',$otp);
        echo $ff;

	}

    public function send_login_otp($number=0)
	{
        $post=$this->input->post();
        $isMobileAlreadyRegistred=$this->db->where('mobile_no',$number)->get('users')->row();
        if(!$isMobileAlreadyRegistred){
         $res['return']=false;
         $res['message']='mobile no is not registered !';
         echo json_encode($res);
        die();
        }
       
        ini_set("allow_url_fopen", 1);
		$mainurl='https://www.fast2sms.com/dev/bulkV2';
		$api=$this->db->where(['tag'=>'FAST2SMS'])->get('apis')->row()->apikey;
        $route='otp';
        $otp=rand(100000,999999);
        $flash=0;
        // $call=$mainurl.'?authorization='.$api.'&route='.$route.'&variables_values='.$otp.'&flash='.$flash.'&numbers='.$number;
        // $result = file_get_contents($call);
        // $gggg = "https://health.rajnikantmahato.me/api.php?apikey=baby&to=$number&msg=your%20otp%20is%20$otp";
        // $ff =  file_get_contents($gggg);
        


        
        $url = 'https://codedrops.in/api/whatsapp/send';

        // Headers
        $headers = [
            'Api-key: 225b5b6c-570c-4ce2-85b9-706efee5827c',
            'Content-Type: application/json'
        ];
        
        // Data to be sent in JSON format
        $data = [
            "contact" => [
                [
                    "number" => "91" . $number,
                    "message" => $otp
                ]
            ]
        ];
        
        // Initialize cURL session
        $ch = curl_init($url);
        
        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        // Execute the request
        $response = curl_exec($ch);
        
        
        curl_close($ch);



        
        $this->session->set_userdata('login_otp',$otp);
        echo $ff;

	}

     function gen_ref_code(){
        $string='abcdefghijklmnopqrstuvwxyz1234567890'.time();
        $string=str_shuffle($string);
        $check=true;
        while($check){
         $code=substr($string,0,8);
         if($this->db->where('code',$code)->get('users')->result()){
            $string=str_shuffle($string);
         }else{
            $check=false;
            return $code;
         }

        }
    }

    function clean($string) {
   $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

     function gen_username($name){
        $count=1;
        $username=$this->clean(strtolower($name));
        
        
        $check=true;
        while($check){
         $un=$username.$count;
         if($this->db->where('username',$un)->get('users')->result()){
            $count++;
         }else{
$check=false;
return $un;
         }

        }
    }

    public function verify_otp($otp=0){
$post=$this->input->post();
// foreach($post as $index=>$val){
 
//    if(!$val){
// $this->session->set_flashdata('txnmsg',"Don't Try to be smart, fill the form correctly.");
// redirect(base_url());
//    }
// }

$post['code']=strtoupper($this->gen_ref_code());
if($this->session->userdata('login_otp')==$post['uotp']){
$post['created_at']=time();
unset($post['uotp']);
$post['avatar']='avatar16.png';
$post['username']=$this->gen_username($post['full_name']);
$post['refer_code']=strtoupper($post['refer_code']);
$this->db->insert('users',$post);
$userid=$this->db->insert_id();
$this->session->set_userdata('UserAuth',$userid);
$this->savelogin($userid);

if($this->db->get('system')->row()->joining_bonus>0){
     $txn['user_id']=$userid;
    $txn['order_id']='txn'.rand(100,999).time();
    $txn['utr']=time();
    $txn['amount']=$this->db->get('system')->row()->joining_bonus;
    $txn['type']='CREDIT';
    $txn['reason']='Joining Bonus';
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='JOINING_BONUS';

    $this->db->insert('transections',$txn);
}
$response['status']=true;
$response['message']='Mobile No, Verified !';
}else{
$response['status']=false;
$response['message']='Incorrect OTP, Please Try Again';

}

echo json_encode($response);
    }


public function verify_login_otp($otp=0){
$post=$this->input->post();

if($this->session->userdata('login_otp')==$otp){

$user=$this->db->where('mobile_no',$post['mobile_no'])->get('users')->row();
if($user){
    $this->session->set_userdata('UserAuth',$user->id);
    $this->savelogin($user->id);
    $response['status']=true;
$response['message']='Mobile No, Verified !';
}else{
    $response['status']=false;
$response['message']='something is wrong, please refresh the page and try again';
}



}else{
$response['status']=false;
$response['message']='Incorrect OTP, Please Try Again';

}

echo json_encode($response);
    }


    public function changeavatar(){
    $post=$this->input->post();
    $avatar = explode('assets/images/avatars/',$post['avatar'])[1];
$userid=$this->session->userdata('UserAuth');
$this->db->where('id',$userid)->update('users',[
'avatar'=>$avatar
]);
echo 'ok';
    }




  public function addwithdrawreq(){
    $post=$this->input->post();


$userid=$this->session->userdata('UserAuth');

if($this->db->get('system')->row()->kyc_type!=2){
$kyc=$this->db->where('user_id',$userid)->where('status',1)->get('kycs')->row();

if(!$kyc){
$response['msg']="please complete your kyc , before placing any withdraw request";
$response['status']=false;
echo json_encode($response);
die();
}

}

if($post['wamount']>$this->getRewardBalance()){

$response['status']=false;
$response['msg']="you have don't have sufficient balance in your reward wallet";

}else{

    $wtxn['user_id']=$userid;
    $wtxn['amount']=$post['wamount'];
    $wtxn['upi_mobile']=$post['upi'];
    $wtxn['upi_app']=$post['upiapp'];
    $wtxn['name']=$post['name'];
    $wtxn['bank_ac_no']=$post['bankno'];
    $wtxn['bank_ifsc_code']=$post['ifsc'];


    $wtxn['created_at']=time();
    $wtxn['status']=2;
    $wtxn['req_id']='WD'.rand(1000,9999).time();

    $this->db->insert('withdraw_reqs',$wtxn);

$this->session->set_flashdata('txnmsg',"your withdraw request is successfully submitted, it will take 24 hours to process");





$response['msg']="your withdraw request is successfully submitted, it will take 24 hours to process";
$response['status']=true;
}


echo json_encode($response);
    }




      public function changeusername(){
    $post=$this->input->post();

$userid=$this->session->userdata('UserAuth');

$un=$this->db->where('username',$post['username'])->get('users')->result();
if($un){
$response['status']=false;
$response['msg']="'".$post['username']."' is already taken";

}else{
$this->db->where('id',$userid)->update('users',['username'=>$post['username']]);
$response['status']=true;
}


echo json_encode($response);
    }


      public function mupdateroomcode(){
     $post=$this->input->post();

 $userid=$this->session->userdata('UserAuth');

 $match=$this->db->where('id',$post['match'])->get('matches')->row();
 if($match){
 $response['status']=true;
 $this->db->where('id',$match->id)->update('matches',['room_code'=>$post['room_code']]);
 $response['msg']="room code updated";

 }else{

 $response['status']=false;
 $response['msg']="room code not updated";

 }


 echo json_encode($response);
    }
    
    
public function updateroomcode(){
    $post=$this->input->post();

$userid=$this->session->userdata('UserAuth');

$match=$this->db->where('id',$post['match'])->get('matches')->row();
if($match){
    
    $game = $match->game;
    if($game=='32'){
        $post=$this->input->post();
        $userid=$this->session->userdata('UserAuth');
        
        $match=$this->db->where('id',$post['match'])->get('matches')->row();
        if($match){
        $response['status']=true;
        $this->db->where('id',$match->id)->update('matches',['room_code'=>$post['room_code']]);
        $response['msg']="room code updated";
        }else{
        $response['status']=false;
        $response['msg']="room code not updated";
        }
        echo json_encode($response);
    }
    else if($game=='28'){
        
        $curl = curl_init();
        
        curl_setopt_array($curl, [
        	CURLOPT_URL => "https://one-goti-ludo-king-api.p.rapidapi.com/api/onegoti/result?roomcode=".$post['room_code']."&apikey=5eb5f408",
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_ENCODING => "",
        	CURLOPT_MAXREDIRS => 10,
        	CURLOPT_TIMEOUT => 30,
        	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        	CURLOPT_CUSTOMREQUEST => "GET",
        	CURLOPT_HTTPHEADER => [
        		"X-RapidAPI-Host: one-goti-ludo-king-api.p.rapidapi.com",
        		"X-RapidAPI-Key: c9cf4acf45mshd420729b685e348p14063fjsn6431e2557035"
        	],
        ]);
        
        $res = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $response['status']=false;
            $response['msg']="try agian";
        } else {
             $res_dat = json_decode($res, true);
             $res_data = $res_dat['result'];
            //  var_dump($res_data);
            $response['msg'] = $res_data;
            if($res_data['roomType']=='classic'){
                $response['status']=true;
                $this->db->where('id',$match->id)->update('matches',['room_code'=>$post['room_code']]);
                $response['msg']="room code updated";
            }
            else{
                $response['status']=false;
                $response['msg']="Enter classic roomcode";
            }
        }
        
        
    }else if($game=='29'){
        
        $curl = curl_init();
    
        curl_setopt_array($curl, [
        	CURLOPT_URL => "https://one-goti-ludo-king-api.p.rapidapi.com/api/twogoti/result?roomcode=".$post['room_code']."&apikey=5eb5f408",
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_ENCODING => "",
        	CURLOPT_MAXREDIRS => 10,
        	CURLOPT_TIMEOUT => 30,
        	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        	CURLOPT_CUSTOMREQUEST => "GET",
        	CURLOPT_HTTPHEADER => [
        		"X-RapidAPI-Host: one-goti-ludo-king-api.p.rapidapi.com",
        		"X-RapidAPI-Key: c9cf4acf45mshd420729b685e348p14063fjsn6431e2557035"
        	],
        ]);
        
        $res = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $response['status']=false;
            $response['msg']="try agian";
        } else {
             $res_dat = json_decode($res, true);
             $res_data = $res_dat['result'];
            //  var_dump($res_data);
            $response['msg'] = $res_data;
            if($res_data['roomType']=='classic'){
                $response['status']=true;
                $this->db->where('id',$match->id)->update('matches',['room_code'=>$post['room_code']]);
                $response['msg']="room code updated";
            }
            else{
                $response['status']=false;
                $response['msg']="Enter classic roomcode";
            }
        }
        
        
    }else if($game=='31'){
        
        $curl = curl_init();
    
        curl_setopt_array($curl, [
        	CURLOPT_URL => "https://one-goti-ludo-king-api.p.rapidapi.com/api/threegoti/result?roomcode=".$post['room_code']."&apikey=5eb5f408",
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_ENCODING => "",
        	CURLOPT_MAXREDIRS => 10,
        	CURLOPT_TIMEOUT => 30,
        	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        	CURLOPT_CUSTOMREQUEST => "GET",
        	CURLOPT_HTTPHEADER => [
        		"X-RapidAPI-Host: one-goti-ludo-king-api.p.rapidapi.com",
        		"X-RapidAPI-Key: c9cf4acf45mshd420729b685e348p14063fjsn6431e2557035"
        	],
        ]);
        
        $res = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $response['status']=false;
            $response['msg']="try agian";
        } else {
             $res_dat = json_decode($res, true);
             $res_data = $res_dat['result'];
            //  var_dump($res_data);
            $response['msg'] = $res_data;
            if($res_data['roomType']=='classic'){
                $response['status']=true;
                $this->db->where('id',$match->id)->update('matches',['room_code'=>$post['room_code']]);
                $response['msg']="room code updated";
            }
            else{
                $response['status']=false;
                $response['msg']="Enter classic roomcode";
            }
        }
        
        
    }else{
    
    $curl = curl_init();
    
    curl_setopt_array($curl, [
    	CURLOPT_URL => "https://ludo-king-room-checker-api.p.rapidapi.com/checkType?roomCode=".$post['room_code'],
    	CURLOPT_RETURNTRANSFER => true,
    	CURLOPT_ENCODING => "",
    	CURLOPT_MAXREDIRS => 10,
    	CURLOPT_TIMEOUT => 5,
    	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    	CURLOPT_CUSTOMREQUEST => "GET",
    	CURLOPT_HTTPHEADER => [
    		"X-RapidAPI-Host: ludo-king-room-checker-api.p.rapidapi.com",
    		"X-RapidAPI-Key: 85f05b9a67mshae29fce015d6660p14af98jsn0d64efacb13a"
    	],
    ]);
    
    $res = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        $response['status']=false;
        $response['msg']="सही roomcode डाले";
    } else {
         $res_data = json_decode($res, true);
        if($res_data['type']=='classic'){
            $response['status']=true;
            $this->db->where('id',$match->id)->update('matches',['room_code'=>$post['room_code']]);
            $response['msg']="room code updated";
        }
        else{
            $response['status']=false;
            $response['msg']="Enter classic roomcode";
        }
    }
}
    
}else{

$response['status']=false;
$response['msg']="room code not updated";

}


echo json_encode($response);
    }



// add by rajni
// contact 919771241425
public function updateroomcode2(){
    $post=$this->input->post();

$userid=$this->session->userdata('UserAuth');

$match=$this->db->where('id',$post['match'])->get('matches')->row();
if($match){
    $curl = curl_init();
    
    curl_setopt_array($curl, [
    	CURLOPT_URL => "https://ludo-king-manual-roomcode-type-result.p.rapidapi.com/rapidapi/manualresult/result/?roomcode=".$post['room_code'],
    	CURLOPT_RETURNTRANSFER => true,
    	CURLOPT_ENCODING => "",
    	CURLOPT_MAXREDIRS => 10,
    	CURLOPT_TIMEOUT => 30,
    	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    	CURLOPT_CUSTOMREQUEST => "GET",
    	CURLOPT_HTTPHEADER => [
    		"X-RapidAPI-Host: ludo-king-manual-roomcode-type-result.p.rapidapi.com",
    		"X-RapidAPI-Key: 3bbf3aef2fmsh5f13c2525e1e52fp1fefddjsn3d6900bf10c0"
    	],
    ]);
    
    $res = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        $response['status']=false;
        $response['msg']="try agian";
    } else {
         $res_data = json_decode($res, true);
        if($res_data['roomType']=='classic'){
            $response['status']=true;
            $this->db->where('id',$match->id)->update('matches',['room_code'=>$post['room_code']]);
            $response['msg']="room code updated";
        }
        else{
            $response['status']=false;
            $response['msg']="Enter classic roomcode";
        }
    }
    
}else{

$response['status']=false;
$response['msg']="room code not updated";

}


echo json_encode($response);
    }

  public function getAvailableBalance(){
        $where['user_id']=@$this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row()->id;
        $where['type']='CREDIT';
       
        $credit = $this->db->select('SUM(amount) as money')->where('(ctg!="MATCH_WININGS" AND ctg!="REFERRAL_BONUS" AND ctg!="ADDTOREWARD")')->where($where)->get('transections')->row()->money;

        $where['type']='DEBIT';
       
        $debit = $this->db->select('SUM(amount) as money')->where('(ctg!="WITHDRAW" AND ctg!="TRANSFER")')->where($where)->get('transections')->row()->money;


        return ($credit-$debit);


    }

  public function getRewardBalance(){
        $where['user_id']=@$this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row()->id;
        $where['type']='CREDIT';
        $credit = $this->db->select('SUM(amount) as money')->where($where)->where('(ctg="MATCH_WININGS" OR ctg="REFERRAL_BONUS" OR ctg="ADDTOREWARD")')->get('transections')->row()->money;

        $where['type']='DEBIT';
       
        $debit = $this->db->select('SUM(amount) as money')->where($where)->where('(ctg="WITHDRAW")')->get('transections')->row()->money;
        

$debit += $this->db->select('SUM(amount) as money')->where([
    'user_id'=>$this->session->userdata('UserAuth'),
    'status'=>2
])->get('withdraw_reqs')->row()->money;

$where['type']='CREDIT';
$where['ctg']='TRANSFER';
$debit += $this->db->select('SUM(amount) as money')->where($where)->get('transections')->row()->money;

        return ($credit-$debit);


    }


     public function creatematch(){

    $post=$this->input->post();
$userid=$this->session->userdata('UserAuth');

$alreadyopenmatch=$this->db->where('status',1)->where('winner !=',$userid)->where('looser !=',$userid)->where("(host_id=$userid OR joiner_id=$userid)")->get('matches')->row();


if($post['amount']>($this->getAvailableBalance() + $this->getRewardBalance())){
$response['status']=false;
$response['msg']="you don't have sufficient balance in your wallet";
}elseif($alreadyopenmatch){
$response['status']=false;
$response['msg']="you are already in a active match or didn't submitted result";
}else{
    if($post['amount']>$this->getAvailableBalance()){
        $txn['user_id']=$userid;
        $txn['order_id']='txn'.$userid.time();
        $txn['amount']=($post['amount'] - $this->getAvailableBalance());
        $txn['utr']='Transfered From Reward';
        $txn['type']='CREDIT';
        $txn['reason']='Added Money from Rewards for match';
        $txn['created_at']=time();
        $txn['ctg']='TRANSFER';
        $this->db->insert('transections',$txn);
    }
    
    $match['host_id']=$userid;
    $match['amount']=$post['amount'];
    $match['game']=$post['match'];
    $match['status']=1;
    $match['created_at']=time();

    $this->db->insert('matches',$match);

    $matchid=$this->db->insert_id();

$game = $this->db->where('id',$post['match'])->get('games')->row();

    $txn['user_id']=$userid;
    $txn['order_id']='txn'.rand(100,999).time();
    $txn['utr']=time();
    $txn['amount']=$post['amount'];
    $txn['type']='DEBIT';
    $txn['reason']='Created '.$game->game_name.' Match';
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH';
    $txn['match_id']=$matchid;

    $this->db->insert('transections',$txn);


$response['status']=true;
}



echo json_encode($response);
    }


    //payment
    public function createorder(){

       
        
    $post=$this->input->post();
    // $post['amount']=1;
    $_SESSION['addamount']=$post['amount'];
$response=[];
$user = $this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
 if($this->db->get('system')->row()->payment_gateway=='UG'){
            

    $user = $this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
    
//    #############


                    $key = $this->db->where('tag','UPIGATEWAY')->get('apis')->row()->apikey;	// Your Api Token https://merchant.upigateway.com/user/api_credentials
					$post_data = new stdClass();
					$post_data->key = $key;
					$post_data->client_txn_id = 'txn'.$user->id.time(); // you can use this field to store order id;
					$post_data->amount = "{$post['amount']}";
					$post_data->p_info = "walletadd";
					$post_data->customer_name = $user->full_name;
					$post_data->customer_email = 'admin@ludotopper.com';
					$post_data->customer_mobile = $user->mobile_no;
					$post_data->redirect_url = base_url('user/wallet'); // automatically ?client_txn_id=xxxxxx&txn_id=xxxxx will be added on redirect_url
					$post_data->udf1 = "dqwdfd72d";
					$post_data->udf2 = "ygbaf8932rQ*9wq";
					$post_data->udf3 = "23%78h*jwk";

					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => 'https://api.ekqr.in/api/create_order',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS => json_encode($post_data),
						CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						),
					));
					$response2 = curl_exec($curl);
					curl_close($curl);

					$result = json_decode($response2, true);
					if ($result['status'] == true) {
						$response['gotourl']=$result['data']['payment_url'];
					}
				// 	if ($result['status'] == true) {
				// 		$response['gotourl']=$result['data']['upi_intent']['bhim_link'];
				// 	}




}elseif($this->db->get('system')->row()->payment_gateway=='SK'){
            

    $user = $this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
    
//    #############


                    $key = $this->db->where('tag','SHOPKING')->get('apis')->row()->apikey;	
					$post_data = new stdClass();
					$post_data->token = $key;
					$post_data->order_id = 'txn'.$user->id.time(); // you can use this field to store order id;
					$post_data->txn_amount = "{$post['amount']}";
					$post_data->txn_note = " ";
					$post_data->product_name = " ";
					$post_data->customer_name = $user->full_name;
					$post_data->customer_email = 'null';
					$post_data->customer_mobile = $user->mobile_no;
					$post_data->callback_url = base_url('api/calbk'); // automatically ?client_txn_id=xxxxxx&txn_id=xxxxx will be added on redirect_url

					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => 'https://pg.shopkiing.com/order/create',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS => json_encode($post_data),
						CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						),
					));
					$response2 = curl_exec($curl);
					curl_close($curl);

					$result = json_decode($response2, true);
					if ($result['status'] == true) {
						$response['gotourl']=$result['data']['payment_url'];
					}

}elseif($this->db->get('system')->row()->payment_gateway=='PG'){

$response['gotourl']=base_url('user/addmoney');
}elseif($this->db->get('system')->row()->payment_gateway=='P'){
// pppppppppppppppppppppppppppppppp

// Replace these with your actual PhonePe API credentials


$merchantId = $this->db->where('tag','PHONEPE')->get('apis')->row()->secretkey; // production merchantId
$apiKey=$this->db->where('tag','PHONEPE')->get('apis')->row()->apikey; // production APIKEY
//$merchantId = 'PGTESTPAYUAT'; // sandbox or test merchantId
//$apiKey="099eb0cd-02cf-4e2a-8aca-3e6c6aff0399"; // sandbox or test APIKEY
$redirectUrl = base_url('user/phonepe_verifypayment/'.$user->id);

// Set transaction details
$order_id = uniqid(); 
$name=$user->full_name;
$mobile=$user->mobile_no;
$amount = $post['amount']; // amount in INR
$description = 'Deposit Money In Wallet';

 
$paymentData = array(
    'merchantId' => $merchantId,
    'merchantTransactionId' => "TXN".$user->id.time(), // test transactionID
    "merchantUserId"=>$user->mobile_no,
    'amount' => $amount*100,
    'redirectUrl'=>$redirectUrl,
    'redirectMode'=>"POST",
    'callbackUrl'=>$redirectUrl,
    "merchantOrderId"=>$order_id,
   "mobileNumber"=>$mobile,
   "message"=>$description,
   "shortName"=>$name,
   "paymentInstrument"=> array(    
    "type"=> "PAY_PAGE",
  )
);
 
 
 $jsonencode = json_encode($paymentData);
 $payloadMain = base64_encode($jsonencode);
 $salt_index = 1; //key index 1
 $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
 $sha256 = hash("sha256", $payload);
 $final_x_header = $sha256 . '###' . $salt_index;
 $request = json_encode(array('request'=>$payloadMain));
                
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_POSTFIELDS => $request,
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
     "X-VERIFY: " . $final_x_header,
     "accept: application/json"
  ],
]);
 
$response2 = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
 
if ($err) {
  echo "cURL Error #:" . $err;
} else {
   $res = json_decode($response2);
 
if(isset($res->success) && $res->success=='1'){
$paymentCode=$res->code;
$paymentMsg=$res->message;
$payUrl=$res->data->instrumentResponse->redirectInfo->url;

$response['gotourl']=$payUrl;
}else{
  
var_dump($res);
}
}



//ppppppppppppppppppppppppppppppppp

}elseif($this->db->get('system')->row()->payment_gateway=='CP'){
// cpcpcpcpcpcpcpcp

$orderId = 'txn'.uniqid(); 
$secretKey=$this->db->where('tag','CASHFREE')->get('apis')->row()->secretkey;
$appId=$this->db->where('tag','CASHFREE')->get('apis')->row()->apikey;

$postData = array( 
     "appId" => $appId, 
     "orderId" => $orderId, 
     "orderAmount" => $post['amount'], 
     "orderCurrency" => 'INR',
     "customerName" => $user->full_name, 
     "customerEmail" => 'admin@ludotopper.com', 
        "customerPhone" => $user->mobile_no, 
     "returnUrl" => base_url('user/verifycashfreepayment/'.$user->id),
     'notifyUrl'=>''
   );


   

   ksort($postData);
   $signatureData = "";
   foreach ($postData as $key => $value){
      $signatureData .= $key.$value;
   }

   $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
   $signature = base64_encode($signature);

   $rrd=$postData;
   $rrd['signature']=$signature;
   $_SESSION['cashfree']=$rrd;

$response['gotourl']=base_url('user/cashfreepayment');

}elseif($this->db->get('system')->row()->payment_gateway=='D'){
$this->session->set_flashdata('txnmsg','Currently Deposit Money is Disabled By Admin');
$response['gotourl']=base_url('user/wallet');
}




echo json_encode($response);

    }


    public function fetchpayment(){
        $pdata = $this->input->post();

		if ($pdata['status'] == 'success') {
		    if($pdata['udf1']=='dqwdfd72d' and $pdata['udf2']=='ygbaf8932rQ*9wq' and $pdata['udf3']=='23%78h*jwk'){
		    
		    $usr=$this->db->where('mobile_no',$pdata['customer_mobile'])->get('users')->row();
		    
            // $txn['user_id']=$user->id;
            // $txn['order_id']=$result['data']['client_txn_id'];
            // $txn['amount']=$result['data']['amount'];
            // $txn['utr']=$result['data']['upi_txn_id'];
            // $txn['type']='CREDIT';
            // $txn['reason']='Added Money';
            // $txn['created_at']=time();
            
            $txn['user_id']=$usr->id;
            $txn['order_id']=$pdata['client_txn_id'];
            $txn['amount']=($pdata['amount'])/1.28;
            $txn['utr']=$pdata['upi_txn_id'];
            $txn['type']='CREDIT';
            $txn['reason']='Added Money';
            $txn['created_at']=time();
            
            $txnn['user_id']=$usr->id;
            $txnn['order_id']=$pdata['client_txn_id'];
            $txnn['amount']=($pdata['amount'])-$txn['amount'];
            $txnn['utr']=$pdata['upi_txn_id'];
            $txnn['type']='CREDIT';
            $txnn['reason']='Bonus';
            $txnn['ctg']='GST';
            $txnn['created_at']=time();
            
            $dp=$this->db->where('user_id',$usr->id)->where('order_id',$txn['order_id'])->get('transections')->row();
            if(!$dp){
                $this->db->insert('transections',$txn);
                $this->db->insert('transections',$txnn);
                // $this->session->set_flashdata('txnmsg','Money Deposited Successfully');
            }
            }
        }
    }
    
    public function fetchpayment2(){
        $pdata = $this->input->post();

		if ($pdata['status'] == 'success') {
		    
		    $usr=$this->db->where('mobile_no',$pdata['customer_mobile'])->get('users')->row();
		    
            // $txn['user_id']=$user->id;
            // $txn['order_id']=$result['data']['client_txn_id'];
            // $txn['amount']=$result['data']['amount'];
            // $txn['utr']=$result['data']['upi_txn_id'];
            // $txn['type']='CREDIT';
            // $txn['reason']='Added Money';
            // $txn['created_at']=time();
            
            $txn['user_id']=$usr->id;
            $txn['order_id']=$pdata['txn_id'];
            $txn['amount']=($pdata['txn_amount'])/1.28;
            $txn['utr']=$pdata['utr_number'];
            $txn['type']='CREDIT';
            $txn['reason']='Added Money';
            $txn['created_at']=time();
            
            $txnn['user_id']=$usr->id;
            $txnn['order_id']=$pdata['client_txn_id'];
            $txnn['amount']=($pdata['txn_amount'])-$txn['amount'];
            $txnn['utr']=$pdata['utr_number'];
            $txnn['type']='CREDIT';
            $txnn['reason']='Bonus';
            $txnn['ctg']='GST';
            $txnn['created_at']=time();
            
            $dp=$this->db->where('user_id',$usr->id)->where('order_id',$txn['txn_id'])->get('transections')->row();
            if(!$dp){
                $this->db->insert('transections',$txn);
                $this->db->insert('transections',$txnn);
                // $this->session->set_flashdata('txnmsg','Money Deposited Successfully');
            }
        }
    }
    
    public function paytapi() {
        $clientReferenceId = $_GET['ClientReferenceId'];
        $paymentReferenceId = $_GET['PaymentReferenceId'];
        $bankUTRNO = $_GET['BankUTRNO'];
        $accountNumber = $_GET['AccountNumber'];
        $ifscCode = $_GET['IfscCode'];
        $amount = $_GET['Amount'];
        $status = $_GET['Status'];
        $message = $_GET['Message'];
        $transferMode = $_GET['TransferMode'];
        $email = $_GET['Email'];
        $mobileNo = $_GET['MobileNo'];
        $remarks = $_GET['Remarks'];
        $transactionTime = $_GET['TransactionTime'];
        $updatedTime = $_GET['UpdatedTime'];
        // echo $clientReferenceId;
        
        if($status=='SUCCESS' and $transferMode=='IMPS'){
            $id=explode("G",$clientReferenceId)[1];
            // echo $id;
         $w=$this->db->where('id',$id)->get('withdraw_reqs')->row();
            if($w and $w->status==2){
                $up['status']=1;
                $up['reason']="(Auto)".$message;
                $this->db->where('id',$id)->update('withdraw_reqs',$up);
                
                $txn['user_id']=$w->user_id;
                $txn['order_id']='txn'.time().rand(100,999);
                $txn['utr']=time();
                $txn['amount']=$w->amount;
                $txn['type']='DEBIT';
            
                if($w->upi_app=='Bank'){
             $txn['reason']='(auto) Transfered to '.$w->upi_app.' / '.$w->bank_ac_no.' ('.$w->bank_ifsc_code.')';
                }else{
             $txn['reason']='(auto) Transfered to '.$w->upi_app.' / '.$w->upi_mobile;
                }
               
                $txn['created_at']=time();
                $txn['status']=1;
                $txn['ctg']='WITHDRAW';
             
                $this->db->insert('transections',$txn);
            }
            // else{
            //     echo "not found";
            // }
        }
        else if($status=='FAILED'){
            $id=explode("G",$clientReferenceId)[1];
           
            $w=$this->db->where('id',$id)->get('withdraw_reqs')->row();
            if($w and $w->status==2){
                $up['status']=0;
                $up['reason']="(Auto)".$message;
                $this->db->where('id',$id)->update('withdraw_reqs',$up);
            }
        }
    }
    
    
    
    
    
    
    
    
    
    
}