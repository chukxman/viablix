<!DOCTYPE html>
<html lang="en">
  <head>
    <title>OneSchool &mdash; Website by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <!-- <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


    

   
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25"><a href="{{rout('home')}}">Viabix</a></div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <!-- <li><a href="#home-section" class="nav-link">Home</a></li>
                <li><a href="#courses-section" class="nav-link">Courses</a></li>
                <li><a href="#programs-section" class="nav-link">Programs</a></li>
                <li><a href="#teachers-section" class="nav-link">Teachers</a></li> -->
              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                <li class="cta"><a href="#contact-section" class="nav-link"><span>Contact Us</span></a></li>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
      
    </header>

    <div class="intro-section single-cover" id="home-section">
      
      <div class="slide-1 " style="background-image: url('images/img_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row justify-content-center align-items-center text-center">
                <div class="col-lg-6">
                  <h1 data-aos="fade-up" data-aos-delay="0">Product Viablitity Accessment for {{$data['product']}}</h1>
                  <p data-aos="fade-up" data-aos-delay="100">For the cost of &bullet; {{$data['price']}}, in {{$data['region']}} &bullet; </p>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section">
      <div class="container">
        <div class="row">

            <div class="mb-5">
              
              <p class="mb-4">
                <strong class="text-black mr-3">Time: </strong> {{$data['time']}}
              </p>
              @if (isset($error))
                <p style="color: red;">{{ $error }}</p>
            @endif

            @if (isset($result))
                <h2>AI Generated Forecast</h2>

                @php
            // Extract generated text
            $generatedText = $result['results'][0]['generated_text'] ?? '';

            // Format text by breaking it into paragraphs and sections
            $sections = preg_split('/\n{2,}/', $generatedText); // Splitting by double newlines
          @endphp
                <div>
                    @foreach ($sections as $section)
                      @if (preg_match('/^\d+\. /', $section))  {{-- If it's a numbered list item --}}
                        <ul>
                          @foreach (preg_split('/\n/', $section) as $line)  {{-- Split by newlines within the section --}}
                            <li>{{ $line }}</li>
                          @endforeach
                        </ul>
                      @elseif (preg_match('/^[A-Z]+\./', $section))  {{-- If it's a section title like I. II. etc. --}}
                        <h4>{{ $section }}</h4>
                      @else  {{-- Regular paragraph --}}
                        <p>{{ $section }}</p>
                      @endif
                    @endforeach
                  </div>
            @endif
              {{-- <div class="row mb-4">
                <div class="col-md-6">
                  <img src="images/img_1.jpg" alt="Image" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                  <img src="images/img_2.jpg" alt="Image" class="img-fluid rounded">
                </div>
              </div>

               --}}
               <p class="mt-4"><a href="#" class="btn btn-primary" onclick="downloadAsPDF()">Download as PDF</a></p>
            </div>



          <!-- <div class="col-lg-4 pl-lg-5">

            <div class="mb-5 text-center border rounded course-instructor">
              <h3 class="mb-5 text-black text-uppercase h6 border-bottom pb-3">Course Instructor</h3>
              <div class="mb-4 text-center">
                <img src="images/person_2.jpg" alt="Image" class="w-25 rounded-circle mb-4">  
                <h3 class="h5 text-black mb-4">Christine Downeyy</h3>
                <p>Lorem ipsum dolor sit amet sectetur adipisicing elit. Ipsa porro expedita libero pariatur vero eos.</p>
              </div>
            </div>

          </div> -->
        </div>
      </div>
    </div>

    <footer class="footer-section bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h3>About Viabix</h3>
            <p>The best AI product viability accessment App</p>
          </div>

          <div class="col-md-3 ml-auto">
            <h3>Links</h3>
            <ul class="list-unstyled footer-links">
              <li><a href="#">Home</a></li>
              <!-- <li><a href="#">Courses</a></li>
              <li><a href="#">Programs</a></li>
              <li><a href="#">Teachers</a></li> -->
            </ul>
          </div>

          <div class="col-md-4">
            <h3>Subscribe</h3>
            <p>Subscribe to our newsletter</p>
            <form action="#" class="footer-subscribe">
              <div class="d-flex mb-5">
                <input type="text" class="form-control rounded-0" placeholder="Email">
                <input type="submit" class="btn btn-primary rounded-0" value="Subscribe">
              </div>
            </form>
          </div>

        </div>

        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  
    
  </div> <!-- .site-wrap -->
  <script>
    // Function to generate and download PDF using jsPDF
    function downloadAsPDF() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
  
      // Get the content of the product assessment
      let content = document.getElementById('assessment-content').innerText;
  
      // Add the content to the PDF document
      doc.text(content, 10, 10); // Adjust margins and placement as needed
  
      // Save the generated PDF with a filename
      doc.save('product_assessment.pdf');
    }
  </script>
  


  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>  
  <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>  
  <script src="{{ asset('js/jquery-ui.js') }}"></script>  
  <script src="{{ asset('js/popper.min.js') }}"></script>  
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>  
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>  
  <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>  
  <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>  
  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>  
  <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>  
  <script src="{{ asset('js/aos.js') }}"></script>  
  <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>  
  <script src="{{ asset('js/jquery.sticky.js') }}"></script>  
  <script src="{{ asset('js/main.js') }}"></script>  

  

  
    
  </body>
</html>