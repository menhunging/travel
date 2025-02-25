let currentScroll = 0;

addEventListener("scroll", (event) => {
  currentScroll = $(window).scrollTop();
  // console.log("currentScroll", currentScroll);

  if ($(".grettings").length > 0) {
    if (currentScroll >= $(".slider-section").offset().top - 100) {
      $(".header").addClass("scroll");
    } else {
      $(".header").removeClass("scroll");
    }
  }
});

$(document).ready(function () {
  if ($(".btn-menu").length > 0) {
    let menu = $(".menu-invis");
    let burger = $(".btn-menu");
    // let header = $(".header");

    burger.on("click", function () {
      if (menu.hasClass("opened")) {
        closeMenu();
      } else {
        burger.addClass("opened");
        menu.addClass("opened");

        $(document).mouseup(function (e) {
          if (
            !menu.is(e.target) &&
            menu.has(e.target).length === 0 &&
            !burger.is(e.target)
          ) {
            closeMenu();
          }
        });
      }
    });

    function closeMenu() {
      burger.removeClass("opened");
      menu.removeClass("opened");
      $(document).off("mouseup");
    }
  }

  if ($(".thisYear").length > 0) {
    let date = new Date();
    $(".thisYear").text(date.getFullYear());
  }

  if ($(".phone-input").length > 0) {
    $(".phone-input").map(function () {
      $(this).inputmask({
        mask: "+7(999) 999-99-99",
        placeholder: "*",
        showMaskOnHover: false,
        showMaskOnFocus: true,
        clearIncomplete: true,
      });
    });
  }

  if ($(".tabs").length > 0) {
    $(".tabs").tabslet({
      mouseevent: "click",
      attribute: "href",
      animation: true,
    });
  }

  if ($(".selectric").length > 0) {
    $(".selectric").map(function () {
      $(this).selectric({
        onOpen: function (element) {},
        onChange: function (element) {},
        onClose: function (element) {},
      });
    });
  }

  if ($(".modal").length > 0) {
    MicroModal.init({
      openTrigger: "data-modal",
      disableScroll: true,
      awaitOpenAnimation: true,
      awaitCloseAnimation: true,

      onShow: () => {
        $("body").addClass("modal-open");
      },

      onClose: () => {
        $("body").removeClass("modal-open");
      },
    });

    $("[data-modal]").map(function () {
      $(this).click((e) => {
        e.preventDefault();
        $("body").addClass("modal-open");
      });
    });

    $("[data-micromodal-close]").map(function () {
      $(this).click((e) => {
        if ($(this).attr("data-modal")) {
          setTimeout(() => {
            $("body").addClass("modal-open");
          }, 0.1);
        }
      });
    });
  }

  if ($("[data-fancybox]").length > 0) {
    Fancybox.bind("[data-fancybox]", {
      speedIn: 600,
      speedOut: 600,
      helpers: {
        media: {},
      },
    });
  }

  if ($(".types-services__slider").length > 0) {
    let observer = () => {
      console.log("observer");
    };

    if ($(window).width() < 1280) {
      initSliderServices();
    }

    $(window).on("resize", function () {
      if ($(window).width() < 1280) {
        initSliderServices();
      } else {
        if ($(".types-services__slider").hasClass("init")) {
          observer();
        }
      }
    });

    function initSliderServices() {
      if ($(".types-services__slider").hasClass("init")) {
        return false;
      }

      $(".types-services__slider").addClass("init");

      const swiperServices = new Swiper(".types-services__slider", {
        slidesPerView: 4,
        spaceBetween: 16,
        autoHeight: true,
        watchSlidesProgress: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          0: {
            slidesPerView: 1.18,
            spaceBetween: 16,
          },
          640: {
            slidesPerView: 2.18,
            spaceBetween: 16,
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 8,
          },
          1024: {
            slidesPerView: 4,
            spaceBetween: 16,
          },
        },
      });

      observer = () => {
        $(".types-services__slider").removeClass("init");
        swiperServices.destroy(true, true);
      };
    }
  }

  if ($(".slider-default").length > 0) {
    const sliders = document.querySelectorAll(".slider-default");
    let mySwipers = [];

    function sliderinit() {
      sliders.forEach((slider, index) => {
        if (!slider.swiper) {
          mySwipers[index] = new Swiper(slider, {
            slidesPerView: 3,
            spaceBetween: 24,
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
            breakpoints: {
              0: {
                slidesPerView: 1.25,
                spaceBetween: 16,
              },
              480: {
                slidesPerView: 2,
                spaceBetween: 16,
              },
              768: {
                slidesPerView: 2,
                spaceBetween: 16,
              },
              1024: {
                slidesPerView: 3,
                spaceBetween: 16,
              },
              1280: {
                slidesPerView: 4,
                spaceBetween: 24,
              },
              1600: {
                slidesPerView: 3,
                spaceBetween: 24,
              },
            },
          });
        } else {
          return;
        }
      });
    }

    sliders.length && sliderinit();
  }

  if ($(".transfers-item").length > 0) {
    $(".transfers-item__head").on("click", function () {
      let parents = $(this).parents(".transfers-item");
      let body = parents.find(".transfers-item__body");

      if (!parents.hasClass("opened")) {
        $(".transfers-item").removeClass("opened");
        $(".transfers-item__body").stop().slideUp();
        parents.addClass("opened");
        body.stop().slideDown();
      } else {
        parents.removeClass("opened");
        body.stop().slideUp();
      }
    });
  }

  if ($(".slider-gallery").length > 0) {
    const swiperGallery = new Swiper(".slider-gallery", {
      slidesPerView: 2,
      spaceBetween: 24,
      autoHeight: true,
      watchSlidesProgress: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 1.1,
          spaceBetween: 16,
        },
        640: {
          slidesPerView: 2.18,
          spaceBetween: 16,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 24,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 24,
        },
      },
    });
  }

  if ($(".country-menu").length > 0) {
    const sliders = document.querySelectorAll(".slider-links");
    let menu = $(".country-menu");
    let btnsMore = $(".country-menu__more");
    let textOpened = btnsMore.attr("data-opened");
    let textDefault = btnsMore.attr("data-text");
    let mySwipers = [];

    $(".country-menu__mobileTitle").on("click", function () {
      $(this).toggleClass("opened");
      $(".country-menu__inner").stop().slideToggle();
    });

    $(".country-menu__close").on("click", function () {
      closeMenu();
    });

    if ($(window).width() <= 767) {
      initMobileCoutry();
    } else {
      sliderinit();
    }

    function closeMenu() {
      $(".slider-links").removeClass("visible");
      btnsMore.text(textDefault);
      menu.removeClass("opened");
      $(document).off("mouseup");
    }

    function sliderinit() {
      $(".country-menu").addClass("init-desktop");

      btnsMore.on("click", function () {
        if (menu.hasClass("opened")) {
          closeMenu();
        } else {
          $(".slider-links").addClass("visible");
          btnsMore.text(textOpened);
          $(document).mouseup(function (e) {
            if (!menu.is(e.target) && menu.has(e.target).length === 0) {
              closeMenu();
            }
          });
          menu.addClass("opened");
        }
      });

      function sliderHandle() {
        sliders.forEach((slider, index) => {
          if (!slider.swiper) {
            mySwipers[index] = new Swiper(slider, {
              slidesPerView: 4,
              spaceBetween: 60,
              watchSlidesProgress: true,
              navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
              },
              breakpoints: {
                0: {
                  slidesPerView: 1,
                  spaceBetween: 16,
                },
                768: {
                  slidesPerView: 3,
                  spaceBetween: 40,
                },
                1024: {
                  slidesPerView: 3,
                  spaceBetween: 50,
                },
                1280: {
                  slidesPerView: 4,
                  spaceBetween: 60,
                },
              },
            });

            $(window).on("resize", function () {
              if ($(window).width() <= 767) {
                menu.removeClass("init-desktop");
                closeMenu();
                mySwipers[index].destroy(true, true);
              } else {
                mySwipers[index].update();
              }
            });
          } else {
            return;
          }
        });
      }

      sliders.length && sliderHandle();
    }

    function initMobileCoutry() {
      menu.addClass("init-mobile");

      btnsMore.on("click", function (e) {
        e.preventDefault();

        let btn = $(this);
        let slider = $(this)
          .parents(".country-menu__line")
          .find(".slider-links");

        if (slider.hasClass("opened")) {
          slider.removeClass("opened");
          $("html, body").animate({ scrollTop: 0 }, 0, "linear");
          btn.text(textDefault);
        } else {
          slider.addClass("opened");
          btn.text(textOpened);
        }
      });
    }

    $(window).on("resize", function () {
      if ($(window).width() <= 767) {
        if (menu.hasClass("init-mobile")) {
          return false;
        }
        if (menu.hasClass("init-desktop")) {
          btnsMore.off("click");
          menu.removeClass("init-desktop");
        }
        initMobileCoutry();
      } else {
        if (menu.hasClass("init-desktop")) {
          return false;
        }
        if (menu.hasClass("init-mobile")) {
          btnsMore.text(textDefault);
          btnsMore.off("click");
          menu.removeClass("init-mobile");
        }
        sliderinit();
      }
    });
  }

  if ($(".slider-images-big").length > 0) {
    const swiperSmall = new Swiper(".slider-images-small", {
      slidesPerView: 6,
      spaceBetween: 24,
      watchSlidesProgress: true,
      breakpoints: {
        0: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        480: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
        640: {
          slidesPerView: 4,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 5,
          spaceBetween: 16,
        },
        1280: {
          slidesPerView: 6,
          spaceBetween: 24,
        },
      },
    });

    const swiper = new Swiper(".slider-images-big", {
      spaceBetween: 10,
      watchSlidesProgress: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiperSmall,
      },
    });
  }

  if ($(".menu-tabs-links__list").length > 0) {
    const swiper = new Swiper(".menu-tabs-links__list", {
      slidesPerView: "auto",
      spaceBetween: 10,
      watchSlidesProgress: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      on: {
        init() {
          handleDisabled();
        },
      },
    });

    swiper.on("sliderMove", handleDisabled);
    swiper.on("slideChange", handleDisabled);
    $(".menu-tabs-links__list .swiper-button-next").on("click", handleDisabled);
    $(".menu-tabs-links__list .swiper-button-prev").on("click", handleDisabled);

    function handleDisabled() {
      $(".arrow-block").removeClass("disabled");

      let disabled = $(".menu-tabs-links__list").find(
        ".btn-arrow.swiper-button-disabled"
      );

      disabled?.parents(".arrow-block").addClass("disabled");
    }
  }

  if ($(".tabs-links").length > 0) {
    let arrowLeft = $(".tabs-links").parents(".tabs").find(".tabs-arrow--left");
    let arrowRight = $(".tabs-links")
      .parents(".tabs")
      .find(".tabs-arrow--right");

    $(".tabs-links").scroll(function () {
      let scroll = $(this).scrollLeft();
      let finish = scroll + this.clientWidth + 100;
      let scrollWidth = this.scrollWidth;

      if (finish >= scrollWidth) {
        $(this).parents(".tabs").addClass("scroll--finish");
      } else {
        $(this).parents(".tabs").removeClass("scroll--finish");
      }

      if (scroll > 0) {
        $(this).parents(".tabs").addClass("scroll");
      } else {
        $(this).parents(".tabs").removeClass("scroll");
      }
    });

    arrowLeft.on("click", function (e) {
      e.preventDefault();
      let num = $(".tabs-links").scrollLeft() - 500;
      arrowLeft
        .parents(".tabs")
        .find(".tabs-links")
        .stop()
        .animate({ scrollLeft: num }, 300, "swing");
    });

    arrowRight.on("click", function (e) {
      e.preventDefault();
      let num = $(".tabs-links").scrollLeft() + 500;
      arrowLeft
        .parents(".tabs")
        .find(".tabs-links")
        .stop()
        .animate({ scrollLeft: num }, 300, "swing");
    });
  }

  if ($(".slider-other-news").length > 0) {
    const swiper = new Swiper(".slider-other-news", {
      slidesPerView: 4,
      spaceBetween: 24,
      autoHeight: true,
      watchSlidesProgress: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
          spaceBetween: 16,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 16,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 24,
        },
        1024: {
          slidesPerView: 4,
          spaceBetween: 24,
        },
      },
    });
  }

  if ($(".country-links").length > 0) {
    $(".country-links .caption").on("click", function () {
      $(this).toggleClass("opened");
      $(".country-links__menu").stop().slideToggle();
    });
  }

  if ($(".btn-more-text").length > 0) {
    $(".btn-more-text").on("click", function (event) {
      event.preventDefault();

      $(".btn-more-text")
        .toggleClass("active")
        .parents("div")
        .find(".hidden-text")
        .stop()
        .slideToggle();
    });
  }

  if ($("#datepicker").length > 0) {
    $("#datepicker").daterangepicker(
      {
        showWeekNumbers: true,
        autoApply: true,
        locale: {
          format: "MM/DD/YYYY",
          separator: " - ",
          applyLabel: "Apply",
          cancelLabel: "Cancel",
          fromLabel: "From",
          toLabel: "To",
          customRangeLabel: "Custom",
          weekLabel: "W",
          daysOfWeek: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
          monthNames: [
            "Январь",
            "Февраль",
            "Март",
            "Апрель",
            "Май",
            "Июнь",
            "Июль",
            "Август",
            "Сентябрь",
            "Октрябрь",
            "Ноябрь",
            "Декабрь",
          ],
          firstDay: 1,
        },
        startDate: "05/01/2024",
        endDate: "05/07/2024",
        opens: "center",
        drops: "auto",
      },
      function (start, end, label) {
        // console.log(
        //   "New date range selected: " +
        //     start.format("YYYY-MM-DD") +
        //     " to " +
        //     end.format("YYYY-MM-DD") +
        //     " (predefined range: " +
        //     label +
        //     ")"
        // );
      }
    );
  }

  if ($(".tabs-mobile__item").length > 0) {
    $(".tabs-mobile__item .head").on("click", function () {
      $(this)
        .toggleClass("opened")
        .parents(".tabs-mobile__item")
        .find(".body")
        .stop()
        .slideToggle();
    });
  }
});

$(window).on("resize", function () {});
