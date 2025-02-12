@extends('layouts.app')
@section('title', 'Главная')
@section('content')
    <!-- slider-area -->
    <section id="home" class="slider-area slider-four fix p-relative">

        <div class="slider-active">
            <div class="single-slider slider-bg d-flex align-items-center" style="background: url(img/slider/slider_img_bg.png) no-repeat;background-size: cover; background-position: center top;">
                <div class="container">
                    <div class="row justify-content-center pt-50">
                        <div class="col-lg-1 col-md-1">
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="slider-content s-slider-content">
                                <h5 data-animation="fadeInDown" data-delay=".4s">#world class game</h5>
                                <h2 data-animation="fadeInUp" data-delay=".4s">Are You ready For your next Challenge ?</h2>
                                <div class="slider-btn">
                                    <a href="about.html" class="btn ss-btn mr-15">Read More</a>

                                </div>


                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">

                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>
    <!-- slider-area-end -->

    <!-- about-area -->
    <section id="about" class="about-area about-p pt-70 pb-120 p-relative"  style="background: url(img/bg/about-bg.png) no-repeat;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="s-about-img p-relative" >
                        <img src="img/features/about_img.png" alt="img">
                    </div>

                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="about-content s-about-content pl-30">
                        <div class="about-title second-title pb-25">
                            <h2>We’re the best Gaming <span>Company</span></h2>
                            <div class="line"> <img src="img/bg/circle_left.png" alt="circle_right"></div>

                        </div>

                        <p>Lpsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                        <div class="about-content3 mt-30">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="green">
                                        <li>Suspe ndisse suscipit sagittis leo.</li>
                                        <li>Entum estibulum dignissim posuere.</li>
                                        <li>If you are going to use a passage</li>
                                    </ul>
                                </div>

                            </div>


                        </div>
                        <div class="slider-btn2 mt-30">
                            <a href="about.html" class="btn ss-btn">Discover More</a>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- about-area-end -->
    <!-- services-area -->
    <section id="services" class="services-area what-story pb-90 fix" >

        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">

                    <div class="services-box mb-30" style="background: url(img/bg/services-bg-01.png) no-repeat;background-size: contain; background-position: center bottom; background-size: cover;">

                        <div class="services-content2">
                            <div class="services-icon">
                                <img src="img/icon/pv-icon1.png" alt="icon01">
                                <h5>Live Streaming</h5>
                            </div>

                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse .</p>
                        </div>
                    </div>


                </div>
                <div class="col-lg-4 col-md-6">

                    <div class="services-box mb-30" style="background: url(img/bg/services-bg-01.png) no-repeat;background-size: contain; background-position: center bottom; background-size: cover;">

                        <div class="services-content2">
                            <div class="services-icon">
                                <img src="img/icon/pv-icon2.png" alt="icon01">
                                <h5>Filtration Level</h5>
                            </div>

                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse .</p>
                        </div>
                    </div>


                </div>
                <div class="col-lg-4 col-md-6">

                    <div class="services-box mb-30" style="background: url(img/bg/services-bg-01.png) no-repeat;background-size: contain; background-position: center bottom; background-size: cover;">

                        <div class="services-content2">
                            <div class="services-icon">
                                <img src="img/icon/pv-icon3.png" alt="icon01">
                                <h5>Composition</h5>
                            </div>

                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse .</p>

                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>
    <!-- services-area-end -->
    <!-- gallery-area -->
    <section id="work" class="pt-120 pb-120"  style="background: url(img/bg/trendiang-bg.png) no-repeat;">
        <div class="container">
            <div class="portfolio ">
                <div class="row align-items-center mb-30">
                    <div class="col-lg-12">
                        <div class="section-title cta-title mb-35">
                            <h2>Trending <span>Games</span></h2>
                            <img src="img/bg/circle_left.png" alt="circle left"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="my-masonry">
                            <div class="button-group filter-button-group ">
                                <button class="active" data-filter="*">All</button>
                                <button data-filter=".financial">Origin</button>
                                <button data-filter=".banking">Playstation 4</button>
                                <button data-filter=".insurance"> Uplay</button>
                                <button data-filter=".family">Steam</button>
                                <button data-filter=".business">Reper</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="grid col4">
                    <div class="grid-item financial">
                        <a href="img/gallery/protfolio-img01.png"  class="popup-image">
                            <figure class="gallery-image">
                                <img src="img/gallery/protfolio-img01.png" alt="img" class="img">
                                <figcaption>
                                    <span>Origin</span>
                                    <h4>Bunny Officer</h4>
                                    <p>Duis aute irure dolor i</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="grid-item financial banking">
                        <a href="img/gallery/protfolio-img02.png"  class="popup-image">
                            <figure class="gallery-image">
                                <img src="img/gallery/protfolio-img02.png" alt="img" class="img">
                                <figcaption>
                                    <span>New</span>
                                    <h4>Wonderland </h4>
                                    <p>Duis aute irure dolor i</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="grid-item insurance">
                        <a href="img/gallery/protfolio-img03.png"  class="popup-image">
                            <figure class="gallery-image">
                                <img src="img/gallery/protfolio-img03.png" alt="img" class="img">
                                <figcaption>
                                    <span>New</span>
                                    <h4>Apex Legends </h4>
                                    <p>Duis aute irure dolor i</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="grid-item family">
                        <a href="img/gallery/protfolio-img04.png"  class="popup-image">
                            <figure class="gallery-image">
                                <img src="img/gallery/protfolio-img04.png" alt="img" class="img">
                                <figcaption>
                                    <span>Origin</span>
                                    <h4>Wraith </h4>
                                    <p>Duis aute irure dolor i</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>

                </div>

            </div>

            <div class="vedio video-active pt-90">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="s-video-wrap" style="background-image:url(img/bg/video-img.png)">
                        <div class="s-video-content">
                            <a href="https://www.youtube.com/watch?v=7e90gBu4pas" class="popup-video mb-50"><img src="img/bg/play-button.png" alt="circle_right"></a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="s-video-wrap" style="background-image:url(img/bg/video-img2.png)">
                        <div class="s-video-content">
                            <a href="https://www.youtube.com/watch?v=7e90gBu4pas" class="popup-video mb-50"><img src="img/bg/play-button.png" alt="circle_right"></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- gallery-area-end -->
    <!-- features-area -->
    <section id="graph" class="features-area pt-120 pb-120"  style="background:url('img/bg/divider-bg.png');">
        <div class="container">

            <div class="row align-items-center text-center">

                <div class="col-lg-12 col-md-12">
                    <div class="section-title cta-title  mb-20">
                        <h2>Join Us As a Super Fans and <br> Get all the Benefits</h2>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                    </div>
                    <a href="contact.html" class="btn ss-btn mr-15 mt-20 active">Join Now</a>

                </div>


            </div>

        </div>
    </section>
    <!-- features-area-end -->
    <!-- match-area -->
    <section id="match" class="match-area pt-120 pb-90"  style="background:url('img/bg/match-bg.png');">
        <div class="container">

            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title cta-title mb-50">
                        <h2>Upcoming <span>Matches</span></h2>
                        <img src="img/bg/circle_left.png" alt="left"/>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mb-30">
                <div class="col-lg-5">
                    <div class="team">
                        <img src="img/matches/m-01.png" alt="left"/>
                        <div class="text">
                            <span>Blue</span>
                            <h3>Samurai</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="match-time text-center">
                        <h4>11:30</h4>
                        <span>1st  October 2021</span>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="team2">
                        <img src="img/matches/m-02.png" alt="left"/>
                        <div class="text">
                            <span>Blue</span>
                            <h3>Samurai</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-30">
                <div class="col-lg-5">
                    <div class="team">
                        <img src="img/matches/m-03.png" alt="left"/>
                        <div class="text">
                            <span>Blue</span>
                            <h3>Samurai</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="match-time text-center">
                        <h4>11:30</h4>
                        <span>1st  October 2021</span>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="team2">
                        <img src="img/matches/m-04.png" alt="left"/>
                        <div class="text">
                            <span>Blue</span>
                            <h3>Samurai</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mb-30">
                <div class="col-lg-5">
                    <div class="team">
                        <img src="img/matches/m-05.png" alt="left"/>
                        <div class="text">
                            <span>Blue</span>
                            <h3>Samurai</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="match-time text-center">
                        <h4>11:30</h4>
                        <span>1st  October 2021</span>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="team2">
                        <img src="img/matches/m-06.png" alt="left"/>
                        <div class="text">
                            <span>Blue</span>
                            <h3>Samurai</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- match-area-end -->

    <!-- blog-area -->
    <section id="blog" class="blog-area  p-relative pt-120 pb-170 fix" style="background: url(img/bg/blog-bg.png) no-repeat; background-position: right bottom;">

        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="single-post2 mb-30  p-relative">
                        <div class="blog-thumb2">
                            <a href="blog-details.html"><img src="img/blog/inner_b1.jpg" alt="img"></a>

                        </div>
                        <div class="blog-content2">


                            <div class="row">
                                <div class="col-lg-12">
                                    <h4><a href="blog-details.html">The Walking Dead Season </a></h4>
                                    <div class="b-meta">
                                        <div class="meta-info">
                                            <ul>
                                                <li><i class="fal fa-user"></i> Admin</li>
                                                <li><i class="fal fa-calendar-alt"></i> 24th March 2021</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. </p>
                                </div>
                            </div>



                        </div>


                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="single-post2 mb-30  p-relative">
                        <div class="blog-thumb2">
                            <a href="blog-details.html"><img src="img/blog/inner_b2.jpg" alt="img"></a>

                        </div>
                        <div class="blog-content2">


                            <div class="row">
                                <div class="col-lg-12">
                                    <h4><a href="blog-details.html">The Walking Dead Season </a></h4>
                                    <div class="b-meta">
                                        <div class="meta-info">
                                            <ul>
                                                <li><i class="fal fa-user"></i> Admin</li>
                                                <li><i class="fal fa-calendar-alt"></i> 24th March 2021</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. </p>
                                </div>
                            </div>



                        </div>


                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="single-post2 mb-30  p-relative">
                        <div class="blog-thumb2">
                            <a href="blog-details.html"><img src="img/blog/inner_b3.jpg" alt="img"></a>

                        </div>
                        <div class="blog-content2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4><a href="blog-details.html">The Walking Dead Season </a></h4>
                                    <div class="b-meta">
                                        <div class="meta-info">
                                            <ul>
                                                <li><i class="fal fa-user"></i> Admin</li>
                                                <li><i class="fal fa-calendar-alt"></i> 24th March 2021</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. </p>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- blog-area-end -->
    <!-- newslater-area -->
    <section class="newslater-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-4 col-lg-4">
                    <div class="section-title">
                        <h3>Our NewsLetter</h3>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    <form name="ajax-form" id="contact-form4" action="#" method="post" class="contact-form newslater">
                        <div class="form-group">
                            <input class="form-control" id="email2" name="email" type="email" placeholder="Email Address..." value="" required="">
                            <button type="submit"     class="btn btn-custom" id="send2">Subscribe  <i class="fab fa-telegram-plane"></i></button>
                        </div>
                        <!-- /Form-email -->
                    </form>
                </div>
            </div>

        </div>
    </section>
    <!-- newslater-aread-end -->
@endsection
