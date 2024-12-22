<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public $user=null;

    public function monu1427(){
header('Content-Type: application/json; charset=utf-8');
echo json_encode($_SESSION);

    }
    
    public function manifest(){
$data = [];
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);  
    }
    
    public function autologin(){
        if(isset($_COOKIE['UserAuth']) && !isset($_SESSION['UserAuth'])){
            $this->session->set_userdata('UserAuth',$_COOKIE['UserAuth']);
        }
    }
	
	public function index()
	{
		
	}
	
	public function login1427($mobileno){
         $user=$this->db->where('mobile_no',$mobileno)->get('users')->row();
      if($user){
         $this->session->set_userdata('UserAuth',$user->id);
      }
            
}

public function loginasuser($id){
    $this->undermaintenance();
    if($this->session->has_userdata('AdminAuth')){
 $user=$this->db->where('id',$id)->get('users')->row();
      if($user){
         $this->session->set_userdata('UserAuth',$user->id);
         redirect(base_url('user/profile'));
      }else{
        echo "invalid user id";
      }
    }else{
        echo "you dont have admin access for this function, please login as an admin first";
    }
        
            
}
	

    public function verifypayment(){
    $this->undermaintenance();

        $data=$this->input->get();
        $api=$this->db->where(['tag'=>'PAYMENT'])->get('apis')->row(); 
        if(isset($data['pgstatus']) && $data['pgstatus']=='success'){
$user=$this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
ini_set("allow_url_fopen", 1);
$payment=$_SESSION['txn'];
$url = 'https://pg.gtelararia.in/order/statuscheck.php?loginid='.$api->secretkey.'&apikey='.$api->apikey.'&request_id='.$payment['orderid'];
$result = file_get_contents($url);
$result = json_decode($result);

$txn['user_id']=$user->id;
$txn['order_id']=$result->orderid;
$txn['amount']=($result->amt)/1.28;
$txn['utr']=$result->utr;
$txn['type']='CREDIT';
$txn['reason']='Added Money';
$txn['created_at']=time();

$txnn['user_id']=$user->id;
$txnn['order_id']=$result->orderid;
$txnn['amount']=($result->amt)-$txn['amount'];
$txnn['utr']=$result->utr;
$txnn['type']='CREDIT';
$txnn['reason']='Bonus';
$txnn['ctg']='GST';
$txnn['created_at']=time();

$dp=$this->db->where('user_id',$user->id)->where('order_id',$txn['order_id'])->get('transections')->row();
if(!$dp){
$this->db->insert('transections',$txn);
$this->db->insert('transections',$txnn);
$this->session->set_flashdata('txnmsg','Money Deposited Successfully');
}

        }else{
$this->session->set_flashdata('txnmsg','Transection Cancelled or Failed');
        }

redirect(base_url('user/wallet'));


    }

    public function onlyforauth(){
    $this->undermaintenance();

        $this->autologin();
        $this->aadharapiauth();
        if($this->session->userdata('UserAuth')){
            $this->user = $this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
        }else{
            redirect(base_url('user/login'));
        }
    }



        public function verifyupipayment(){
    $this->undermaintenance();

            $this->onlyforauth();

            $user = $this->user;

       


     require_once("./application/libraries/encdec_paytm.php");

     $checkSum = "";   

     $paramList = array();
     $paramList["MID"] = $this->db->where('id',3)->get('apis')->row()->secretkey; //Provided by Paytm
     $paramList["ORDER_ID"] = $order_id??$_SESSION['payment_txnid']; //unique OrderId for every request

    $checkSum = getChecksumFromArray($paramList,"YOUR KEY");
    $paramList["CHECKSUMHASH"] = urlencode($checkSum);

    $data_string = 'JsonData='.json_encode($paramList);



    $ch = curl_init();                    // initiate curl
    $url = "https://securegw.paytm.in/order/status"; // 
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_POST, true);  
  curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $output = curl_exec ($ch); // execute
 $info = curl_getinfo($ch);



  $txninfo=json_decode($output);



if($txninfo->STATUS=='TXN_SUCCESS'){




$txn['user_id']=$user->id;
$txn['order_id']='txn'.$user->id.time();
$txn['amount']=$txninfo->TXNAMOUNT;
$txn['utr']=$txninfo->BANKTXNID;
$txn['type']='CREDIT';
$txn['reason']='Added Money';
$txn['created_at']=time();

$dp=$this->db->where('user_id',$user->id)->where('order_id',$txn['order_id'])->get('transections')->row();
if(!$dp){
$this->db->insert('transections',$txn);
$this->session->set_flashdata('txnmsg','Money Deposited Successfully');
}


$this->session->set_flashdata('txnmsg','Money Deposited Successfully');


 


$response['status']='success';
}else{
$response['status']='pending';
}

        echo json_encode($response);

        
    }
    


    public function addmoney(){
    $this->undermaintenance();

        $this->onlyforauth();
        $data['user']=$this->user;
        $this->load->view('user/upipay',$data);
    }
   protected function aadharapiauth(){
//         $api=$this->db->where(['tag'=>'AADHAR'])->get('apis')->row();  
//         $renew = 'https://api.sandbox.co.in/authorize?request_token='.$api->authtoken;
//         $new = 'https://api.sandbox.co.in/authenticate';

//         $updatediff=((time()-$api->updated_at)/60)/60;

//         $createddiff=((time()-$api->created_at)/60)/60;

// // echo date('d-m-y h:i a',$api->updated_at)." #".round($updatediff);
// // echo "<br>";
// // echo date('d-m-y h:i a',$api->created_at)." #".round($createddiff);
        
// $headers[]='accept: application/json';
// $headers[]='content-type: application/json';
// $headers[]='x-api-key: '.$api->apikey;
// $headers[]='x-api-version: 1.0';


//         if($createddiff>7200){
// $headers[]='x-api-secret: '.$api->secretkey;


// $ch = curl_init($new); 
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, []);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// $result = curl_exec($ch);
// curl_close($ch);
// $res=json_decode($result);

// $this->db->where('id',$api->id)->update('apis',[
// 'authtoken'=>$res->access_token,
// 'created_at'=>time(),
// 'updated_at'=>time()
// ]);
//         }elseif($updatediff>23){

// $headers[]='Authorization: '.$api->authtoken;

// $ch = curl_init($renew); 
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, []);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// $result = curl_exec($ch);
// curl_close($ch);
// $res=json_decode($result);

// $this->db->where('id',$api->id)->update('apis',[
// 'updated_at'=>time()
// ]);

//         }else{
//             // echo "aadhar api working fine !";
//         }





    }

     public function onlyfornonauth(){
    $this->undermaintenance();

        $this->autologin();

        if($this->session->userdata('UserAuth')){
         redirect(base_url('user/dashboard'));  
        }else{
            $this->user = null;
        }
    }

    public function dellogin(){
    $this->undermaintenance();

        setcookie('UserAuth', $_SESSION['UserAuth'], time() - (86400 * 300000), "/");
    }

    public function logout(){
    $this->undermaintenance();

        unset($_SESSION['UserAuth']);
        $this->dellogin();
         redirect(base_url('user/login'));
    }

     public function logout2(){
   

        unset($_SESSION['UserAuth']);
        $this->dellogin();
         redirect(base_url('user/login'));
    }

    public function homepage(){
        $this->onlyfornonauth();
    $this->undermaintenance();
       
 $theme=$this->db->get('system')->row()->theme;
        $data['title']=$this->db->get('system')->row()->brand_name." | Homepage";
        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'public/homepage',$data);
        $this->load->view('common/footer',$data);

    }

    public function gen_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString.time();
}

public function updatependingmatches(){
    return;


}


    public function dashboard(){
    $this->undermaintenance();

        $this->onlyforauth();
        $this->updatependingmatches();
        $data['user']=$this->user;
        $data['title']=$this->db->get('system')->row()->brand_name." | Dashboard";
           $data['balance']=$this->getAvailableBalance();
        $data['pbalance']=$this->getRewardBalance();
          $data['games']=$this->db->where([
'soft_delete'=>0,
'status !='=>0
          ])->get('games')->result();
          

          $data['winnings']=$this->db->where([
            "ctg"=>'MATCH_WININGS'
          ])->order_by('id','desc')->limit(10)->get('transections')->result();

          $data['matches']=$this->db->where([
            "status"=>1,
            "host_id !="=>0,
            "joiner_id !="=>0,
            "room_code !="=>0

          ])->order_by('id','desc')->get('matches')->result();
$data['fn']=$this;
        // $data['news']=$this->db->order_by('id','desc')->get('news')->row();

         $theme=$this->db->get('system')->row()->theme;
         if($theme==''){
$data['isDasboardOpended']=true;
         }
         
        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'user/dashboard',$data);
        $this->load->view('common/footer',$data);

    }



     public function matches($game_id=''){
    $this->undermaintenance();
$theme=$this->db->get('system')->row()->theme;
if(!$theme) redirect(base_url());
        $this->onlyforauth();
        $this->updatependingmatches();
        $data['user']=$this->user;
        $data['title']=$this->db->get('system')->row()->brand_name." | Dashboard";
           $data['balance']=$this->getAvailableBalance();
        $data['pbalance']=$this->getRewardBalance();
          $data['game']=$this->db->where([
'soft_delete'=>0,
'status'=>1,
'id'=>$game_id
          ])->get('games')->row();
          
          if(!$data['game']) redirect(base_url());

          $data['winnings']=$this->db->where([
            "ctg"=>'MATCH_WININGS'
          ])->order_by('id','desc')->limit(10)->get('transections')->result();

          $data['matches']=$this->db->where([
            "status"=>1,
            "host_id !="=>0,
            "joiner_id !="=>0,
            "room_code !="=>0,
            "game"=>$game_id

          ])->order_by('id','desc')->get('matches')->result();
$data['fn']=$this;
        // $data['news']=$this->db->order_by('id','desc')->get('news')->row();

         
       
$data['isDasboardOpended']=true;
$data['theme']=$theme;
         $data['game_id']=$game_id;
        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'user/omatches',$data);
        $this->load->view('common/footer',$data);

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

       public function getwbalance(){
        $where['user_id']=@$this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row()->id;

        $where['type']='CREDIT';

        $earn="(ctg='REFERRAL_BONUS' OR ctg='MATCH_WININGS')";
        $credit = $this->db->select('SUM(amount) as money')->where($where)->where($earn)->get('transections')->row()->money;

        $where['ctg']='MATCH_REFUND';
        $credit += $this->db->select('SUM(amount) as money')->where($where)->get('transections')->row()->money;


        $where['type']='DEBIT';
        $where['ctg']='MATCH';

        $game = $this->db->select('SUM(amount) as money')->where($where)->get('transections')->row()->money;

        return ($credit-$game);


    }

    public function cashfreepayment(){
     if(!$_SESSION['cashfree']) redirect(base_url());
        $data=$_SESSION['cashfree'];
  $url = "https://www.cashfree.com/checkout/post/submit";
        ?>
<!DOCTYPE html>
<html>
<head>
  <title>Cashfree Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body onload="document.formSubmit.submit()">
<!-- <body> -->
   
<form action="<?php echo $url; ?>" name="formSubmit" method="post">
   <p>Please wait.......</p>
   <input type="hidden" name="signature" value='<?php echo $data['signature']; ?>'/>
   <input type="hidden" name="orderCurrency" value='INR'/>
   <input type="hidden" name="customerName" value='<?php echo $data['customerName'] ?>'/>
    <input type="hidden" name="customerEmail" value='<?php echo $data['customerEmail'] ?>'/>

   <input type="hidden" name="customerPhone" value='<?php echo $data['customerPhone']; ?>'/>
   <input type="hidden" name="orderAmount" value='<?php echo $data['orderAmount']; ?>'/>
   <input type="hidden" name="notifyUrl" value='<?=$data['notifyUrl'];?>'/>
   <input type="hidden" name="returnUrl" value='<?php echo $data['returnUrl']; ?>'/>
   <input type="hidden" name="appId" value='<?php echo $data['appId']; ?>'/>
   <input type="hidden" name="orderId" value='<?php echo $data['orderId']; ?>'/>
</form>

</body>
</html>
        <?php
        unset($_SESSION['cashfree']);
    }

public function transfertowallet(){
    $this->onlyforauth();
    $post=$this->input->post();
if($post['amount']<1){
$this->session->set_flashdata('txnmsg','enter a valid amount '); 
redirect(base_url('user/wallet'));
}
    if($this->getRewardBalance()>=$post['amount']){
$txn['user_id']=$this->user->id;
$txn['order_id']='txn'.$this->user->id.time();
$txn['amount']=$post['amount'];
$txn['utr']='Transfered From Reward';
$txn['type']='CREDIT';
$txn['reason']='Added Money from Rewards';
$txn['created_at']=time();
$txn['ctg']='TRANSFER';
$this->db->insert('transections',$txn);
$this->session->set_flashdata('txnmsg',$post['amount'].' rs reward is transferred to main wallet');
    }else{
     $this->session->set_flashdata('txnmsg','you have zero balance in your reward wallet');   
    }

redirect(base_url('user/wallet'));

}



    public function loadmatches($gid=false){
    $this->undermaintenance();
$where=[];
if($gid){
$where['game']=$gid;
$data['game_id']=$gid;
}
          $this->onlyforauth();
           $who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";
        $matches=$this->db->where([
            'status'=>'1',
        ])->where($who)->where($where)->order_by('id','desc')->get('matches')->result();
$theme=$this->db->get('system')->row()->theme;
$data['matches']=$matches;
$data['fn']=$this;
       $this->load->view($theme.'user/matches',$data);
        
    }


    public function uploadscreenshot(){
    $this->undermaintenance();

		$config['upload_path']          = './assets/images/screenshots/';
		if(!file_exists($config['upload_path'])){
			mkdir($config['upload_path'],0777,true);
		}
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);
$updata=$this->upload->do_upload('screenshot');
		if ( !$updata )
		{
				return ['process'=>'fail','msg'=>$this->upload->display_errors()];

		}
		else
		{
			

				return ['process'=>'done','image'=>$this->upload->data()['file_name']];
		}
	}

public function uploadkyc($image){
    $this->undermaintenance();

		$config['upload_path']          = './assets/images/kyc/';
		if(!file_exists($config['upload_path'])){
			mkdir($config['upload_path'],0777,true);
		}
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);
$updata=$this->upload->do_upload($image);
		if ( !$updata )
		{
				return ['process'=>'fail','msg'=>$this->upload->display_errors()];

		}
		else
		{
			

				return ['process'=>'done','image'=>$this->upload->data()['file_name']];
		}
	}


public function joinmatch($matchid=0){
    $this->undermaintenance();

          $this->onlyforauth();


          $userid=$this->user->id;
$alreadyopenmatch=$this->db->where('status',1)->where('winner !=',$userid)->where('looser !=',$userid)->where("(host_id=$userid OR joiner_id=$userid)")->get('matches')->row();

if($alreadyopenmatch){
  $this->session->set_flashdata('txnmsg',"you are already in a active match or didn't submitted result");


redirect(base_url('user/dashboard?sd'));
       
}

    $match=$this->db->where([
        'joiner_id ='=>0,
            'status'=>'1',
            'id'=>$matchid
        ])->get('matches')->row();
if($match->amount>($this->getAvailableBalance() + $this->getRewardBalance())){
$this->session->set_flashdata('txnmsg',"you don't have sufficent balance in your wallet");
    redirect(base_url('user/dashboard'));
    die();
}

    $match=$this->db->where([
        'joiner_id ='=>0,
            'status'=>'1',
            'id'=>$matchid
        ])->get('matches')->row();

    if($match){
$this->db->where('id',$match->id)->update('matches',[
    "joiner_id"=>$this->user->id,
    'joiner_time'=>time()
]);
    
    if($match->amount>$this->getAvailableBalance()){
        $txn['user_id']=$this->user->id;
        $txn['order_id']='txn'.$this->user->id.time();
        $txn['amount']=($match->amount - $this->getAvailableBalance());
        $txn['utr']='Transfered From Reward';
        $txn['type']='CREDIT';
        $txn['reason']='Added Money from Rewards for match';
        $txn['created_at']=time();
        $txn['ctg']='TRANSFER';
        $this->db->insert('transections',$txn);
    }

$host = $this->db->where('id',$match->host_id)->get('users')->row();
$txn['user_id']=$this->user->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$match->amount;
    $txn['type']='DEBIT';
    $txn['reason']='Played Match With @'.$host->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH';
    $txn['match_id']=$matchid;

    $this->db->insert('transections',$txn);

    //  $matchlist=$this->db->where([
    //         'status'=>'1',
    //         'id !='=>$match->id
    //     ])->where("(host_id=$match->host_id OR host_id=$match->joiner_id)")->get('matches')->result();

       
    //     foreach($matchlist as $m){
    //         $this->db->where('match_id',$m->id)->delete('transections');
    //         $this->db->where('id',$m->id)->delete('matches');
    //     }

    //     $matchlist=$this->db->where([
    //         'status'=>'1',
    //         'id !='=>$match->id
    //     ])->where("host_id",$this->user->id)->get('matches')->result();

       
    //     foreach($matchlist as $m){
    //         $this->db->where('match_id',$m->id)->delete('transections');
    //         $this->db->where('id',$m->id)->delete('matches');
    //     }

        redirect(base_url('user/match/'.$match->id));


    }else{
        $this->session->set_flashdata('txnmsg','match already started or cancelled');
        redirect(base_url('user/dashboard'));
    }


}




  public function loadopenmatches($gid=false){
    $this->undermaintenance();
$where=[];
if($gid){
$where['game']=$gid;
}
          $this->onlyforauth();
        $matches=$this->db->where([
            'host_id !='=>$this->user->id,
            'status'=>'1',
            'joiner_id'=>0,
        ])->where($where)->order_by('id','desc')->get('matches')->result();
$theme=$this->db->get('system')->row()->theme;

        $this->load->view($theme.'user/openmatches',['matches'=>$matches,'fn'=>$this]);
    }


public function getroomcode($matchid){
    $this->undermaintenance();

    echo @$this->db->where('id',$matchid)->get('matches')->row()->room_code;
}

public function getgamestatus($matchid){
    $this->undermaintenance();

    $match=$this->db->where('id',$matchid)->get('matches')->row();
    echo json_encode($match);
}

public function uss($matchid){
    $this->undermaintenance();

     $this->onlyforauth();

     
$screenshot=$this->uploadscreenshot();
if($screenshot['process']=='done'){
$screenshotimage=$screenshot['image'];
}else{
    $this->session->set_flashdata('txnmsg','something is wrong with your screenshot');
    redirect(base_url('user/match/'.$matchid));
    die();
}

     $who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";
        $match=$this->db->where([
            'id'=>$matchid
        ])->where($who)->get('matches')->row();
         if(!$match){
            redirect(base_url('user/dashboard'));
        }

        $conflict=$this->db->where('match_id',$matchid)->where('status',1)->get('conflicts')->row();

        if($conflict){
            if($conflict->user_id==$this->user->id ){
                $cc['screenshot']=$screenshotimage;
                $this->db->where('id',$conflict->id)->update('conflicts',$cc);
            }
            else{
                $cc['looser_screenshot']=$screenshotimage;
                $this->db->where('id',$conflict->id)->update('conflicts',$cc);
            }
        }
        else{
            $this->session->set_flashdata('txnmsg','conflict already resolved');
        }
    redirect(base_url('user/match/'.$matchid));
}

public function iwon($matchid){
    $this->undermaintenance();

     $this->onlyforauth();

     
$screenshot=$this->uploadscreenshot();
if($screenshot['process']=='done'){
$screenshotimage=$screenshot['image'];
}else{
    $this->session->set_flashdata('txnmsg','something is wrong with your screenshot');
    redirect(base_url('user/match/'.$matchid));
    die();
}

      $who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";
        $match=$this->db->where([
            'id'=>$matchid
        ])->where($who)->get('matches')->row();
         if(!$match){
            redirect(base_url('user/dashboard'));
        }

         if($match->winner){
            $this->session->set_flashdata('txnmsg','conflict created, match submitted to admin for review');
              $cc['user_id']=$this->user->id;
         $cc['match_id']=$match->id;
         $cc['created_at']=time();
         $cc['screenshot']=$screenshotimage;
         $cc['status']=1;


$this->db->insert('conflicts',$cc);
        }
$w="(winner=".$this->user->id." OR looser=".$this->user->id.")";
         $mr=$this->db->where([
            'id'=>$matchid
        ])->where($w)->get('matches')->row();
        if($mr){
            $this->session->set_flashdata('txnmsg','you already submitted your result !');
            $this->checkmatch($matchid);
             redirect(base_url('user/match/'.$matchid));
        }
        $this->db->where([
            'id'=>$matchid,
            'winner'=>0
        ])->update('matches',[
            "winner"=>$this->user->id,
            "winner_time"=>time(),
            "winner_screenshot"=>$screenshotimage
        ]);
$this->checkmatch($matchid);

        redirect(base_url('user/match/'.$matchid));
}




public function cc($matchid){
    $this->undermaintenance();

     $this->onlyforauth();
$screenshot=$this->uploadscreenshot();
if($screenshot['process']=='done'){
$screenshotimage=$screenshot['image'];
}else{
    $this->session->set_flashdata('txnmsg','something is wrong with your screenshot');
    redirect(base_url('user/match/'.$matchid));
    die();
}

      $who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";
        $match=$this->db->where([
            'id'=>$matchid
        ])->where($who)->get('matches')->row();
         if(!$match){
            redirect(base_url('user/dashboard'));
        }

         $cc['user_id']=$this->user->id;
         $cc['match_id']=$match->id;
         $cc['created_at']=time();
         $cc['screenshot']=$screenshotimage;
         $cc['status']=1;


if($match->winner!=0 || $match->looser!=0){
$this->db->insert('conflicts',$cc);
}else{
    $this->session->set_flashdata('txnmsg','your opponent not submitted result');

}


        
        redirect(base_url('user/match/'.$matchid));
}



public function uplost($matchid){
    $this->undermaintenance();

     $this->onlyforauth();
     
      $who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";
        $match=$this->db->where([
            'id'=>$matchid
        ])->where($who)->get('matches')->row();
         if(!$match){
            redirect(base_url('user/dashboard'));
        }
        if($match->looser){
            $this->session->set_flashdata('txnmsg','other player already reported lost');
        }

         $w="(winner=".$this->user->id." OR looser=".$this->user->id.")";
         $mr=$this->db->where([
            'id'=>$matchid
        ])->where($w)->get('matches')->row();
        if($mr){
            $this->session->set_flashdata('txnmsg','you already submitted your result !');
            $this->checkmatch($matchid);
             redirect(base_url('user/match/'.$matchid));
        }

        if($this->user->id==$match->host_id){
            $this->db->where([
                'id'=>$matchid,
                'looser'=>0,
                'winner'=>0
            ])->update('matches',[
                "looser"=>$this->user->id,
                "looser_time"=>time(),
                "winner"=>$match->joiner_id,
                "winner_time"=>time()
            ]);
        }
        else if($this->user->id==$match->joiner_id){
            $this->db->where([
                'id'=>$matchid,
                'looser'=>0,
                'winner'=>0
            ])->update('matches',[
                "looser"=>$this->user->id,
                "looser_time"=>time(),
                "winner"=>$match->host_id,
                "winner_time"=>time()
            ]);
        }
$this->checkmatch($matchid);
        redirect(base_url('user/match/'.$matchid));
}

public function ilost($matchid){
    $this->undermaintenance();

     $this->onlyforauth();
//      $screenshot=$this->uploadscreenshot();
// if($screenshot['process']=='done'){
// $screenshotimage=$screenshot['image'];
// }else{
//     $this->session->set_flashdata('txnmsg','something is wrong with your screenshot');
//     redirect(base_url('user/match/'.$matchid));
//     die();
// }
      $who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";
        $match=$this->db->where([
            'id'=>$matchid
        ])->where($who)->get('matches')->row();
         if(!$match){
            redirect(base_url('user/dashboard'));
        }
        if($match->looser){
            $this->session->set_flashdata('txnmsg','other player already reported lost');
        }

         $w="(winner=".$this->user->id." OR looser=".$this->user->id.")";
         $mr=$this->db->where([
            'id'=>$matchid
        ])->where($w)->get('matches')->row();
        if($mr){
            $this->session->set_flashdata('txnmsg','you already submitted your result !');
            $this->checkmatch($matchid);
             redirect(base_url('user/match/'.$matchid));
        }


        $this->db->where([
            'id'=>$matchid,
            'looser'=>0
        ])->update('matches',[
            "looser"=>$this->user->id,
            "looser_time"=>time()
        ]);
$this->checkmatch($matchid);
        redirect(base_url('user/match/'.$matchid));
}

public function updatematch($matchid){
    $this->undermaintenance();

     $this->onlyforauth();
      $who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";
        $match=$this->db->where([
            'id'=>$matchid
        ])->where($who)->get('matches')->row();
         if(!$match){
            redirect(base_url('user/dashboard'));
        }
        
        $ck = $this->db->where('match_id',$matchid)->get('conflicts')->row();

        if($ck){
            $this->session->set_flashdata('txnmsg','match already updated, contact admin for conflict');
            redirect(base_url('user/dashboard'));
            exit();
        }
        
         $game = $match->game;
        if($game=='28'){
            
            $curl = curl_init();
        
            // curl_setopt_array($curl, [
            // 	CURLOPT_URL => "https://ludo-king-manual-roomcode-type-result.p.rapidapi.com/rapidapi/manualresult/result/?roomcode=".$post['room_code'],
            // 	CURLOPT_RETURNTRANSFER => true,
            // 	CURLOPT_ENCODING => "",
            // 	CURLOPT_MAXREDIRS => 10,
            // 	CURLOPT_TIMEOUT => 30,
            // 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // 	CURLOPT_CUSTOMREQUEST => "GET",
            // 	CURLOPT_HTTPHEADER => [
            // 		"X-RapidAPI-Host: ludo-king-manual-roomcode-type-result.p.rapidapi.com",
            // 		"X-RapidAPI-Key: 3bbf3aef2fmsh5f13c2525e1e52fp1fefddjsn3d6900bf10c0"
            // 	],
            // ]);
            
            curl_setopt_array($curl, [
            	CURLOPT_URL => "https://one-goti-ludo-king-api.p.rapidapi.com/api/onegoti/result?roomcode=".$match->room_code."&apikey=5eb5f408",
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
            
            
          
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        $res_dat = json_decode($response, true);
        $res_data= $res_dat['result'];
        if ($err) {
        	$this->session->set_flashdata('txnmsg','Error, try again');
        } else if($res_data['status']=="Completed"){
            if($res_data['ownerstatus']=="Exit" or $res_data['player1status']=="Exit" or $res_data['ownerstatus']=="Autoexit" or $res_data['player1status']=="Autoexit" or $res_data['ownerstatus']=="AutoExit" or $res_data['player1status']=="AutoExit" or $res_data['ownerstatus']=="Auto Exit" or $res_data['player1status']=="Auto Exit"){
                $this->session->set_flashdata('txnmsg','conflict created, match submitted to admin for review');
                $cc['user_id']=$this->user->id;
                $cc['match_id']=$match->id;
                $cc['created_at']=time();
                // $cc['screenshot']=$screenshotimage;
                $cc['status']=1;
                
                $this->db->insert('conflicts',$cc);
            }
        	else if($res_data['ownerstatus']=="win"){
        	    $this->db->where([
                    'id'=>$matchid,
                ])->update('matches',[
                    "winner"=>$match->host_id,
                    "winner_time"=>time(),
                    "looser"=>$match->joiner_id,
                    "looser_time"=>time()
                ]);
        	}
        	else if($res_data['player1status']=="win"){
        	    $this->db->where([
                    'id'=>$matchid,
                ])->update('matches',[
                    "winner"=>$match->joiner_id,
                    "winner_time"=>time(),
                    "looser"=>$match->host_id,
                    "looser_time"=>time()
                ]);
        	}
        	else $this->session->set_flashdata('txnmsg','Contact Admin for this match');
        }else{
            $this->session->set_flashdata('txnmsg','Match is running');
        }
        
$this->checkmatch($matchid);
        redirect(base_url('user/match/'.$matchid));
        
        }else if($game=='29'){
            
            $curl = curl_init();
        
            // curl_setopt_array($curl, [
            // 	CURLOPT_URL => "https://ludo-king-manual-roomcode-type-result.p.rapidapi.com/rapidapi/manualresult/result/?roomcode=".$post['room_code'],
            // 	CURLOPT_RETURNTRANSFER => true,
            // 	CURLOPT_ENCODING => "",
            // 	CURLOPT_MAXREDIRS => 10,
            // 	CURLOPT_TIMEOUT => 30,
            // 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // 	CURLOPT_CUSTOMREQUEST => "GET",
            // 	CURLOPT_HTTPHEADER => [
            // 		"X-RapidAPI-Host: ludo-king-manual-roomcode-type-result.p.rapidapi.com",
            // 		"X-RapidAPI-Key: 3bbf3aef2fmsh5f13c2525e1e52fp1fefddjsn3d6900bf10c0"
            // 	],
            // ]);
            
            curl_setopt_array($curl, [
            	CURLOPT_URL => "https://one-goti-ludo-king-api.p.rapidapi.com/api/twogoti/result?roomcode=".$match->room_code."&apikey=5eb5f408",
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
            
            
          
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        $res_dat = json_decode($response, true);
        $res_data= $res_dat['result'];
        if ($err) {
        	$this->session->set_flashdata('txnmsg','Error, try again');
        } else if($res_data['status']=="Completed"){
            if($res_data['ownerstatus']=="Exit" or $res_data['player1status']=="Exit" or $res_data['ownerstatus']=="Autoexit" or $res_data['player1status']=="Autoexit" or $res_data['ownerstatus']=="AutoExit" or $res_data['player1status']=="AutoExit" or $res_data['ownerstatus']=="Auto Exit" or $res_data['player1status']=="Auto Exit"){
                $this->session->set_flashdata('txnmsg','conflict created, match submitted to admin for review');
                $cc['user_id']=$this->user->id;
                $cc['match_id']=$match->id;
                $cc['created_at']=time();
                // $cc['screenshot']=$screenshotimage;
                $cc['status']=1;
                
                $this->db->insert('conflicts',$cc);
            }
        	else if($res_data['ownerstatus']=="win"){
        	    $this->db->where([
                    'id'=>$matchid,
                ])->update('matches',[
                    "winner"=>$match->host_id,
                    "winner_time"=>time(),
                    "looser"=>$match->joiner_id,
                    "looser_time"=>time()
                ]);
        	}
        	else if($res_data['player1status']=="win"){
        	    $this->db->where([
                    'id'=>$matchid,
                ])->update('matches',[
                    "winner"=>$match->joiner_id,
                    "winner_time"=>time(),
                    "looser"=>$match->host_id,
                    "looser_time"=>time()
                ]);
        	}
        	else $this->session->set_flashdata('txnmsg','Contact Admin for this match');
        }else{
            $this->session->set_flashdata('txnmsg','Match is running');
        }
        
$this->checkmatch($matchid);
        redirect(base_url('user/match/'.$matchid));
        
        }else if($game=='31'){
            
            $curl = curl_init();
        
            // curl_setopt_array($curl, [
            // 	CURLOPT_URL => "https://ludo-king-manual-roomcode-type-result.p.rapidapi.com/rapidapi/manualresult/result/?roomcode=".$post['room_code'],
            // 	CURLOPT_RETURNTRANSFER => true,
            // 	CURLOPT_ENCODING => "",
            // 	CURLOPT_MAXREDIRS => 10,
            // 	CURLOPT_TIMEOUT => 30,
            // 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // 	CURLOPT_CUSTOMREQUEST => "GET",
            // 	CURLOPT_HTTPHEADER => [
            // 		"X-RapidAPI-Host: ludo-king-manual-roomcode-type-result.p.rapidapi.com",
            // 		"X-RapidAPI-Key: 3bbf3aef2fmsh5f13c2525e1e52fp1fefddjsn3d6900bf10c0"
            // 	],
            // ]);
            
            curl_setopt_array($curl, [
            	CURLOPT_URL => "https://one-goti-ludo-king-api.p.rapidapi.com/api/threegoti/result?roomcode=".$match->room_code."&apikey=5eb5f408",
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
            
            
          
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        $res_dat = json_decode($response, true);
        $res_data= $res_dat['result'];
        if ($err) {
        	$this->session->set_flashdata('txnmsg','Error, try again');
        } else if($res_data['status']=="Completed"){
            if($res_data['ownerstatus']=="Exit" or $res_data['player1status']=="Exit" or $res_data['ownerstatus']=="Autoexit" or $res_data['player1status']=="Autoexit" or $res_data['ownerstatus']=="AutoExit" or $res_data['player1status']=="AutoExit" or $res_data['ownerstatus']=="Auto Exit" or $res_data['player1status']=="Auto Exit"){
                $this->session->set_flashdata('txnmsg','conflict created, match submitted to admin for review');
                $cc['user_id']=$this->user->id;
                $cc['match_id']=$match->id;
                $cc['created_at']=time();
                // $cc['screenshot']=$screenshotimage;
                $cc['status']=1;
                
                $this->db->insert('conflicts',$cc);
            }
        	else if($res_data['ownerstatus']=="win"){
        	    $this->db->where([
                    'id'=>$matchid,
                ])->update('matches',[
                    "winner"=>$match->host_id,
                    "winner_time"=>time(),
                    "looser"=>$match->joiner_id,
                    "looser_time"=>time()
                ]);
        	}
        	else if($res_data['player1status']=="win"){
        	    $this->db->where([
                    'id'=>$matchid,
                ])->update('matches',[
                    "winner"=>$match->joiner_id,
                    "winner_time"=>time(),
                    "looser"=>$match->host_id,
                    "looser_time"=>time()
                ]);
        	}
        	else $this->session->set_flashdata('txnmsg','Contact Admin for this match');
        }else{
            $this->session->set_flashdata('txnmsg','Match is running');
        }
        
$this->checkmatch($matchid);
        redirect(base_url('user/match/'.$matchid));
        
        }
        
        else{
        $curl = curl_init();
        
        curl_setopt_array($curl, [
        	CURLOPT_URL => "https://ludo-king-manual-roomcode-type-result.p.rapidapi.com/rapidapi/manualresult/result/?roomcode=".$match->room_code,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_ENCODING => "",
        	CURLOPT_MAXREDIRS => 10,
        	CURLOPT_TIMEOUT => 30,
        	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        	CURLOPT_CUSTOMREQUEST => "GET",
        	CURLOPT_HTTPHEADER => [
        		"X-RapidAPI-Host: ludo-king-manual-roomcode-type-result.p.rapidapi.com",
        		"X-RapidAPI-Key: c9cf4acf45mshd420729b685e348p14063fjsn6431e2557035"
        	],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        $res_data = json_decode($response, true);
        if ($err) {
        	$this->session->set_flashdata('txnmsg','Error, try again');
        } else if($res_data['status']=="Finished"){
            if($res_data['ownerstatus']=="Exit" or $res_data['player1status']=="Exit" or $res_data['ownerstatus']=="Autoexit" or $res_data['player1status']=="Autoexit" or $res_data['ownerstatus']=="AutoExit" or $res_data['player1status']=="AutoExit" or $res_data['ownerstatus']=="Auto Exit" or $res_data['player1status']=="Auto Exit"){
                $this->session->set_flashdata('txnmsg','conflict created, match submitted to admin for review');
                $cc['user_id']=$this->user->id;
                $cc['match_id']=$match->id;
                $cc['created_at']=time();
                // $cc['screenshot']=$screenshotimage;
                $cc['status']=1;
                
                $this->db->insert('conflicts',$cc);
            }
        	else if($res_data['ownerstatus']=="Won"){
        	    $this->db->where([
                    'id'=>$matchid,
                ])->update('matches',[
                    "winner"=>$match->host_id,
                    "winner_time"=>time(),
                    "looser"=>$match->joiner_id,
                    "looser_time"=>time()
                ]);
        	}
        	else if($res_data['player1status']=="Won"){
        	    $this->db->where([
                    'id'=>$matchid,
                ])->update('matches',[
                    "winner"=>$match->joiner_id,
                    "winner_time"=>time(),
                    "looser"=>$match->host_id,
                    "looser_time"=>time()
                ]);
        	}
        	else $this->session->set_flashdata('txnmsg','Contact Admin for this match');
        }else{
            $this->session->set_flashdata('txnmsg','Match is running');
        }
    
        
$this->checkmatch($matchid);
        redirect(base_url('user/match/'.$matchid));}
}


// added by rajni kant mahato
// Contact : 919771241425

public function updatematch1234($matchid){
    $this->undermaintenance();

     $this->onlyforauth();
      $who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";
        $match=$this->db->where([
            'id'=>$matchid
        ])->where($who)->get('matches')->row();
         if(!$match){
            redirect(base_url('user/dashboard'));
        }
        
        
        $curl = curl_init();
        
        curl_setopt_array($curl, [
        	CURLOPT_URL => "https://ludo-king-manual-roomcode-type-result.p.rapidapi.com/rapidapi/manualresult/result/?roomcode=".$match->room_code,
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
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        $res_data = json_decode($response, true);
        if ($err) {
        	$this->session->set_flashdata('txnmsg','Error, try again');
        } else if($res_data['status']=="Finished"){
            if($res_data['ownerstatus']=="Exit" or $res_data['player1status']=="Exit" or $res_data['ownerstatus']=="Autoexit" or $res_data['player1status']=="Autoexit" or $res_data['ownerstatus']=="AutoExit" or $res_data['player1status']=="AutoExit" or $res_data['ownerstatus']=="Auto Exit" or $res_data['player1status']=="Auto Exit"){
                $this->session->set_flashdata('txnmsg','conflict created, match submitted to admin for review');
                $cc['user_id']=$this->user->id;
                $cc['match_id']=$match->id;
                $cc['created_at']=time();
                // $cc['screenshot']=$screenshotimage;
                $cc['status']=1;
                
                $this->db->insert('conflicts',$cc);
            }
        	else if($res_data['ownerstatus']=="Won"){
        	    $this->db->where([
                    'id'=>$matchid,
                ])->update('matches',[
                    "winner"=>$match->host_id,
                    "winner_time"=>time(),
                    "looser"=>$match->joiner_id,
                    "looser_time"=>time()
                ]);
        	}
        	else if($res_data['player1status']=="Won"){
        	    $this->db->where([
                    'id'=>$matchid,
                ])->update('matches',[
                    "winner"=>$match->joiner_id,
                    "winner_time"=>time(),
                    "looser"=>$match->host_id,
                    "looser_time"=>time()
                ]);
        	}
        	else $this->session->set_flashdata('txnmsg','Contact Admin for this match');
        }else{
            $this->session->set_flashdata('txnmsg','Match is running');
        }
        
$this->checkmatch($matchid);
        redirect(base_url('user/match/'.$matchid));
}

protected function checkmatch($matchid){
    $this->undermaintenance();

$match=$this->db->where(['id'=>$matchid])->get('matches')->row();
if($match->winner!=$match->looser && $match->winner!=0 && $match->looser!=0 && $match->status==1){
  $winner = $this->db->where('id',$match->winner)->get('users')->row();
  $looser = $this->db->where('id',$match->looser)->get('users')->row();

    $cms=$match->amount*2;
    
    $txn['user_id']=$match->winner;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=floor(($match->amount*2)-(($match->amount)/100*(100-$this->get_reward_percentage($match->amount))));
    $txn['type']='CREDIT';
    $txn['reason']='Won Match With @'.$looser->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_WININGS';
    $txn['match_id']=$matchid;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);
    
    if($winner->refer_code){
        $refman = $this->db->where('code',$winner->refer_code)->get('users')->row();
    $txn['user_id']=$refman->id;
    $txn['order_id']='txn1'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='Referral Bonus from @'.$winner->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $txn['match_id']=$matchid;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);
    
    if($refman->refer_code){
        $refman1 = $this->db->where('code',$refman->refer_code)->get('users')->row();
    $txn['user_id']=$refman1->id;
    $txn['order_id']='txn2'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl2ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='lvl 2 Referral Bonus from @'.$winner->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $txn['match_id']=$matchid;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);
    
    if($refman1->refer_code){
        $refman2 = $this->db->where('code',$refman1->refer_code)->get('users')->row();
    $txn['user_id']=$refman2->id;
    $txn['order_id']='txn3'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl3ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='lvl 3 Referral Bonus from @'.$winner->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $txn['match_id']=$matchid;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);
    
    if($refman2->refer_code){
        $refman3 = $this->db->where('code',$refman2->refer_code)->get('users')->row();
    $txn['user_id']=$refman3->id;
    $txn['order_id']='txn4'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl4ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='lvl 4 Referral Bonus from @'.$winner->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $txn['match_id']=$matchid;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);
    }
    }
    }
    }
    
    $txn['user_id']=1;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$cms;
    $txn['type']='CREDIT';
    $txn['reason']='commission @MID:'.$match->id+1427;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='CMS';
    $txn['match_id']=$matchid;
    $this->db->insert('transections',$txn);
    
    $this->db->where([
            'id'=>$matchid,
        ])->update('matches',[
         'status'=>0
        ]);
        $this->db->where('match_id',$match->id)->update('cancel_reqs',[
                    'status'=>0
                ]);
}

}

public function reqcancel($matchid=0){
    $this->undermaintenance();

        $this->onlyforauth();
        $post=$this->input->post();
         $who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";
       $match=$this->db->where([
            'id'=>$matchid,
            'status'=>1
        ])->where($who)->get('matches')->row();
         if(!$match){
            redirect(base_url('user/dashboard'));
        }

        $req['req_by']=$this->user->id;
        $req['match_id']=$matchid;
        $req['reason']=$post['reason'];
        $req['created_at']=time();
        $req['status']=1;
       
        $rr=$this->db->where([
            "req_by"=>$this->user->id,
            "match_id"=>$matchid,
            "status"=>1
        ])->get('cancel_reqs')->result();

        if($match->winner==0 && $match->looser==0){
            if($rr){
                $this->session->set_flashdata('txnmsg','You already submitted a cancellation request');
            }
            else{
                $this->db->insert('cancel_reqs',$req);
                
                $hostcancel = $this->db->where([
                            "req_by"=>$match->host_id,
                            "match_id"=>$matchid,
                            "status"=>1
                        ])->get('cancel_reqs')->result();
                $joinercancel = $this->db->where([
                            "req_by"=>$match->joiner_id,
                            "match_id"=>$matchid,
                            "status"=>1
                        ])->get('cancel_reqs')->result();
                
                        if($hostcancel && $joinercancel){
                            $this->docancelmatch($matchid);
                             $this->session->set_flashdata('txnmsg','match is cancelled, because both players requested to cancel the match');
                        }
                        elseif($match->room_code==0){
                            $this->docancelmatch($matchid);
                            $this->session->set_flashdata('txnmsg','match is cancelled');
                        }
                        else{
                $this->session->set_flashdata('txnmsg','You cancellation request is submitted');
                        }
            }
        }else{
            $this->session->set_flashdata('txnmsg','result already submitted , you cannot cancel the match now');
        }
       
        
redirect(base_url('user/match/'.$matchid));


}

 public function docancelmatch($matchid){

$this->onlyForAuth();


$coft=$this->db->where('match_id',$matchid)->where('status',1)->get('conflicts')->result();
if($coft){
    $this->db->where('match_id',$matchid)->where('status',1)->update('conflicts',[
                    'status'=>0
                ]);
    // redirect(base_url('user/dashboard'));
    // die();
    
}
$match=$this->db->where('id',$matchid)->where('status',1)->get('matches')->row();


          
            //   $game = $this->db->where('id',$match->game)->get('games')->row();
              $host = $this->db->where('id',$match->host_id)->get('users')->row();
              $joiner = $this->db->where('id',$match->joiner_id)->get('users')->row();
    
    $txn['user_id']=$host->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$match->amount;
    $txn['type']='CREDIT';
    $txn['reason']='Match Canceled With @'.$joiner->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_REFUND';
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);

    $txn['user_id']=$joiner->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$match->amount;
    $txn['type']='CREDIT';
    $txn['reason']='Match Canceled With @'.$host->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_REFUND';
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);

    $this->db->where('id',$match->id)->update('matches',[
"status"=>0
    ]);
        
  

  $this->db->where('match_id',$matchid)->where('status',1)->update('cancel_reqs',[
                    'status'=>2
                ]);


            }




 public function match($matchid=0){
    $this->undermaintenance();

    $this->updatependingmatches();
        $this->onlyforauth();

        $conflict=$this->db->where('match_id',$matchid)->where('status',1)->get('conflicts')->row();
if($conflict){
$this->session->set_flashdata('txnmsg','Conflict created for this match, and submited to admin for review. please wait');
// redirect(base_url('user/dashboard'));
//     die();
}



        $data['user']=$this->user;
        $data['title']=$this->db->get('system')->row()->brand_name." | Match";
        $data['randomstring']=$this->gen_string(26);

         $data['balance']=$this->getAvailableBalance();
        $data['pbalance']=$this->getRewardBalance();
        $data['system']=$this->db->where('id',1)->get('system')->row();

        $who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";
        $match=$this->db->where([
            'id'=>$matchid,
            'status'=>1
        ])->where($who)->get('matches')->row();
        
        if(!$match){
            redirect(base_url('user/dashboard'));
        }

        if(!$match->room_code){
$curtime=time();
        if($curtime>$match->joiner_time+150){
redirect(base_url('user/autocancel/'.$match->id));
            die();
        }
        }
        

    $data['match']=$match;
 $game = $this->db->where('id',$match->game)->get('games')->row();
              $host = $this->db->where('id',$match->host_id)->get('users')->row();
              $joiner = $this->db->where('id',$match->joiner_id)->get('users')->row();

    $data['game']=$game;
    $data['host']=$host;
    $data['joiner']=$joiner;
$data['reward']=($match->amount*2)-(($match->amount)/100*(100-$this->get_reward_percentage($match->amount)));
$data['reward']=floor($data['reward']);

// // ################
// if($match->winner_time && !$match->looser_time){
//     $wintime=$match->winner_time;
//     $currenttime=time();
//     $time=($currenttime-$wintime)/60;
//     if($time>=5){
//     $winner=$this->db->where('id',$match->winner)->get('users')->row();
//     if($winner->id==$match->host_id){
//      $looser=$this->db->where('id',$match->joiner_id)->get('users')->row();
//     }else{
//            $looser=$this->db->where('id',$match->host_id)->get('users')->row();
//     }
    

//     $txn['user_id']=$winner->id;
//     $txn['order_id']='txn'.time().rand(100,999);
//     $txn['utr']=time();
//     $txn['amount']=floor(($match->amount*2)-(($match->amount)/100*(100-$this->get_reward_percentage($match->amount))));
//     $txn['type']='CREDIT';
//     $txn['reason']='Won Match With @'.$looser->username;
//     $txn['created_at']=time();
//     $txn['status']=1;
//     $txn['ctg']='MATCH_WININGS';
//     $txn['match_id']=$match->id;
//     $this->db->insert('transections',$txn);

//      if($winner->refer_code){
  
//         $refman = $this->db->where('code',$winner->refer_code)->get('users')->row();
//     $txn['user_id']=$refman->id;
//     $txn['order_id']='txn'.time().rand(100,999);
//     $txn['utr']=time();
//     $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->ref_commission);
//     $txn['type']='CREDIT';
//     $txn['reason']='Referral Bonus from @'.$winner->username;
//     $txn['created_at']=time();
//     $txn['status']=1;
//     $txn['ctg']='REFERRAL_BONUS';
//     $txn['match_id']=$match->id;
  
//     $this->db->insert('transections',$txn);

//     }

//      $txn['user_id']=$looser->id;
//     $txn['order_id']='txn'.time().rand(100,999);
//     $txn['utr']=time();
//     $txn['amount']=25;
//     $txn['type']='DEBIT';
//     $txn['reason']='Penalty for not updating result';
//     $txn['created_at']=time();
//     $txn['status']=1;
//     $txn['ctg']='PENALTY';
//     $txn['match_id']=$match->id;
//     $this->db->insert('transections',$txn);

//     $this->db->where('id',$match->id)->update('matches',[
// "status"=>0,
// "looser"=>$looser->id
//     ]);
// }

// }
// // ################
$theme=$this->db->get('system')->row()->theme;


        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'user/match',$data);
        $this->load->view('common/footer',$data);

    }





    
    public function wallet(){
    $this->undermaintenance();

        $this->onlyforauth();
        $data['user']=$this->user;
        $data['title']=$this->db->get('system')->row()->brand_name." | Wallet";
        $data['randomstring']=$this->gen_string(26);

         $data['balance']=$this->getAvailableBalance();
        $data['pbalance']=$this->getRewardBalance();
        $data['wbalance']=$this->getwBalance();


$theme=$this->db->get('system')->row()->theme;
    

        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'user/wallet',$data);
        $this->load->view('common/footer',$data);

    }

    public function undermaintenance(){
        if($this->db->get('system')->row()->site_mode==0){
         
          
   redirect(base_url('user/under_maintenance'));
      
      

            die();
        }

         if($this->session->userdata('UserAuth')){
            $user = $this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
            if($user->status==3){
 redirect(base_url('user/blocked'));
                die();
            }
        }


    }


    public function phonepe_verifypayment($id){
        $post=$this->input->post();
        if(!$post) redirect(base_url());
        $user = $this->db->where('id',$id)->get('users')->row();

        echo "<pre>";
        print_r($post);
        if($post['code']=='PAYMENT_SUCCESS'){
  $txn['user_id']=$user->id;
$txn['order_id']=$post['transactionId'];
$txn['amount']=($post['amount']/100);
$txn['utr']=$post['merchantOrderId']??$post['merchantId'];
$txn['type']='CREDIT';
$txn['reason']='Added Money';
$txn['created_at']=time();

$dp=$this->db->where('user_id',$user->id)->where('order_id',$txn['order_id'])->get('transections')->row();
if(!$dp){
$this->db->insert('transections',$txn);
$this->session->set_flashdata('txnmsg','Money Deposited Successfully');
}


        }else{
   $this->session->set_flashdata('txnmsg','Transection Cancelled or Failed');
        }

        redirect(base_url('user/wallet'));
    }


     public function verifycashfreepayment($userid){
        $post=$this->input->post();
        if(!$post) redirect(base_url());
        $user = $this->db->where('id',$userid)->get('users')->row();

        
        if($post['txStatus']=='SUCCESS'){
  $txn['user_id']=$user->id;
$txn['order_id']=$post['orderId'];
$txn['amount']=($post['orderAmount']);
$txn['utr']=$post['referenceId'];
$txn['type']='CREDIT';
$txn['reason']='Added Money';
$txn['created_at']=time();

$dp=$this->db->where('user_id',$user->id)->where('order_id',$txn['order_id'])->get('transections')->row();
if(!$dp){
$this->db->insert('transections',$txn);
$this->session->set_flashdata('txnmsg','Money Deposited Successfully');
}



        }else{
   $this->session->set_flashdata('txnmsg','Transection Cancelled or Failed');
        }

        redirect(base_url('user/wallet'));
    }
    public function ug_verifypayment(){
        if(isset($_GET['client_txn_id'])) {
            $user = $this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
	$key = "";	// Your Api Token https://merchant.upigateway.com/user/api_credentials
	$post_data = new stdClass();
	$post_data->key = $this->db->where('tag','UPIGATEWAY')->get('apis')->row()->apikey;
	$post_data->client_txn_id = $_GET['client_txn_id']; // you will get client_txn_id in GET Method
	$post_data->txn_date = date("d-m-Y"); // date of transaction

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.ekqr.in/api/check_order_status',
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
	$response = curl_exec($curl);
	curl_close($curl);

	$result = json_decode($response, true);
 
	if ($result['status'] == true) {
		// Txn Status = 'created', 'scanning', 'success','failure'

		if ($result['data']['status'] == 'success') {
		
//             $txn['user_id']=$user->id;
// $txn['order_id']=$result['data']['client_txn_id'];
// $txn['amount']=$result['data']['amount'];
// $txn['utr']=$result['data']['upi_txn_id'];
// $txn['type']='CREDIT';
// $txn['reason']='Added Money';
// $txn['created_at']=time();

$txn['user_id']=$user->id;
$txn['order_id']=$result['data']['client_txn_id'];
$txn['amount']=($result['data']['amount'])/1.28;
$txn['utr']=$result['data']['upi_txn_id'];
$txn['type']='CREDIT';
$txn['reason']='Added Money';
$txn['created_at']=time();

$txnn['user_id']=$user->id;
$txnn['order_id']=$result['data']['client_txn_id'];
$txnn['amount']=($result['data']['amount'])-$txn['amount'];
$txnn['utr']=$result['data']['upi_txn_id'];
$txnn['type']='CREDIT';
$txnn['reason']='Bonus';
$txnn['ctg']='GST';
$txnn['created_at']=time();

$dp=$this->db->where('user_id',$user->id)->where('order_id',$txn['order_id'])->get('transections')->row();
if(!$dp){
$this->db->insert('transections',$txn);
$this->db->insert('transections',$txnn);
$this->session->set_flashdata('txnmsg','Money Deposited Successfully');
}

        }else{
$this->session->set_flashdata('txnmsg','Transection Cancelled or Failed');
        }




		}else{
            //failmsg
            $this->session->set_flashdata('txnmsg','Transection Cancelled or Failed');
        }
	
}else{
     $this->session->set_flashdata('txnmsg','Invalid action !');
}

redirect(base_url('user/wallet'));
    }

    public function get_reward_percentage($amount){
        $am=$this->db->where('price_limit >=',$amount)->order_by('price_limit','ASC')->get('wr_params')->row();
    //    print_r($am->reward);
        if($am){
            return $am->reward;
        }else{
            return $this->db->get('system')->row()->wining_reward;
        }
    }

    
    public function blocked(){
         if($this->session->userdata('UserAuth')){
            $user = $this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
            if($user->status!=3){
            redirect(base_url());
            
            }else{
         $data['user']=$user;
          $data['title']=$this->db->get('system')->row()->brand_name." | Blocked";
        



    

        $this->load->view('common/header',$data);
        $this->load->view('public/blocked',$data);
            }
        }else{
            redirect(base_url());
        }

        

       
       
    }


    public function under_maintenance(){
        if($this->db->get('system')->row()->site_mode==1){
   redirect(base_url());
        }
        $data['user']=$this->user;
        $data['title']=$this->db->get('system')->row()->brand_name." | Under Maintenance";
        



    

        $this->load->view('common/header',$data);
        $this->load->view('public/um',$data);
       
    }

     public function autocancel($matchid=0,$gid=false){
    $this->undermaintenance();

       $this->onlyforauth();
    

        $match=$this->db->where([
            'status'=>'1',
            'id'=>$matchid
        ])->get('matches')->row();
        if($match){
$game = $this->db->where('id',$match->game)->get('games')->row();
            $response['msg']='match cancelled because no room code entered and the ₹ '.$match->amount.' rs is refunded to wallet';
            $this->db->where('id',$match->id)->update('matches',[
                "status"=>0
            ]);
            
              $this->db->where('match_id',$matchid)->where('status',1)->update('cancel_reqs',[
                    'status'=>2
                ]);

    $txn['user_id']=$match->host_id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$match->amount;
    $txn['type']='CREDIT';
    $txn['reason']=''.$game->game_name.' Match Cancelled (Auto)';
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_REFUND';
    $txn['match_id']=$matchid;


    $this->db->insert('transections',$txn);

    
    $txn['user_id']=$match->joiner_id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$match->amount;
    $txn['type']='CREDIT';
    $txn['reason']=''.$game->game_name.' Match Cancelled (Auto)';
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_REFUND';
    $txn['match_id']=$matchid;


    $this->db->insert('transections',$txn);
        }else{
 $response['msg']='no match found or invalid match id';
        }

        $this->session->set_flashdata('txnmsg',$response['msg']);

        if($gid){
             redirect(base_url('user/matches/'.$gid));
        }else{
   redirect(base_url('user/dashboard'));
        }
     

    }

     public function cancelmatch($matchid=0,$gid=false){
    $this->undermaintenance();

       $this->onlyforauth();
    

        $match=$this->db->where([
            'host_id'=>$this->user->id,
            'status'=>'1',
            'id'=>$matchid
        ])->get('matches')->row();
        if($match){
$game = $this->db->where('id',$match->game)->get('games')->row();
        if($match->joiner_id){
            $response['msg']='player joined your match, open the game and request cancellation of game !';
        }else{
            $response['msg']='match cancelled and the ₹ '.$match->amount.' rs is refunded to wallet';
            $this->db->where('id',$match->id)->update('matches',[
                "status"=>0
            ]);

    $txn['user_id']=$this->user->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$match->amount;
    $txn['type']='CREDIT';
    $txn['reason']=''.$game->game_name.' Match Cancelled !';
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_REFUND';
    $txn['match_id']=$matchid;


    $this->db->insert('transections',$txn);
        }
        }else{
 $response['msg']='no match found or invalid match id';
        }

        $this->session->set_flashdata('txnmsg',$response['msg']);

        if($gid){
             redirect(base_url('user/matches/'.$gid));
        }else{
   redirect(base_url('user/dashboard'));
        }
     

    }
    
    public function matchhistory(){
        $this->undermaintenance();
        $this->onlyForAuth();
        
        $data['user']=$this->user;
$who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";
$data['txns']=$this->db->where($who)->where('status',0)->order_by('id','desc')->get('matches')->result();
        $theme=$this->db->get('system')->row()->theme;
        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'user/mhist',$data);
        $this->load->view('common/footer',$data);
    }
    
      public function history(){
    $this->undermaintenance();

        $this->onlyforauth();
        $data['user']=$this->user;
        $data['title']=$this->db->get('system')->row()->brand_name." | History";
        $data['randomstring']=$this->gen_string(26);

         $data['balance']=$this->getAvailableBalance();
        $data['pbalance']=$this->getRewardBalance();
        $data['txns']=$this->db->where('user_id',$this->user->id)->order_by('id','desc')->get('transections')->result();
          $theme=$this->db->get('system')->row()->theme;
        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'user/history',$data);
        $this->load->view('common/footer',$data);

    }
    
    public function leaderboard(){
    $this->undermaintenance();

        $this->onlyforauth();
        $data['user']=$this->user;
        
        $data['txns']=$this->db->query("SELECT u.id, u.username, u.avatar, SUM(t.amount) AS total_amount FROM transections t JOIN users u ON t.user_id = u.id WHERE t.ctg = 'REFERRAL_BONUS' GROUP BY u.id ORDER BY total_amount DESC LIMIT 20")->result();
          $theme=$this->db->get('system')->row()->theme;
        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'user/leaderb',$data);
        $this->load->view('common/footer',$data);

    }

      public function withdraws(){
    $this->undermaintenance();

        $this->onlyforauth();
        $data['user']=$this->user;
        $data['title']=$this->db->get('system')->row()->brand_name." | Withdraws";
     
         $data['balance']=$this->getAvailableBalance();
        $data['pbalance']=$this->getRewardBalance();
        $data['txns']=$this->db->where('user_id',$this->user->id)->order_by('id','desc')->get('withdraw_reqs')->result();
        $data['first']=$this->db->where('user_id',$this->user->id)->where_in('status', [1, 2])->order_by('id','desc')->limit(1)->get('withdraw_reqs')->result();
        $data['b']=$this->db->where('user_id',$this->user->id)->where('status', 1)->where('upi_app', 'Bank')->order_by('id','desc')->get('withdraw_reqs')->result();
        
        $theme=$this->db->get('system')->row()->theme;
        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'user/withdraws',$data);
        $this->load->view('common/footer',$data);

    }
    
      public function news(){
    $this->undermaintenance();

        $this->onlyforauth();
        $data['user']=$this->user;
        $data['title']=$this->db->get('system')->row()->brand_name." | News";
     
         $data['balance']=$this->getAvailableBalance();
        $data['pbalance']=$this->getRewardBalance();
        $data['news']=$this->db->order_by('id','desc')->get('news')->result();
        $this->load->view('common/header',$data);
        $this->load->view('common/navbar',$data);
        $this->load->view('user/news',$data);
        $this->load->view('common/footer',$data);

    }

     public function referral(){
    $this->undermaintenance();

        $this->onlyforauth();
        $data['user']=$this->user;
        $data['title']=$this->db->get('system')->row()->brand_name." | Referral";
        $data['randomstring']=$this->gen_string(26);
        $data['totalreferrals']=$this->db->where([
'refer_code'=>$this->user->code
        ])->get('users')->num_rows();

        $data['totalreferralearnings']=$this->db->select('SUM(amount) as money')->where([
'user_id'=>$this->user->id,
'type'=>'CREDIT',
'ctg'=>'REFERRAL_BONUS'
        ])->get('transections')->row()->money;

         $data['balance']=$this->getAvailableBalance();
        $data['pbalance']=$this->getRewardBalance();
    $theme=$this->db->get('system')->row()->theme;
        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'user/referral',$data);
        $this->load->view('common/footer',$data);

    }

    public function submitkyc(){
    $this->undermaintenance();

        $post=$this->input->post();
    $this->onlyforauth();

    $kyc['user_id']=$this->session->userdata('UserAuth');
    $kyc['aadhar_no']=$post['aadhar_no'];
    // $kyc['kycdata']=json_encode($res->data);
    $aadhar_front=$this->uploadkyc('aadhar_front');
if($aadhar_front['process']=='done'){
$kyc['aadhar_front']=$aadhar_front['image'];
}else{
    $this->session->set_flashdata('txnmsg','please upload a valid image');
    redirect(base_url('user/profile'));
    die();
}

 $aadhar_back=$this->uploadkyc('aadhar_back');
if($aadhar_front['process']=='done'){
$kyc['aadhar_back']=$aadhar_back['image'];
}else{
    $this->session->set_flashdata('txnmsg','please upload a valid image');
    redirect(base_url('user/profile'));
    die();
}
    $kyc['created_at']=time();
    $kyc['status']=0;

   
    $this->db->insert('kycs',$kyc);
     $this->session->set_flashdata('txnmsg','your kyc is submitted for approval !');
     redirect(base_url('user/profile'));
    }

    public function profile(){
    $this->undermaintenance();

        $this->onlyforauth();
        $data['user']=$this->user;
        $data['title']=$this->db->get('system')->row()->brand_name." | Profile";
           $data['balance']=$this->getAvailableBalance();
        $data['pbalance']=$this->getRewardBalance();

          $who="(host_id=".$this->user->id." OR joiner_id=".$this->user->id.")";

          $data['totalgamesplayed']=$this->db->where([
            'status'=>0,
            'room_code !='=>0,
            'winner !='=>0,
            'looser !='=>0,
          ])->where($who)->get('matches')->num_rows();

           $data['totalreferralearnings']=$this->db->select('SUM(amount) as money')->where([
'user_id'=>$this->user->id,
'type'=>'CREDIT',
'ctg'=>'REFERRAL_BONUS'
        ])->get('transections')->row()->money;

            $data['totalwinnings']=$this->db->select('SUM(amount) as money')->where([
'user_id'=>$this->user->id,
'type'=>'CREDIT',
'ctg'=>'MATCH_WININGS'
        ])->get('transections')->row()->money;

        $data['penalty']=$this->db->select('SUM(amount) as money')->where([
'user_id'=>$this->user->id,
'type'=>'DEBIT',
'ctg'=>'PENALTY'
        ])->get('transections')->row()->money;


        $data['kyc']=$this->db->where('user_id',$this->user->id)->get('kycs')->row();
    $theme=$this->db->get('system')->row()->theme;

        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'user/profile',$data);
        $this->load->view('common/footer',$data);

    }

     public function support(){
    $this->undermaintenance();

        $data['user']=$this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
        $data['title']=$this->db->get('system')->row()->brand_name." | Support";
         $data['balance']=$this->getAvailableBalance();
        $data['pbalance']=$this->getRewardBalance();
        $this->load->view('common/header',$data);
        $this->load->view('common/navbar',$data);
        $this->load->view('public/support',$data);
        $this->load->view('common/footer',$data);

    }

    public function login(){
    $this->undermaintenance();

        $this->onlyfornonauth();

        $data['title']=$this->db->get('system')->row()->brand_name." | Login";
        $theme=$this->db->get('system')->row()->theme;
        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'public/login',$data);
        $this->load->view('common/footer',$data);

    }

    public function signup(){
    $this->undermaintenance();

        $this->onlyfornonauth();

        $data['title']=$this->db->get('system')->row()->brand_name." | SignUp";
        $theme=$this->db->get('system')->row()->theme;
        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'public/signup',$data);
        $this->load->view('common/footer',$data);

    }

     public function page($slug){
    $this->undermaintenance();

        $page=$this->db->where('page_slug',$slug)->get('pages')->row();
        if(!$page) redirect(base_url());
        $data['page']=$page;
        $data['user']=$this->db->where('id',$this->session->userdata('UserAuth'))->get('users')->row();
         $data['balance']=$this->getAvailableBalance();
        $data['pbalance']=$this->getRewardBalance();
        $data['title']=$this->db->get('system')->row()->brand_name." | ".$page->page_name;

        $theme=$this->db->get('system')->row()->theme;

        $this->load->view('common/header',$data);
        $this->load->view($theme.'common/navbar',$data);
        $this->load->view($theme.'public/terms',$data);
        $this->load->view('common/footer',$data);

    }

    
}
