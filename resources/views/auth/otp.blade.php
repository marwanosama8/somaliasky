@extends('layouts.app')

@section('content')
    {{-- <center>
        <div class="tw-m-auto">
            <h3 class="tw-py-10 tw-font-bold tw-text-xl">تفعيل رقم الموبايل</h3>
            <div class="tw-flex tw-w-1/3" style="justify-content: center">
                <input type="text" id="default-input" placeholder="..."
                    class="tw-bg-gray-50 tw-border w-25  tw-text-center tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-block tw-w-full tw-p-2.5 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:ring-blue-500 dark:focus:tw-border-blue-500">
            </div>
            <a href="#" class="">
                <div class="tw-my-10 tw-py-3 w-25 tw-px-6 tw-bg-primary tw-font-bold tw-text-white tw-rounded-md tw-w-1/3">
                    تأكيد رمز التفعيل </div>
            </a>
            <a href="#" class="tw-w-[28%] tw-font-bold">
                اضغط هنا لإعادة إرسال رمز التفعيل </a>
        </div>
    </center> --}}
    <div class="container mt-5" style="max-width: 550px">
        <div class="alert alert-danger" id="error" style="display: none;"></div>
        <h3>{{__('lang.sendOTP')}}</h3>
        <div class="alert alert-success" id="successAuth" style="display: none;"></div>
        <form>
            <label>{{__('lang.addPhone')}}</label>
            <input type="text" id="number" class="form-control" value="{{ $number }}" placeholder="+91 ********">
            <div id="recaptcha-container"></div>
            <div class="row d-flex justify-content-center">

                <button type="button" class="btn btn-primary mt-3" onclick="sendOTP();">{{__('lang.sendIt')}}</button>
            </div>
        </form>

        <div class="mb-5 mt-5">
            <h3>{{__('lang.verfiyCode')}}</h3>
            <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
            <form>
                <input type="text" id="verification" class="form-control" placeholder="Verification code">
                <div class="row d-flex justify-content-center">
                    <button type="button" class="btn btn-primary mt-3" onclick="verify()">{{__('lang.verfiyIt')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"
    integrity="sha512-zJYu9ICC+mWF3+dJ4QC34N9RA0OVS1XtPbnf6oXlvGrLGNB8egsEzu/5wgG90I61hOOKvcywoLzwNmPqGAdATA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const firebaseConfig = {
        apiKey: "AIzaSyD6bK8eXFixLFgHBANFxZ2AcVdnXVadZs4",
        authDomain: "firstsooq-44f00.firebaseapp.com",
        projectId: "firstsooq-44f00",
        storageBucket: "firstsooq-44f00.appspot.com",
        messagingSenderId: "374147529857",
        appId: "1:374147529857:web:f5f71ac49bb2e40b17e180"
    };
    firebase.initializeApp(firebaseConfig);
</script>
<script type="text/javascript">
    window.onload = function() {
        render();
    };

    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }

    function sendOTP() {
        var number = $("#number").val();
        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult) {
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            console.log(coderesult);
            $("#successAuth").text("Message sent");
            $("#successAuth").show();
        }).catch(function(error) {
            $("#error").text(error.message);
            $("#error").show();
        });
    }

    function verify() {
        var code = $("#verification").val();
        confirmationResult.confirm(code).then(function(result) {
            try {
                axios.get('save-otp')
                console.log('api done')
                window.location.replace("register");

            } catch (error) {
                console.log(error)
            }
        }).catch(function(error) {
            $("#error").text(error.message);
            $("#error").show();
        });
    }
</script>

<script src="{{ asset('/new/assets/js/flowbite.js') }}"></script>
