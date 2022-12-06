<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<script src="{{ asset('js/modal.js')}}"></script>
<script>
let isSet = (localStorage.getItem('attempts'))
if (isSet && (isSet > 0 || isSet == 3)) {
    localStorage.setItem('attempts', isSet);
     document.getElementById('casing').classList.add('d-none');
} else if (isSet && isSet == 0) {
    localStorage.setItem('attempts', isSet);
} else if(localStorage.getItem("attempts") === null){
    localStorage.setItem('attempts', 3);
    document.getElementById('casing').classList.add('d-none');
}
</script>