<!doctype html>
<html class="fixed">

<head>

 @include('admin.inc.head')

</head>

<body>
    <section class="body">

        <!-- start: header -->
        <header class="header">
            @include('admin.inc.nav')
        </header>
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
                @include('admin.inc.side')
            <!-- end: sidebar -->

            <section role="main" class="content-body">
                @include('admin.inc.header')

                <!-- start: page -->
                @section('main-section')
                    
                @show
                <!-- end: page -->
            </section>
        </div>

    </section>

    @include('admin.inc.footer')
</body>

</html>