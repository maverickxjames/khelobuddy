<br>
<br>
<br>


</div>


<div class="modal fade" id="rules" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Rules</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <p><?=$this->db->get('messages')->row()->on_conflict_pop_up?></p?
      </div>
   
    </div>
  </div>
</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
<?php
if(isset($match) && $match->joiner_time){
    ?>
var countDownDate = new Date(" <?=date('M d, Y H:i:s',$match->joiner_time+150)?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  if(seconds<10){
    seconds='0'+seconds
  }
  console.log('play audio');
             document.getElementById('clock').play();
  document.getElementById("timer").innerHTML = '0'+ minutes + ":" + seconds ;
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "Times Up";
    $("#loading").show();
    location.reload();
  }
}, 1000);
    <?php
}

?>


    var timer;
var count = 0;

$("#upiapp").change(function(){
    if($(this).val()=='Bank'){
$('.bank').show();
$('.nonbank').hide();
    }else{
$('.bank').hide();
$('.nonbank').show();
    }
})

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
        $("#signup").hide();
        $("#signupotp").show();
        starttimer();
        // console.log(res)
        // swal("You can get otp only 3 times in 60 min, If you have other issue contact admin");
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
$("#login").hide();
$("#loginotp").show();
loginstarttimer();
        starttimer();
        // swal(res.message);
        // console.log(res)
        // swal("You can get otp only 3 times in 60 min, If you have other issue contact admin");
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
        swal("Error, Please Try Again After Some time.");
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
        swal("Error, Please Try Again After Some time.");
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
        swal("Error, Please Try Again After Some time.");
    }
    
})
 })


 $("#addmoney_btn").click(function(){
    if(!$("#damount").val()){
swal('enter amount first !')
        return;
    }

    if($("#damount").val()<10 || $("#damount").val()>100000){

        swal('you can deposit minimum ₹ 10 rs & maximum ₹ 100000 rs')
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
        swal("Error, Please Try Again After Some time.");
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
        swal("Something went wrong, please refresh and try Again After Some time.");
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

   if(gameamount<=0 || gameamount=='' || (gameamount%<?=$this->db->get('system')->row()->game_amount?>)!==0){
    swal('please enter amount in multiple of <?=$this->db->get('system')->row()->game_amount?>');
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
        swal("Something went wrong, please refresh and try Again After Some time.");
    }
    
})

})

<?php
if(isset($isDasboardOpended) && $isDasboardOpended){
    ?>

    
var oldmdata='';

    function loadmatches(){
      //load matches starts here
 $.ajax({
    method:'get',
    url:'<?=base_url('user/loadmatches/'.($game_id??''))?>',
    success:function(res){
    
        $("#mymatches").html(res)
        
        if(oldmdata!=res){
            console.log('play audio');
            document.getElementById('notsound').play();
            
        }
        oldmdata=res;

    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Inactive for too long, Please refresh");
    }
    
})

// laod matches ends here
    }

    var opmslist=[]

    setInterval(() => {
        let opms = document.querySelectorAll('.opm')

        opms.forEach(opm => {
            let opmid=$(opm).data('id')

            if(opmslist.includes(opmid)===false){
            $(opm).addClass('animate__animated animate__backInLeft')
            //document.getElementById('notsound').play();
            opmslist.push(opmid);
            }

           
        });
    }, 0);
     

    
    function loadopenmatches(){
      //load matches starts here
 $.ajax({
    method:'get',
    url:'<?=base_url('user/loadopenmatches/'.($game_id??''))?>',
    success:function(res){
    
        $("#openmatches").html(res)

    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Inactive for too long, Please refresh");
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
        swal("सही roomcode  डाले ");
    }
    
})

})

<?php
if(isset($match) && !$match->room_code){
    ?>
    var ajaxisrunning=false;
$(function() {


    setInterval(() => {
        if(ajaxisrunning) return;
        ajaxisrunning=true;
       $.ajax({
    method:'get',
    url:'<?=base_url('user/getroomcode/'.$match->id)?>',
    success:function(res){
        console.log(res)
if(res>0){
$("#loading").show();
location.reload();
}
ajaxisrunning=false;
    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Something went wrong, please refresh");
    }
    
})  
    }, 100);


});
    <?php
}
?>

<?php
if(isset($match)){
    ?>
    var ajaxisrunning=false;
$(function() {

  

    setInterval(() => {
        if(ajaxisrunning) return;
        ajaxisrunning=true;

       $.ajax({
    method:'get',
    url:'<?=base_url('user/getgamestatus/'.$match->id)?>',
    dataType:'json',
    success:function(res){
        console.log(res)
if(res.status==0){
$("#loading").show();
location.reload();
}
ajaxisrunning=false;
    }
,
    error:function(res){
         $("#loading").hide()
        console.log(res)
        swal("Something went wrong, please refresh");
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
    let name = $("#name_in_bank").val();
    let bankno = $("#bank_ac_no").val();
    let ifsc = $("#bank_ifsc_code").val();
    
    upi = upi.trim();
    name = name.trim();
    bankno = bankno.trim();
    ifsc = ifsc.trim();
    
       if(upiapp=='Bank'){
if(name==''){
        swal('please enter your full name shown in your bank passbook')
        return;
    }

 
    if(ifsc==''){
        swal('please enter your bank ifsc code ')
        return;
    }
       if(bankno==''){
        swal('please enter your bank account no')
        return;
    }
       }else{
if(upi==''){
        swal('please enter a upi id or registered mobile no')
        return;
    }
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
        wamount:wamount,
        name:name,
        bankno:bankno,
        ifsc:ifsc
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
        swal("Something went wrong, please refresh and try Again After Some time.");
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

    
   const installButton=document.querySelector('#download') 
   if('serviceWorker' in navigator) {
       navigator.serviceWorker.register("<?=base_url('sw.js')?>").then(registration => {
           console.log('sw worker registred',registration)
       })
   }else{
       console.log('application not supported');
   }
   
   // This variable will save the event for later use.
let deferredPrompt;
window.addEventListener('beforeinstallprompt', (e) => {
  // Prevents the default mini-infobar or install dialog from appearing on mobile
  e.preventDefault();
  // Save the event because you'll need to trigger it later.
  deferredPrompt = e;
  // Show your customized install prompt for your PWA
  // Your own UI doesn't have to be a single element, you
  // can have buttons in different locations, or wait to prompt
  // as part of a critical journey.
  showInAppInstallPromotion();
});
    
    // Gather the data from your custom install UI event listener
installButton.addEventListener('click', async () => {
  // deferredPrompt is a global variable we've been using in the sample to capture the `beforeinstallevent`
  deferredPrompt.prompt();
  // Find out whether the user confirmed the installation or not
  const { outcome } = await deferredPrompt.userChoice;
  // The deferredPrompt can only be used once.
  deferredPrompt = null;
  // Act on the user's choice
  if (outcome === 'accepted') {
    console.log('User accepted the install prompt.');
  } else if (outcome === 'dismissed') {
    console.log('User dismissed the install prompt');
  }
});


</script>

<?php
if($this->db->get('system')->row()->livcht){
    ?>
<!-- Start of LiveChat (www.livechat.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 17840988;
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
    <?php
    if(isset($user)){
    ?>
    LiveChatWidget.call("set_customer_name", <?=$user->mobile_no?>);
    <?php
    }
    ?>
</script>
<noscript><a href="https://www.livechat.com/chat-with/17840988/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<!-- End of LiveChat code -->
<?php
}
?>

</body>
</html>