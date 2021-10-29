<!-- Footer-->
<footer class="bg-black text-center py-5">
    <div class="container px-5">
        <div class="text-white-50 small">
            <div class="mb-2">&copy; ScooterRent 2021. All Rights Reserved.</div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@if (old('itIsRegistration') || old('itIsLogin'))
    <script>
        const popUp = new bootstrap.Modal(document.querySelector('#popUp'));
        popUp.show();
    </script>
@endif
</body>
</html>
