</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var timer;
var count = 0;

 $(function () {
// for adjusting the height and width of youtube player
  $('.video-container iframe').attr('height',$('.video-container').width()*9/16);

 });

 //for stoping instructions video on close of offcanvas bottom
$(".close").click(function(){
 $("#iframe-instruction").attr('src', $('#iframe-instruction').attr('src'));
})

$("#offcanvasBottom").on('hidden.bs.offcanvas',function(){
 $("#iframe-instruction").attr('src', $('#iframe-instruction').attr('src'));
})


 $(".showloading").click(function(){
    $("#loading").show();
 })

 $(document).on("click", '.showloading', function(event) { 
    $("#loading").show();
});


 $(".otp").keydown(function(e){

    if($(this).val()>99999){
    e.preventDefault();
    }
    
 })

$(".showloadingform").submit(function(){
    $("#loading").show();
})


 function register(){
    $("#otp").val('')
    let mobileno=document.querySelector('#mobileno').value;
    let fullname=document.querySelector('#fullname').value;
    let refercode=document.querySelector('#refercode').value;
if(!fullname){
    swal("Please enter your full name");
    return;
}
if(!mobileno){
    swal("Please enter your 10 digit mobile no");
    return;
}
$("#loading").show();
$.ajax({
    method:'post',
    url:'<?=base_url('api/send_otp/')?>'+mobileno,
    dataType:'json',
    data:{
        mobile_no:mobileno,
        full_name:fullname,
        refer_code:refercode,
    },
    success:function(res){
$("#loading").hide();
if(res.return==true){
     swal('please enter 6 digit code sended to your mobile no');
$("#signup").hide();
$("#signupotp").show();
starttimer();
}else{
 
    swal(res.message);

}

    },
    error:function(res){
$("#loading").hide();

        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})


 }

 $("#signup_btn").click(function(){
    if(count!=0){

        swal('please wait, '+count+' seconds before sending, otp again');
        return;
    }
    register();
 })

 function login(){


    let mobileno=document.querySelector('#mobileno').value;

if(!mobileno){
    swal("Please enter your 10 digit mobile no");
    return;
}
$("#loading").show();
$.ajax({
    method:'post',
    url:'<?=base_url('api/send_login_otp/')?>'+mobileno,
    dataType:'json',
    success:function(res){
$("#loading").hide();
if(res.return==true){
     swal('please enter 6 digit code sended to your mobile no');
$("#login").hide();
$("#loginotp").show();
loginstarttimer();
}else{
 
    swal(res.message);

}

    },
    error:function(res){
$("#loading").hide();

        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})
 }

  $("#getotp_btn").click(function(){
    if(count!=0){

        swal('please wait, '+count+' seconds before sending, otp again');
        return;
    }
    login();
 })

 $("#resendotp-btn").click(function(){
    register();
 })

 $("#login-resendotp-btn").click(function(){
    login();
 })

 $("#changenumber-btn").click(function(){
    $("#otp").val('');
    $("#signup").show();
    $("#mobileno").val('');
    $("#signupotp").hide();

 })

  $("#login-changenumber-btn").click(function(){
    $("#otp").val('');
    $("#login").show();
    $("#mobileno").val('');
    $("#loginotp").hide();

 })

 function loginstarttimer(){
    count=60
     $("#resendotp-msg").html('Resend otp in '+count+' seconds');
        $("#login-resendotp-btn").attr('disabled',true)

//update display

timer = setTimeout(update, 1000);
function update()
{
    if (count > 0)
    {
       $("#resendotp-msg").html('Resend otp in '+(--count)+' seconds');
       timer = setTimeout(update, 1000);
    }
    else
    {
        $("#resendotp-msg").html('');
        $("#login-resendotp-btn").attr('disabled',false)
    }
}
}

function starttimer(){
    count=60
     $("#resendotp-msg").html('Resend otp in '+count+' seconds');
        $("#resendotp-btn").attr('disabled',true)

//update display

timer = setTimeout(update, 1000);
function update()
{
    if (count > 0)
    {
       $("#resendotp-msg").html('Resend otp in '+(--count)+' seconds');
       timer = setTimeout(update, 1000);
    }
    else
    {
        $("#resendotp-msg").html('');
        $("#resendotp-btn").attr('disabled',false)
    }
}
}



$("#login-verifyotp-btn").click(function(){
     let mobileno=document.querySelector('#mobileno').value;
    let otp=document.querySelector('#otp').value;


if(!mobileno){
    swal("Please enter your 10 digit mobile no");
    return;
}
if(!otp || otp<100000 || otp>999999){
    swal("Please enter 6 digit code");
    return;
}

$("#loading").show();
$.ajax({
    method:'post',
    url:'<?=base_url('api/verify_login_otp/')?>'+otp,
    dataType:'json',
    data:{
        mobile_no:mobileno,
    },
    success:function(res){
$("#loading").hide();

if(res.status==true){
     swal(res.message);
     $('input').attr('disabled',true)
     $('button').attr('disabled',true)
     setTimeout(() => {
          window.location.reload();
     }, 1500);
   
}else{
$("#otp").val('')
     swal(res.message);
}
console.log(res);

    },
    error:function(res){
$("#loading").hide();

        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})
 })


$("#verifyotp-btn").click(function(){
     let mobileno=document.querySelector('#mobileno').value;
    let fullname=document.querySelector('#fullname').value;
    let refercode=document.querySelector('#refercode').value;
    let otp=document.querySelector('#otp').value;

if(!fullname){
    swal("Please enter your full name");
    return;
}
if(!mobileno){
    swal("Please enter your 10 digit mobile no");
    return;
}
if(!otp || otp<100000 || otp>999999){
    swal("Please enter 6 digit code");
    return;
}

$("#loading").show();
$.ajax({
    method:'post',
    url:'<?=base_url('api/verify_otp/')?>'+otp,
    dataType:'json',
    data:{
        mobile_no:mobileno,
        full_name:fullname,
        refer_code:refercode,
        uotp:otp
    },
    success:function(res){
$("#loading").hide();

if(res.status==true){
     swal(res.message);
     $('input').attr('disabled',true)
     $('button').attr('disabled',true)
     setTimeout(() => {
          window.location.reload();
     }, 1500);
   
}else{
$("#otp").val('')
     swal(res.message);
}
console.log(res);

    },
    error:function(res){
$("#loading").hide();

        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})
 })

 $(".avatar").click(function(){
    $("#loading").show()
    $("#profile").attr('src',$(this).attr('src'))
    
    $.ajax({
    method:'post',
    url:'<?=base_url('api/changeavatar')?>',
    data:{
        avatar:$(this).attr('src')     
    },
    success:function(res){
    $("#loading").hide()

         $('#avatars').modal('toggle');
console.log(res);
    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})
 })


 $("#addmoney_btn").click(function(){
    if(!$("#damount").val()){
swal('enter amount first !')
        return;
    }

    if($("#damount").val()<10 || $("#damount").val()>10000){

        swal('you can deposit minimum ₹ 10 rs & maximum ₹ 10000 rs')
        return;
    }

    
    $("#loading").show()
    

    
    $.ajax({
    method:'post',
    url:'<?=base_url('api/createorder')?>',
    data:{
        amount:$("#damount").val()     
    },
    dataType:'json',
    success:function(res){
    window.location.href=res.gotourl;
console.log(res);
    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})
 })


$(function() {
   <?php
if($this->session->flashdata('txnmsg')){
    ?>
swal("<?=$this->session->flashdata('txnmsg')?>")
    <?php
}

?>
});

function hasWhiteSpace(s) {
  return /\s/g.test(s);
}

$(".money").click(function(){


var addmount = $(this).text()
addamount = addmount.replace(/[^0-9]/g, '')


$("#damount").val(addamount)
});
var aadhar_verification_ref_id=null;

$("#verify-kyc").click(function(){
    let aadharno = $("#aadharno").val();
      if(aadharno<100000000000 || aadharno>999999999999 || aadharno==''){
    swal('please enter a valid aadhar no');
    return;
   }

 $("#loading").show()


   $.ajax({
    method:'post',
    url:'<?=base_url('api/sendaadharotp')?>',
    data:{
        aadharno:aadharno   
    },
    dataType:'json',
    success:function(res){
 $("#loading").hide()

        console.log(res)

        if(res.code==200 && ('ref_id' in res.data) ){
aadhar_verification_ref_id=res.data.ref_id;
swal('OTP sent successfully');
$("#enteraadhar").hide();
$("#verifyaotp").show();
        }else{
            
          swal(res.data.message);  
        }

//     if(res.status==true){
// location.reload();
//     }else{
//         $("#loading").hide()
//         swal(res.msg);
//     }

   
console.log(res);
    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})



})



$("#verify-kyc-otp").click(function(){
  var aadharotp = $("#aadharotp").val();
  let aadharno = $("#aadharno").val();
   if(aadharotp==''){
    swal('please enter otp');
    return;
   }
      if(aadhar_verification_ref_id==null){
    swal('something went wrong, please try again after some time');
    return;
   }

 $("#loading").show()


   $.ajax({
    method:'post',
    url:'<?=base_url('api/verifyaadharotp')?>',
    data:{
        aadharotp:aadharotp,
        ref_id:aadhar_verification_ref_id ,
        aadhar_no:aadharno
    },
    dataType:'json',
    success:function(res){


        console.log(res)

        if(res.code==200 && ('dob' in res.data) ){
location.reload();

        }else{
          $("#loading").hide()
          swal(res.message);  
        }




    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})



})






$("#update-username").click(function(){
    let username = $("#username").val()
    if(username==''){
        swal('please enter a username')
        return;
    }
    var re = /^[a-zA-Z0-9_]+$/; // or /^\w+$/ as mentioned
if (!re.test(username)) {
swal('only letters,numbers and underscore allowed in username');
return;
}
   
 $("#loading").show()
   
    
    $.ajax({
    method:'post',
    url:'<?=base_url('api/changeusername')?>',
    data:{
        username:username     
    },
    dataType:'json',
    success:function(res){
    $("#loading").hide()
    if(res.status==true){
swal('username updated !')
    }else{
        swal(res.msg);
    }

   
console.log(res);
    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})

})

function copyreflink(containerid) {

  if (document.selection) {
    var range = document.body.createTextRange();
    range.moveToElementText(document.getElementById(containerid));
    range.select().createTextRange();
    document.execCommand("copy");
    swal('copied !')
    return;
  } else if (window.getSelection) {
    var range = document.createRange();
    range.selectNode(document.getElementById(containerid));
    window.getSelection().addRange(range);
    document.execCommand("copy");
    swal('copied !')
    return;
  }

  swal('sorry , your browser not allowing us to copy')
}



$("#creategame-btn").click(function(){
    let gameamount = $("#match-amount").val()
    let game = $("#match").val()

   if(gameamount<=0 || gameamount=='' || (gameamount%5)!==0){
    swal('please enter amount in multiple of 5');
    return;
   }



   
   
 $("#loading").show()
   
    
    $.ajax({
    method:'post',
    url:'<?=base_url('api/creatematch')?>',
    data:{
        match:game,
        amount:gameamount     
    },
    dataType:'json',
    success:function(res){
    if(res.status==true){
location.reload();
    }else{
        $("#loading").hide()
        swal(res.msg);
    }

   
console.log(res);
    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})

})

<?php
if(isset($isDasboardOpended) && $isDasboardOpended){
    ?>

    

    function loadmatches(){
      //load matches starts here
 $.ajax({
    method:'get',
    url:'<?=base_url('user/loadmatches')?>',
    success:function(res){
    
        $("#mymatches").html(res)

    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})

// laod matches ends here
    }


    
    function loadopenmatches(){
      //load matches starts here
 $.ajax({
    method:'get',
    url:'<?=base_url('user/loadopenmatches')?>',
    success:function(res){
    
        $("#openmatches").html(res)

    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})

// laod matches ends here
    }

$(function() {
loadmatches();
loadopenmatches()

    setInterval(() => {
  
loadmatches()
loadopenmatches()
    }, 1500);


});
    <?php
}
?>





$("#updateroomcode-btn").click(function(){
    let roomcode = $("#roomcode").val();

    if(roomcode=='' || roomcode<1){
        swal('please enter room code')
        return;
    }
    
    
 
   
 $("#loading").show()
   
    
    $.ajax({
    method:'post',
    url:'<?=base_url('api/updateroomcode')?>',
    data:{
        room_code:roomcode,
        match:<?=@$match->id??0?>     
    },
    dataType:'json',
    success:function(res){
    
    if(res.status==true){
location.reload();
    }else{
        $("#loading").hide()
        swal(res.msg);
    }

   
console.log(res);
    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})

})

<?php
if(isset($match) && !$match->room_code){
    ?>
$(function() {

    setInterval(() => {
       $.ajax({
    method:'get',
    url:'<?=base_url('user/getroomcode/'.$match->id)?>',
    success:function(res){
        console.log(res)
if(res>0){
$("#loading").show();
location.reload();
}
    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})  
    }, 2000);


});
    <?php
}
?>

$("#wmoney_btn").click(function(){

    let upi = $("#upi").val();
    let upiapp = $("#upiapp").val();
    let wamount = $("#wamount").val();

      if(upi==''){
        swal('please enter a upi id or registered mobile no')
        return;
    }

     if(wamount=='' || wamount<<?=$this->db->get('system')->row()->minimum_withdraw?>){
        swal('you can withdraw minimum <?=$this->db->get('system')->row()->minimum_withdraw?> rs')
        return;
    }
    $("#loading").show()

     $.ajax({
    method:'post',
    url:'<?=base_url('api/addwithdrawreq')?>',
    data:{
        upi:upi,
        upiapp:upiapp,
        wamount:wamount     
    },
    dataType:'json',
    success:function(res){
    
    if(res.status==true){

        $("#upi").val('')
        $("#upiapp").val('')
        $("#wamount").val('')

location.reload();
    }else{
        $("#loading").hide()
        swal(res.msg);
    }

   
console.log(res);
    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Server Down, Please Try Again After Some time.");
    }
    
})

})
 $(".creason").click(function(){

        $(".creason").removeClass('btn-primary');
        $(".creason").removeClass('btn-outline-primary');
        $(".creason").addClass('btn-outline-primary');
        $(this).removeClass('btn-outline-primary');
        $(this).addClass('btn-primary');
$("#creason").val($(this).text());

    })
</script>
</body>
</html>