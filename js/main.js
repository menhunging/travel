addEventListener("scroll", (event) => {
  currentScroll = $(window).scrollTop();
  // console.log("currentScroll", currentScroll);
});

$(document).ready(function () {
  if ($(".btn-menu").length > 0) {
    let menu = $(".menu-invis");
    let burger = $(".btn-menu");
    let header = $(".header");

    burger.on("click", function () {
      if (menu.hasClass("opened")) {
        closeMenu();
      } else {
        burger.addClass("opened");
        menu.addClass("opened");
        header.addClass("opened");

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
      header.removeClass("opened");
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

  if ($(".slider-collection").length > 0) {
    const swiper = new Swiper(".slider-collection", {
      slidesPerView: 3,
      initialSlide: 3,
      spaceBetween: 24,
      centeredSlides: true,
      watchSlidesProgress: true,
      navigation: {
        nextEl: ".collection-main .arrows-controls__right",
        prevEl: ".collection-main .arrows-controls__left",
      },
      breakpoints: {
        0: {
          slidesPerView: 1.28,
          initialSlide: 3,
          spaceBetween: 16,
        },
        768: {
          slidesPerView: 3,
          initialSlide: 3,
          spaceBetween: 8,
        },
        1024: {
          slidesPerView: 3,
          initialSlide: 3,
          spaceBetween: 16,
        },
        1280: {
          slidesPerView: 3,
          initialSlide: 3,
          spaceBetween: 24,
        },
      },
    });

    setHeightBlock();

    $(window).on("resize", function () {
      setHeightBlock();
    });

    function setHeightBlock() {
      if ($(window).width() < 768) {
        let height =
          $(".slider-collection .swiper-slide-active").outerHeight() + 30;
        console.log(height);
        $(".slider-collection").css("min-height", height);
      } else {
        $(".slider-collection").css("min-height", 0);
      }
    }
  }

  if ($(".slider-default").length > 0) {
    const sliders = document.querySelectorAll(".slider-default");
    let mySwipers = [];

    function sliderinit() {
      sliders.forEach((slider, index) => {
        if (!slider.swiper) {
          // if ($(slider).hasClass("slider-default--spaces")) {
          //   count = 2;
          //   initial = $(slider).find(".slider-default__slide").length;

          //   navNext = $(slider)
          //     .parents(".slider-default-wrapper")
          //     .find(".arrows-controls__right")[0];
          //   navPrev = $(slider)
          //     .parents(".slider-default-wrapper")
          //     .find(".arrows-controls__left")[0];
          // }

          mySwipers[index] = new Swiper(slider, {
            slidesPerView: 3,
            spaceBetween: 24,
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
            breakpoints: {
              0: {
                slidesPerView: 1,
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

  // --------------------------------------------
});

$(window).on("resize", function () {});
