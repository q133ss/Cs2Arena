@extends('layouts.app')
@section('title', 'Главная')
@section('content')
    <!-- slider-area -->
    <section id="home" class="slider-area slider-four fix p-relative">

        <div class="slider-active">
            <div class="single-slider slider-bg d-flex align-items-center" style="background: url('https://rocketnode.com/games/cs2-bg.png') no-repeat;background-size: cover; background-position: center top;">
                <div class="container">
                    <div class="row justify-content-center pt-50">
                        <div class="col-lg-1 col-md-1">
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="slider-content s-slider-content">
                                <h5 data-animation="fadeInDown" data-delay=".4s">CSArena</h5>
                                <h2 data-animation="fadeInUp" data-delay=".4s">Испытай себя!</h2>
                                <div class="slider-btn">
                                    <a href="about.html" class="btn ss-btn mr-15">ИГРАТЬ</a>

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
                        <img src="https://files.bo3.gg/uploads/image/18192/image/webp-2e072c58551b57f6e9e0833b706dc6bb.webp" alt="img">
                    </div>

                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="about-content s-about-content pl-30">
                        <div class="about-title second-title pb-25">
                            <h2><span>Испытайте</span> себя!</h2>
                            <div class="line"> <img src="img/bg/circle_left.png" alt="circle_right"></div>

                        </div>

                        <p>Ощути конкурентную игру во всей ее красе, поднимаясь по рейтингу. Принимай участие в ранговых матчах, сбалансированных на основе навыков. Попробуй командные лиги, клубы и многое другое!</p>
                        <div class="about-content3 mt-30">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="green">
                                        <li>Микс</li>
                                        <li>Битва кланов</li>
                                        <li>Турниры</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="slider-btn2 mt-30">
                            <a href="about.html" class="btn ss-btn">Подробнее</a>
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
                                <h5>Античит</h5>
                            </div>

                            <p>Самый надежный Античит в Counter-Strike</p>
                        </div>
                    </div>


                </div>
                <div class="col-lg-4 col-md-6">

                    <div class="services-box mb-30" style="background: url(img/bg/services-bg-01.png) no-repeat;background-size: contain; background-position: center bottom; background-size: cover;">

                        <div class="services-content2">
                            <div class="services-icon">
                                <img src="img/icon/pv-icon2.png" alt="icon01">
                                <h5>Система</h5>
                            </div>

                            <p>Почувствуйте азарт игры против игроков вашего уровня мастерства</p>
                        </div>
                    </div>


                </div>
                <div class="col-lg-4 col-md-6">

                    <div class="services-box mb-30" style="background: url(img/bg/services-bg-01.png) no-repeat;background-size: contain; background-position: center bottom; background-size: cover;">

                        <div class="services-content2">
                            <div class="services-icon">
                                <img src="img/icon/pv-icon3.png" alt="icon01">
                                <h5>Навыки</h5>
                            </div>

                            <p>Совершенствуйте свои навыки в серьезной среде</p>

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
                            <h2>Ближайшие <span>туриниры</span></h2>
                            <img src="img/bg/circle_left.png" alt="circle left"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="my-masonry">
                            <div class="button-group filter-button-group ">
                                <button class="active" data-filter="*">Дивизион А</button>
                                <button data-filter=".financial">Дивизион B</button>
                                <button data-filter=".banking">Дивизион C</button>
                                <button data-filter=".insurance">Дивизион D</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="grid col4">
                    <div class="grid-item financial">
                        <a href="img/gallery/protfolio-img01.png"  class="popup-image">
                            <figure class="gallery-image">
                                <img src="https://files.bo3.gg/uploads/image/18192/image/webp-2e072c58551b57f6e9e0833b706dc6bb.webp" alt="img" class="img">
                                <figcaption>
                                    <span>01.03</span>
                                    <h4>Турнир 1</h4>
                                    <p>Описание</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="grid-item financial banking">
                        <a href="img/gallery/protfolio-img02.png"  class="popup-image">
                            <figure class="gallery-image">
                                <img src="https://files.bo3.gg/uploads/image/18192/image/webp-2e072c58551b57f6e9e0833b706dc6bb.webp" alt="img" class="img">
                                <figcaption>
                                    <span>03.03</span>
                                    <h4>Турнир 2</h4>
                                    <p>Описание</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="grid-item insurance">
                        <a href="img/gallery/protfolio-img03.png"  class="popup-image">
                            <figure class="gallery-image">
                                <img src="https://files.bo3.gg/uploads/image/18192/image/webp-2e072c58551b57f6e9e0833b706dc6bb.webp" alt="img" class="img">
                                <figcaption>
                                    <span>06.03</span>
                                    <h4>Турнир 3</h4>
                                    <p>Duis aute irure dolor i</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="grid-item family">
                        <a href="img/gallery/protfolio-img04.png"  class="popup-image">
                            <figure class="gallery-image">
                                <img src="https://files.bo3.gg/uploads/image/18192/image/webp-2e072c58551b57f6e9e0833b706dc6bb.webp" alt="img" class="img">
                                <figcaption>
                                    <span>08.03</span>
                                    <h4>Турнир 4</h4>
                                    <p>Duis aute irure dolor i</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- gallery-area-end -->
    <!-- features-area -->
    <section id="graph" class="features-area pt-120 pb-120"  style="background:url('https://donanimarsivi.com/wp-content/uploads/2023/09/counter-strike-global-offensive-.jpg'); background-position: center top">
        <div class="container">

            <div class="row align-items-center text-center">

                <div class="col-lg-12 col-md-12">
                    <div class="section-title cta-title  mb-20">
                        <h2>Сколько это стоит?</h2>
                        <p>Присоединиться можно бесплатно! Мы также предлагаем премиальные подписки, чтобы улучшить ваш опыт.</p>
                    </div>
                    <a href="contact.html" class="btn ss-btn mr-15 mt-20 active">Начать</a>

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
                        <h2>Ближайшие <span>матчи</span></h2>
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
                        <span>01.03.2025</span>
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
                        <h4>12:30</h4>
                        <span>02.03.2025</span>
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
                        <span>03.03.2025</span>
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
                            <a href="blog-details.html"><img src="https://distribution.faceit-cdn.net/images/63f93548-ec70-4ece-b85a-96decfd524e9.png" alt="img"></a>

                        </div>
                        <div class="blog-content2">


                            <div class="row">
                                <div class="col-lg-12">
                                    <h4><a href="blog-details.html">Обновление рейтинга FPL Europe Season 4!</a></h4>
                                    <div class="b-meta">
                                        <div class="meta-info">
                                            <ul>
                                                <li><i class="fal fa-user"></i> Admin</li>
                                                <li><i class="fal fa-calendar-alt"></i>27.02.2025</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>Wicadia с 89 очками удерживает трон 👑 cmtrycs и Krabeni забрались в топ-3, а KaiR0N- совершил огромный скачок, поднявшись на 16 мест! 📈</p>
                                </div>
                            </div>



                        </div>


                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="single-post2 mb-30  p-relative">
                        <div class="blog-thumb2">
                            <a href="blog-details.html"><img src="https://distribution.faceit-cdn.net/images/ce471874-806d-43a5-a2e8-41251d8529b8.jpeg?action=fit&width=800&height=1600" alt="img"></a>

                        </div>
                        <div class="blog-content2">


                            <div class="row">
                                <div class="col-lg-12">
                                    <h4><a href="blog-details.html">Пусть готовят! 👨‍🍳</a></h4>
                                    <div class="b-meta">
                                        <div class="meta-info">
                                            <ul>
                                                <li><i class="fal fa-user"></i> Admin</li>
                                                <li><i class="fal fa-calendar-alt"></i> 24th March 2021</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>Пусть готовят! 👨‍🍳 Qiddiya Gaming</p>
                                </div>
                            </div>



                        </div>


                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="single-post2 mb-30  p-relative">
                        <div class="blog-thumb2">
                            <a href="blog-details.html"><img src="https://distribution.faceit-cdn.net/images/372bae44-261f-4cd6-9be2-c2d958df90ed.png?action=fit&width=800&height=1600" alt="img"></a>

                        </div>
                        <div class="blog-content2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4><a href="blog-details.html">Ежедневные раздачи скинов</a></h4>
                                    <div class="b-meta">
                                        <div class="meta-info">
                                            <ul>
                                                <li><i class="fal fa-user"></i> Admin</li>
                                                <li><i class="fal fa-calendar-alt"></i> 24th March 2021</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>Ознакомьтесь с расписанием и призами ниже и следите за каждым матчем, чтобы получить шанс выиграть.
                                        Не пропустите 👉</p>
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
                        <h3>Наши новости</h3>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    <form name="ajax-form" id="contact-form4" action="#" method="post" class="contact-form newslater">
                        <div class="form-group">
                            <input class="form-control" id="email2" name="email" type="email" placeholder="Email..." value="" required="">
                            <button type="submit"     class="btn btn-custom" id="send2">Подписаться  <i class="fab fa-telegram-plane"></i></button>
                        </div>
                        <!-- /Form-email -->
                    </form>
                </div>
            </div>

        </div>
    </section>
    <!-- newslater-aread-end -->
@endsection
