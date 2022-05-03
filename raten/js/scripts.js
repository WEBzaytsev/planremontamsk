$(() => {
  Parsley.addMessages("ru", {
    defaultMessage: "Некорректное значение.",

    type: {
      email: "Введите адрес электронной почты.",

      url: "Введите URL адрес.",

      number: "Введите число.",

      integer: "Введите целое число.",

      digits: "Введите только цифры.",

      alphanum: "Введите буквенно-цифровое значение.",
    },

    notblank: "Это поле должно быть заполнено.",

    required: "Обязательное поле.",

    pattern: "Это значение некорректно.",

    min: "Это значение должно быть не менее чем %s.",

    max: "Это значение должно быть не более чем %s.",

    range: "Это значение должно быть от %s до %s.",

    minlength: "Это значение должно содержать не менее %s символов.",

    maxlength: "Это значение должно содержать не более %s символов.",

    length: "Это значение должно содержать от %s до %s символов.",

    mincheck: "Выберите не менее %s значений.",

    maxcheck: "Выберите не более %s значений.",

    check: "Выберите от %s до %s значений.",

    equalto: "Это значение должно совпадать.",
  });

  Parsley.setLocale("ru");

  $("form").parsley();

  // Ширина окна для ресайза

  WW = $(window).width();

  $(document).on("change", "select", function () {
    $(".nice-select .current").each(function (index) {
      if ($(this).text() != "Выберите вариант") {
        $(this).addClass("new");
      }
    });
  });

  $(document).on("change", ".error", function () {
    $(this).removeClass("error");
  });

  $("form .submit_btn").on("click", function (event) {
    if ($(this).closest("form").parsley().isValid()) {
      var form = $(this).closest("form");

      event.preventDefault();

      var dataForAjax = "action=form&";

      var addressForAjax = myajax.url;

      var valid = true;

      $(this)
        .closest("form")
        .find("input:not([type=submit]),textarea, select")
        .each(function (i, elem) {
          if (this.value.length < 3 && $(this).hasClass("required")) {
            valid = false;

            $(this).addClass("error");
          }

          if ($(this).attr("name") == "email" && $(this).hasClass("required")) {
            var pattern =
              /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;

            if (!pattern.test($(this).val())) {
              valid = false;

              $(this).addClass("error");
            }
          }

          /*if ($(this).attr('name') == 'agree' && !$(this).prop("checked")) {

	                $(this).addClass('error');

	                valid = false;

	            }*/

          if ($(this).attr("name") == "phone" && $(this).hasClass("required")) {
            if (!$(this).inputmask("isComplete")) {
              valid = false;

              $(this).addClass("error");
            }
          }

          if (i > 0) {
            dataForAjax += "&";
          }

          dataForAjax += this.name + "=" + this.value;
        });

      if (!valid) {
        return false;
      }

      $.ajax({
        type: "POST",

        data: form.serialize(),

        url: "/wp-content/themes/raten/php/sendmessage.php",

        success: function (response) {
          if (form.closest("#callback_modal").length > 0) {
            gtag("event", "click", {
              event_category: "general",
              event_label: "callback",
            });

            ym(87447650, "reachGoal", "callback");

            console.log("callback");
          } else {
            gtag("event", "click", {
              event_category: "general",
              event_label: "lead",
            });

            ym(87447650, "reachGoal", "lead");

            console.log("lead");
          }

          $("form").trigger("reset");

          Fancybox.close();

          Fancybox.show([
            {
              src: "#success_modal",

              type: "inline",
            },
          ]);
        },
      });
    }
  });

  // Форма заказа

  if ($("#area_range").length) {
    areaRange = $("#area_range")
      .ionRangeSlider({
        min: 10,

        max: 200,

        from: 60,

        step: 1,

        postfix: " м²",

        onChange: (data) => {
          if ($("#area_range").closest(".area").length) {
            $("#area_range").closest(".area").find(".input").val(data.from);
          }

          $("#area_range_value").text($("#area_range").val());
        },
      })
      .data("ionRangeSlider");
  }

  $(".quiz .data .area .input").keyup(function () {
    areaRange.update({
      from: parseFloat($(this).val()),
    });
  });

  if ($("#calc_area_range").length) {
    $("#calc_area_range").ionRangeSlider({
      min: 10,

      max: 200,

      from: 60,

      step: 1,

      postfix: " м²",

      onChange: (data) => {
        $("#calc_area_range_value").text($("#calc_area_range").val());
      },
    });
  }

  // Тарифы

  $(".tariffs .tariff .work").click(function (e) {
    e.preventDefault();

    $(this).toggleClass("active").next().slideToggle(300);
  });

  // Портфолио

  const portfolioSliders = [],
    portfolioThumbsSliders = [];

  if ($(".portfolio").length) {
    $(".portfolio_item .slider .thumbs .swiper-container").each(function (i) {
      $(this).addClass("portfolio_thumbs_s" + i);

      let options = {
        loop: false,

        speed: 500,

        watchSlidesVisibility: true,

        slideActiveClass: "active",

        slideVisibleClass: "visible",

        breakpoints: {
          0: {
            spaceBetween: 12,

            slidesPerView: 4,
          },

          768: {
            spaceBetween: 16,

            slidesPerView: 4,
          },

          1218: {
            spaceBetween: 19,

            slidesPerView: 4,
          },
        },
      };

      portfolioThumbsSliders.push(
        new Swiper(".portfolio_thumbs_s" + i, options)
      );
    });

    $(".portfolio_item .slider .big .swiper-container").each(function (i) {
      $(this).addClass("portfolio_big_s" + i);

      let options = {
        loop: false,

        speed: 500,

        slidesPerView: 1,

        spaceBetween: 19,

        watchSlidesVisibility: true,

        slideActiveClass: "active",

        slideVisibleClass: "visible",

        navigation: {
          nextEl: ".swiper-button-next",

          prevEl: ".swiper-button-prev",
        },

        thumbs: {
          swiper: portfolioThumbsSliders[i],
        },
      };

      portfolioSliders.push(new Swiper(".portfolio_big_s" + i, options));
    });
  }

  // Бонусы

  if ($(".bonuses .swiper-container").length) {
    new Swiper(".bonuses .swiper-container", {
      loop: true,

      speed: 500,

      watchSlidesVisibility: true,

      slideActiveClass: "active",

      slideVisibleClass: "visible",

      slidesPerView: "auto",

      navigation: {
        nextEl: ".swiper-button-next",

        prevEl: ".swiper-button-prev",
      },

      pagination: {
        el: ".swiper-pagination",

        type: "bullets",

        clickable: true,

        bulletActiveClass: "active",
      },

      breakpoints: {
        0: {
          spaceBetween: 20,
        },

        1024: {
          spaceBetween: 24,
        },

        1280: {
          spaceBetween: 30,
        },
      },
    });
  }

  // Сейчас мы работаем

  if ($(".objects .cont > .swiper-container").length) {
    new Swiper(".objects .cont > .swiper-container", {
      loop: false,

      speed: 500,

      watchSlidesVisibility: true,

      slideActiveClass: "active",

      slideVisibleClass: "visible",

      navigation: {
        nextEl: ".swiper-button-next",

        prevEl: ".swiper-button-prev",
      },

      breakpoints: {
        0: {
          slidesPerView: "auto",

          spaceBetween: 24,
        },

        768: {
          slidesPerView: 2,

          spaceBetween: 24,
        },

        1024: {
          slidesPerView: 3,

          spaceBetween: 24,
        },

        1280: {
          slidesPerView: 3,

          spaceBetween: 30,
        },
      },
    });
  }

  // Запишитесь на просмотр объекта

  if ($(".objects .order .swiper-container").length) {
    new Swiper(".objects .order .swiper-container", {
      loop: true,

      speed: 500,

      watchSlidesVisibility: true,

      slideActiveClass: "active",

      slideVisibleClass: "visible",

      spaceBetween: 0,

      slidesPerView: 1,

      navigation: {
        nextEl: ".swiper-button-next",

        prevEl: ".swiper-button-prev",
      },
    });
  }

  // Квиз

  var currentStep = 1;

  $(".quiz .data .next_btn").click(function (e) {
    e.preventDefault();

    let step = $(this)
        .closest(".data")
        .find(".step" + currentStep),
      newDiscount = step.next().data("discount"),
      newProgress = step.next().data("progress");

    step.hide().next().fadeIn(300);

    $(".quiz .discount .val").text(newDiscount);

    $(".quiz .data .progress .val").text(newProgress);

    $(".quiz .data .progress .bar div").css("width", newProgress);

    currentStep++;

    if (currentStep > 1) {
      $(".quiz .data .back_btn").removeClass("disabled");
    }

    if (step.next().hasClass("finish")) {
      $(
        ".quiz .data .back_btn, .quiz .data .next_btn, .quiz .manager .message"
      ).hide();

      $(".quiz .data .finish_btn, .quiz .manager .message.finish").fadeIn(300);
    } else {
      $(".quiz .data .finish_btn").hide();

      $(".quiz .data .back_btn, .quiz .data .next_btn").fadeIn(300);
    }
  });

  $(".quiz .data .back_btn").click(function (e) {
    e.preventDefault();

    let step = $(this)
        .closest(".data")
        .find(".step" + currentStep),
      newDiscount = step.prev().data("discount"),
      newProgress = step.prev().data("progress");

    step.hide().prev().fadeIn(300);

    $(".quiz .discount .val").text(newDiscount);

    $(".quiz .data .progress .val").text(newProgress);

    $(".quiz .data .progress .bar div").css("width", newProgress);

    currentStep = currentStep - 1;

    if (currentStep < 2) {
      $(".quiz .data .back_btn").addClass("disabled");
    }
  });

  $('a[href^="tel:"]').on("click", function () {
    gtag("event", "click", { event_category: "general", event_label: "call" });

    ym(87447650, "reachGoal", "call");

    console.log("call");
  });

  $('a[href*="://wa.me"]').on("click", function () {
    gtag("event", "click", {
      event_category: "general",
      event_label: "whatsapp",
    });

    ym(87447650, "reachGoal", "whatsapp");

    console.log("whatsapp");
  });
});

$(window).on("load", () => {
  // Выравнивание элементов в сетке

  $(".tariffs .row").each(function () {
    tariffHeight($(this), parseInt($(this).css("--tariffs_count")));
  });

  // Всплывашки

  setTimeout(() => {
    $("#free_measurement_modal").fadeIn(300);
  }, 10000);

  $("#free_measurement_modal .close_btn").click((e) => {
    e.preventDefault();

    $("#free_measurement_modal").hide();
  });

  setTimeout(() => {
    Fancybox.show([
      {
        src: "#calc_modal",

        type: "inline",
      },
    ]);
  }, 25000);
});

$(window).on("resize", () => {
  if (typeof WW !== "undefined" && WW != $(window).width()) {
    // Моб. версия

    if (!fiestResize) {
      $("meta[name=viewport]").attr(
        "content",
        "width=device-width, initial-scale=1, maximum-scale=1"
      );

      if ($(window).width() < 480)
        $("meta[name=viewport]").attr("content", "width=480, user-scalable=no");

      fiestResize = true;
    } else {
      fiestResize = false;
    }

    // Выравнивание элементов в сетке

    $(".tariffs .row").each(function () {
      tariffHeight($(this), parseInt($(this).css("--tariffs_count")));
    });

    // Перезапись ширины окна

    WW = $(window).width();
  }
});

// Выравнивание тарифов

function tariffHeight(context, step) {
  let start = 0,
    finish = step,
    $tariffs = context.find(".tariff");

  $tariffs.find(".desc, .items").height("auto");

  $tariffs.each(function () {
    setHeight($tariffs.slice(start, finish).find(".desc"));

    setHeight($tariffs.slice(start, finish).find(".items"));

    start = start + step;

    finish = finish + step;
  });
}

// Карта

const initMap = () => {
  ymaps.ready(() => {
    let myMap = new ymaps.Map("map", {
      center: [55.685219, 37.628163],

      zoom: 16,

      controls: [],
    });

    // Кастомный маркер

    let myPlacemark = new ymaps.Placemark(
      [55.68529, 37.628828],
      {},
      {
        iconLayout: "default#image",

        iconImageHref: "/wp-content/themes/raten/images/map_marker.png",

        iconImageSize: [70, 70],

        iconImageOffset: [-24, -32],
      }
    );

    myMap.geoObjects.add(myPlacemark);

    myMap.controls.add("zoomControl", {
      position: {
        right: "20px",

        top: "20px",
      },
    });

    myMap.behaviors.disable("scrollZoom");
  });
};

$(document).ready(function () {
  $('[data-content="#callback_modal"]').on("click", function () {
    $this = $(this);

    $($this.attr("data-content")).find(".title").text($this.text());
  });
});
