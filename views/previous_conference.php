<!-- Custom CSS for previous conference page -->
<style>
  .section-title {
    position: relative;
    display: inline-block;
    letter-spacing: 1px;
    font-weight: 800;
    color: #11245A;
    text-transform: uppercase;
    margin-bottom: 20px;
    padding-left: 55px;
  }

  .section-title::before {
    position: absolute;
    content: "";
    top: 50%;
    left: 0;
    width: 45px;
    height: 2px;
    background: #11245A;
  }

  .btn-primary {
    background-color: #1A237E;
    border-color: #1A237E;
  }

  .btn-primary:hover {
    background-color: #0D1757;
    border-color: #0D1757;
  }

  .btn-outline-primary {
    color: #1A237E;
    border-color: #1A237E;
  }

  .btn-outline-primary:hover {
    background-color: #1A237E;
    border-color: #1A237E;
  }

  /* Style for disabled buttons */
  .btn-outline-primary:disabled {
    color: #9E9E9E;
    border-color: #E0E0E0;
  }

  /* Row with section styling */
  .previous-conference-row {
    margin-bottom: 60px;
  }

  /* Text colors */
  .text-danger {
    color: #F44336 !important;
  }

  /* Souvenir image styling */
  .souvenir-image {
    max-height: 600px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin: 0 auto;
  }

  .page-counter {
    background-color: #1A237E;
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 16px;
    display: inline-block;
    margin-bottom: 15px;
  }

  .navigation-controls {
    margin-top: 20px;
    margin-bottom: 30px;
  }

  /* Carousel styling */
  .carousel {
    margin-bottom: 30px;
  }

  .carousel-item img {
    max-height: 600px;
    object-fit: contain;
    margin: 0 auto;
  }

  .carousel-control-prev,
  .carousel-control-next {
    width: 5%;
    opacity: 1;
  }

  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: transparent;
    filter: invert(1) grayscale(100);
  }

  .carousel-caption {
    background: none !important;
  }

  /* Page counter styling on carousel */
  .carousel-page-counter {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    color: #11245A;
    padding: 8px 16px;
    z-index: 2;
    font-weight: bold;
  }
</style>

<!-- Previous Conference Start -->
<div class="container-fluid py-5">
  <div class="container">
    <h1 class="text-center mb-5">PREVIOUS CONFERENCE</h1>

    <?php 
    // Configuration for the sections to avoid repeating HTML code
    $sections = [
        ['title' => 'SOUVENIR', 'id' => 'souvenirCarousel', 'images' => $souvenir_images],
        ['title' => 'NEWSLETTER', 'id' => 'newsletterCarousel', 'images' => $newsletter_images],
        ['title' => 'SCHEDULE', 'id' => 'scheduleCarousel', 'images' => $schedule_images],
        ['title' => 'WINNER LIST', 'id' => 'winnerCarousel', 'images' => $winner_images]
    ];
    ?>

    <?php foreach ($sections as $section): ?>
    <div class="row mt-5">
      <div class="col-lg-12 pt-3 pb-lg-3">
        <h1 class="section-title"><?php echo $section['title']; ?></h1>
      </div>
      <div class="col-lg-12">
        <div id="<?php echo $section['id']; ?>" class="carousel slide" data-ride="carousel" data-interval="false">
          <div class="carousel-inner">
            <?php foreach ($section['images'] as $index => $image_path): ?>
              <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                <img src="<?php echo $image_path; ?>" class="d-block w-100" alt="Page <?php echo ($index + 1); ?>" 
                     onerror="this.style.display='none';">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Page <?php echo ($index + 1); ?> of <?php echo count($section['images']); ?></h5>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          
          <a class="carousel-control-prev" href="#<?php echo $section['id']; ?>" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#<?php echo $section['id']; ?>" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

  </div>
</div>
<!-- Previous Conference End -->

<!-- Initialize Scripts -->
<script>
  $(document).ready(function() {
    // Initialize other carousels (PDF viewers)
    $('.newsletter-carousel, .schedule-carousel, .winner-carousel').owlCarousel({
      autoplay: true,
      smartSpeed: 1500,
      margin: 30,
      dots: true,
      loop: true,
      nav: false,
      responsive: {
        0: {
          items: 1
        },
        576: {
          items: 1
        },
        768: {
          items: 1
        },
        992: {
          items: 1
        }
      }
    });

    // Add PDF embed dimensions for better viewing
    function adjustPdfEmbedSize() {
      const embedElements = document.querySelectorAll('embed[type="application/pdf"]');
      const width = window.innerWidth;

      embedElements.forEach(embed => {
        if (width < 768) {
          embed.style.height = '300px'; // Smaller height on mobile
        } else {
          embed.style.height = '500px'; // Larger height on desktop
        }
      });
    }

    // Enhance souvenir viewing experience
    function enhanceSouvenirViewer() {
      // Get current page and total pages
      const currentPage = <?php echo $current_page; ?>;
      const totalPages = <?php echo $total_pages; ?>;

      // Preload adjacent images for faster navigation
      function preloadImage(pageNum) {
        if (pageNum >= 1 && pageNum <= totalPages) {
          const paddedNum = String(pageNum).padStart(4, '0');
          const img = new Image();
          img.src = `../assets/images/previous_conference/souvenir/VIDYEN Sovenir_page-${paddedNum}.jpg`;
        }
      }

      // Preload next and previous images
      preloadImage(currentPage - 1);
      preloadImage(currentPage + 1);

      // Add keyboard navigation
      $(document).keydown(function(e) {
        // Left arrow key (previous)
        if (e.keyCode == 37 && currentPage > 1) {
          window.location.href = `previous_conference.php?page=${currentPage - 1}`;
        }
        // Right arrow key (next)
        else if (e.keyCode == 39 && currentPage < totalPages) {
          window.location.href = `previous_conference.php?page=${currentPage + 1}`;
        }
      });

      // Set focus to image for keyboard navigation
      $('.souvenir-image').focus();
    }

    // Call functions on page load
    adjustPdfEmbedSize();
    enhanceSouvenirViewer();

    // Update on window resize
    window.addEventListener('resize', adjustPdfEmbedSize);

    $('#souvenirCarousel').on('slide.bs.carousel', function(e) {
      var currentSlide = e.to + 1;
      $('#currentPage').text(currentSlide);
    });

    // Add JavaScript for carousel page counters
    $('#souvenirCarousel, #newsletterCarousel, #scheduleCarousel, #winnerCarousel').on('slide.bs.carousel', function(e) {
      var currentSlide = e.to + 1;
      var totalSlides = {
        'souvenirCarousel': <?php echo $total_pages; ?>,
        'newsletterCarousel': <?php echo $newsletter_total_pages; ?>,
        'scheduleCarousel': <?php echo $schedule_total_pages; ?>,
        'winnerCarousel': <?php echo $winner_total_pages; ?>
      };
      $(this).find('.carousel-caption h5').text('Page ' + currentSlide + ' of ' + totalSlides[$(this).attr('id')]);
    });
  });
</script>