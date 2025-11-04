$.getJSON( "json/" + document.title + ".json", function( json ) {
    document.getElementById("system_title").innerHTML = json.name;
  
    json.levels.forEach(function(level, index) {
      if ( (index+1) % 2 != 0 ){
        document.getElementById("contenedor-json").innerHTML += `
              <div class="js-timeline_item ag-timeline_item">
                <div class="ag-timeline-card_box">
                  <div class="js-timeline-card_point-box ag-timeline-card_point-box">
                    <div class="ag-timeline-card_point">`+(index+1)+`</div>
                  </div>
                  <div class="ag-timeline-card_meta-box">
                    <div class="ag-timeline-card_meta">`+level.name+`</div>
                  </div>
                </div>
                
                <div class="ag-timeline-card_item">
                  <div class="ag-timeline-card_inner">
                    <div class="ag-timeline-card_img-box">
                      <a href=""><img
                        src="`+level.image+`"
                        class="ag-timeline-card_img"
                        width="640"
                        height="360" /></a>
                    </div>
                    <div class="ag-timeline-card_info">
                      <div class="ag-timeline-card_title">`+(index+1)+`</div>
                      <div class="ag-timeline-card_areas">`+level.areas+`</div>
                      <div class="ag-timeline-card_desc">`+level.brief+`</div>
                    </div>
                  </div>
                  <div class="ag-timeline-card_arrow"></div>
                </div>
              </div>
      `;
        
      } else {
        
        document.getElementById("contenedor-json").innerHTML += `
              <div class="js-timeline_item ag-timeline_item">
                <div class="ag-timeline-card_box">
                  <div class="ag-timeline-card_meta-box">
                    <div class="ag-timeline-card_meta">`+level.name+`</div>
                  </div>
                  <div class="js-timeline-card_point-box ag-timeline-card_point-box">
                    <div class="ag-timeline-card_point">`+(index+1)+`</div>
                  </div>
                </div>
                
                <div class="ag-timeline-card_item">
                  <div class="ag-timeline-card_inner">
                    <div class="ag-timeline-card_img-box">
                      <a href=""><img
                        src="`+level.image+`"
                        class="ag-timeline-card_img"
                        width="640"
                        height="360" /></a>
                    </div>
                    <div class="ag-timeline-card_info">
                      <div class="ag-timeline-card_title">`+(index+1)+`</div>
                      <div class="ag-timeline-card_areas">`+level.areas+`</div>
                      <div class="ag-timeline-card_desc">`+level.brief+`</div>
                    </div>
                  </div>
                  <div class="ag-timeline-card_arrow"></div>
                </div>
              </div>
      `;
      }
      
    });
  
    // new
    $(function () {
    $(window).on("scroll", function () {
      fnOnScroll();
    });

    $(window).on("resize", function () {
      fnOnResize();
    });

    var agTimeline = $(".js-timeline"),
      agTimelineLine = $(".js-timeline_line"),
      agTimelineLineProgress = $(".js-timeline_line-progress"),
      agTimelinePoint = $(".js-timeline-card_point-box"),
      agTimelineItem = $(".js-timeline_item"),
      agOuterHeight = $(window).outerHeight(),
      agHeight = $(window).height(),
      f = -1,
      agFlag = false;

    function fnOnScroll() {
      agPosY = $(window).scrollTop();

      fnUpdateFrame();
    }

    function fnOnResize() {
      agPosY = $(window).scrollTop();
      agHeight = $(window).height();

      fnUpdateFrame();
    }

    function fnUpdateWindow() {
      agFlag = false;

      agTimelineLine.css({
        top: agTimelineItem.first().find(agTimelinePoint).offset().top - agTimelineItem.first().offset().top,
        bottom:
          agTimeline.offset().top + agTimeline.outerHeight() - agTimelineItem.last().find(agTimelinePoint).offset().top
      });

      f !== agPosY && ((f = agPosY), agHeight, fnUpdateProgress());
    }

    function fnUpdateProgress() {
      var agTop = agTimelineItem.last().find(agTimelinePoint).offset().top;

      i = agTop + agPosY - $(window).scrollTop();
      a = agTimelineLineProgress.offset().top + agPosY - $(window).scrollTop();
      n = agPosY - a + agOuterHeight / 2;
      i <= agPosY + agOuterHeight / 2 && (n = i - a);
      agTimelineLineProgress.css({ height: n + "px" });

      agTimelineItem.each(function () {
        var agTop = $(this).find(agTimelinePoint).offset().top;

        agTop + agPosY - $(window).scrollTop() < agPosY + 0.5 * agOuterHeight
          ? $(this).addClass("js-ag-active")
          : $(this).removeClass("js-ag-active");
      });
    }

    function fnUpdateFrame() {
      agFlag || requestAnimationFrame(fnUpdateWindow);
      agFlag = true;
    }
  });
    
 });
