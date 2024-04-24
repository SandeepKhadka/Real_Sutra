@yield('scripts')

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<!-- Add Bootstrap JS link -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var dropdown = document.getElementById("custom-hover-dropdown");

        dropdown.addEventListener("mouseenter", function() {
            this.querySelector(".dropdown-menu").style.display = "block";
        });

        dropdown.addEventListener("mouseleave", function() {
            this.querySelector(".dropdown-menu").style.display = "none";
        });

        var dropdownMenu = dropdown.querySelector(".dropdown-menu");
        dropdownMenu.addEventListener("mouseenter", function() {
            this.style.display = "block";
        });

        dropdownMenu.addEventListener("mouseleave", function() {
            this.style.display = "none";
        });
    });
</script>

<script>
    document.addEventListener('click', function(event) {
        var dropdown = document.querySelector('.dropdown-content');
        var userDropdown = document.querySelector('.user-dropdown');

        if (!userDropdown.contains(event.target)) {
            // Clicked outside the user-dropdown, hide the dropdown
            dropdown.style.display = 'none';
        }
    });

    function toggleDropdown() {
        var dropdown = document.querySelector('.dropdown-content');
        dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
    }
</script>



</body>

</html>
