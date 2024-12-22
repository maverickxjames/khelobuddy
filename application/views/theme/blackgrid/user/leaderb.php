<style>
         .fixed_kefu {
         position: fixed;
         right: 5px;
         top: 80%;
         display: flex;
         justify-content: center;
         align-items: center;
         flex-direction: column;
         font-size: 12px;
         color: #000;
         border-radius: 50%;
         background: #fff;
         width: 60px;
         height: 60px;
         box-shadow: 0 0 1px #000;
             z-index: 9999;
         }
         .fixed_kefu img {
         max-width: 65px;
         max-height: 65px;
         width:100%;
         height:100%;
         }
         .htwspan{
         /* margin: 0 auto; */
         display: table;
         color: #000;
         font-size: 25px;
         /* margin-top: 5px; */
         margin-bottom: 15px;
         margin-top: 10px;
         }
         .box img {
         width: 72px;
         height: 65px;
         padding: 5px;
         margin: 5px;
         }
         .box {
         align-self: flex-end;
         animation-duration: 2s;
         animation-iteration-count: infinite;
         margin: -10px auto -20px auto;
         transform-origin: bottom;
         width: 200px;
         }
         .bounce-1, .bounce-3, .bounce-5 {
         animation-name: bounce-1;
         animation-timing-function: linear;
         }
         @keyframes bounce-1 {
         0%   { transform: translateY(0); }
         50%  { transform: translateY(-10px); }
         100% { transform: translateY(0); }
         }
         .bounce-2, .bounce-4{
         animation-name: bounce-2;
         animation-timing-function: linear;
         }
         @keyframes bounce-2 {
         0%   { transform: translateY(0); }
         50%  { transform: translateY(10px); }
         100% { transform: translateY(0); }
         }
         .counter li {
         display: inline-block;
         font-size: 14px;
         list-style-type: none;
         padding: 0.5em;
         text-transform: uppercase;
         font-weight: 500;
         background: #fff;
         margin-bottom: 15px;
         width: 23%;
         border-radius: 15px 15px;
         box-shadow: 3px 5px 0 rgb(172 182 192 / 30%);
         }
         .counter li span {
         background:#FAFAFB;
         display: block;
         margin-top: 10px;
         }
         .ribbon {
         font-weight: 600;
         font-size: 14px;
         color: #fff;
         position: absolute;
         top: 30px;
         margin-left: 33%;
         }
         .card .card-title {
         color:#696969;
         font-size:20px;
         font-weight:500;
         margin-bottom:16px
         }
         .fade-item {
         text-align:center;
         padding:20px 0px;
         list-style: none;
         transition: 2s all ease-in-out;
         opacity: 0;
         }
         .tabs-list  .active span{
         background:#FFF7F7;
         }
         .tabs-list  .active a{
         box-shadow: 0 2px 4px 3px rgb(238 211 215 / 30%);
         }
         .tabs-list  a .redimg{
         display:none;
         }
         .tabs-list .active .redimg{
         display:block;
         }
         .tabs-list li span{
         background:#DFDFDF;
         }
         #overlay{
         display: none;
         position: fixed;
         top: 0%;
         left: 0%;
         width: 100%;
         height: 100%;
         background-color: black;
         z-index:1001;
         }
         #overlay-content{ 
         position: fixed;
         width: 100%;
         height: 100%;
         background-color: red;
         text-align:center
         }
         #text{
         margin-top:150%;
         font-size:25px;
         text-align:center;
         color:#fff;
         font-weight:600;
         }
         .word-bx{
         font-size: 10px;
         font-weight: 100;
         color: #eee;
         }
         .cssbox {
         overflow: hidden;
         position: relative;
         display: flex;
         height: 30px;
         }
         .swipetext {
         vertical-align:middle;
         color: #000000;
         font-weight: 400;
         font-size: 16px;
         padding: 0 10px;
         height: 45px;
         margin-bottom: 45px;
         display: block;
         }
         .words { 
         animation: words 10s cubic-bezier(0.23, 1, 0.32, 1.2) infinite; 
         }
         @keyframes words {
         0% {
         margin-top: -360px; 
         }
         5% {
         margin-top: -270px; 
         }
         25% {
         margin-top: -270px; 
         }
         30% {
         margin-top: -180px; 
         }
         50% {
         margin-top: -180px; 
         }
         55% {
         margin-top: -90px; 
         }
         75% {
         margin-top: -90px; 
         }
         80% {
         margin-top: 0px; 
         }
         99.99% {
         margin-top: 0px; 
         }
         100% {
         margin-top: -270px; 
         }
         }
         .headerflag1{
         margin-left:14px;
         width: 100px;
         height: 45px;
         margin-top: -2px;  
         }
         .download1{
           width: 45px;
           height: 45px;   
           margin-top: -70px;  
          margin-right:-10px;
         }
         .headerflag{
           width: 100px;
           height: 30px;   
           margin-top: 5px;  
          margin-left:10px;
          border-radius: 5px;
           border: 1px ;
         }
         .appHeader1{
            color: #000;
            width: 100%;
            height: 50px;
            background: #f7f8ff;
         }
         
         .pull-right img{
             width:30px;
         }
         .pull-right{
             margin-right: 0px;
         }
         .notice{
                display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
            width: 100%;
            height: 55px;
            padding-inline: 0.26667rem;
            color: #303a4c;
            font-size: 12px;
            border-radius: 30px;
            background: #fff;
            box-shadow: 0 3px 3px #d0d0ed4d;
         }
         
.notice_title {
        width: 66%;
    /* padding: 0 0.26667rem; */
    display: inline-block;
    /* line-height: .8rem; */
    /* color: #fff; */
    height: 35px;
    right: 3px;
    top: -12px;
    position: absolute;
    /* padding: 5px; */
    background-color: #fff;
    background-image: url(./images/dtl.png);
    border-radius: 20px;
    color: #fff;
    background-size: 100px;
    background-repeat: no-repeat;
}
.notice_title img{
    width:40px;
}
.gamelist-box{
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    height: 100%;
    margin-top: 10px;
    width:100%;
}
.g-side-b{
    -webkit-flex-shrink: 0;
    flex-shrink: 0;
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    flex-grow: 1;
    /*width: 10%;*/
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}
.game-type{
        
    
    background: url(images/bg-edc23a85.png) no-repeat;
    background-size: 100% 100% !important;
    width: 80px;
    height: 80px;
    margin-bottom: 10px;
    padding: 0;
    font-weight: 500;
    
    background-size: 100% 100%;
    position: relative;
    display: block;
    box-sizing: border-box;
    padding: var(--van-sidebar-padding);
    overflow: hidden;
    color: var(--van-sidebar-text-color);
    font-size: var(--van-sidebar-font-size);
    line-height: var(--van-sidebar-line-height);
    
    cursor: pointer;
    -webkit-user-select: none;
    user-select: none;
}
.g-dtl{
    display: flex;
    height: 80px;
    flex-direction: column;
    align-items: center;
    
}
.g-dtl img{
    width: 50px;
    margin-top: 5px;
}
.g-dtl span{
    color:black;
    font-size: 14px;
}
.gm-b{
    position: sticky;
    top: 0;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: inline-flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    flex-direction: column;
    width: 80%;
    height: -webkit-min-content;
    height: min-content;
    padding-left: 5px;
    
}
.gm-b-c{
    
}
.game-lb{
    position: relative;
    width: 100%;
     height: 100px;
    /* text-align: end; */
    background: -webkit-linear-gradient(324.57deg,#ff8e89 12.38%,#ffc3a2 87.13%);
    background: linear-gradient(125.43deg,#ff8e89 12.38%,#ffc3a2 87.13%);
    box-shadow: 0 -0.05333rem 0.13333rem #fff6f4 inset, 0 0.10667rem 0.21333rem 0.05333rem #d0d0ed5c;
    margin-bottom: 10px;
    border-radius: 20px;
    display: flex;
    justify-content: space-around;
    padding: 14px 6px;
}
.gm-t img{
    width:90px;
}
.gm-t p{
    margin: 0px;
    color: #f4f5f8;
    font-weight: 600;
    font-size: 12px;
    white-space: pre-wrap;
    /* text-align: left; */
    line-height: 20px;
}
.gm-t h{
    /*font-size:14px;*/
    /*margin:0px;*/
    color:#fff;
    white-space: break-spaces;
    font-weight: 700;
    font-size: 15px;
}
.wind-h h1{
    font-size: 20px;
    padding-left: 14px;
    font-weight: 700;
    color: #473e3e;
}
.wind-h h1::before {
        content: "";
    position: relative;
    top: 28px;
    left: -10px;
    z-index: 9999;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    width: 4px;
    height: 15px;
    background: #f64646;
    display: block;
}
}
.wind-db{
        overflow: hidden;
}
.wind-dt{
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
    width: 100%;
    /*height: 1.6rem;*/
    margin-bottom: 10px;
    padding: 0.26667rem 0.24rem;
    border-radius: 0.13333rem;
    background: #fff;
    box-shadow: 0 0.05333rem 0.21333rem #d0d0ed5c;
}
.wd{
    display: flex;
    flex-direction: row;
    align-items: center;
        padding: 8px;
}
.wind-lft img{
    width: 65px!important;
    border-radius: 50px;
}
.wind-lft span{
    color: #243047;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: 700;
}
.r-txt {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    color: #243047;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: 700;
}
.wd img{
    width:100px;
}
.place{
    position: relative;
    display: grid;
    grid-template-columns: repeat(3,1fr);
    justify-items: center;
    width: 100%;
    z-index: 1;
    height: 160px;
    margin-bottom: 30px;
    background: url(images/stage-f0b7a560.png) no-repeat center center/100% 100%;
}
.p-box{
        position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    flex-direction: column;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
    width: 3rem;
    height: 3.46667rem;
}
.p-imgu{
    position: relative;
    display: grid;
    place-items: center;
    width: 80px;
    /* min-width: 65px; */
    /* height: 80px; */
    min-height: 80px;
    border-radius: 50%;
    overflow: hidden;
}
.p-imgb{
    position: absolute;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    justify-content: space-between;
    width: 80px;
    height: 80px;
}
.p-imgu img{
    width: 80px;
    border-radius: 40px;
}
.p-imgb img{
    /*width: 70px;*/
    /*border-radius: 40px;*/
}
.ia{
    position: relative;
    top: -42px;
    left: -35px;
    width: 80px;
}
.ib{
    width: 110px;
    position: relative;
    left: -14px;
    top: 5px;
}
.p-txt {
    text-align: center;
    margin-top: 15px;
    color: #fff;
    font-weight: 700;
    font-size: 12px;
}
.am{
    padding: 2px 14px;
    border-radius: 20px;
    display: block;
    color: #fff;
    background: linear-gradient(90deg,#ff8f8b 1.19%,#ffbda0 97.86%);
}
.p-dt{
        position: relative;
    z-index: 2;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    flex-direction: column;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
    gap: 0.21333rem;
    width: 100%;
    top: -40px;
}
.wind-db{
    width: 100%;
}
.carousel-item{
 border-radius: 20px;   
    
}


</style>
<div class="mt-3 mx-2 p-2">



<div class="card" id="">
  <div class="card-header text-center">
   Leaderboard
  </div>
  <div class="card-body py-2 justify-content-between">
<div class="wind-b">
    <div class="wind-db" style="margin-top: 100px;">
<div class="place">
            
            <div class="p-box">
                
                <div class="p-imgu" style="top: -23px;">
                    <img src="<?=base_url('assets/images/avatars/'.$txns[1]->avatar)?>">
                </div>
                <div class="p-imgb" style="top: -23px;">
                    <img class="ia" src="<?=base_url('assets/images/crown2-c8aced52.png')?>">
                    <img class="ib" src="<?=base_url('assets/images/place2-8189be28.png')?>">
                </div>
                <div class="p-txt">
                    <span><?=$txns[1]->username?></span>
                    <span class="am"><?=$txns[1]->total_amount?></span>
                </div>
                
                
                
            </div>
            <div class="p-box">
                
                <div class="p-imgu" style="top: -50px;">
                    <img src="<?=base_url('assets/images/avatars/'.$txns[0]->avatar)?>">
                </div>
                <div class="p-imgb" style="top: -50px;">
                    <img class="ia" src="<?=base_url('assets/images/crown1-3912fd85.png')?>">
                    <img class="ib" src="<?=base_url('assets/images/place1-fe39c3f3.png')?>">
                </div>
                <div class="p-txt">
                    <span><?=$txns[0]->username?></span>
                    <span class="am"><?=$txns[0]->total_amount?></span>
                </div>
                
                
                
            </div>
            <div class="p-box">
                
                <div class="p-imgu" style="top: -20px;">
                    <img src="<?=base_url('assets/images/avatars/'.$txns[2]->avatar)?>">
                </div>
                <div class="p-imgb" style="top: -20px;">
                    <img class="ia" src="<?=base_url('assets/images/crown3-2ca02146.png')?>">
                    <img class="ib" src="<?=base_url('assets/images/place3-d9b0be38.png')?>">
                </div>
                <div class="p-txt">
                    <span><?=$txns[2]->username?></span>
                    <span class="am"><?=$txns[2]->total_amount?></span>
                </div>
                
                
                
            </div>
            
</div>

<?php
for($t=3;$t<20;$t++){
    ?>
    <div class="wind-dt">
        <div class="wind-lft wd">
            <div class="wind-img">
                <img src="<?=base_url('assets/images/avatars/'.$txns[$t]->avatar)?>">
                <span><?=$txns[$t]->username?></span>
            </div>
            
        </div>
        <div class="wind-rigt wd">
            
            
            <div class="r-txt am" style="font-size: 18px;font-size: 18px;width: 140px;text-align: center;margin-left: 5px;">
                <span><?=$txns[$t]->total_amount?></span>
            </div>
            
        </div>
        
    </div>
    <?php
}
?>   
</div>
</div>
<!-- </div>
    <button href="#" class="btn w-100 btn-primary my-2" id="loadmore-btn" >SHOW MORE</button>

  </div> -->
</div>

</div>
