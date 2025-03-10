<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Order Details | Imperial Fiber Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Abdul Rauf" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="icon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <!-- App css -->
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/config.js"></script>
</head>
<style>
    .success-tick {
  width: 60px;
  height: 60px;
  position: relative;
}
.success {
  color: rgb(13, 226, 13);
}
.tick {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  border: 3px solid green;
  position: absolute;
  left: 0;
  top: 0;
  animation: fill 3s ease-in-out forwards;
  animation-delay: 0.3s;
}

@keyframes fill {
  0% {
      transform: scale(0);
  }

  50% {
      transform: scale(1.2);
      border-color: rgb(1, 156, 1);
  }

  100% {
      transform: scale(1);
      background-color: rgb(3, 151, 3);
  }
}
</style>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- ========== Left Sidebar ========== -->
        @include('nav')



        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- ========== Topbar Start ========== -->
            @include('topnav')
            <!-- ========== Topbar End ========== -->

            <div class="px-3">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="py-3 py-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="page-title mb-0">Order Details</h4>
                            </div>
                            <div class="col-lg-6">
                               <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Imperial Fiber Portal</a></li>
                                    <li class="breadcrumb-item active">Order Details</li>
                                </ol>
                               </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row g-4">

                    <div class="col-12 col-md-12 col-sm-12 d-flex flex-column align-items-center">
                    <div class="success-tick">
                <div class="tick d-flex justify-content-center align-items-center"><i class="bi bi-check2 text-white fs-2"></i></div>
            </div>
                        <h4 class="checkout fw-bold mt-2">Thank You,</h4>
                        <p class="fs-5 text-center">Your order has been placed successfully</p>
                    </div>

                    <div class="col-12 col-md-12 col-sm-12 ">
                        <div class=" shadow mt-3 rounded p-3 border d-flex justify-content-between">
                        <span class="product-heading">Your Order is <span class=" thankyou-span rounded product-heading">Accepted</span></span><span class="product-heading">Transaction ID: <span class="fw-bold product-heading">123</span></span>
                    </div></div>
                    <!-- Write Code Here -->
                    <div class="col-12 col-md-6 col-sm-12 ">
                        <div class="card shadow thanks-card h-100 p-3">
                            <div><span class="fs-5"><img src="location-pin.webp" class="img-fluid" alt=""> Order Information:</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span>Busniess Name</span> <span>asd</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span>Busniess Name</span> <span>asd</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span>Busniess Name</span> <span>asd</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span>Busniess Name</span> <span>asd</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span>Busniess Name</span> <span>asd</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span>Busniess Name</span> <span>asd</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span>Busniess Name</span> <span>asd</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span>Busniess Name</span> <span>asd</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span>Busniess Name</span> <span>asd</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span>Payment Type</span> <span class="fw-bold">PAYPAL</span></div>

                        </div>
                    </div>


                    <div class="col-12 col-md-6 col-sm-12 ">
                        <div class="card shadow thanks-card p-3 h-100">
                            <div><span class="fs-5"><img src="payment-hand.webp" class="img-fluid" alt=""> Payment</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span>Sub Total</span> <span>$123</span></div>
                            <div class="thanks-li product-heading d-flex justify-content-between mt-2"><span class="fs-5 fw-bold">Total</span> <span class="fs-5 fw-bold">$123 </span></div>

                        </div>
                    </div>
                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->

            @include('footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- App js -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>





</body>

</html>
