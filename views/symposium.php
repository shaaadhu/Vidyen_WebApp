

  <!-- About Start -->
<div class="container-fluid py-5 mb-2">
  <div class="container">
    <center>
      <h1 class="mb-4">VIDYEN Conference 2026 –<span class="text-primary"> Symposium</span></h1>
    </center>
    <!-- <div class="d-flex justify-content-center">
    	<div id="pdf-container"></div>
    </div>
    
    <div class="text-center mt-4">
      <button id="prev-button" class="btn btn-primary">Previous</button>
      <span id="page-number"></span>
      <button id="next-button" class="btn btn-primary">Next</button>
    </div> -->
 <div class="row mt-5">
    	<div class="col-lg-3 ">
    	</div>
      <div class="col-lg-6 ">
       <img class="img-fluid rounded w-100 mb-4" src="<?= ROOT ?>/assets/images/brochure/Symposium 4.0_page-0001.webp" alt="Image1">
      </div>
      <div class="col-lg-3 ">
    	</div>
    </div>

    <div class="row ">
    	<div class="col-lg-3 ">
    	</div>
      <div class="col-lg-6 ">
       <img class="img-fluid rounded w-100 mb-4" src="<?= ROOT ?>/assets/images/brochure/Symposium 4.0_page-0002.webp" alt="Image2">
      </div>
      <div class="col-lg-3 ">
    	</div>
    </div>

    <div class="row ">
    	<div class="col-lg-3 ">
    	</div>
      <div class="col-lg-6 ">
       <img class="img-fluid rounded w-100 mb-4" src="<?= ROOT ?>/assets/images/brochure/Symposium 4.0_page-0003.webp" alt="Image3">
      </div>
      <div class="col-lg-3 ">
    	</div>
    </div>

    <div class="row ">
    	<div class="col-lg-3 ">
    	</div>
      <div class="col-lg-6 ">
       <img class="img-fluid rounded w-100 mb-4" src="<?= ROOT ?>/assets/images/brochure/Symposium 4.0_page-0004.webp" alt="Image4">
      </div>
      <div class="col-lg-3 ">
    	</div>
    </div>

     
  </div>
</div>
<!-- About End -->


  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
 <script src="pdf/pdf.worker.js"></script>
 <script src="pdf/pdf.js"></script>
   <script>
  // PDF.js code
  document.addEventListener('DOMContentLoaded', function() {
    var pdfContainer = document.getElementById('pdf-container');
    var pageNumberSpan = document.getElementById('page-number');
    var prevButton = document.getElementById('prev-button');
    var nextButton = document.getElementById('next-button');
    var pdfURL = 'decyen/full-brochure.pdf'; // Replace with the path to your PDF file
    var currentPage = 1;
    var pdfInstance = null;

    // Load the PDF file
    pdfjsLib.getDocument(pdfURL).promise.then(function(pdf) {
      pdfInstance = pdf;
      renderPage(currentPage);
      updateButtons();
      updatePageNumber();
    });

    // Event listeners for button clicks
    prevButton.addEventListener('click', function() {
      if (currentPage > 1) {
        currentPage--;
        renderPage(currentPage);
        updateButtons();
        updatePageNumber();
      }
    });

    nextButton.addEventListener('click', function() {
      if (currentPage < pdfInstance.numPages) {
        currentPage++;
        renderPage(currentPage);
        updateButtons();
        updatePageNumber();
      }
    });

    // Function to render a specific page
    function renderPage(pageNumber) {
      pdfInstance.getPage(pageNumber).then(function(page) {
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        var viewport = page.getViewport({ scale: 2 }); // Adjust the scale value for better readability

        // Set the canvas dimensions to match the PDF page
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        // Render the PDF page onto the canvas
        page.render({ canvasContext: context, viewport: viewport, renderInteractiveForms: true, enableWebGL: true }).promise.then(function() {
          // Clear previous canvas if any
          pdfContainer.innerHTML = '';
          pdfContainer.appendChild(canvas);
        });
      });
    }

    // Function to update the state of the navigation buttons
    function updateButtons() {
      prevButton.disabled = currentPage === 1;
      nextButton.disabled = currentPage === pdfInstance.numPages;
    }

    // Function to update the page number display
    function updatePageNumber() {
      pageNumberSpan.textContent = 'Page ' + currentPage + ' of ' + pdfInstance.numPages;
    }
  });
</script>