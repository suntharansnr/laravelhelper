 <div class="row text-center">
           <div class="col-12">
              <h1 style="color:#fff;font-weight:bold">A few words from our customers</h1> 
           </div>
        </div>
       <div id="testim" class="testim">
<!--         <div class="testim-cover"> -->
            <div class="wrap">

                <span id="right-arrow" class="arrow right fa fa-chevron-right"></span>
                <span id="left-arrow" class="arrow left fa fa-chevron-left "></span>
                <ul id="testim-dots" class="dots">
                    @foreach ($testimonial as $key => $value)
                    <li class="dot {{$key == 0 ? 'active' : ''}}"></li>
                    @endforeach
                </ul>
                <div id="testim-content" class="cont">
                  @foreach ($testimonial as $key => $value)
                    <div class="{{$key == 0 ? 'active' : ''}}">
                        <div class="img"><img src="{{$value->img_path}}" alt=""></div>
                        <div class="h4">{{$value->name}}</div>
                        <p><?php echo substr(strip_tags($value->content),0,250) . "..."; ?></p>
                    </div>
                  @endforeach
                </div>
                 </div>
            </div>
<!--         </div> -->



    <style>

.testimonial-section2{
/*height: 600px;*/
position: relative;
padding: 50px 0;
background-color: #e91c5e;
}

.testim .wrap {
  position: relative;
  width: 100%;
  max-width: 1020px;
  padding: 40px 20px;
  margin: auto;
}

.testim .arrow {
  display: block;
  position: absolute;
  color: #eee;
  cursor: pointer;
  font-size: 2em;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  -webkit-transition: all .3s ease-in-out;
  -ms-transition: all .3s ease-in-out;
  -moz-transition: all .3s ease-in-out;
  -o-transition: all .3s ease-in-out;
  transition: all .3s ease-in-out;
  padding: 5px;
  z-index: 22222222;
}

.testim .arrow:before {
  cursor: pointer;
}

.testim .arrow:hover {
  color: #f03271;
}


.testim .arrow.left {
  left: 10px;
}

.testim .arrow.right {
  right: 10px;
}

.testim .dots {
  text-align: center;
  position: absolute;
  width: 100%;
  bottom: 60px;
  left: 0;
  display: block;
  z-index: 1;
  height: 12px;
}

.testim .dots .dot {
  list-style-type: none;
  display: inline-block;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  border: 1px solid #eee;
  margin: 0 10px;
  cursor: pointer;
  -webkit-transition: all .5s ease-in-out;
  -ms-transition: all .5s ease-in-out;
  -moz-transition: all .5s ease-in-out;
  -o-transition: all .5s ease-in-out;
  transition: all .5s ease-in-out;
  position: relative;
}

.testim .dots .dot.active,
.testim .dots .dot:hover {
  background:  #f03271;
  border-color: #f03271;
}

.testim .dots .dot.active {
  -webkit-animation: testim-scale .5s ease-in-out forwards;
  -moz-animation: testim-scale .5s ease-in-out forwards;
  -ms-animation: testim-scale .5s ease-in-out forwards;
  -o-animation: testim-scale .5s ease-in-out forwards;
  animation: testim-scale .5s ease-in-out forwards;
}

.testim .cont {
  position: relative;
  overflow: hidden;
}

.testim .cont > div {
  text-align: center;
  position: absolute;
  top: 0;
  left: 0;
  padding: 0 0 70px 0;
  opacity: 0;
}

.testim .cont > div.inactive {
  opacity: 1;
}


.testim .cont > div.active {
  position: relative;
  opacity: 1;
}


.testim .cont div .img img {
  display: block;
  width: 100px;
  height: 100px;
  margin: auto;
  border-radius: 50%;
}

.testim .cont div .h4 {
  color:  #f03271;
  font-size: 1.2em;
  margin: 15px 0;
}

.testim .cont div p {
  font-size: 1.15em;
  color: #eee;
  width: 80%;
  margin: auto;
}

.testim .cont div.active .img img {
  -webkit-animation: testim-show .5s ease-in-out forwards;
  -moz-animation: testim-show .5s ease-in-out forwards;
  -ms-animation: testim-show .5s ease-in-out forwards;
  -o-animation: testim-show .5s ease-in-out forwards;
  animation: testim-show .5s ease-in-out forwards;
}

.testim .cont div.active .h4 {
  -webkit-animation: testim-content-in .4s ease-in-out forwards;
  -moz-animation: testim-content-in .4s ease-in-out forwards;
  -ms-animation: testim-content-in .4s ease-in-out forwards;
  -o-animation: testim-content-in .4s ease-in-out forwards;
  animation: testim-content-in .4s ease-in-out forwards;
}

.testim .cont div.active p {
  -webkit-animation: testim-content-in .5s ease-in-out forwards;
  -moz-animation: testim-content-in .5s ease-in-out forwards;
  -ms-animation: testim-content-in .5s ease-in-out forwards;
  -o-animation: testim-content-in .5s ease-in-out forwards;
  animation: testim-content-in .5s ease-in-out forwards;
}

.testim .cont div.inactive .img img {
  -webkit-animation: testim-hide .5s ease-in-out forwards;
  -moz-animation: testim-hide .5s ease-in-out forwards;
  -ms-animation: testim-hide .5s ease-in-out forwards;
  -o-animation: testim-hide .5s ease-in-out forwards;
  animation: testim-hide .5s ease-in-out forwards;
}

.testim .cont div.inactive .h4 {
  -webkit-animation: testim-content-out .4s ease-in-out forwards;
  -moz-animation: testim-content-out .4s ease-in-out forwards;
  -ms-animation: testim-content-out .4s ease-in-out forwards;
  -o-animation: testim-content-out .4s ease-in-out forwards;
  animation: testim-content-out .4s ease-in-out forwards;
}

.testim .cont div.inactive p {
  -webkit-animation: testim-content-out .5s ease-in-out forwards;
  -moz-animation: testim-content-out .5s ease-in-out forwards;
  -ms-animation: testim-content-out .5s ease-in-out forwards;
  -o-animation: testim-content-out .5s ease-in-out forwards;
  animation: testim-content-out .5s ease-in-out forwards;
}

@-webkit-keyframes testim-scale {
  0% {
      -webkit-box-shadow: 0px 0px 0px 0px #eee;
      box-shadow: 0px 0px 0px 0px #eee;
  }

  35% {
      -webkit-box-shadow: 0px 0px 10px 5px #eee;
      box-shadow: 0px 0px 10px 5px #eee;
  }

  70% {
      -webkit-box-shadow: 0px 0px 10px 5px #ea830e;
      box-shadow: 0px 0px 10px 5px #ea830e;
  }

  100% {
      -webkit-box-shadow: 0px 0px 0px 0px #ea830e;
      box-shadow: 0px 0px 0px 0px #ea830e;
  }
}

@-moz-keyframes testim-scale {
  0% {
      -moz-box-shadow: 0px 0px 0px 0px #eee;
      box-shadow: 0px 0px 0px 0px #eee;
  }

  35% {
      -moz-box-shadow: 0px 0px 10px 5px #eee;
      box-shadow: 0px 0px 10px 5px #eee;
  }

  70% {
      -moz-box-shadow: 0px 0px 10px 5px #ea830e;
      box-shadow: 0px 0px 10px 5px #ea830e;
  }

  100% {
      -moz-box-shadow: 0px 0px 0px 0px #ea830e;
      box-shadow: 0px 0px 0px 0px #ea830e;
  }
}

@-ms-keyframes testim-scale {
  0% {
      -ms-box-shadow: 0px 0px 0px 0px #eee;
      box-shadow: 0px 0px 0px 0px #eee;
  }

  35% {
      -ms-box-shadow: 0px 0px 10px 5px #eee;
      box-shadow: 0px 0px 10px 5px #eee;
  }

  70% {
      -ms-box-shadow: 0px 0px 10px 5px #ea830e;
      box-shadow: 0px 0px 10px 5px #ea830e;
  }

  100% {
      -ms-box-shadow: 0px 0px 0px 0px #ea830e;
      box-shadow: 0px 0px 0px 0px #ea830e;
  }
}

@-o-keyframes testim-scale {
  0% {
      -o-box-shadow: 0px 0px 0px 0px #eee;
      box-shadow: 0px 0px 0px 0px #eee;
  }

  35% {
      -o-box-shadow: 0px 0px 10px 5px #eee;
      box-shadow: 0px 0px 10px 5px #eee;
  }

  70% {
      -o-box-shadow: 0px 0px 10px 5px #ea830e;
      box-shadow: 0px 0px 10px 5px #ea830e;
  }

  100% {
      -o-box-shadow: 0px 0px 0px 0px #ea830e;
      box-shadow: 0px 0px 0px 0px #ea830e;
  }
}

@keyframes testim-scale {
  0% {
      box-shadow: 0px 0px 0px 0px #eee;
  }

  35% {
      box-shadow: 0px 0px 10px 5px #eee;
  }

  70% {
      box-shadow: 0px 0px 10px 5px #ea830e;
  }

  100% {
      box-shadow: 0px 0px 0px 0px #ea830e;
  }
}

@-webkit-keyframes testim-content-in {
  from {
      opacity: 0;
      -webkit-transform: translateY(100%);
      transform: translateY(100%);
  }

  to {
      opacity: 1;
      -webkit-transform: translateY(0);
      transform: translateY(0);
  }
}

@-moz-keyframes testim-content-in {
  from {
      opacity: 0;
      -moz-transform: translateY(100%);
      transform: translateY(100%);
  }

  to {
      opacity: 1;
      -moz-transform: translateY(0);
      transform: translateY(0);
  }
}

@-ms-keyframes testim-content-in {
  from {
      opacity: 0;
      -ms-transform: translateY(100%);
      transform: translateY(100%);
  }

  to {
      opacity: 1;
      -ms-transform: translateY(0);
      transform: translateY(0);
  }
}

@-o-keyframes testim-content-in {
  from {
      opacity: 0;
      -o-transform: translateY(100%);
      transform: translateY(100%);
  }

  to {
      opacity: 1;
      -o-transform: translateY(0);
      transform: translateY(0);
  }
}

@keyframes testim-content-in {
  from {
      opacity: 0;
      transform: translateY(100%);
  }

  to {
      opacity: 1;
      transform: translateY(0);
  }
}

@-webkit-keyframes testim-content-out {
  from {
      opacity: 1;
      -webkit-transform: translateY(0);
      transform: translateY(0);
  }

  to {
      opacity: 0;
      -webkit-transform: translateY(-100%);
      transform: translateY(-100%);
  }
}

@-moz-keyframes testim-content-out {
  from {
      opacity: 1;
      -moz-transform: translateY(0);
      transform: translateY(0);
  }

  to {
      opacity: 0;
      -moz-transform: translateY(-100%);
      transform: translateY(-100%);
  }
}

@-ms-keyframes testim-content-out {
  from {
      opacity: 1;
      -ms-transform: translateY(0);
      transform: translateY(0);
  }

  to {
      opacity: 0;
      -ms-transform: translateY(-100%);
      transform: translateY(-100%);
  }
}

@-o-keyframes testim-content-out {
  from {
      opacity: 1;
      -o-transform: translateY(0);
      transform: translateY(0);
  }

  to {
      opacity: 0;
      transform: translateY(-100%);
      transform: translateY(-100%);
  }
}

@keyframes testim-content-out {
  from {
      opacity: 1;
      transform: translateY(0);
  }

  to {
      opacity: 0;
      transform: translateY(-100%);
  }
}

@-webkit-keyframes testim-show {
  from {
      opacity: 0;
      -webkit-transform: scale(0);
      transform: scale(0);
  }

  to {
      opacity: 1;
      -webkit-transform: scale(1);
      transform: scale(1);
  }
}

@-moz-keyframes testim-show {
  from {
      opacity: 0;
      -moz-transform: scale(0);
      transform: scale(0);
  }

  to {
      opacity: 1;
      -moz-transform: scale(1);
      transform: scale(1);
  }
}

@-ms-keyframes testim-show {
  from {
      opacity: 0;
      -ms-transform: scale(0);
      transform: scale(0);
  }

  to {
      opacity: 1;
      -ms-transform: scale(1);
      transform: scale(1);
  }
}

@-o-keyframes testim-show {
  from {
      opacity: 0;
      -o-transform: scale(0);
      transform: scale(0);
  }

  to {
      opacity: 1;
      -o-transform: scale(1);
      transform: scale(1);
  }
}

@keyframes testim-show {
  from {
      opacity: 0;
      transform: scale(0);
  }

  to {
      opacity: 1;
      transform: scale(1);
  }
}

@-webkit-keyframes testim-hide {
  from {
      opacity: 1;
      -webkit-transform: scale(1);
      transform: scale(1);
  }

  to {
      opacity: 0;
      -webkit-transform: scale(0);
      transform: scale(0);
  }
}

@-moz-keyframes testim-hide {
  from {
      opacity: 1;
      -moz-transform: scale(1);
      transform: scale(1);
  }

  to {
      opacity: 0;
      -moz-transform: scale(0);
      transform: scale(0);
  }
}

@-ms-keyframes testim-hide {
  from {
      opacity: 1;
      -ms-transform: scale(1);
      transform: scale(1);
  }

  to {
      opacity: 0;
      -ms-transform: scale(0);
      transform: scale(0);
  }
}

@-o-keyframes testim-hide {
  from {
      opacity: 1;
      -o-transform: scale(1);
      transform: scale(1);
  }

  to {
      opacity: 0;
      -o-transform: scale(0);
      transform: scale(0);
  }
}

@keyframes testim-hide {
  from {
      opacity: 1;
      transform: scale(1);
  }

  to {
      opacity: 0;
      transform: scale(0);
  }
}

@media all and (max-width: 300px) {
body {
  font-size: 14px;
}
}

@media all and (max-width: 500px) {
.testim .arrow {
  font-size: 1.5em;
}

.testim .cont div p {
  line-height: 25px;
}

}

    </style>

    <script type="text/javascript">

// vars
'use strict'
var	testim = document.getElementById("testim"),
  testimDots = Array.prototype.slice.call(document.getElementById("testim-dots").children),
  testimContent = Array.prototype.slice.call(document.getElementById("testim-content").children),
  testimLeftArrow = document.getElementById("left-arrow"),
  testimRightArrow = document.getElementById("right-arrow"),
  testimSpeed = 4500,
  currentSlide = 0,
  currentActive = 0,
  testimTimer,
  touchStartPos,
  touchEndPos,
  touchPosDiff,
  ignoreTouch = 30;
;

window.onload = function() {

  // Testim Script
  function playSlide(slide) {
      for (var k = 0; k < testimDots.length; k++) {
          testimContent[k].classList.remove("active");
          testimContent[k].classList.remove("inactive");
          testimDots[k].classList.remove("active");
      }

      if (slide < 0) {
          slide = currentSlide = testimContent.length-1;
      }

      if (slide > testimContent.length - 1) {
          slide = currentSlide = 0;
      }

      if (currentActive != currentSlide) {
          testimContent[currentActive].classList.add("inactive");
      }
      testimContent[slide].classList.add("active");
      testimDots[slide].classList.add("active");

      currentActive = currentSlide;

      clearTimeout(testimTimer);
      testimTimer = setTimeout(function() {
          playSlide(currentSlide += 1);
      }, testimSpeed)
  }

  testimLeftArrow.addEventListener("click", function() {
      playSlide(currentSlide -= 1);
  })

  testimRightArrow.addEventListener("click", function() {
      playSlide(currentSlide += 1);
  })

  for (var l = 0; l < testimDots.length; l++) {
      testimDots[l].addEventListener("click", function() {
          playSlide(currentSlide = testimDots.indexOf(this));
      })
  }

  playSlide(currentSlide);

  // keyboard shortcuts
  document.addEventListener("keyup", function(e) {
      switch (e.keyCode) {
          case 37:
              testimLeftArrow.click();
              break;

          case 39:
              testimRightArrow.click();
              break;

          case 39:
              testimRightArrow.click();
              break;

          default:
              break;
      }
  })

  testim.addEventListener("touchstart", function(e) {
      touchStartPos = e.changedTouches[0].clientX;
  })

  testim.addEventListener("touchend", function(e) {
      touchEndPos = e.changedTouches[0].clientX;

      touchPosDiff = touchStartPos - touchEndPos;

      console.log(touchPosDiff);
      console.log(touchStartPos);
      console.log(touchEndPos);


      if (touchPosDiff > 0 + ignoreTouch) {
          testimLeftArrow.click();
      } else if (touchPosDiff < 0 - ignoreTouch) {
          testimRightArrow.click();
      } else {
        return;
      }

  })
}


    </script>
