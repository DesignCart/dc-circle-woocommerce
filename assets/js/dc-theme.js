jQuery(document).ready(function($) {
    var $panel = $('#dc-mobile-panel');
    var $overlay = $('.dc-mobile-overlay');

    $('.btn-menu-toggle.dc-style-3').on('click', function() {
        $panel.addClass('active');
        $overlay.addClass('active');
    });

    $('.dc-mobile-close, .dc-mobile-overlay').on('click', function() {
        $panel.removeClass('active');
        $overlay.removeClass('active');
    });

    $(document).on('keyup', function(e) {
        if (e.key === "Escape") {
            $panel.removeClass('active');
            $overlay.removeClass('active');
        }
    });
});

jQuery(function($){
    $(document).off('click.dcAcc', '.dc-acc-toggle').on('click.dcAcc', '.dc-acc-toggle', function(e){
        e.preventDefault();
        e.stopPropagation();

        var $btn = $(this);
        var sel  = $btn.attr('data-target');
        if (!sel) return;

        var $pane = $(sel);
        if (!$pane.length) return;

        var isOpen = $pane.hasClass('show');

        // Zamknij inne otwarte panele (akordeon w obrębie menu)
        $('.dc-mobile-accordion .dc-collapse.show').not($pane).removeClass('show');

        // Przełącz bieżący
        $pane.toggleClass('show', !isOpen);
        $btn.attr('aria-expanded', (!isOpen).toString());
    });
});

jQuery(function($){

  function equalizeEducation() {
    var $blocks = $('.education-container .wp-block-media-text.is-stacked-on-mobile');

    // reset zanim zmierzymy
    $blocks.css('min-height', '');

    if (window.innerWidth <= 600) {
      var maxH = 0;

      $blocks.each(function(){
        // mierz aktualny box po resecie
        var h = this.getBoundingClientRect().height;
        if (h > maxH) maxH = h;
      });

      // ustawiamy minimalną, żeby nie „pompować” gdy treść się zawinie
      $blocks.css('min-height', Math.ceil(maxH) + 'px');
    }
  }

  // debounce, żeby nie liczyć 100x podczas resize
  var rAF, ticking = false;
  function debounceEqualize(){
    if (ticking) return;
    ticking = true;
    rAF = window.requestAnimationFrame(function(){
      ticking = false;
      equalizeEducation();
    });
  }

  // 1) po załadowaniu strony i obrazków w sekcji
  $(window).on('load', equalizeEducation);
  $('.education-container img').on('load', equalizeEducation);

  // 2) na zmianę rozmiaru
  $(window).on('resize', debounceEqualize);

  // 3) na wszelki wypadek po krótkiej chwili (fonts/layout)
  setTimeout(equalizeEducation, 200);
});

jQuery(function($){
    // Po dodaniu produktu do koszyka przez AJAX
    $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button){
        // Wywołaj swoją funkcję otwierającą slide cart
        if (typeof openSlidecart === 'function') {
            openSlidecart();
        }
    });
});


