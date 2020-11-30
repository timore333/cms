@Include('layouts.partials.head')

<body class="skin-default-dark fixed-layout">

@include('layouts.partials.preloader')

<div id="main-wrapper">

@Include('layouts.partials.topbar.main')
@Include('layouts.partials.sidebar.left_side_bar')

<!-- Page wrapper  -->
    <div class="page-wrapper">

        <div class="container-fluid">
{{--        @Include('layouts.partials.bread_crumb')--}}

        <!-- Page content  -->
            @inertia

            @Include('layouts.partials.right_side_bar')
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Page wrapper  -->

    @Include('layouts.partials.footer')
</div>
@Include('layouts.partials.scripts')

</body>
</html>
