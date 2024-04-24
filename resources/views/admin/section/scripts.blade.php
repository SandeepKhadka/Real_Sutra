<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
{{-- <div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div> --}}
<!-- END PAGA BACKDROPS-->

<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../../../template/admin/assets/vendors/jquery/dist/jquery.min.js"></script>
{{-- <script type="text/javascript" data-keditor="script" src="@vite('resources/js/admin.js')"> --}}
{{-- <script src=" @vite(['resources/css/admin.css', 'resources/js/admin.js'])"> --}}

@yield('scripts')
<script>
    function toggleLogoutDropdown() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('show');
    }
</script>

{{-- <script>
    function openBannerFormModal() {
        $('#bannerFormModal').modal('show');
        // Load the banner form content using AJAX and insert it into modal-content div
        $.get("{{ route('banner.create') }}", function(data) {
            $('#bannerFormModal .modal-content').html(data);
        });
    }
</script> --}}
</body>

</html>
