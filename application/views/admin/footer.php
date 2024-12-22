 <!-- CoreUI and necessary plugins-->
 <script src="<?=base_url('assets/adminpanel/dist')?>/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="<?=base_url('assets/adminpanel/dist')?>/vendors/simplebar/js/simplebar.min.js"></script>


    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
        $(".showloading").click(function(){
            $("#loadingscreen").show();
        })

        $("form").submit(function(){
            
            $("#loadingscreen").show();
        });

    function readURL(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#directorprofilei").change(function(){
    readURL(this,'directorprofile');
});

$("#centerlogoi").change(function(){
    readURL(this,'centerlogo');
});

function showalert(type,msg){
    let timerInterval
Swal.fire({
 icon:type,
  html: msg,
  timer: 4000,
  timerProgressBar: true,
  didOpen: () => {
 
    const b = Swal.getHtmlContainer().querySelector('b')
    timerInterval = setInterval(() => {
      b.textContent = Swal.getTimerLeft()
    }, 100)
  },
  willClose: () => {
    clearInterval(timerInterval)
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    
  }
})
}

$(".updatecentercourses").submit(function(e){
e.preventDefault();
$.ajax({
    url:$(this).attr('action'),
    method:'post',
    data:$(this).serialize(),
    success:function(res){
$("#loadingscreen").hide();
showalert('success','Courses Selection Updated Successfully !')

    }
})
})

$(".updatestudentcourses").submit(function(e){
e.preventDefault();
$.ajax({
    url:$(this).attr('action'),
    method:'post',
    data:$(this).serialize(),
    success:function(res){
$("#loadingscreen").hide();
showalert('success','Courses Selection Updated Successfully !')

    }
})
})

<?php
if(isset($_SESSION['newadded'])){
?>
showalert('success','Added Successfully !')
<?php
    unset($_SESSION['newadded']);
}
?>

<?php
if(isset($_SESSION['updated'])){
?>
showalert('success','Updated Successfully !')
<?php
    unset($_SESSION['updated']);
}
?>

$('.icardform').submit(function(){
    $("#loadingscreen").hide();
})


$(document).ready( function () {
      $.fn.dataTable.ext.errMode = 'none';
    $('.datatable1').DataTable({ "bSort" : false });
    $('.datatable2').DataTable({ "bSort" : false });
    $('.datatable3').DataTable({ "bSort" : false });

  

   
} );

$(document).ready(function() {
  $('#page_content').summernote({
    height:200
  });
var ajaxisrunning=false;

  setInterval(() => {
if(ajaxisrunning) return;
    ajaxisrunning=true;
    $.ajax({
    url:'<?=base_url('admin/getnotifications')?>',
    method:'post',
    success:function(res){
        ajaxisrunning=false;
        console.log(res)
if(res){
$(".notstrip").show();
$(".notstrip").html('<div class="px-2 animate__animated animate__flash animate__infinite	infinite">'+res+'</div>');
console.log('show not');
}else{
$(".notstrip").hide();
$(".notstrip marquee").html('');
console.log('hide not');
}
    },
    error:function(res){
        console.log(res)
    }
})
}, 5000);
});



    </script>
    
  </body>
</html>