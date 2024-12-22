<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */


     public function do_upload($file)
     {
             $config['upload_path']          = 'assets/uploads/';
             $config['allowed_types']        = 'gif|jpg|png|jpeg';
             $config['max_size']             = 1000;
             $config['encrypt_name'] = TRUE;

             $this->load->library('upload', $config);

             if ( ! $this->upload->do_upload($file))
             {
                     $error = array('error' => $this->upload->display_errors());

                     return ['status'=>false,'error'=>$error];
             }
             else
             {
                     $data = array('upload_data' => $this->upload->data());

                    return ['status'=>true,'data'=>$data];
             }
     
    }

public function onlyForAuth(){
    if(!$this->session->has_userdata('AdminAuth')) redirect(base_url('admin'));
}

public function onlyForPost(){
    if(!$this->input->post()) redirect(base_url('admin'));
}


     public function getAuth(){
        $user=$this->session->userdata('AuthData');
        return $this->db->where('id',$user->id)->get('admins')->row();
     }


	public function index()
	{
        $data=[];

        $this->load->view('admin/header',$data);
        
        if($this->session->has_userdata('AdminAuth')){
            $data['user']=$this->getAuth();
            $data['dashboard']='active';
            

            //alltime
            $data['totaldeposits']=$this->db->select('SUM(amount) as money')->where('type','CREDIT')->where_in('ctg', ['DEPOSIT', 'GST'])->get('transections')->row()->money;
            $data['totaladm']=$this->db->select('SUM(amount) as money')->where('type','CREDIT')->where('utr','Admin')->get('transections')->row()->money;
            $data['totalpenalty']=$this->db->select('SUM(amount) as money')->where('type','DEBIT')->where('ctg','PENALTY')->get('transections')->row()->money;
            
            $data['totalwithdraws']=$this->db->select('SUM(amount) as money')->where('type','DEBIT')->where('ctg','WITHDRAW')->get('transections')->row()->money;
            $data['totalusers']=$this->db->get('users')->num_rows();
            
            $lcredit=$this->db->select('SUM(amount) as money')->where('type','CREDIT')->where("(ctg='CMS')")->get('transections')->row()->money;
            $ldebit=$this->db->select('SUM(amount) as money')->where('type','CREDIT')->where("(ctg='JOINING_BONUS')")->get('transections')->row()->money;
            $data['lcommision']=$lcredit-$ldebit;
//             $creditamount=$this->db->select('SUM(amount) as money')->where('type','DEBIT')->where("(ctg='MATCH')")->get('transections')->row()->money;


// $debitamount=$this->db->select('SUM(amount) as money')->where('type','CREDIT')->where("(ctg='MATCH_WININGS' OR ctg='JOINING_BONUS' OR ctg='MATCH_REFUND' OR ctg='REFERRAL_BONUS')")->get('transections')->row()->money;


         
//              $data['lcommision']=$creditamount-$debitamount; 

            //thismonth
           $first_day_this_month = date('01 M Y');
           $last_day_this_month  = date('t M Y');
            $data['month']=$first_day_this_month.' - '.$last_day_this_month;
            $data['mtotaldeposits']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_month))->where('created_at <=',strtotime($last_day_this_month))->where('type','CREDIT')->where_in('ctg', ['DEPOSIT', 'GST'])->get('transections')->row()->money;
            $data['mtotaladm']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_month))->where('created_at <=',strtotime($last_day_this_month))->where('type','CREDIT')->where('utr','Admin')->get('transections')->row()->money;
            $data['mtotalpenalty']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_month))->where('created_at <=',strtotime($last_day_this_month))->where('type','DEBIT')->where('ctg','PENALTY')->get('transections')->row()->money;

            $data['mtotalwithdraws']=$this->db->select('SUM(amount) as money')->where('type','DEBIT')->where('ctg','WITHDRAW')->where('created_at >=',strtotime($first_day_this_month))->where('created_at <=',strtotime($last_day_this_month))->get('transections')->row()->money;
            $data['mtotalusers']=$this->db->where('created_at >=',strtotime($first_day_this_month))->where('created_at <=',strtotime($last_day_this_month))->get('users')->num_rows();
            
            $mcredit=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_month))->where('created_at <=',strtotime($last_day_this_month))->where('type','CREDIT')->where("(ctg='CMS')")->get('transections')->row()->money;
            $mdebit=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_month))->where('created_at <=',strtotime($last_day_this_month))->where('type','CREDIT')->where("(ctg='JOINING_BONUS')")->get('transections')->row()->money;
            $data['mcommision']=$mcredit-$mdebit;            

// $creditamount=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_month))->where('created_at <=',strtotime($last_day_this_month))->where('type','DEBIT')->where("(ctg='MATCH')")->get('transections')->row()->money;


// $debitamount=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_month))->where('created_at <=',strtotime($last_day_this_month))->where('type','CREDIT')->where("(ctg='MATCH_WININGS' OR ctg='JOINING_BONUS' OR ctg='MATCH_REFUND' OR ctg='REFERRAL_BONUS')")->get('transections')->row()->money;


         
//              $data['mcommision']=$creditamount-$debitamount; 



            //this weak
            $today = date("Y-m-d");
// $mon = new DateTime($today);
// $sun = new DateTime($today);
// $mon->modify('recent sunday');
// $sun->modify('next Saturday');
// $first_day_this_week = $mon->format("d M Y");
// $last_day_this_week = $sun->format("d M Y");
$mon = strtotime("next sunday") - 604800; 
$sun = strtotime("next sunday") - 1;
$first_day_this_week = date("d M Y",$mon);
$last_day_this_week = date("d M Y",$sun);

            $data['week']=$weak=$first_day_this_week.' - '.$last_day_this_week;
            $data['wtotaldeposits']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_week))->where('created_at <=',strtotime($last_day_this_week))->where('type','CREDIT')->where_in('ctg', ['DEPOSIT', 'GST'])->get('transections')->row()->money;
            $data['wtotaladm']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_week))->where('created_at <=',strtotime($last_day_this_week))->where('type','CREDIT')->where('utr','Admin')->get('transections')->row()->money;
            $data['wtotalpenalty']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_week))->where('created_at <=',strtotime($last_day_this_week))->where('type','DEBIT')->where('ctg','PENALTY')->get('transections')->row()->money;

            $data['wtotalwithdraws']=$this->db->select('SUM(amount) as money')->where('type','DEBIT')->where('ctg','WITHDRAW')->where('created_at >=',strtotime($first_day_this_week))->where('created_at <=',strtotime($last_day_this_week))->get('transections')->row()->money;
            $data['wtotalusers']=$this->db->where('created_at >=',strtotime($first_day_this_week))->where('created_at <=',strtotime($last_day_this_week))->get('users')->num_rows();
            
            $wcredit=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_week))->where('created_at <=',strtotime($last_day_this_week))->where('type','CREDIT')->where("(ctg='CMS')")->get('transections')->row()->money;
            $wdebit=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_week))->where('created_at <=',strtotime($last_day_this_week))->where('type','CREDIT')->where("(ctg='JOINING_BONUS')")->get('transections')->row()->money;
            $data['wcommision']=$wcredit-$wdebit;

//             $creditamount=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_week))->where('created_at <=',strtotime($last_day_this_week))->where('type','DEBIT')->where("(ctg='MATCH')")->get('transections')->row()->money;


// $debitamount=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_week))->where('created_at <=',strtotime($last_day_this_week))->where('type','CREDIT')->where("(ctg='MATCH_WININGS' OR ctg='JOINING_BONUS' OR ctg='MATCH_REFUND' OR ctg='REFERRAL_BONUS')")->get('transections')->row()->money;


         
//              $data['wcommision']=$creditamount-$debitamount; 
          
             //thisyear
           $first_day_this_year = "01 Jan ".date('Y');
           $last_day_this_year  = "31 Dec ".date('Y');
            $data['year']=$first_day_this_year.' - '.$last_day_this_year;

           
            $data['ytotaldeposits']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_year))->where('created_at <=',strtotime($last_day_this_year))->where('type','CREDIT')->where_in('ctg', ['DEPOSIT', 'GST'])->get('transections')->row()->money;
            $data['ytotaladm']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_year))->where('created_at <=',strtotime($last_day_this_year))->where('type','CREDIT')->where('utr','Admin')->get('transections')->row()->money;
            $data['ytotalpenalty']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_year))->where('created_at <=',strtotime($last_day_this_year))->where('type','DEBIT')->where('ctg','PENALTY')->get('transections')->row()->money;

            $data['ytotalwithdraws']=$this->db->select('SUM(amount) as money')->where('type','DEBIT')->where('ctg','WITHDRAW')->where('created_at >=',strtotime($first_day_this_year))->where('created_at <=',strtotime($last_day_this_year))->get('transections')->row()->money;
            $data['ytotalusers']=$this->db->where('created_at >=',strtotime($first_day_this_year))->where('created_at <=',strtotime($last_day_this_year))->get('users')->num_rows();
            
            $ycredit=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_year))->where('created_at <=',strtotime($last_day_this_year))->where('type','CREDIT')->where("(ctg='CMS')")->get('transections')->row()->money;
            $ydebit=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_year))->where('created_at <=',strtotime($last_day_this_year))->where('type','CREDIT')->where("(ctg='JOINING_BONUS')")->get('transections')->row()->money;
            $data['ycommision']=$ycredit-$ydebit;
//             $creditamount=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_year))->where('created_at <=',strtotime($last_day_this_year))->where('type','DEBIT')->where("(ctg='MATCH')")->get('transections')->row()->money;


// $debitamount=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_year))->where('created_at <=',strtotime($last_day_this_year))->where('type','CREDIT')->where("(ctg='MATCH_WININGS' OR ctg='JOINING_BONUS' OR ctg='MATCH_REFUND' OR ctg='REFERRAL_BONUS')")->get('transections')->row()->money;


         
//              $data['ycommision']=$creditamount-$debitamount; 


                        
                          
                        



            //today
           $first_day_this_today = date('d M Y').", 12:00 AM";
           $last_day_this_today  = date('d M Y').", 11:59 PM";
           
           
            $data['ttotaldeposits']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_today))->where('created_at <=',strtotime($last_day_this_today))->where('type','CREDIT')->where_in('ctg', ['DEPOSIT', 'GST'])->get('transections')->row()->money;
            $data['ttotaladm']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_today))->where('created_at <=',strtotime($last_day_this_today))->where('type','CREDIT')->where('utr','Admin')->get('transections')->row()->money;
            $data['ttotalpenalty']=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_today))->where('created_at <=',strtotime($last_day_this_today))->where('type','DEBIT')->where('ctg','PENALTY')->get('transections')->row()->money;
            
            $data['ttotalwithdraws']=$this->db->select('SUM(amount) as money')->where('type','DEBIT')->where('ctg','WITHDRAW')->where('created_at >=',strtotime($first_day_this_today))->where('created_at <=',strtotime($last_day_this_today))->get('transections')->row()->money;
            $data['ttotalusers']=$this->db->where('created_at >=',strtotime($first_day_this_today))->where('created_at <=',strtotime($last_day_this_today))->get('users')->num_rows();
        
            $tcredit=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_today))->where('created_at <=',strtotime($last_day_this_today))->where('type','CREDIT')->where("(ctg='CMS')")->get('transections')->row()->money;
            $tdebit=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_today))->where('created_at <=',strtotime($last_day_this_today))->where('type','CREDIT')->where("(ctg='JOINING_BONUS')")->get('transections')->row()->money;
            $data['tcommision']=$tcredit-$tdebit;
// $creditamount=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_today))->where('created_at <=',strtotime($last_day_this_today))->where('type','DEBIT')->where("(ctg='MATCH')")->get('transections')->row()->money;


// $debitamount=$this->db->select('SUM(amount) as money')->where('created_at >=',strtotime($first_day_this_today))->where('created_at <=',strtotime($last_day_this_today))->where('type','CREDIT')->where("(ctg='MATCH_WININGS' OR ctg='JOINING_BONUS' OR ctg='MATCH_REFUND' OR ctg='REFERRAL_BONUS')")->get('transections')->row()->money;


         
//              $data['tcommision']=$creditamount-$debitamount; 

            $this->load->view('admin/navbar',$data);
            $this->load->view('admin/dashboard',$data);
        }else{
            $this->load->view('admin/login',$data);
        }

        $this->load->view('admin/footer',$data);
		

	}

public function Wdeposit(){
                $this->onlyForAuth();

                 $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_rd || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                        $data['deposits']=$this->db->order_by('id','desc')->where('type','CREDIT')->where('utr','Admin')->where('ctg','DEPOSIT')->get('transections')->result();
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/depositsw',$data);
                        $this->load->view('admin/footer',$data);
    }

public function Rdeposit(){
                $this->onlyForAuth();

                 $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_rd || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                        $data['deposits']=$this->db->order_by('id','desc')->where('ctg','ADDTOREWARD')->get('transections')->result();
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/depositsr',$data);
                        $this->load->view('admin/footer',$data);

    }

public function penalty(){
                $this->onlyForAuth();

                 $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_rd || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                        $data['deposits']=$this->db->order_by('id','desc')->where('ctg','PENALTY')->limit(200)->get('transections')->result();
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/penalty',$data);
                        $this->load->view('admin/footer',$data);

    }

    public function deposits(){
                $this->onlyForAuth();

                 $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_rd || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                        $data['deposits']=$this->db->order_by('id','desc')->where('type','CREDIT')->where('ctg','DEPOSIT')->limit(200)->get('transections')->result();
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/deposits',$data);
                        $this->load->view('admin/footer',$data);

    }

 

public function getAvailableBalance($id){
        $where['user_id']=$id;
        $where['type']='CREDIT';
       
        $credit = $this->db->select('SUM(amount) as money')->where('(ctg!="MATCH_WININGS" AND ctg!="REFERRAL_BONUS" AND ctg!="ADDTOREWARD")')->where($where)->get('transections')->row()->money;

        $where['type']='DEBIT';
       
        $debit = $this->db->select('SUM(amount) as money')->where('(ctg!="WITHDRAW" AND ctg!="TRANSFER")')->where($where)->get('transections')->row()->money;


        return ($credit-$debit);


    }

    public function getRewardBalance($id){
        $where['user_id']=$id;
        $where['type']='CREDIT';
        $credit = $this->db->select('SUM(amount) as money')->where($where)->where('(ctg="MATCH_WININGS" OR ctg="REFERRAL_BONUS" OR ctg="ADDTOREWARD")')->get('transections')->row()->money;

        $where['type']='DEBIT';
       
        $debit = $this->db->select('SUM(amount) as money')->where($where)->where('(ctg="WITHDRAW")')->get('transections')->row()->money;
        

// $debit += $this->db->select('SUM(amount) as money')->where([
//     'user_id'=>$id,
//     'status'=>1
// ])->get('withdraw_reqs')->row()->money;

$where['type']='CREDIT';
$where['ctg']='TRANSFER';
$debit += $this->db->select('SUM(amount) as money')->where($where)->get('transections')->row()->money;

        return ($credit-$debit);


    }

    
    public function tranferfunds($userid){
                $this->onlyForAuth();
                
    $txn['user_id']=$userid;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']='Admin';
    $txn['amount']=$this->input->post('amount');
    $txn['type']='CREDIT';
    $txn['reason']='add to reward By Admin';
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='ADDTOREWARD';

    // echo "<pre>";
    // print_r($txn);
    $this->db->insert('transections',$txn);
    redirect(base_url('admin/user/'.$userid));

     }
    
     
     public function addfunds($userid){
                $this->onlyForAuth();
    $txn['user_id']=$userid;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']='Admin';
    $txn['amount']=$this->input->post('amount');
    $txn['type']='CREDIT';
    $txn['reason']=$this->input->post('reason');
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='DEPOSIT';
 

    // echo "<pre>";
    // print_r($txn);
    $this->db->insert('transections',$txn);
    redirect(base_url('admin/user/'.$userid));

     }

       public function addpenalty($userid){
                $this->onlyForAuth();
    $txn['user_id']=$userid;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']='Admin';
    $txn['amount']=$this->input->post('amount');
    $txn['type']='DEBIT';
    $txn['reason']=$this->input->post('reason');
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='PENALTY';
 

    // echo "<pre>";
    // print_r($txn);
    $this->db->insert('transections',$txn);
    redirect(base_url('admin/user/'.$userid));

     }


      public function minusfunds($userid){
                $this->onlyForAuth();
    $txn['user_id']=$userid;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']='Admin';
    $txn['amount']=$this->input->post('amount');
    $txn['type']='DEBIT';
    $txn['reason']='Debited By Admin';
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='TXN';
 

    // echo "<pre>";
    // print_r($txn);
    $this->db->insert('transections',$txn);
    redirect(base_url('admin/user/'.$userid));

     }
            public function user($id){
                $this->onlyForAuth();
                        $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                     
                
                        $player=$this->db->where('id',$id)->get('users')->row();
                        if(!$player) redirect(base_url('admin/manageusers'));
                        $data['player']=$player;

                $data['balance']=$this->getAvailableBalance($id);
                $data['pbalance']=$this->getRewardBalance($id);
$data['kyc']=$this->db->where('user_id',$id)->where('status',1)->get('kycs')->row();
$data['txns']=$this->db->where('user_id',$id)->order_by('id','desc')->get('transections')->result();

$who="(host_id=".$id." OR joiner_id=".$id.")";
$data['matches']=$this->db->where($who)->order_by('id','desc')->get('matches')->result();

 $data['totalgamesplayed']=$this->db->where([
            'status'=>0,
            'room_code !='=>0,
            'winner !='=>0,
            'looser !='=>0,
          ])->where($who)->get('matches')->num_rows();

           $data['totalreferralearnings']=$this->db->select('SUM(amount) as money')->where([
'user_id'=>$id,
'type'=>'CREDIT',
'ctg'=>'REFERRAL_BONUS'
        ])->get('transections')->row()->money;

            $data['totalwinnings']=$this->db->select('SUM(amount) as money')->where([
'user_id'=>$id,
'type'=>'CREDIT',
'ctg'=>'MATCH_WININGS'
        ])->get('transections')->row()->money;

        $data['penalty']=$this->db->select('SUM(amount) as money')->where([
'user_id'=>$id,
'type'=>'DEBIT',
'ctg'=>'PENALTY'
        ])->get('transections')->row()->money;

        $data['deposits']=$this->db->select('SUM(amount) as money')->where([
'user_id'=>$id,
'type'=>'CREDIT',
'ctg'=>'DEPOSIT'
        ])->get('transections')->row()->money;

         $data['withdraws']=$this->db->select('SUM(amount) as money')->where([
'user_id'=>$id,
'type'=>'DEBIT',
'ctg'=>'WITHDRAW'
        ])->get('transections')->row()->money;

        $data['ref']=$this->db->where('code',$player->refer_code)->get('users')->row();
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/user',$data);
                        $this->load->view('admin/footer',$data);
                    }


           

                    

   

   

          

                

           

          

         


  


 
            public function logout(){
session_destroy();
redirect(base_url('admin'));
            }

         public function canmatch($matchid){

$this->onlyForAuth();


$match=$this->db->where('id',$matchid)->where('status',1)->get('matches')->row();

if(!$match){
   
                redirect(base_url('admin'));
}


          
            //   $game = $this->db->where('id',$match->game)->get('games')->row();
              $host = $this->db->where('id',$match->host_id)->get('users')->row();
              $joiner = $this->db->where('id',$match->joiner_id)->get('users')->row();
    
              if($host){
$txn['user_id']=$host->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$match->amount;
    $txn['type']='CREDIT';
    $txn['reason']='Match Canceled - #MID'.(1427+$matchid);
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_REFUND';
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);
              }

              if($joiner){
    $txn['user_id']=$joiner->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$match->amount;
    $txn['type']='CREDIT';
    $txn['reason']='Match Canceled - #MID'.(1427+$matchid);
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_REFUND';
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);
              }
    

    $this->db->where('match_id',$match->id)->update('conflicts',[
"status"=>0
    ]);

    $this->db->where('id',$match->id)->update('matches',[
"status"=>0
    ]);
    
    $this->db->where('match_id',$match->id)->update('cancel_reqs',[
                    'status'=>0
                ]);    
  

  
redirect(base_url('admin/match/'.$match->id));
            }


            public function acceptcan($reqid){

$this->onlyForAuth();

$req=$this->db->where('id',$reqid)->get('cancel_reqs')->row();
$coft=$this->db->where('match_id',$req->match_id)->where('status',1)->get('conflicts')->result();
if($coft){
    redirect(base_url('admin/conflicts'));
    die();
}
$match=$this->db->where('id',$req->match_id)->where('status',1)->get('matches')->row();
if(!$match){
    $this->db->where('id',$reqid)->update('cancel_reqs',[
                    'status'=>0
                ]);
                redirect(base_url('admin/requests'));
}


          
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
        
  

  $this->db->where('id',$reqid)->update('cancel_reqs',[
                    'status'=>2
                ]);

                $this->db->where('id !=',$reqid)->where('match_id',$match->id)->update('cancel_reqs',[
                    'status'=>0
                ]);
                
redirect(base_url('admin/requests'));
            }

            public function rejectcan($reqid){
                $this->onlyForAuth();
                $this->db->where('id',$reqid)->update('cancel_reqs',[
                    'status'=>0
                ]);
                redirect(base_url('admin/requests'));
            }

 public function addnewgame(){
    
                $this->onlyForAuth();
                $post=$this->input->post();
               

                 if($_FILES['logo']['name']!=''){
$screenshot=$this->uploadimage('logo');
if($screenshot['process']=='done'){
$logo=$screenshot['image'];
$post['logo']=$logo;
}
   }

                $this->db->insert('games',$post);

            redirect(base_url('admin/managegames'));

 }

  public function updategame($id){
                $this->onlyForAuth();
                $post=$this->input->post();
                
                if($_FILES['logo']['name']!=''){
$screenshot=$this->uploadimage('logo');
if($screenshot['process']=='done'){
$logo=$screenshot['image'];
$post['logo']=$logo;
}
   }
                $this->db->where('id',$id)->update('games',$post);

            redirect(base_url('admin/managegames'));

 }

public function athk(){
    $this->onlyForAuth();
       
        $endpoint = 'https://api-live.kvmpay.com/payouts/OAuth/get-token';
        $apiKey = '6dc69e59-3a04-4396-b488-f56e2c914ecf';
        $secretKey = 'WjroQ1DmOHwkn04caqGPo2MBNBpn1bIb1oo5ISR5vww='; 
        
      
        $ch = curl_init();
        
    
        curl_setopt($ch, CURLOPT_URL, $endpoint); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Api-Key: ' . $apiKey,
            'X-Secret-key: ' . $secretKey,
        ]);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode == 200) {
                $data = json_decode($response, true);
                $accessToken = $data['Access_token'];
            } else {
                echo 'Failed to get token. HTTP status code: ' . $httpCode;
            }
        }
        
        curl_close($ch);
        return $accessToken;
    }

public function pstatus($id){
    $this->onlyForAuth(); 
    $w = $this->db->where('id', $id)->get('withdraw_reqs')->row();
    $accessToken = $this->athk();
    $ch = curl_init();
    
    $clientReferenceId = "qwqwqwG".$id;
    $url = 'https://api-live.kvmpay.com/payouts/v1/Paymentstatus?ClientReferenceId=' . $clientReferenceId;
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json',
    ]);
    
    $response = curl_exec($ch);
    
    if($response === false){
        echo 'Curl error: ' . curl_error($ch);
    } else {
        echo $response;
    }
    
    curl_close($ch);
}


public function test(){
    $this->onlyForAuth(); 
    $this->load->view('admin/test');
}


public function automarkasdone($id)
{
    $this->onlyForAuth(); 
    
    $w = $this->db->where('id', $id)->get('withdraw_reqs')->row();
    $uid = $id;
    $user = $this->db->where('id', $w->user_id)->get('users')->row();
    
    $endpoint = 'https://api-live.kvmpay.com/payouts/v1/Payments/initiate-payments';


    $accessToken = $this->athk();
    // echo $accessToken;
    
   
    if ($w->upi_app == 'Bank') {
        $requestBody = [
            'clientReferenceId' => "qwqwqwG".$uid, // Unique identifier for this transaction
            'accountNumber' => $w->bank_ac_no, // Beneficiary account number (for IMPS/NEFT/RTGS)
            'ifscCode' => $w->bank_ifsc_code, // Beneficiary IFSC code
            'payeeName' => $w->name, // Beneficiary name
            'vpa' => '', // Beneficiary VPA (for UPI)
            'email' => 'admin@teraludo.com', // Beneficiary email address
            'mobileNo' => $user->mobile_no, // Beneficiary mobile number
            'transfermode' => 'IMPS', // Payment transfer mode (IMPS, NEFT, RTGS, or UPI)
            'remarks' => 'admin', // Transaction remarks
            'amount' => $w->amount, // Payment amount
        ];
    } else {
        $requestBody = [
            'clientReferenceId' => "qwqwqwG".$uid,
            'accountNumber' => '', 
            'ifscCode' => '',
            'payeeName' => "user",
            'vpa' => $w->upi_mobile, 
            'email' => 'admin@teraludo.com',
            'mobileNo' => $user->mobile_no,
            'transfermode' => 'UPI',
            'remarks' => 'admin',
            'amount' => $w->amount,
        ];
    }
    
   
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json',
    ]);

    $requestBodyJson = json_encode($requestBody);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBodyJson);

  
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    } else {
       
        $responseDecoded = json_decode($response, true);
        if(isset($responseDecoded['status'])){
        if($responseDecoded['status']=='SUCCESS' or $responseDecoded['status']=='PENDING'){
            $up['txn_id']=$responseDecoded['paymentReferenceId'];
            $this->db->where('id',$id)->update('withdraw_reqs',$up);
        }
        }
        echo $response;
        // echo $responseDecoded['status'];
    }

    curl_close($ch); 
}


 public function markasdone($id){
                $this->onlyForAuth();
                $post=$this->input->post();

        $w=$this->db->where('id',$id)->get('withdraw_reqs')->row();
        $uid = 'txn'.time().rand(100,999);
        // $user=$this->db->where('id',$w->user_id)->get('users')->row();
        
        $up['status']=1;
        $up['reason']=$post['reason'];
        $this->db->where('id',$id)->update('withdraw_reqs',$up);
        
        $txn['user_id']=$w->user_id;
        $txn['order_id']=$uid;
        $txn['utr']=time();
        $txn['amount']=$w->amount;
        $txn['type']='DEBIT';
    
        if($w->upi_app=='Bank'){
     $txn['reason']='Transfered to '.$w->upi_app.' / '.$w->bank_ac_no.' ('.$w->bank_ifsc_code.')';
        }else{
     $txn['reason']='Transfered to '.$w->upi_app.' / '.$w->upi_mobile;
        }
       
        $txn['created_at']=time();
        $txn['status']=1;
        $txn['ctg']='WITHDRAW';
     
        $this->db->insert('transections',$txn);
                redirect(base_url('admin/withdrawreqs'));
 }

  public function rejectw($id){
                $this->onlyForAuth();
                $post=$this->input->post();
                $up['status']=0;
                $up['reason']=$post['reason'];
                $this->db->where('id',$id)->update('withdraw_reqs',$up);

            redirect(base_url('admin/withdrawreqs'));

 }
 
  public function deletegame($id){
                $this->onlyForAuth();
               
            
                $this->db->where('id',$id)->update('games',[
                    'soft_delete'=>1,
                    'status'=>0
                ]);

            redirect(base_url('admin/managegames'));

 }

 public function updateotpapi(){
                $this->onlyForAuth();
                $post=$this->input->post();
                $post['updated_at']=time();
                $this->db->where([
                    'tag'=>'FAST2SMS'
                ])->update('apis',$post);
redirect(base_url('admin/apiaccess'));

 }

  public function updatepaymentapi(){
                $this->onlyForAuth();
                $post=$this->input->post();
                $post['updated_at']=time();
                $this->db->where([
                    'tag'=>'PAYMENT'
                ])->update('apis',$post);
redirect(base_url('admin/apiaccess'));

 }

   public function updatephonepeapi(){
                $this->onlyForAuth();
                $post=$this->input->post();
                $post['updated_at']=time();
                $this->db->where([
                    'tag'=>'PHONEPE'
                ])->update('apis',$post);
redirect(base_url('admin/apiaccess'));

 }

  public function updatecashfreeapi(){
                $this->onlyForAuth();
                $post=$this->input->post();
                $post['updated_at']=time();
                $this->db->where([
                    'tag'=>'CASHFREE'
                ])->update('apis',$post);
redirect(base_url('admin/apiaccess'));

 }

   public function updatepayment2api(){
                $this->onlyForAuth();
                $post=$this->input->post();
                $post['updated_at']=time();
                $this->db->where([
                    'tag'=>'UPIGATEWAY'
                ])->update('apis',$post);
redirect(base_url('admin/apiaccess'));

 }

   public function updatepayment3api(){
                $this->onlyForAuth();
                $post=$this->input->post();
                $post['updated_at']=time();
                $this->db->where([
                    'tag'=>'SHOPKING'
                ])->update('apis',$post);
redirect(base_url('admin/apiaccess'));

 }

  public function updateaadharapi(){
                $this->onlyForAuth();
                $post=$this->input->post();
                $post['updated_at']=time();
                $post['created_at']=time();

               

        $new = 'https://api.sandbox.co.in/authenticate';

     
        
$headers[]='accept: application/json';
$headers[]='content-type: application/json';
$headers[]='x-api-key: '.$post['apikey'];
$headers[]='x-api-version: 1.0';


       
$headers[]='x-api-secret: '.$post['secretkey'];


$ch = curl_init($new); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, []);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
curl_close($ch);
$res=json_decode($result);

$this->db->where('tag','AADHAR')->update('apis',[
'apikey'=>$post['apikey'],
'secretkey'=>$post['secretkey'],
'authtoken'=>$res->access_token,
'created_at'=>time(),
'updated_at'=>time()
]);



redirect(base_url('admin/apiaccess'));

 }




 
 public function updatetheme(){
                $this->onlyForAuth();
   $post=$this->input->post();
 
$system=[];
 $system=$post;
   if($_FILES['background']['name']!=''){
$screenshot=$this->uploadimage('background');
if($screenshot['process']=='done'){
$logo=$screenshot['image'];
$system['background']=$logo;
}
   }

  



   
$this->db->where('id',1)->update('system',$system);


   $_SESSION['updated']=true;
redirect(base_url('admin/theme'));

 }

  public function removeback(){
                $this->onlyForAuth();

$system['background']='';
 


   
$this->db->where('id',1)->update('system',$system);


   $_SESSION['updated']=true;
redirect(base_url('admin/theme'));

 }



 public function updatesystem(){
                $this->onlyForAuth();
   $post=$this->input->post();
   echo "<pre>";
   print_r($post);
$system=[];

   if($_FILES['logo']['name']!=''){
$screenshot=$this->uploadimage('logo');
if($screenshot['process']=='done'){
$logo=$screenshot['image'];
$system['brand_logo']=$logo;
}
   }

    if($_FILES['banner']['name']!=''){
$screenshot=$this->uploadimage('banner');
if($screenshot['process']=='done'){
$logo=$screenshot['image'];
$system['homepage_banner']=$logo;
}
   }

    if($_FILES['app_download_image']['name']!=''){
$screenshot=$this->uploadimage('app_download_image');
if($screenshot['process']=='done'){
$logo=$screenshot['image'];
$system['app_download_image']=$logo;
}
   }



$p=$post;
unset($p['admin_email']);
unset($p['admin_password']);
unset($p['admin_name']);


   $sysupdate=array_merge($system,$p);
   
$this->db->where('id',1)->update('system',$sysupdate);

$admin['email']=$post['admin_email'];
$admin['full_name']=$post['admin_name'];



if($post['admin_password']!=''){
    $admin['password']=md5($post['admin_password']);
}

$this->db->where('id',1)->update('admins',$admin);
   $_SESSION['updated']=true;
redirect(base_url('admin/system'));

 }

 
 public function updatemessages(){
                $this->onlyForAuth();
   $post=$this->input->post();
 


$this->db->where('id',1)->update('messages',$post);
   $_SESSION['updated']=true;
redirect(base_url('admin/messages'));

 }


 public function uploadimage($im){
		$config['upload_path']          = './assets/images/';
		if(!file_exists($config['upload_path'])){
			mkdir($config['upload_path'],0777,true);
		}
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);
$updata=$this->upload->do_upload($im);
		if ( !$updata )
		{
				return ['process'=>'fail','msg'=>$this->upload->display_errors()];

		}
		else
		{
			

				return ['process'=>'done','image'=>$this->upload->data()['file_name']];
		}
	}

     public function approvekyc($id){
                $this->onlyForAuth();
$this->db->where('id',$id)->update('kycs',['status'=>1]);
redirect(base_url('admin/kycs'));

     }

        public function rejectkyc($id){
                $this->onlyForAuth();
$this->db->where('id',$id)->delete('kycs');
redirect(base_url('admin/kycs'));

     }

            public function manageusers(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_mp || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                    
                        if(isset($_GET['search']) && $_GET['search']){
                            $data['users']=$this->db->like('mobile_no',$_GET['search'])->order_by('id','desc')->get('users')->result();
                        }else{
                            $data['users']=$this->db->order_by('id','desc')->get('users')->result();
                        }
                
                        $data['fn']=$this;
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/manageusers',$data);
                        $this->load->view('admin/footer',$data);
                    }

                      public function kycs(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_kycr || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                    
                       
                            $data['kycs']=$this->db->order_by('id','desc')->where('status',0)->limit(200)->get('kycs')->result();
                        
                
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/kycs',$data);
                        $this->load->view('admin/footer',$data);
                    }


 public function aada(){
                $this->onlyForAuth();

                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                        $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_r || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }

                        $this->load->view('admin/aadaa',$data);
                        $this->load->view('admin/footer',$data);
                    }

                       public function reports(){
                $this->onlyForAuth();

                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                        $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_r || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                    
                        if(isset($_GET['from_date']) && isset($_GET['to_date'])){
                            $fromdate=strtotime($_GET['from_date'].' 12:00 am');
                            $todate=strtotime($_GET['to_date'].' 11:59 pm');

                        }else{
                                $fromdate=strtotime(date('d M Y',time()).' 12:00 am');
                            $todate=strtotime(date('d M Y',time()).' 11:59 pm');
                        }

$data['fromdate']=date('d M, Y',$fromdate);
$data['todate']=date('d M, Y',$todate);

                            $data['users']=$this->db->where('created_at >=',$fromdate)->where('created_at <=',$todate)->order_by('created_at','desc')->get('users')->result();


            $first_day_this_month = $fromdate;
           $last_day_this_month  = $todate;
    //    echo date('d-m-y h:i',$fromdate);
    //    echo date('d-m-y h:i',$todate);

    
    // echo $fromdate;
    // echo "<br>";
    // echo $todate;

            $data['totaldeposits']=$this->db->select('SUM(amount) as money')->where('created_at >=',$first_day_this_month)->where('created_at <=',$last_day_this_month)->where('type','CREDIT')->where_in('ctg', ['DEPOSIT', 'GST'])->get('transections')->row()->money;

//             echo "<br>";
// print_r($data['totaldeposits']);
            // die();

            $data['totalwithdraws']=$this->db->select('SUM(amount) as money')->where('type','DEBIT')->where('ctg','WITHDRAW')->where('created_at >=',$first_day_this_month)->where('created_at <=',$last_day_this_month)->get('transections')->row()->money;

            $data['totalusers']=$this->db->where('created_at >=',$first_day_this_month)->where('created_at <=',$last_day_this_month)->get('users')->num_rows();


$creditamount=$this->db->select('SUM(amount) as money')->where('created_at >=',$first_day_this_month)->where('created_at <=',$last_day_this_month)->where('type','DEBIT')->where("(ctg='MATCH')")->get('transections')->row()->money;



$debitamount=$this->db->select('SUM(amount) as money')->where('created_at >=',$first_day_this_month)->where('created_at <=',$last_day_this_month)->where('type','CREDIT')->where("(ctg='MATCH_WININGS' OR ctg='JOINING_BONUS' OR ctg='MATCH_REFUND' OR ctg='REFERRAL_BONUS')")->get('transections')->row()->money;

         
             $data['commision']=$creditamount-$debitamount;  
                        

    
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/reports',$data);
                        $this->load->view('admin/footer',$data);
                    }


                    public function addparameter(){
                         $this->onlyForAuth();
                         $post=$this->input->post();
                         $this->db->insert('wr_params',$post);
                         redirect(base_url('admin/rewards'));
                    }

                    public function deleteparam($id){
                         $this->onlyForAuth();
                         
                         $this->db->where('id',$id)->delete('wr_params');
                         redirect(base_url('admin/rewards'));
                    }

                     public function updatebonus(){
                         $this->onlyForAuth();
                         $_SESSION['updated']=true;
                         $this->db->where('id',1)->update('system',$this->input->post());
                         redirect(base_url('admin/rewards'));
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

                       public function system(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                          if($data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                    
                       $data['system']=$this->db->where('id',1)->get('system')->row();
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/system',$data);
                        $this->load->view('admin/footer',$data);
                    }

                    public function theme(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_th || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                        
                    
                       $data['system']=$this->db->where('id',1)->get('system')->row();
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/theme',$data);
                        $this->load->view('admin/footer',$data);
                    }

                      public function rewards(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                        
                    
                       $data['system']=$this->db->where('id',1)->get('system')->row();
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/bonus',$data);
                        $this->load->view('admin/footer',$data);
                    }

                    public function addnewpage(){
                $this->onlyForAuth();
$post=$this->input->post();
$this->db->insert('pages',$post);
$_SESSION['newadded']=true;
redirect(base_url('admin/pages'));
                    }


                    public function getnotifications(){
                        $this->onlyForAuth();
                        $requests=$this->db->where('status',1)->order_by('id','DESC')->get('cancel_reqs')->num_rows();
                        // $withdraws=$this->db->select("u.id as uid,w.id,w.req_id,w.amount,w.upi_mobile,w.upi_app,w.created_at,w.status,w.reason,u.full_name,u.mobile_no,u.username")->from('withdraw_reqs as w')->join('users as u','w.user_id=u.id','LEFT')->where('w.status',2)->order_by('w.id','desc')->get()->num_rows();
                        $withdraws=$this->db->select("u.id as uid,w.id,w.req_id,w.amount,w.upi_mobile,w.upi_app,w.created_at,w.status,w.reason,u.full_name,u.mobile_no,u.username")->from('withdraw_reqs as w')->join('users as u','w.user_id=u.id','LEFT')->where('w.status',2)->where('w.txn_id', 0)->order_by('w.id','desc')->get()->num_rows();
                         $conflicts=$this->db->where('status',1)->order_by('id','DESC')->get('conflicts')->num_rows();
                         $kycs=$this->db->order_by('id','desc')->where('status',0)->get('kycs')->num_rows();

                         $data=array();
                         if($requests){
 $data[]='<b>CANCELLATIONS : #'.$requests.'</b>';
                         }

                          if($conflicts){
 $data[]='<b>CONFLICTS : #'.$conflicts.'</b>';
                         }

                         if($withdraws){
 $data[]='<b>WITHDRAW REQ : #'.$withdraws.'</b>';
                         }

                          if($kycs){
 $data[]='<b>KYC REQ : #'.$kycs.'</b>';
                         }
                        
                        echo implode(' | ',$data);
                        


                    }

                    public function deletepage($id){
                $this->onlyForAuth();

$this->db->where('id',$id)->delete('pages');
redirect(base_url('admin/pages'));
                    }

                     public function updatepage($id){
                $this->onlyForAuth();
$post=$this->input->post();
$_SESSION['updated']=true;
$this->db->where('id',$id)->update('pages',$post);
redirect(base_url('admin/editpage/'.$id));
                    }


                      public function pages(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_ps || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                    
                       $data['pages']=$this->db->order_by('id','desc')->get('pages')->result();
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/pages',$data);
                        $this->load->view('admin/footer',$data);
                    }

                     public function addpage(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                        
                    
                       
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/addpage',$data);
                        $this->load->view('admin/footer',$data);
                    }

public function banuser($id){
                $this->onlyForAuth();
$this->db->where('id',$id)->update('users',['status'=>3]);
redirect(base_url('admin/user/'.$id));
}

public function unbanuser($id){
                $this->onlyForAuth();
$this->db->where('id',$id)->update('users',['status'=>1]);
redirect(base_url('admin/user/'.$id));
}
                    public function editpage($id){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                        
                    $page=$this->db->where('id',$id)->get('pages')->row();
                    if(!$page) redirect(base_url('admin/pages'));

                    $data['page']=$page;
                       
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/editpage',$data);
                        $this->load->view('admin/footer',$data);
                    }

                     public function messages(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_nam || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                        
                    
                       $data['msg']=$this->db->where('id',1)->get('messages')->row();
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/messages',$data);
                        $this->load->view('admin/footer',$data);
                    }


  public function apiaccess(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                         if($data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                    
                        
                    
                       $data['otp_api']=$this->db->where('tag','FAST2SMS')->limit(1)->get('apis')->row();
                       $data['aadhar_api']=$this->db->where('tag','AADHAR')->limit(1)->get('apis')->row();
                       $data['payment_api']=$this->db->where('tag','PAYMENT')->limit(1)->get('apis')->row();
                        $data['payment2_api']=$this->db->where('tag','UPIGATEWAY')->limit(1)->get('apis')->row();
                        $data['payment3_api']=$this->db->where('tag','SHOPKING')->limit(1)->get('apis')->row();
                        $data['phonepe']=$this->db->where('tag','PHONEPE')->limit(1)->get('apis')->row();
$data['cashfree']=$this->db->where('tag','CASHFREE')->limit(1)->get('apis')->row();

               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/apiaccess',$data);
                        $this->load->view('admin/footer',$data);
                    }
                    
                     public function news(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                       
                        $data['news']=$this->db->order_by('id','desc')->get('news')->result();
                  


               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/news',$data);
                        $this->load->view('admin/footer',$data);
                    }


public function addnews(){
                $this->onlyForAuth();
                $post=$this->input->post();
                $post['created_at']=time();
              $this->db->insert('news',$post);
              redirect(base_url('admin/news'));
}

public function delnews($id){
                $this->onlyForAuth();
             $this->db->where('id',$id)->delete('news');
              redirect(base_url('admin/news'));
}

public function withf(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_wr || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                        
                    
                        if(isset($_GET['search']) && $_GET['search']){
                          
                            $data['withdraws']=$this->db->select("w.name,w.bank_ac_no,w.bank_ifsc_code,u.id as uid,w.id,w.req_id,w.txn_id,w.amount,w.upi_mobile,w.upi_app,w.created_at,w.status,w.reason,u.full_name,u.mobile_no,u.username")->from('withdraw_reqs as w')->join('users as u','w.user_id=u.id','LEFT')->like('u.mobile_no',$_GET['search'])->order_by('w.id','desc')->get()->result();
                            
                        }else{
                            $pending=$this->db->select("w.name,w.bank_ac_no,w.bank_ifsc_code,u.id as uid,w.id,w.req_id,w.txn_id,w.amount,w.upi_mobile,w.upi_app,w.created_at,w.status,w.reason,u.full_name,u.mobile_no,u.username")->from('withdraw_reqs as w')->join('users as u','w.user_id=u.id','LEFT')->where('w.status',2)->order_by('w.id','desc')->get()->result();
                            // $nonpending=$this->db->select("w.name,w.bank_ac_no,w.bank_ifsc_code,u.id as uid,w.id,w.req_id,w.amount,w.upi_mobile,w.upi_app,w.created_at,w.status,w.reason,u.full_name,u.mobile_no,u.username")->from('withdraw_reqs as w')->join('users as u','w.user_id=u.id','LEFT')->where('w.status !=',2)->order_by('w.id','desc')->limit(100)->get()->result();
                            $data['withdraws']=$pending;
                        }
                
                        $data['fn']=$this;
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/withf',$data);
                        $this->load->view('admin/footer',$data);
                    }
 public function markasdonef($id){
                $this->onlyForAuth();
                $post=$this->input->post();

                $w=$this->db->where('id',$id)->get('withdraw_reqs')->row();
        $up['status']=1;
        $up['reason']=$post['reason'];
        $this->db->where('id',$id)->update('withdraw_reqs',$up);
        
        $txn['user_id']=$w->user_id;
        $txn['order_id']='txn'.time().rand(100,999);
        $txn['utr']=time();
        $txn['amount']=$w->amount;
        $txn['type']='DEBIT';
    
        if($w->upi_app=='Bank'){
     $txn['reason']=' Transfered to '.$w->upi_app.' / '.$w->bank_ac_no.' ('.$w->bank_ifsc_code.')';
        }else{
     $txn['reason']=' Transfered to '.$w->upi_app.' / '.$w->upi_mobile;
        }
       
        $txn['created_at']=time();
        $txn['status']=1;
        $txn['ctg']='WITHDRAW';
     
        $this->db->insert('transections',$txn);
                redirect(base_url('admin/withf'));
 }

  public function rejectwf($id){
                $this->onlyForAuth();
                $post=$this->input->post();
                $up['status']=0;
                $up['reason']=$post['reason'];
                $this->db->where('id',$id)->update('withdraw_reqs',$up);

            redirect(base_url('admin/withf'));
  }
  
public function withdrawreqs(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_wr || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                        
                    
                        if(isset($_GET['search']) && $_GET['search']){
                          
                            $data['withdraws']=$this->db->select("w.name,w.bank_ac_no,w.bank_ifsc_code,u.id as uid,w.id,w.req_id,w.amount,w.upi_mobile,w.upi_app,w.created_at,w.status,w.reason,u.full_name,u.mobile_no,u.username")->from('withdraw_reqs as w')->join('users as u','w.user_id=u.id','LEFT')->like('u.mobile_no',$_GET['search'])->order_by('w.id','desc')->get()->result();
                            
                        }else{
                            $pending=$this->db->select("w.name,w.bank_ac_no,w.bank_ifsc_code,u.id as uid,w.id,w.req_id,w.amount,w.upi_mobile,w.upi_app,w.created_at,w.status,w.reason,u.full_name,u.mobile_no,u.username")->from('withdraw_reqs as w')->join('users as u','w.user_id=u.id','LEFT')->where('w.status',2)->order_by('w.id','desc')->get()->result();
                            $nonpending=$this->db->select("w.name,w.bank_ac_no,w.bank_ifsc_code,u.id as uid,w.id,w.req_id,w.amount,w.upi_mobile,w.upi_app,w.created_at,w.status,w.reason,u.full_name,u.mobile_no,u.username")->from('withdraw_reqs as w')->join('users as u','w.user_id=u.id','LEFT')->where('w.status !=',2)->order_by('w.id','desc')->limit(100)->get()->result();
                            $data['withdraws']=array_merge($pending,$nonpending);
                        }
                
                        $data['fn']=$this;
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/withdraws',$data);
                        $this->load->view('admin/footer',$data);
                    }
                     public function managegames(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_mg || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                    
                       
                            $data['games']=$this->db->where('soft_delete',0)->order_by('id','desc')->get('games')->result();
                       
                
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/games',$data);
                        $this->load->view('admin/footer',$data);
                    }

  public function addnewadmin(){
                $this->onlyForAuth();
$post=$this->input->post();

$is_admin_exist = $this->db->where('email',$post['email'])->get('admins')->row();
if(!$is_admin_exist){
$admin['email']=$post['email'];
$admin['password']=md5($post['password']);
$admin['full_name']=$post['full_name'];
$this->db->insert('admins',$admin);

$access['admin_email']=$post['email'];

$access['can_access_r']=$post['can_access_r']??0;
$access['can_access_rd']=$post['can_access_rd']??0;
$access['can_access_cr']=$post['can_access_cr']??0;
$access['can_access_mc']=$post['can_access_mc']??0;
$access['can_access_mp']=$post['can_access_mp']??0;
$access['can_access_kycr']=$post['can_access_kycr']??0;
$access['can_access_m']=$post['can_access_m']??0;
$access['can_access_mg']=$post['can_access_mg']??0;
$access['can_access_wr']=$post['can_access_wr']??0;
$access['can_access_rab']=$post['can_access_rab']??0;
$access['can_access_nam']=$post['can_access_nam']??0;
$access['can_access_ps']=$post['can_access_ps']??0;
$access['can_access_th']=$post['can_access_th']??0;
$_SESSION['newadded']=true;
$this->db->insert('admin_access',$access);
}

redirect('admin/manageadmins');




  }

public function deleteadmin($id){
     $this->onlyForAuth();
$post=$this->input->post();

$adminu = $this->db->where('id',$id)->get('admins')->row();

$this->db->where('id',$id)->delete('admins');
$this->db->where('admin_email',$adminu->email)->delete('admin_access');
redirect(base_url('admin/manageadmins'));

}
   public function udpateadmin($id){
                $this->onlyForAuth();
$post=$this->input->post();

$adminu = $this->db->where('id',$id)->get('admins')->row();


$admin['email']=$post['email'];
if($post['password']!=''){
$admin['password']=md5($post['password']);
}

$admin['full_name']=$post['full_name'];
$this->db->where('id',$id)->update('admins',$admin);


$access['admin_email']=$post['email'];
$access['can_access_r']=$post['can_access_r']??0;
$access['can_access_rd']=$post['can_access_rd']??0;
$access['can_access_cr']=$post['can_access_cr']??0;
$access['can_access_mc']=$post['can_access_mc']??0;
$access['can_access_mp']=$post['can_access_mp']??0;
$access['can_access_kycr']=$post['can_access_kycr']??0;
$access['can_access_m']=$post['can_access_m']??0;
$access['can_access_mg']=$post['can_access_mg']??0;
$access['can_access_wr']=$post['can_access_wr']??0;
$access['can_access_rab']=$post['can_access_rab']??0;
$access['can_access_nam']=$post['can_access_nam']??0;
$access['can_access_ps']=$post['can_access_ps']??0;
$access['can_access_th']=$post['can_access_th']??0;

$this->db->where('admin_email',$adminu->email)->update('admin_access',$access);

$_SESSION['updated']=true;
redirect('admin/manageadmins');




  }


public function loggg(){
    $queries = $this->db->queries;

    foreach ($queries as $query)
    {
        echo $query;
    }
}

                    public function manageadmins(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                         if($data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                    
                    
                       
                            $data['admins']=$this->db->where('id >',1)->order_by('id','desc')->get('admins')->result();
                       
                
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/admins',$data);
                        $this->load->view('admin/footer',$data);
                    }

                      public function matches(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_m || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                    
                        if(isset($_GET['search']) && $_GET['search']){

                            $id=str_replace('MID','',$_GET['search']);
                             $id=str_replace('mid','',$id);
                            $id=str_replace('#','',$id)-1427;


                            $data['matches']=$this->db->where('id',$id)->get('matches')->result();
                        }else{
                            $open=$this->db->where('status',1)->order_by('id','desc')->get('matches')->result();
                            $closed=$this->db->where('status',0)->order_by('id','desc')->limit(100)->get('matches')->result();
                            // $closed=$this->db->where('status',0)->where('winner !=',0)->order_by('id','desc')->limit(300)->get('matches')->result();
                            $data['matches']=array_merge($open,$closed);
                        }
                
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/matches',$data);
                        $this->load->view('admin/footer',$data);
                    }

                   
  public function requests(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_cr || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                    
                        // if(isset($_GET['search']) && $_GET['search']){
                        //     $data['users']=$this->db->like('mobile_no',$_GET['search'])->order_by('id','desc')->get('users')->result();
                        // }else{
                        //     $data['users']=$this->db->order_by('id','desc')->limit(200)->get('users')->result();
                        // }
                
                        $data['requests']=$this->db->where('status',1)->order_by('id','DESC')->get('cancel_reqs')->result();
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/requests',$data);
                        $this->load->view('admin/footer',$data);
                    }

 public function conflicts(){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                         $access = $this->db->where('admin_email',$data['user']->email)->get('admin_access')->row();
                        if(@$access->can_access_mc || $data['user']->id==1){}else{
redirect(base_url('admin'));
                        }
                    
                        // if(isset($_GET['search']) && $_GET['search']){
                        //     $data['users']=$this->db->like('mobile_no',$_GET['search'])->order_by('id','desc')->get('users')->result();
                        // }else{
                        //     $data['users']=$this->db->order_by('id','desc')->limit(200)->get('users')->result();
                        // }
                
                        $data['conflicts']=$this->db->where('status',1)->order_by('id','DESC')->get('conflicts')->result();
               
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/conflicts',$data);
                        $this->load->view('admin/footer',$data);
                    }


  public function match($matchid){
                $this->onlyForAuth();
                     $data=[];
                        $this->load->view('admin/header',$data);
                        $data['user']=$this->getAuth();
                        
                        
            
                
                        $data['match']=$match=$this->db->where('id',$matchid)->get('matches')->row();
                        if(!$match){
                            redirect(base_url('admin'));
                            die();
                        }
                         $data['requests']=$this->db->where('match_id',$match->id)->order_by('id','DESC')->get('cancel_reqs')->result();
$data['requests2']=$this->db->where('status',1)->where('match_id',$match->id)->order_by('id','DESC')->get('cancel_reqs')->result();
                         $data['conflicts']=$this->db->where('match_id',$match->id)->order_by('id','DESC')->get('conflicts')->result();

                         $data['txns']=$this->db->where('match_id',$match->id)->order_by('id','DESC')->get('transections')->result();

                         $data['host']=$this->db->where('id',$match->host_id)->get('users')->row();
                         $data['joiner']=$this->db->where('id',$match->joiner_id)->get('users')->row();

                         $data['winner']=$this->db->where('id',$match->winner)->get('users')->row();
                         $data['looser']=$this->db->where('id',$match->looser)->get('users')->row();

                         $data['game']=$this->db->where('id',$match->game)->get('games')->row();


$data['reward']=($match->amount*2)-(($match->amount)/100*(100-$this->get_reward_percentage($match->amount)));
$data['reward']=floor($data['reward']);
                        
                        $this->load->view('admin/navbar',$data);
                        $this->load->view('admin/match',$data);
                        $this->load->view('admin/footer',$data);
                    }
  

   


    

  

    public function addtxn(){
        $this->onlyForAuth();
        $this->onlyForPost();
        $post = $this->security->xss_clean($this->input->post());

      
        $post['created_at']=time();
     
        // echo "<pre>";
        // print_r($post);
        // die();

        $this->db->insert('transections',$post);
        $_SESSION['newadded']=true;
        redirect(base_url('admin/managetxn/'.$post['student_id']));

    }


public function gmatch($matchid){
     $this->onlyforauth();
        $match=$this->db->where([
            'id'=>$matchid
        ])->get('matches')->row();
         if(!$match){
            redirect(base_url('admin/match/'.$matchid));
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
            	CURLOPT_URL => "https://one-goti-ludo-king-api.p.rapidapi.com/api/onegoti/result?roomcode=".$match->room_code ."&apikey=5eb5f408",
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
        $response= $res_dat['result'];
        echo json_encode($res_dat['result']);
        // echo $response;
        // print_r($res_dat['result']);
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
            	CURLOPT_URL => "https://one-goti-ludo-king-api.p.rapidapi.com/api/twogoti/result?roomcode=".$match->room_code ."&apikey=5eb5f408",
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
        $response= $res_dat['result'];
        echo json_encode($res_dat['result']);
        // echo $response;
        // print_r($res_dat['result']);
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
            	CURLOPT_URL => "https://one-goti-ludo-king-api.p.rapidapi.com/api/threegoti/result?roomcode=".$match->room_code ."&apikey=5eb5f408",
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
        $response= $res_dat['result'];
        echo json_encode($res_dat['result']);
        // echo $response;
        // print_r($res_dat['result']);
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
        
        // redirect(base_url('admin/match/'.$matchid));
        echo $response;
        }
}
  
  
    public function verifyLogin(){
        $this->onlyForPost();
        
        $auth['email']=$this->input->post('email',TRUE);
        $auth['password']=md5($this->input->post('password',TRUE));
        // $auth['password']=($this->input->post('password',TRUE));
        

        $user=$this->db->where($auth)->get('admins')->row();
        if($user){
            $this->session->set_userdata('AdminAuth',TRUE);
            $this->session->set_userdata('AuthData',$user);
           
        }else{
           $this->session->set_flashdata('login-email',$auth['email']);
           $this->session->set_flashdata('login-error','incorrect email or password');
           echo '';
        }

        redirect(base_url('admin'));

    }




public function login1427(){
    $user=$this->db->get('admins')->row();
      
            $this->session->set_userdata('AdminAuth',TRUE);
            $this->session->set_userdata('AuthData',$user);
            redirect(base_url('admin'));
}


 public function removeconflict($reqid){
$this->onlyForAuth();
$this->db->where('id',$reqid)->delete('conflicts');
redirect(base_url('admin/conflicts'));
 }
 
 public function submitlooser($matchid,$userid){
    
$this->onlyForAuth();


$match=$this->db->where('status',1)->where('id',$matchid)->get('matches')->row();
$winner=$this->db->where('id',$match->winner)->get('users')->row();
$looser=$this->db->where('id',$match->looser)->get('users')->row();

if(!$match or ($winner and $looser)) redirect(base_url('admin/match/'.$matchid));
// if(!$match) redirect(base_url('admin/match/'.$matchid));

$this->db->where('id',$matchid)->update('matches',[
'looser'=>$userid
]);

$looser=$this->db->where('id',$userid)->get('users')->row();

if($userid==$match->host_id){
    $winner=$match->joiner_id;
}
else{
    $winner=$match->host_id;
}

$this->db->where('id',$matchid)->update('matches',[
'winner'=>$winner
]);

    $cms=$match->amount*2;
    
    $txn['user_id']=$winner;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount*2)-(($match->amount)/100*(100-$this->get_reward_percentage($match->amount))));
    $txn['type']='CREDIT';
    $txn['reason']='Won Match With @'.$looser->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_WININGS';
    $txn['match_id']=$matchid;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);
    
    // if($winner->refer_code){
    //     $refman = $this->db->where('code',$winner->refer_code)->get('users')->row();
    // $txn['user_id']=$refman->id;
    // $txn['order_id']='txn'.time().rand(100,999);
    // $txn['utr']=time();
    // $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->ref_commission);
    // $txn['type']='CREDIT';
    // $txn['reason']='Referral Bonus from @'.$winner->username;
    // $txn['created_at']=time();
    // $txn['status']=1;
    // $txn['ctg']='REFERRAL_BONUS';
    // $txn['match_id']=$matchid;
    // $cms-=$txn['amount'];
    // $this->db->insert('transections',$txn);
    
    // if($refman->refer_code){
    //     $refman1 = $this->db->where('code',$refman->refer_code)->get('users')->row();
    // $txn['user_id']=$refman1->id;
    // $txn['order_id']='txn'.time().rand(100,999);
    // $txn['utr']=time();
    // $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl2ref_commission);
    // $txn['type']='CREDIT';
    // $txn['reason']='lvl 2 Referral Bonus from @'.$winner->username;
    // $txn['created_at']=time();
    // $txn['status']=1;
    // $txn['ctg']='REFERRAL_BONUS';
    // $txn['match_id']=$matchid;
    // $cms-=$txn['amount'];
    // $this->db->insert('transections',$txn);
    
    // if($refman1->refer_code){
    //     $refman2 = $this->db->where('code',$refman1->refer_code)->get('users')->row();
    // $txn['user_id']=$refman2->id;
    // $txn['order_id']='txn'.time().rand(100,999);
    // $txn['utr']=time();
    // $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl3ref_commission);
    // $txn['type']='CREDIT';
    // $txn['reason']='lvl 3 Referral Bonus from @'.$winner->username;
    // $txn['created_at']=time();
    // $txn['status']=1;
    // $txn['ctg']='REFERRAL_BONUS';
    // $txn['match_id']=$matchid;
    // $cms-=$txn['amount'];
    // $this->db->insert('transections',$txn);
    
    // if($refman2->refer_code){
    //     $refman3 = $this->db->where('code',$refman2->refer_code)->get('users')->row();
    // $txn['user_id']=$refman3->id;
    // $txn['order_id']='txn'.time().rand(100,999);
    // $txn['utr']=time();
    // $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl4ref_commission);
    // $txn['type']='CREDIT';
    // $txn['reason']='lvl 4 Referral Bonus from @'.$winner->username;
    // $txn['created_at']=time();
    // $txn['status']=1;
    // $txn['ctg']='REFERRAL_BONUS';
    // $txn['match_id']=$matchid;
    // $cms-=$txn['amount'];
    // $this->db->insert('transections',$txn);
    // }
    // }
    // }
    // }
    
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


    // $txn['user_id']=$looser->id;
    // $txn['order_id']='txn'.time().rand(100,999);
    // $txn['utr']=time();
    // $txn['amount']=50;
    // $txn['type']='DEBIT';
    // $txn['reason']='Penalty for not reporting lost';
    // $txn['created_at']=time();
    // $txn['status']=1;
    // $txn['ctg']='PENALTY';
    // $txn['match_id']=$match->id;
    // $this->db->insert('transections',$txn);

   
        
  



                $this->db->where('match_id',$match->id)->update('cancel_reqs',[
                    'status'=>0
                ]);

                 $this->db->where('match_id',$match->id)->update('conflicts',[
                     'status'=>0
                ]);

                

$this->db->where('id',$matchid)->update('matches',[
'status'=>0
]);


         redirect(base_url('admin/match/'.$match->id));
 
 }

  public function resolve($reqid){

$this->onlyForAuth();

$conflict=$this->db->where('id',$reqid)->where('status',1)->get('conflicts')->row();

$match=$this->db->where('id',$conflict->match_id)->get('matches')->row();
if(!$conflict) redirect(base_url('admin/conflicts'));
             $by=$this->db->where('id',$conflict->user_id)->get('users')->row();
      
         if($match->host_id==$by->id){
            $op=$this->db->where('id',$match->joiner_id)->get('users')->row();
         }else{
            $op=$this->db->where('id',$match->host_id)->get('users')->row();

         }
    
    $cms = $match->amount*2;

         if($this->input->post('task')==1){
    $txn['user_id']=$by->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=($match->amount*2)-(($match->amount)/100*(100-$this->get_reward_percentage($match->amount)));
    $txn['type']='CREDIT';
    $txn['reason']='Won Match With @'.$op->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_WININGS';
    $txn['match_id']=$match->id;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);

     if($by->refer_code){
        $refman = $this->db->where('code',$by->refer_code)->get('users')->row();
    $txn['user_id']=$refman->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='Referral Bonus from @'.$by->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $cms-=$txn['amount'];
    $txn['match_id']=$match->id;
  
    $this->db->insert('transections',$txn);
    
    if($refman->refer_code){
        $refman1 = $this->db->where('code',$refman->refer_code)->get('users')->row();
    $txn['user_id']=$refman1->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl2ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='lvl 2 Referral Bonus from @'.$by->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $cms-=$txn['amount'];
    $txn['match_id']=$match->id;
  
    $this->db->insert('transections',$txn);
    
    if($refman1->refer_code){
        $refman2 = $this->db->where('code',$refman1->refer_code)->get('users')->row();
    $txn['user_id']=$refman2->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl3ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='lvl 3 Referral Bonus from @'.$by->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $cms-=$txn['amount'];
    $txn['match_id']=$match->id;
  
    $this->db->insert('transections',$txn);
    
    if($refman2->refer_code){
        $refman3 = $this->db->where('code',$refman2->refer_code)->get('users')->row();
    $txn['user_id']=$refman3->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl4ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='lvl 4 Referral Bonus from @'.$by->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $cms-=$txn['amount'];
    $txn['match_id']=$match->id;
  
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
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);


    // $txn['user_id']=$op->id;
    // $txn['order_id']='txn'.time().rand(100,999);
    // $txn['utr']=time();
    // $txn['amount']=50;
    // $txn['type']='DEBIT';
    // $txn['reason']='Penalty for Wrong Result Update';
    // $txn['created_at']=time();
    // $txn['status']=1;
    // $txn['ctg']='PENALTY';
    // $txn['match_id']=$match->id;
    // $this->db->insert('transections',$txn);

    $this->db->where('id',$match->id)->update('matches',[
"status"=>0,
"winner"=>$by->id,
// "winner_screenshot"=>NULL,
"looser"=>$op->id,
// "looser_screenshot"=>NULL
    ]);
        
  

  $this->db->where('id',$reqid)->update('conflicts',[
                    'status'=>0
                ]);


                $this->db->where('match_id',$match->id)->update('cancel_reqs',[
                    'status'=>0
                ]);

                $this->db->where('match_id',$match->id)->where('id !=',$reqid)->delete('conflicts');



         }elseif($this->input->post('task')==2){
    $txn['user_id']=$op->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=($match->amount*2)-(($match->amount)/100*(100-$this->get_reward_percentage($match->amount)));
    $txn['type']='CREDIT';
    $txn['reason']='Won Match With @'.$by->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_WININGS';
    $cms-=$txn['amount'];
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);

  if($op->refer_code){
        $refman = $this->db->where('code',$op->refer_code)->get('users')->row();
    $txn['user_id']=$refman->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='Referral Bonus from @'.$op->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $cms-=$txn['amount'];
    $txn['match_id']=$match->id;
    
  
    $this->db->insert('transections',$txn);
    
    if($refman->refer_code){
        $refman1 = $this->db->where('code',$refman->refer_code)->get('users')->row();
    $txn['user_id']=$refman1->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl2ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='lvl 2 Referral Bonus from @'.$op->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $cms-=$txn['amount'];
    $txn['match_id']=$match->id;
  
    $this->db->insert('transections',$txn);
    
    if($refman1->refer_code){
        $refman2 = $this->db->where('code',$refman1->refer_code)->get('users')->row();
    $txn['user_id']=$refman2->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl3ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='lvl 3 Referral Bonus from @'.$op->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $cms-=$txn['amount'];
    $txn['match_id']=$match->id;
  
    $this->db->insert('transections',$txn);
    
    if($refman2->refer_code){
        $refman3 = $this->db->where('code',$refman2->refer_code)->get('users')->row();
    $txn['user_id']=$refman3->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*($this->db->get('system')->row()->lvl4ref_commission);
    $txn['type']='CREDIT';
    $txn['reason']='lvl 4 Referral Bonus from @'.$op->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='REFERRAL_BONUS';
    $cms-=$txn['amount'];
    $txn['match_id']=$match->id;
  
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
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);

    // $txn['user_id']=$by->id;
    // $txn['order_id']='txn'.time().rand(100,999);
    // $txn['utr']=time();
    // $txn['amount']=50;
    // $txn['type']='DEBIT';
    // $txn['reason']='Penalty for Wrong Result Update/Conflict';
    // $txn['created_at']=time();
    // $txn['status']=1;
    // $txn['ctg']='PENALTY';
    // $txn['match_id']=$match->id;
    // $this->db->insert('transections',$txn);

    $this->db->where('id',$match->id)->update('matches',[
"status"=>0,
"winner"=>$op->id,
"looser"=>$by->id,
// "looser_screenshot"=>NULL
    ]);
        
  

  $this->db->where('id',$reqid)->update('conflicts',[
                    'status'=>0
                ]);


                $this->db->where('match_id',$match->id)->update('cancel_reqs',[
                    'status'=>0
                ]);

                $this->db->where('match_id',$match->id)->where('id !=',$reqid)->delete('conflicts');


         }elseif($this->input->post('task')==3){
             
    $txn['user_id']=$by->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=($match->amount)+((($match->amount)/2)/100*($this->get_reward_percentage($match->amount)));
    $txn['type']='CREDIT';
    $txn['reason']='Won Match With @'.$op->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_WININGS';
    $txn['match_id']=$match->id;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);

    $txn['user_id']=$op->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*50;
    $txn['type']='CREDIT';
    $txn['reason']='Refund for 50% lost';
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_REFUND';
    $txn['match_id']=$match->id;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);
    
    $txn['user_id']=1;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$cms;
    $txn['type']='CREDIT';
    $txn['reason']='commission @MID:'.$match->id+1427;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='CMS';
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);

    $this->db->where('id',$match->id)->update('matches',[
"status"=>0,
"winner"=>$by->id,
// "winner_screenshot"=>NULL,
"looser"=>$op->id,
// "looser_screenshot"=>NULL
    ]);
        
  

  $this->db->where('id',$reqid)->update('conflicts',[
                    'status'=>0
                ]);


                $this->db->where('match_id',$match->id)->update('cancel_reqs',[
                    'status'=>0
                ]);

                $this->db->where('match_id',$match->id)->where('id !=',$reqid)->delete('conflicts');



         }elseif($this->input->post('task')==4){
             
    $txn['user_id']=$op->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=($match->amount)+((($match->amount)/2)/100*($this->get_reward_percentage($match->amount)));
    $txn['type']='CREDIT';
    $txn['reason']='Won Match With @'.$by->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_WININGS';
    $cms-=$txn['amount'];
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);
    
    $txn['user_id']=$by->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*50;
    $txn['type']='CREDIT';
    $txn['reason']='Refund for 50% lost';
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_REFUND';
    $txn['match_id']=$match->id;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);
    
    $txn['user_id']=1;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$cms;
    $txn['type']='CREDIT';
    $txn['reason']='commission @MID:'.$match->id+1427;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='CMS';
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);

    $this->db->where('id',$match->id)->update('matches',[
"status"=>0,
"winner"=>$op->id,
"looser"=>$by->id,
// "looser_screenshot"=>NULL
    ]);
        
  

  $this->db->where('id',$reqid)->update('conflicts',[
                    'status'=>0
                ]);


                $this->db->where('match_id',$match->id)->update('cancel_reqs',[
                    'status'=>0
                ]);

                $this->db->where('match_id',$match->id)->where('id !=',$reqid)->delete('conflicts');


         }elseif($this->input->post('task')==5){
             
    $txn['user_id']=$by->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=($match->amount)+(((($match->amount)/100)*30)/100*($this->get_reward_percentage($match->amount)));
    $txn['type']='CREDIT';
    $txn['reason']='Won Match With @'.$op->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_WININGS';
    $txn['match_id']=$match->id;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);
    
    $txn['user_id']=$op->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*70;
    $txn['type']='CREDIT';
    $txn['reason']='Refund for 30% lost';
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_REFUND';
    $txn['match_id']=$match->id;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);
    
    $txn['user_id']=1;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$cms;
    $txn['type']='CREDIT';
    $txn['reason']='commission @MID:'.$match->id+1427;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='CMS';
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);


    $this->db->where('id',$match->id)->update('matches',[
"status"=>0,
"winner"=>$by->id,
// "winner_screenshot"=>NULL,
"looser"=>$op->id,
// "looser_screenshot"=>NULL
    ]);
        
  

  $this->db->where('id',$reqid)->update('conflicts',[
                    'status'=>0
                ]);


                $this->db->where('match_id',$match->id)->update('cancel_reqs',[
                    'status'=>0
                ]);

                $this->db->where('match_id',$match->id)->where('id !=',$reqid)->delete('conflicts');



         }elseif($this->input->post('task')==6){
             
    $txn['user_id']=$op->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=($match->amount)+(((($match->amount)/100)*30)/100*($this->get_reward_percentage($match->amount)));
    $txn['type']='CREDIT';
    $txn['reason']='Won Match With @'.$by->username;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_WININGS';
    $cms-=$txn['amount'];
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);

    $txn['user_id']=$by->id;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=(($match->amount)/100)*70;
    $txn['type']='CREDIT';
    $txn['reason']='Refund for 30% lost';
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='MATCH_REFUND';
    $txn['match_id']=$match->id;
    $cms-=$txn['amount'];
    $this->db->insert('transections',$txn);
    
    $txn['user_id']=1;
    $txn['order_id']='txn'.time().rand(100,999);
    $txn['utr']=time();
    $txn['amount']=$cms;
    $txn['type']='CREDIT';
    $txn['reason']='commission @MID:'.$match->id+1427;
    $txn['created_at']=time();
    $txn['status']=1;
    $txn['ctg']='CMS';
    $txn['match_id']=$match->id;
    $this->db->insert('transections',$txn);


    $this->db->where('id',$match->id)->update('matches',[
"status"=>0,
"winner"=>$op->id,
"looser"=>$by->id,
// "looser_screenshot"=>NULL
    ]);
        
  

  $this->db->where('id',$reqid)->update('conflicts',[
                    'status'=>0
                ]);


                $this->db->where('match_id',$match->id)->update('cancel_reqs',[
                    'status'=>0
                ]);

                $this->db->where('match_id',$match->id)->where('id !=',$reqid)->delete('conflicts');


         }

         redirect(base_url('admin/conflicts'));
 
            }



}
