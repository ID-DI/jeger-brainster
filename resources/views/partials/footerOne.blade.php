<div>
    @include('partials.scripts')
    <script>
    var csrftoken = '{{ csrf_token() }}';
    </script>
    <script src="{{ asset('js/modal.js')}}" defer></script>

    <script>
    function getAJAX(route, action, classy) {
        return new Promise(resolve => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: route,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    cards(res, action, classy);
                }
            });
        });
    }
    </script>

    <script>
    //APPROVE FORM
    const formApprove = document.getElementById('approveForm');
    formApprove.addEventListener('submit', function(e) {
        e.preventDefault();
        // AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let formDataApprove = new FormData(this);
        let id = document.getElementById('approveId').value;
        let counter = document.querySelectorAll("querryImg").length;
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.approve') }}",
            data: formDataApprove,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.success == 1) {
                    addApproveClass(id, 'approved');
                    hide(id);
                    location.reload();
                }
            },
            error: (response) => {
                msg('Something went terribly wrong with the base.');
            }
        })
    });
    </script>

    <script>
    //DECLINE FORM
    const formDecline = document.getElementById('declineForm');
    formDecline.addEventListener('submit', function(e) {
        e.preventDefault();
        //AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let formDataDecline = new FormData(this);
        let id = document.getElementById('declineId').value;
        let counter = document.querySelectorAll("querryImg").length;
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.decline') }}",
            data: formDataDecline,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.success == 1) {
                    if (counter > 1) {
                        hide(id);

                    } else if (counter <= 1) {
                        hide(id);
                        location.reload()
                    }
                }
            },
            error: (response) => {
                msg('Something went terribly wrong with the base.');
            }
        })
        counter = counter - 1
    });
    </script>


    <script>
    //APPROVED BUTTON
    const approved = document.getElementById('approvedBtn');
    approved.addEventListener('click', function() {
        document.getElementById('nest').innerHTML = '';
        let giveAward = document.getElementById('giveAward');
        giveAward.classList.remove('d-none');
        //AJAX
        changeTitle(`- Approved receipts -`);
        getAJAX("{{ route('admin.getApproved') }}", "approved", "d-none");
    });
    </script>

    <script>
    //DECLINED BUTTON
    const declined = document.getElementById('declinedBtn');
    declined.addEventListener('click', function() {
        document.getElementById('nest').innerHTML = '';
        let giveAward = document.getElementById('giveAward');
        giveAward.classList.add('d-none');
        //AJAX
        changeTitle(`- Declined receipts -`);
        getAJAX("{{ route('admin.getDeclined') }}", "declined", "");
    });
    </script>

    <script>
    // AWARDED BUTTON
    const awardedBtn = document.getElementById('awardedBtn');
    awardedBtn.addEventListener('click', function() {
        document.getElementById('nest').innerHTML = '';
        changeTitle(`- Awarded receipts -`);
        getAJAX("{{ route('admin.getAwarded') }}", 'awarded', 'd-none');
    });
    </script>

    <script>
    //GIVE AWARD BUTTON
    const award = document.getElementById('giveAward');
    award.addEventListener('click', function() {
        document.getElementById('nest').innerHTML = '';
        //AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('admin.giveAward') }}",
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                rewarded(res);
                let modalReward = document.getElementById('modalReward');
                modalReward.classList.add('d-block');
            }
        });
    });
    </script>

    <script>
    //WRITE REWARDED
    const formNotify = document.getElementById('rewardForm');
    formNotify.addEventListener('submit', function(e) {
        e.preventDefault();
        // AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let rewardForm = new FormData(this);
        let id = document.getElementById('receiptId').value;
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.notification') }}",
            data: rewardForm,
            contentType: false,
            processData: false,
            async: false,
            success: (response) => {
                if (response.success == 1) {
                    msg('Award was given successfully.');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            },
            error: (res) => {
                msg('Something went terribly wrong with the app.');
            }
        })
    });
    </script>

    <script>
    function declinedApproved() {
        console.log('peeeeer');
        const formDeclinedApproved = document.getElementById('declinedApprovedForm');
        formDeclinedApproved.addEventListener('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let id = document.getElementById('declAppId').value;
            let formDeclApp = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.declineApprove') }}",
                data: formDeclApp,
                contentType: false,
                processData: false,
                success: (response) => {
                    hide(id);
                    cards(response, 'approved', '')
              
                },
                error: (response) => {
                    msg('Something went terribly wrong with the base.');
                }
            })
        });
    }
    </script>

</div>