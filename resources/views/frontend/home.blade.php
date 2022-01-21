@extends('frontend.layouts.app')
@section('extra_css')
    <style>
        .slide {
    position: relative;
    height: 80vh;
    margin: 10px;
    display: flex;
    flex: 1;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    cursor: pointer;
    color: #fff;
    border-radius: 20px;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    -ms-border-radius: 20px;
    -o-border-radius: 20px;
    transition: flex 0.3s;
    -webkit-transition: flex 0.3s;
    -moz-transition: flex 0.3s;
    -ms-transition: flex 0.3s;
    -o-transition: flex 0.3s;
  }
  
  .slide h3 {
    font-size: 24px;
    letter-spacing: 3px;
    position: absolute;
    left: 20px;
    bottom: 5px;
    opacity: 0;
    transition: opacity 0.3s ease 0.3s;
    -webkit-transition: opacity 0.3s ease 0.3s;
    -moz-transition: opacity 0.3s ease 0.3s;
    -ms-transition: opacity 0.3s ease 0.3s;
    -o-transition: opacity 0.3s ease 0.3s;
  }
  
  .slide.active {
    flex: 10;
  }
  
  .slide.active h3 {
    opacity: 1;
  }

    </style>
@endsection
@include('frontend.layouts.nav')

@section('content')

<section class="main-content">
    <div class="main-content-img">
        <img alt="" src="https://www.footyrenders.com/render/kylian-mbappe-48.png">
    </div> 
    <h2 class="main-content-title">ဘောပွဲလောင်းမယ်</h2> 
    <p class="main-content-text">
        Promotion များကိုဒီနေရာတွင် ကြေညာနိုင်သည်။
    </p> 
</section>
<section>
    <div class="game-box">
        <div class="card">
            <div class="card-header">
                <h3>ပွဲစဥ်များ</h3>
            </div>
            <div class="card-body">
                <div class="match_today container" id="match_today">
                    <h3>Matches ( 25 July )</h3>
                    
                    <div class="widget-content">
                    
                    <!--matches-->
                    <div class="match-content">
                        <a class="fullink" href="#"></a>
                        <div class="match-content-inner">
                            <div class="mpart1">
                            <div class="right_match">
                                <span class="right_tech">
                                    <img src="{{ asset('image/football.png') }}">
                                    <div class="fname">မန်ယူ</div>
                                </span>
                            </div>
                            <strong class="match-time">19:00</strong>
                            <div class="left_match">
                                <span class="left_tech">
                                    <img src="{{ asset('image/football.png') }}">
                                    <div class="fname">အာဆင်နယ်</div>
                                </span>
                                </div>
                            </div>
                            <div class="details_match">
                                <span class="first_match">
                                    အပေါ်ကြေးအသင်း (2+65)
                                </span>
                                <span class="thany">
                                    ဂိုးပေါင်း (3-50)
                                </span>
                                <span class="liga_mdw">
                                    အောက်ကြေးအသင်း
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="match-content">
                        <a class="fullink" href="#"></a>
                        <div class="match-content-inner">
                            <div class="mpart1">
                            <div class="right_match">
                                <span class="right_tech">
                                    <img src="{{ asset('image/football.png') }}">
                                    <div class="fname">မန်ယူ</div>
                                </span>
                            </div>
                            <strong class="match-time">19:00</strong>
                            <div class="left_match">
                                <span class="left_tech">
                                    <img src="{{ asset('image/football.png') }}">
                                    <div class="fname">အာဆင်နယ်</div>
                                </span>
                                </div>
                            </div>
                            <div class="details_match">
                                <span class="first_match">
                                    အပေါ်ကြေးအသင်း (2+65)
                                </span>
                                <span class="thany">
                                    ဂိုးပေါင်း (3-50)
                                </span>
                                <span class="liga_mdw">
                                    အောက်ကြေးအသင်း
                                </span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>

<script>
    const slides = document.querySelectorAll(".slide");

    for (const slide of slides) {
        slide.addEventListener("click", () => {
            removeActiveClass();
            slide.classList.add("active");
        });
        }

        function removeActiveClass() {
        slides.forEach((slide) => {
            slide.classList.remove("active");
        });
    }

</script>
@endsection
