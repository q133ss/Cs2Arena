<section id="bracket">
    <style>
        body {font-family: 'Istok Web', sans-serif;background: url("http://picjumbo.com/wp-content/uploads/HNCK2189-1300x866.jpg") no-repeat #000;background-size: cover;min-height: 100%;margin: 0;}
        .hero {position:relative; text-align: center; overflow: hidden; color: #fcfcfc; }
        .hero h1 {font-family: 'Holtwood One SC', serif;font-weight: normal;font-size: 5.4em;margin:0 0 20px; text-shadow:0 0 12px rgba(0, 0, 0, 0.5);text-transform: uppercase;letter-spacing:-1px;}
        .hero p {font-family: 'Abel', sans-serif;text-transform: uppercase; color: #5CCA87; letter-spacing: 6px;text-shadow:0 0 12px rgba(0, 0, 0, 0.5);font-size: 1.2em;}
        .hero-wrap {padding: 3.5em 10px;}
        .hero p.intro {font-family: 'Holtwood One SC', serif;text-transform: uppercase;letter-spacing: 1px;font-size: 3em;margin-bottom:-40px;}
        .hero p.year {color: #fff; letter-spacing: 20px; font-size: 34px; margin: -25px 0 25px;}
        .hero p.year i {font-size: 14px;vertical-align: middle;}
        #bracket {overflow:hidden;padding-top: 20px;font-size: 12px;padding: 40px 0;}
        .container {max-width: 1100px;margin: 0 auto;display:block;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: -webkit-flex;display: flex;-webkit-flex-direction:row;flex-direction: row;}
        .split {display:block;float:left;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display:flex;width: 42%;-webkit-flex-direction:row;-moz-flex-direction:row;flex-direction:row;}
        .champion {float:left;display:block;width: 16%;-webkit-flex-direction:row;flex-direction:row;-webkit-align-self:center;align-self:center;margin-top: -15px;text-align: center;padding: 230px 0\9;}
        .champion i {color: #a0a6a8; font-size: 45px;padding: 10px 0; }
        .round {display:block;float:left;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display:flex;-webkit-flex-direction:column;flex-direction:column;width:95%;width:30.8333%\9;}
        .split-two {}
        .split-one .round {margin: 0 2.5% 0 0;}
        .split-two .round {margin: 0 0 0 2.5%;}
        .matchup {margin:0;width: 100%;padding: 10px 0;height:60px;-webkit-transition: all 0.2s;transition: all 0.2s;}
        .score {font-size: 11px;text-transform: uppercase;float: right;color: #2C7399;font-weight: bold;font-family: 'Roboto Condensed', sans-serif;position: absolute;right: 5px;}
        .team {padding: 0 5px;margin: 3px 0;height: 25px; line-height: 25px;white-space: nowrap; overflow: hidden;position: relative;}
        .round-two .matchup {margin:0; height: 60px;padding: 50px 0;}
        .round-three .matchup {margin:0; height: 60px; padding: 130px 0;}
        .round-details {font-family: 'Roboto Condensed', sans-serif; font-size: 13px; color: #6c5ffc;text-transform: uppercase;text-align: center;height: 40px;}
        .champion li, .round li {background-color: #fff;box-shadow: none; opacity: 0.45;}
        .current li {opacity: 1;}
        .current li.team {background-color: #2a2a4a;box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);opacity: 1;}
        .vote-options {display: block;height: 52px;}
        .share .container {margin: 0 auto; text-align: center;}
        .share-icon {font-size: 24px; color: #fff;padding: 25px;}
        .share-wrap {max-width: 1100px; text-align: center; margin: 60px auto;}
        .final {margin: 4.5em 0;}

        @-webkit-keyframes pulse {
            0% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }

            50% {
                -webkit-transform: scale(1.3);
                transform: scale(1.3);
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes pulse {
            0% {
                -webkit-transform: scale(1);
                -ms-transform: scale(1);
                transform: scale(1);
            }

            50% {
                -webkit-transform: scale(1.3);
                -ms-transform: scale(1.3);
                transform: scale(1.3);
            }

            100% {
                -webkit-transform: scale(1);
                -ms-transform: scale(1);
                transform: scale(1);
            }
        }

        .share-icon {color: #fff; opacity: 0.35; }
        .share-icon:hover { opacity:1;  -webkit-animation: pulse 0.5s; animation: pulse 0.5s;}
        .date {font-size: 10px; letter-spacing: 2px;font-family: 'Istok Web', sans-serif;color:#ffffff;}



        @media screen and (min-width: 981px) and (max-width: 1099px) {
            .container {margin: 0 1%;}
            .champion {width: 14%;}
            .split {width:43%; }
            .split-one .vote-box {margin-left: 138px;}
            .hero p.intro {font-size: 28px;}
            .hero p.year {margin: 5px 0 10px;}

        }

        @media screen and (max-width: 980px) {
            .container {-webkit-flex-direction:column;-moz-flex-direction:column;flex-direction:column;}
            .split, .champion {width: 90%;margin: 35px 5%;}
            .champion {-webkit-box-ordinal-group:3;-moz-box-ordinal-group:3;-ms-flex-order:3;-webkit-order:3;order:3;}
            .split {border-bottom: 1px solid #b6b6b6; padding-bottom: 20px;}
            .hero p.intro {font-size: 24px;}
            .hero h1 {font-size: 3em; margin: 15px 0;}
            .hero p {font-size: 1em;}
        }


        @media screen and (max-width: 400px) {

            .split {width: 95%;margin: 25px 2.5%;}
            .round {width:21%;}
            .current {-webkit-flex-grow:1;-moz-flex-grow:1;flex-grow:1;}
            .hero h1 {font-size: 2.15em; letter-spacing: 0;margin:0; }
            .hero p.intro {font-size: 1.15em;margin-bottom: -10px;}
            .round-details {font-size: 90%;}
            .hero-wrap {padding: 2.5em;}
            .hero p.year {margin: 5px 0 10px; font-size: 18px;}

        }
    </style>
    <div class="container">
        <div class="split split-one">
            <div class="round round-one current">
                <div class="round-details">Раунд 1<br/><span class="date">16 апреля</span></div>
                <ul class="matchup">
                    <li class="team team-top">Team Spirit<span class="score">76</span></li>
                    <li class="team team-bottom">Team Vitality<span class="score">82</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">Natus Vincere<span class="score">64</span></li>
                    <li class="team team-bottom">MOUZ<span class="score">56</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">FaZe Clan<span class="score">68</span></li>
                    <li class="team team-bottom">The Mongolz<span class="score">54</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">Eternal Fire<span class="score">74</span></li>
                    <li class="team team-bottom">Virtus.pro<span class="score">92</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">Astralis<span class="score">78</span></li>
                    <li class="team team-bottom">Heroic<span class="score">80</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">Team Falcons<span class="score">64</span></li>
                    <li class="team team-bottom">Team Liquid<span class="score">63</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">Team 3DMAX<span class="score">70</span></li>
                    <li class="team team-bottom">Complexity Gaming<span class="score">59</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">ENCE <span class="score">64</span></li>
                    <li class="team team-bottom">SAW<span class="score">68</span></li>
                </ul>
            </div>	<!-- END ROUND ONE -->

            <div class="round round-two">
                <div class="round-details">Раунд 2<br/><span class="date">18 Апреля</span></div>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
            </div>	<!-- END ROUND TWO -->

            <div class="round round-three">
                <div class="round-details">Раунд 3<br/><span class="date">22 Апреля</span></div>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
            </div>	<!-- END ROUND THREE -->
        </div>

        <div class="champion">
            <div class="semis-l">
                <div class="round-details">Полуфинал<br/><span class="date">26-28 Апреля</span></div>
                <ul class ="matchup championship">
                    <li class="team team-top">&nbsp;<span class="vote-count">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="vote-count">&nbsp;</span></li>
                </ul>
            </div>
            <div class="final">
                <i class="fa fa-trophy"></i>
                <div class="round-details">Цемпионы<br/><span class="date">30 апреля - 1 мая</span></div>
                <ul class ="matchup championship">
                    <li class="team team-top">&nbsp;<span class="vote-count">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="vote-count">&nbsp;</span></li>
                </ul>
            </div>
            <div class="semis-r">
                <div class="round-details">Полуфинал <br/><span class="date">26-28 Апреля</span></div>
                <ul class ="matchup championship">
                    <li class="team team-top">&nbsp;<span class="vote-count">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="vote-count">&nbsp;</span></li>
                </ul>
            </div>
        </div>


        <div class="split split-two">


            <div class="round round-three">
                <div class="round-details">Раунд 3<br/><span class="date">22 Апреля</span></div>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
            </div>	<!-- END ROUND THREE -->

            <div class="round round-two">
                <div class="round-details">Раунд 2<br/><span class="date">18 Апреля</span></div>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                    <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                </ul>
            </div>	<!-- END ROUND TWO -->
            <div class="round round-one current">
                <div class="round-details">Рауд 1<br/><span class="date">16 Апреля</span></div>
                <ul class="matchup">
                    <li class="team team-top">Monte<span class="score">62</span></li>
                    <li class="team team-bottom">Nemiga Gaming<span class="score">54</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">Fnatic<span class="score">68</span></li>
                    <li class="team team-bottom">FURIA Esports<span class="score">66</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">BIG<span class="score">64</span></li>
                    <li class="team team-bottom">GamerLegion<span class="score">56</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">Cloud9<span class="score">36</span></li>
                    <li class="team team-bottom">Imperial Esports<span class="score">40</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">BetBoom Team<span class="score">38</span></li>
                    <li class="team team-bottom">B8 Esports<span class="score">44</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">9z Team<span class="score">52</span></li>
                    <li class="team team-bottom">Sangal Esports<span class="score">80</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">FlyQuest<span class="score">58</span></li>
                    <li class="team team-bottom">Bleed Esports<span class="score">59</span></li>
                </ul>
                <ul class="matchup">
                    <li class="team team-top">OG<span class="score">74</span></li>
                    <li class="team team-bottom">9Pandas<span class="score">111</span></li>
                </ul>
            </div>	<!-- END ROUND ONE -->
        </div>
    </div>
</section>
<section class="share">
    <div class="share-wrap">
        <a class="share-icon" href="https://twitter.com/_joebeason"><i class="fa fa-twitter"></i></a>
        <a class="share-icon" href="#"><i class="fa fa-facebook"></i></a>
        <a class="share-icon" href="#"><i class="fa fa-envelope"></i></a>
    </div>
</section>
