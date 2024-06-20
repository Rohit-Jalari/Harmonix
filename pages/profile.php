<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links of CSS files -->
    <?php require '../includes/linkHeads.php'; ?>

    <title>My Proflie</title>
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
                            <span class="menu-title">News Feed</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="notifications.html" class="nav-link">
                            <span class="icon"><i class="flaticon-bell"></i></span>
                            <span class="menu-title">Notifications</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="messages.html" class="nav-link">
                            <span class="icon"><i class="flaticon-comment-1"></i></span>
                            <span class="menu-title">Messages</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="friends.html" class="nav-link">
                            <span class="icon"><i class="flaticon-friends"></i></span>
                            <span class="menu-title">Friends</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="groups.html" class="nav-link">
                            <span class="icon"><i class="flaticon-team"></i></span>
                            <span class="menu-title">Groups</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="favorite.html" class="nav-link">
                            <span class="icon"><i class="flaticon-star"></i></span>
                            <span class="menu-title">Favorite</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="events.html" class="nav-link">
                            <span class="icon"><i class="flaticon-calendar"></i></span>
                            <span class="menu-title">Events</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="live-chat.html" class="nav-link">
                            <span class="icon"><i class="flaticon-live-chat"></i></span>
                            <span class="menu-title">Live Chat</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="birthday.html" class="nav-link">
                            <span class="icon"><i class="flaticon-cake"></i></span>
                            <span class="menu-title">Birthday</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="video.html" class="nav-link">
                            <span class="icon"><i class="flaticon-video"></i></span>
                            <span class="menu-title">Video</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="weather.html" class="nav-link">
                            <span class="icon"><i class="flaticon-cloudy"></i></span>
                            <span class="menu-title">Weather</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="marketplace.html" class="nav-link">
                            <span class="icon"><i class="flaticon-online-shopping"></i></span>
                            <span class="menu-title">Marketplace</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="login.html" class="nav-link">
                            <span class="icon"><i class="flaticon-user"></i></span>
                            <span class="menu-title">Login</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="register.html" class="nav-link">
                            <span class="icon"><i class="flaticon-information"></i></span>
                            <span class="menu-title">Register</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Sidemenu Area -->

        <!-- Start Content Page Box Area -->
        <div class="content-page-box-area">
            <div class="my-profile-inner-box">
                <div class="profile-cover-image">
                    <a href="#">
                        <img src="../assets/images/my-profile-bg.jpg" alt="image">
                    </a>
                    <a href="#" class="edit-cover-btn">Edit Cover</a>
                </div>

                <div class="profile-info-box">
                    <div class="inner-info-box d-flex justify-content-between align-items-center">
                        <div class="info-image">
                            <a href="#">
                                <img src="../assets/images/my-profile.jpg" alt="image">
                            </a>
                            <div class="icon">
                                <a href="#"><i class="flaticon-photo-camera"></i></a>
                            </div>
                        </div>
                        <div class="info-text ms-3">
                            <h3><a href="#">Matthew Turner</a></h3>
                            <span><a href="/cdn-cgi/l/email-protection#127f7366667a776552757f737b7e3c717d7f"><span class="__cf_email__" data-cfemail="96fbf7e2e2fef3e1d6f1fbf7fffab8f5f9fb">[email&#160;protected]</span></a></span>
                        </div>
                        <ul class="statistics">
                            <li>
                                <a href="#">
                                    <span class="item-number">59862</span>
                                    <span class="item-text">Likes</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="item-number">8591</span>
                                    <span class="item-text">Following</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="item-number">784514</span>
                                    <span class="item-text">Followers</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="profile-list-tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="timeline-tab" data-bs-toggle="tab" href="#timeline" role="tab" aria-controls="timeline">Timeline</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="about-tab" data-bs-toggle="tab" href="#about" role="tab" aria-controls="about">About</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="friends-tab" data-bs-toggle="tab" href="#friends" role="tab" aria-controls="friends">Friends</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="photos-tab" data-bs-toggle="tab" href="#photos" role="tab" aria-controls="photos">Photos</a>
                            </li>
                        </ul>
                    </div>

                    <?php require '../includes/social-link.php';?>
                </div>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="timeline" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-8 col-md-12" id="middleDiv">
                            <div class="news-feed-area">
                                <?php require '../includes/createPost.php';?>

                                <?php require '../includes/my-Posts.php';?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <!-- right side friend online status bar start-->
                            <?php require '../includes/rightFriendOnlineStatus.php'; ?>
                            <!-- righ side friend online status bar end-->
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="about" role="tabpanel">
                    <?php require '../includes/info-aboutPersonal.php';?>
                </div>

                <div class="tab-pane fade" id="friends" role="tabpanel">
                    <?php require '../includes/info-Friends.php';?>
                </div>

                <div class="tab-pane fade" id="photos" role="tabpanel">
                    <?php require '../includes/info-Photos.php'; ?>
                </div>
            </div>
        </div>
        <!-- End Content Page Box Area -->

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