<!DOCTYPE html>
<html>
@include('partials.head')

<body>
    <h2 class="text-center text-capitalize">{{ $details['title'] }}</h2>

    <p class="text-center font-weight-bold">{{ $details['body'] }}</p>
   
    <p class="text-center font-weight-bold py-2">Thank you for being loyal stag.</p>
    <small class="font-weight-bold">Do not reply to this mail.</small class="font-weight-bold">

@include('partials.scripts')
</body>
</html>