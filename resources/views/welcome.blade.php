<!doctype html>
<html lang="en">

@include('partials.head')

<body class="font-sans antialiased">

    @section('title', 'Jägermeister game')


    <div class="cover position-relative" style="background-image: url({{ $cover }})">
        <img src="{{asset('images/stag.png')}}" alt="stag" class="logo img">
        <div class="title" id="title" data-bs-toggle="modal" data-bs-target="#modalJegger">
            <h2 class="text-center pt-4 mb-1 c-text">For the loyal stags!</h2>
            <h5 class="text-center c-text font-italic">Click here</h5>
        </div>

        <div class="lds-roller d-none" id="loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div id="casing" class="">
        <div id="clock"><span id="timerText">Time remaining: </span><span id="timer"></span></div>
    </div>
    <!-- Modal form-->
    <div class="modal fade" id="modalJegger" tabindex="-1" aria-labelledby="modalJeggerLabel" aria-hidden="true">
        <div class="modal-dialog border-1">
            <div class="modal-content transparent">
                <div class="modal-header">
                    <h5 class="modal-title text-center c-text" id="staticBackdropLabel" style="font-family: sans-serif">
                        Fill the form to enter the game</h5>
                </div>
                <div class="modal-body" id='modal-body'>
                    <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data"
                        id="submitForm">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="w-100">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="name@example.com">
                                <label for="email" class="c-text h5 my-1 d-none" id="emailLabel">Please enter valid
                                    email</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-file w-100">
                                <input type="file" class="form-control w-100" name="file" id="file">
                                <label for="file" class="c-text h5 my-1 d-none" id="chooseFileLabel">Please Attach
                                    File</label>
                                <label for="file" class="c-text h5 my-1 text-bold d-none" id="chooseFileType">Attach
                                    valid format of image(jpg, jpeg, gif, pdf, etc.)</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-jeger" id="btnSubmit">Upload
                                files</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal message-->
    <div class="modal fade " id="modalResponse" tabindex="-1" aria-labelledby="modalJeggerLabel" aria-hidden="true">
        <div class="modal-dialog border-1">
            <div class="modal-content transparent">
                <div class="modal-body modalBodyResponse">
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
</body>

</html>