<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links of CSS files -->
    <?php require '../includes/linkHeads.php'; ?>

    <title>Studio Library</title>
</head>

<body>

    <!-- Start Preloader Area -->
    <div class="preloader-area">
        <div class="spinner">
            <div class="inner">
                <div class="disc"></div>
                <div class="disc"></div>
                <div class="disc"></div>
            </div>
        </div>
    </div>
    <!-- End Preloader Area -->

    <!-- Start Main Content Wrapper Area -->
    <div class="main-content-wrapper d-flex flex-column">

        <!-- Start Navbar Area -->
        <?php require '../includes/navbar.php'; ?>
        <!-- End Navbar Area -->

        <!-- Start Sidemenu Area -->
        <div class="sidemenu-area">
            <div class="responsive-burger-menu d-lg-none d-block">
                <span class="top-bar"></span>
                <span class="middle-bar"></span>
                <span class="bottom-bar"></span>
            </div>

            <div class="sidemenu-body">
                <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>
                    <li class="nav-item">
                        <a href="index.html" class="nav-link">
                            <span class="icon"><i class="flaticon-newspaper"></i></span>
                            <span class="menu-title">Studio</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.html" class="nav-link">
                            <span class="icon"><i class="flaticon-newspaper"></i></span>
                            <span class="menu-title">Library</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.html" class="nav-link">
                            <span class="icon"><i class="flaticon-newspaper"></i></span>
                            <span class="menu-title">Separate</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Sidemenu Area -->

        <!-- Start Content Page Box Area -->
        <div class="nav-align-top">
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">Records</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">Saved Tracks</button>
    </li>
   
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
    <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Track</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span class="fw-medium">Angular Project</span></td>
        <td>Albert Cook</td>
        <td>
          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
              <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
            </li>
           
          </ul>
        </td>
        
        <td>
          <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>Edit</a>
              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>Delete</a>
            </div>
          </div>
        </td>
      </tr>
      
    </tbody>
  </table>
      
    </div>
    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
    <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span class="fw-medium">Angular Project</span></td>
        <td>Albert Cook</td>
       
        
        <td>
          <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>Edit</a>
              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>Delete</a>
            </div>
          </div>
        </td>
      </tr>
      
    </tbody>
  </table>
    </div>
    <audio class="w-100" id="plyr-audio-player" controls>
  <source src="./assets/audio/Water_Lily.mp3" type="audio/mp3" />
</audio>
  </div>
</div>
    <!-- End Main Content Wrapper Area -->
  
    <!-- Start Go Top Area -->
    <div class="go-top">
        <i class="ri-arrow-up-line"></i>
    </div>
    <!-- End Go Top Area -->

    <!-- Links of JS files -->
    <?php require '../includes/linkScripts.php';?>
    <script>
        const middleDiv = document.getElementById('middleDiv');
        const rightChatArea = document.getElementById('rightChatArea');
        const audioPlayer = new Plyr('#plyr-audio-player');

        function handleScroll() {
            const rect = middleDiv.getBoundingClientRect();
            const top = rect.top;
            

            // Check viewport width
            if (window.innerWidth >= 992) {
                if (top <= 5 * parseFloat(getComputedStyle(document.documentElement).fontSize)) {
                    rightChatArea.style.position = 'fixed';
                    rightChatArea.style.top = '4.9rem';
                    rightChatArea.style.right = '2.32rem';
                    console.log('fixed' + top);
                } else {
                    rightChatArea.style.position = 'relative';
                    rightChatArea.style.top = 'auto';
                    rightChatArea.style.right = 'auto';
                    console.log('relative' + top);
                }
            }
            if (window.innerWidth < 992 && window.innerWidth > 767) {
                rightChatArea.style.position = 'fixed';
                rightChatArea.style.top = '4.9rem';
                rightChatArea.style.right = '1%';
            } else {
                // Reset styles if viewport width is less than 992px
                rightChatArea.style.position = 'relative';
                rightChatArea.style.top = 'auto';
                rightChatArea.style.right = 'auto';
            }

        }

        window.addEventListener('scroll', handleScroll);
        window.addEventListener('resize', handleScroll); // Handle resize events to adjust behavior dynamically
    </script>
</body>

</html>