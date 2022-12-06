<footer>
    @include('partials.scripts')
    <!-- <script src="{{ asset('js/modal.js')}}"></script> -->

    <script>
    if (localStorage.getItem("count_timer")) {
        var count_timer = localStorage.getItem("count_timer");
    } else {
        var count_timer = 8;
    }
    var hours = Math.floor(count_timer / 3600) % 60;
    var minutes = Math.floor(count_timer / 60) % 60;
    var seconds = count_timer % 60;

    function countDownTimer() {
        if (seconds < 10) {
            seconds = "0" + seconds;
        }
        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        if (hours < 10) {
            hours = "0" + hours;
        }

        document.getElementById("timer").innerHTML = hours + " : " + minutes + " : " + seconds + " !";
        if (count_timer <= 0) {
            localStorage.clear("count_timer");
            document.getElementById('casing').classList.add('d-none');
            localStorage.setItem('attempts', 3);
            window.location.reload();
        } else {
            count_timer = count_timer - 1;
            hours = Math.floor(count_timer / 3600) % 60;
            minutes = Math.floor(count_timer / 60) % 60;
            seconds = count_timer % 60;
            localStorage.setItem("count_timer", count_timer);
            setTimeout("countDownTimer()", 1000);
        }
    }
    // setTimeout("countDownTimer()", 1000);

    function decreaseStorage() {
        let counter = localStorage.getItem('attempts');
        if (counter == 3 || counter > 1) {
            counter -= 1;
            localStorage.setItem('attempts', counter);
            msg('Attempts left: ' + counter);
            document.getElementById('casing').classList.add('d-none');
        } else if (counter == 1) {
            counter -= 1;
            localStorage.setItem('attempts', counter);
            msg('Three strikes and you are out - 24h.');
            document.getElementById('casing').classList.remove('d-none');
            setTimeout("countDownTimer()", 1000);
        }

    }
    </script>


    <script>
    //USER SIDE FORM
    const form = document.getElementById('submitForm');
    form.addEventListener('submit', function(e) {
        reset();
        e.preventDefault();
        document.getElementById('emailLabel').classList.add('d-none');
        document.getElementById('chooseFileLabel').classList.add('d-none');
        document.getElementById('chooseFileType').classList.add('d-none');
        const emailRegex = new RegExp(
            /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum)$/
        );
        const email = document.getElementById('email').value;
        const isValidEmail = emailRegex.test(email);
        if (isValidEmail == false) {
            document.getElementById('emailLabel').classList.remove('d-none');
            document.getElementById('emailLabel').classList.add('d-block');
            return;
        }

        if (document.getElementById("file").files.length == 0) {
            document.getElementById('chooseFileLabel').classList.remove('d-none');
            document.getElementById('chooseFileLabel').classList.add('d-block');
            return;
        }
        var file = document.getElementById('file');
        if (/\.(jpe?g|png|gif|tiff|pdf)$/i.test(file.files[0].name) === false) {
            document.getElementById('chooseFileType').classList.remove('d-none');
            document.getElementById('chooseFileType').classList.add('d-block');
            return
        }
        //AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let formData = new FormData(this);
        $('#file-input-error').text('');
        $('#modalJegger').modal('hide');
        startLoader();
        $.ajax({
            type: 'POST',
            url: "{{ route('file.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.success == 1) {
                    this.reset();
                    endLoader();
                    msg('Good luck!');
                } else if (response.success == 0) {
                    this.reset();
                    endLoader();
                    msg('The receipt was not valid. Try another.');
                    setTimeout(decreaseStorage, 2500);
                   
                } else if (response.success == 2) {
                    this.reset();
                    endLoader();
                    msg('Something went wrong. Try again.');
                }
            },
            error: (response) => {
                if (response == 3) {
                    this.reset();
                    endLoader();
                    msg('Something went wrong with our database. Try again later.');
                }
            }
        });
    });
    </script>
</footer>